-- T01
BEGIN TRANSACTION
SET TRANSACTION --faltam aqui cenas

-- Insert new progress_update
INSERT INTO Progress_update (new_value, id_user, id_task)
VALUES ($new_value, $id_user, $id_task)

-- Update column progress in table Task
UPDATE Task
SET progress = $new_value
WHERE id = $id_task

COMMIT

-----------------------------------------------------
--T02
BEGIN TRANSACTION
SET TRANSACTION ---faltam cenas aqui

-- Insert new message
INSERT INTO Message (message, id_user, id_project)
VALUES ($message, $id_user, $id_project)

-- Select last messages
SELECT * 
    FROM Message
    WHERE Message.id_project=$projectId AND Message.date >= DATEADD(day, -7, GETDATE())

COMMIT

-----------------------------------------------------
--T03
BEGIN TRANSACTION
SET TRANSACTION -- faltam cenas aqui

-- Insert new task
INSERT INTO Task (description, name, id_creator, id_board, deadline, budget)
VALUES ($description, $name, $id_creator, $id_project, $deadline, $budget)

-- Select tasks from board
SELECT Task.id
    FROM Task
    WHERE Task.id_board=$boardId

COMMIT

----------------------------------------------------
-- T04
BEGIN TRANSACTION
SET TRANSACTION ---faltam cenas aqui

-- Insert new board
INSERT INTO Board (description, name, id_creator, id_project)
VALUES ($description, $name, $id_creator, $id_project)

-- Select boards from project and user
SELECT * FROM Board
    INNER JOIN Board_team ON Board.id=Board_team.id_board
    WHERE Board.id_project=$projectId AND Board_team.id_user=$id_user

COMMIT
