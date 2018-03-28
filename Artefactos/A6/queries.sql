-- Todos os e-mails
SELECT "e-mail" FROM "User"

-- Password de certo e-mail
SELECT password FROM "User"
    WHERE user.e-mail = $userEmail

-- Todos os projetos publicos
SELECT name FROM Project
    WHERE project.privacy=1

-- Todos os projetos de um utilizador
SELECT * 
    FROM Project
    INNER JOIN Project_team ON Project.id=Project_team.id_project
    WHERE Project.id_coordinator=$user OR Project_team.id_user=$user

-- Todos os eventos de um utilizador e das suas boards
SELECT * FROM Personal_event
    WHERE Personal_event.id_user=$user

SELECT *
    FROM Meeting
    INNER JOIN Board_team ON Meeting.id_board=Board_team.id_board
    WHERE Board_team.id_worker=$user

-- Toda a informação pessoal de um utilizador
SELECT * FROM "User"
    WHERE User.id=$user

-- Todas as notificações de um utilizador
SELECT * FROM Notification
    WHERE Notification.id_user=$user

-- Contar todas as notificações por ler de um utilizador
SELECT COUNT id
    FROM Notification
    WHERE Notification.id_user=$user AND Notification.read=0

-- Todas as boards do projeto em que o utilizador está incluído
SELECT *
    FROM Board
    WHERE Board.id_project=$projectId

-- Toda a informação de um projeto
SELECT * FROM Project
    WHERE Project.id=$projectId

-- Todos os users (nome, foto, mail) de um projeto
SELECT User.full_name, Profile_picture.path, User.e-mail
    FROM "User"
    INNER JOIN Profile_picture ON Profile_picture.id_user=$user
    WHERE Project.id=$projectId AND Profile_picture.path=SELECT(MAX(Profile_picture.id))

-- Todos os eventos do projeto
SELECT *
    FROM Meeting
    INNER JOIN Board ON Board.id=Meeting.id_board
    WHERE Board.id_project=$projectId

-- Todas as mensagens do projeto (última semana)
SELECT * 
    FROM Message
    WHERE Message.id_project=$projectId AND Message.date >= DATEADD(day, -7, GETDATE())

-- Todas as tasks de uma board
SELECT Task.id
    FROM Task
    WHERE Task.id_board=$boardId

-- Toda a informação de uma task
SELECT * 
    FROM Task
    WHERE Task.id=$taskId

-- Últimos 5 updates de uma task
SELECT TOP 5 Comment.id, File.id, Progress_update.id
    FROM Task
    INNER JOIN Comment ON Task.id=Comment.id_task
    INNER JOIN File ON Task.id=File.id_task
    INNER JOIN Task.id=Progress_update.id_task
    WHERE Task.id=$taskId
