-- T01
BEGIN TRANSACTION
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE

-- Archive project
UPDATE Project
SET project_state=$states
WHERE id=$id

-- Archive project boards
UPDATE Board
SET board_state=$states
WHERE id_project=$id

-- Archive board tasks
UPDATE Task
SET task_state=$states
INNER JOIN Board ON Board.id=Task.id_board
WHERE Board.id_project=$id

COMMIT

--------------------------------------------------------
--T02
BEGIN TRANSACTION
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE

-- Delete user
DELETE FROM User
WHERE id=$userID

-- Archive project
UPDATE Project
SET project_state='Archived'
WHERE id_coordinator=$userID

-- Archive project boards
UPDATE Board
SET board_state='Archived'
INNER JOIN Project ON Board.id_project=Project.id
WHERE Porject.id_coordinator=$userID

-- Archive board tasks
UPDATE Task
SET task_state='Archived'
INNER JOIN Board ON Board.id=Task.id_board
    INNER JOIN Project ON Project.id=Board.id_project
WHERE Project.id_coordinator=$userID

COMMIT

------------------------------------------------------------
--T03
BEGIN TRANSACTION
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY

-- Get number of unread notifications
SELECT COUNT id
    FROM Notification
    WHERE Notification.id_user=$user AND Notification.read=0

-- Get notifications
SELECT * FROM Notification
    WHERE Notification.id_user=$user

COMMIT