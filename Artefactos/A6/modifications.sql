-- New progress update
INSERT INTO Progress_update (new_value, id_user, id_task)
VALUES ($new_value, $id_user, $id_task)

-- Update task progress
UPDATE Task
SET progress = $progress

-- New file
INSERT INTO File (path, description, id_user, id_task)
VALUES ($path, $description, $id_user, $id_task)

-- New comment
INSERT INTO Comment (comment, id_user, id_task)
VALUES ($comment, $id_user, $id_task)

-- New personal event
INSERT INTO Personal_event (date, place, name, id_user)
VALUES ($date, $place, $name, $id_user)

-- New meeting
INSERT INTO Meeting (date, name, place, id_board)
VALUES ($date, $name, $place, $id_board)

-- New project
INSERT INTO Project (description, name, id_coordinator, privacy)
VALUES ($description, $name, $id_coordinator, $privacy)

-- New board
INSERT INTO Board (description, name, id_creator, id_project)
VALUES ($description, $name, $id_creator, $id_project)

-- Archive/close task
UPDATE Task
SET task_state=$task_state

-- Archive/close project
UPDATE Project
SET project_state=$project_state

-- New project worker
INSERT INTO Project_team (id_user, id_project)
VALUES ($id_user, $id_project)

-- New board worker
INSERT INTO Board_team (id_board, id_user)
VALUES ($id_board, $id_user)

-- New user
INSERT INTO User (e-mail, password, URL, username)
VALUES ($e-mail, $password, $URL, $username)

-- Update user info - full_name
UPDATE User
SET full_name=$full_name

-- Update user info - password
UPDATE User
SET password=$password

-- Update user info - administrator
UPDATE User
SET administrator=$administrator

-- Update user info - photo
INSERT INTO Profile_picture (id_user, path)
VALUES ($id_user, $path)

-- Update project info - description
UPDATE Project
SET description=$description

-- Update project info - end-date
UPDATE Project
SET end_date=$end_date

-- Update project info - photo
INSERT INTO Project_picture (id_project, path)
VALUES ($id_project, $path)

-- Add user to contacts
INSERT INTO Contact (id_user, id_contact)
VALUES ($id_user, $id_contact)

-- Send messages to project forum
INSERT INTO Message (message, id_user, id_project)
VALUES ($message, $id_user, $id_project)

-- New notification
INSERT INTO Notification (id_user, notification)
VALUES ($id_user, $notification)

-- Mark notification as read/unread
UPDATE Notification
SET read=$read