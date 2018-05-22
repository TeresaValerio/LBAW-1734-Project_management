DROP TABLE IF EXISTS Board_team CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS Contact CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS File CASCADE;
DROP TABLE IF EXISTS Meeting CASCADE;
DROP TABLE IF EXISTS Message CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Personal_event CASCADE;
DROP TABLE IF EXISTS Profile_picture CASCADE;
DROP TABLE IF EXISTS Progress_update CASCADE;
DROP TABLE IF EXISTS Project CASCADE;
DROP TABLE IF EXISTS Project_picture CASCADE;
DROP TABLE IF EXISTS Project_team CASCADE;
DROP TABLE IF EXISTS Task CASCADE;
DROP DOMAIN IF EXISTS state CASCADE;
DROP TABLE IF EXISTS Board CASCADE;

--
-- Domains
--

CREATE DOMAIN state AS TEXT
CHECK(
   VALUE ~ 'In_progress'
OR VALUE ~ 'Closed'
OR VALUE ~ 'Archived'
);

--
-- Tables
--

CREATE TABLE Board (
    id SERIAL NOT NULL,
    description text,
    name text NOT NULL,
    board_state state DEFAULT 'In_progress' NOT NULL,
    id_creator integer NOT NULL,
    id_project integer NOT NULL
    
);

CREATE TABLE Board_team (
    id_board integer NOT NULL,
    id_user integer NOT NULL
);

CREATE TABLE Comment (
    id SERIAL NOT NULL,
    comment text NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    id_task integer NOT NULL
);

CREATE TABLE Contact (
    id_user integer NOT NULL,
    id_contact integer NOT NULL
);

CREATE TABLE File (
    id SERIAL NOT NULL,
    path text NOT NULL,
    publish_date timestamp without time zone DEFAULT now() NOT NULL,
    description text,
    id_user integer NOT NULL,
    id_task integer NOT NULL
);

CREATE TABLE Meeting (
    id SERIAL NOT NULL,
    date timestamp without time zone NOT NULL,
    name text,
    place text,
    id_board integer NOT NULL,
    CONSTRAINT CK1 CHECK ((date > now()))
);

CREATE TABLE Message (
    id SERIAL NOT NULL,
    message text NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    id_project integer NOT NULL
);

CREATE TABLE Notification (
    id SERIAL NOT NULL,
    id_user integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    notification text NOT NULL,
    read boolean DEFAULT false NOT NULL
);

CREATE TABLE Personal_event (
    id SERIAL NOT NULL,
    date timestamp without time zone NOT NULL,
    place text,
    name text,
    id_user integer NOT NULL,
    CONSTRAINT CK1 CHECK ((date > now()))
);

CREATE TABLE Profile_picture (
    id SERIAL NOT NULL,
    id_user integer NOT NULL,
    path text NOT NULL
);

CREATE TABLE Progress_update (
    id SERIAL NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    new_value integer NOT NULL,
    id_user integer NOT NULL,
    id_task integer NOT NULL,
    CONSTRAINT CK1 CHECK ((new_value > 0)),
    CONSTRAINT CK2 CHECK ((new_value <= 100))
);

CREATE TABLE Project (
    id SERIAL NOT NULL,
    description text,
    start_date timestamp without time zone DEFAULT now() NOT NULL,
    end_date date,
    name text NOT NULL,
    id_coordinator integer NOT NULL,
    project_state state DEFAULT 'In_progress' NOT NULL,
    privacy boolean DEFAULT false NOT NULL,
    user_archived integer,
    CONSTRAINT CK1 CHECK ((end_date > start_date))
);

CREATE TABLE Project_picture (
    id SERIAL NOT NULL,
    id_project integer NOT NULL,
    path text NOT NULL
);

CREATE TABLE Project_team (
    id_user integer NOT NULL,
    id_project integer NOT NULL
);

CREATE TABLE Task (
    id SERIAL NOT NULL,
    budget money,
    deadline date NOT NULL,
    description text,
    name text NOT NULL,
    progress integer DEFAULT 0 NOT NULL,
    task_state state DEFAULT 'In_progress' NOT NULL,
    id_creator integer NOT NULL,
    id_board integer NOT NULL,
    CONSTRAINT CK1 CHECK ((progress > 0)),
    CONSTRAINT CK2 CHECK ((progress <= 100))
);

CREATE TABLE Users (
    id SERIAL NOT NULL,
    e_mail text NOT NULL,
    full_name text NOT NULL,
    password text NOT NULL,
    url SERIAL NOT NULL,
    username text NOT NULL,
    administrator boolean DEFAULT false NOT NULL,
    user_ban integer
);


--
-- Primary Keys and Uniques
--

ALTER TABLE ONLY Board
    ADD CONSTRAINT Board_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Board_team
    ADD CONSTRAINT Board_team_pkey PRIMARY KEY (id_board, id_user);

ALTER TABLE ONLY Comment
    ADD CONSTRAINT Comment_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Contact
    ADD CONSTRAINT Contact_pkey PRIMARY KEY (id_user, id_contact);

ALTER TABLE ONLY File
    ADD CONSTRAINT File_path_key UNIQUE (path);

ALTER TABLE ONLY File
    ADD CONSTRAINT File_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Meeting
    ADD CONSTRAINT Meeting_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Message
    ADD CONSTRAINT Message_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Notification
    ADD CONSTRAINT Notification_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Personal_event
    ADD CONSTRAINT Personal_event_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Profile_picture
    ADD CONSTRAINT Profile_picture_path_key UNIQUE (path);

ALTER TABLE ONLY Profile_picture
    ADD CONSTRAINT Profile_picture_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Progress_update
    ADD CONSTRAINT Progress_update_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_path_key UNIQUE (path);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Project
    ADD CONSTRAINT Project_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_pkey PRIMARY KEY (id_user, id_project);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_url_key UNIQUE (url);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_e_mail_key UNIQUE (e_mail);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_username_key UNIQUE (username);

--
-- Foreign Keys
--

ALTER TABLE ONLY Board
    ADD CONSTRAINT Board_id_creator_fkey FOREIGN KEY (id_creator) REFERENCES Users(id);

ALTER TABLE ONLY Board
    ADD CONSTRAINT Board_id_project_fkey FOREIGN KEY (id_project) REFERENCES Project(id);

ALTER TABLE ONLY Board_team
    ADD CONSTRAINT Board_team_id_board_fkey FOREIGN KEY (id_board) REFERENCES Board(id);

ALTER TABLE ONLY Board_team
    ADD CONSTRAINT Board_team_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Comment
    ADD CONSTRAINT Comment_id_task_fkey FOREIGN KEY (id_task) REFERENCES Task(id);

ALTER TABLE ONLY Comment
    ADD CONSTRAINT Comment_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Contact
    ADD CONSTRAINT Contact_id_contact_fkey FOREIGN KEY (id_contact) REFERENCES Users(id);

ALTER TABLE ONLY Contact
    ADD CONSTRAINT Contact_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY File
    ADD CONSTRAINT File_id_task_fkey FOREIGN KEY (id_task) REFERENCES Task(id);

ALTER TABLE ONLY File
    ADD CONSTRAINT File_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Meeting
    ADD CONSTRAINT Meeting_id_board_fkey FOREIGN KEY (id_board) REFERENCES Board(id);

ALTER TABLE ONLY Message
    ADD CONSTRAINT Message_id_project_fkey FOREIGN KEY (id_project) REFERENCES Project(id);

ALTER TABLE ONLY Message
    ADD CONSTRAINT Message_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Notification
    ADD CONSTRAINT Notification_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Personal_event
    ADD CONSTRAINT Personal_event_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Profile_picture
    ADD CONSTRAINT Profile_picture_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Progress_update
    ADD CONSTRAINT Progress_update_id_task_fkey FOREIGN KEY (id_task) REFERENCES Task(id);

ALTER TABLE ONLY Progress_update
    ADD CONSTRAINT Progress_update_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Project
    ADD CONSTRAINT Project_id_coordinator_fkey FOREIGN KEY (id_coordinator) REFERENCES Users(id);

ALTER TABLE ONLY Project
    ADD CONSTRAINT Project_user_archived_fkey FOREIGN KEY (user_archived) REFERENCES Users(id);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_id_project_fkey FOREIGN KEY (id_project) REFERENCES Project(id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_id_project_fkey FOREIGN KEY (id_project) REFERENCES Project(id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_id_board_fkey FOREIGN KEY (id_board) REFERENCES Board(id);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_id_creator_fkey FOREIGN KEY (id_creator) REFERENCES Users(id);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_user_ban_fkey FOREIGN KEY (user_ban) REFERENCES Users(id);




INSERT INTO Users (e_mail, password, username, full_name) VALUES ('carlasantos@gmail.com', 'palavrapasse1', 'CarlaS', 'Carla Santos');

INSERT INTO Project (description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES ('Projeto de LIEB para deteção de apneia do sono', TIMESTAMP '2018/03/04', timestamp '2019/05/18', 'Hypnos', 1, 'In_progress', true);

INSERT INTO Project (start_date, end_date, name, id_coordinator, project_state) VALUES (TIMESTAMP '2018/02/20', TIMESTAMP '2019/05/25 24:00:00', 'Fotopletismógrafo portátil', 1, 'In_progress');

INSERT INTO Users (e_mail, password, username, full_name) VALUES ('martins.577@gmail.com', 'palavrapasse2', 'TMartins', 'Tiago Martins');

INSERT INTO Project_team (id_user, id_project) VALUES (2,1);


