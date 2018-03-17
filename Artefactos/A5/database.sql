--
-- Tables
--
CREATE TABLE "Archive_project" (
    id_administrator integer NOT NULL,
    id_project integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL
);

CREATE TABLE "Ban_user" (
    id_user integer NOT NULL,
    id_administrator integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL
);

CREATE TABLE "Board" (
    id integer NOT NULL,
    description text,
    name text NOT NULL,
    id_creator integer NOT NULL,
    id_project integer NOT NULL
);

CREATE TABLE "Board_team" (
    id_board integer NOT NULL,
    id_user integer NOT NULL
);

CREATE TABLE "Comment" (
    id integer NOT NULL,
    comment text NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    id_task integer NOT NULL
);

CREATE TABLE "Contact" (
    id_user integer NOT NULL,
    id_contact integer NOT NULL
);

CREATE TABLE "File" (
    id integer NOT NULL,
    path text NOT NULL,
    publish_date timestamp without time zone DEFAULT now() NOT NULL,
    description text,
    id_user integer NOT NULL,
    id_task integer NOT NULL
);

CREATE TABLE "Meeting" (
    id integer NOT NULL,
    date timestamp without time zone NOT NULL,
    name text,
    place text,
    id_board integer NOT NULL,
    CONSTRAINT "CK1" CHECK ((date > now()))
);

CREATE TABLE "Message" (
    id integer NOT NULL,
    message text NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL,
    id_project integer NOT NULL
);

CREATE TABLE "Notification" (
    id integer NOT NULL,
    id_user integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    notification text NOT NULL,
    read boolean DEFAULT false NOT NULL
);

CREATE TABLE "Personal_event" (
    id integer NOT NULL,
    date timestamp without time zone NOT NULL,
    place text,
    name text,
    id_user integer NOT NULL,
    CONSTRAINT "CK1" CHECK ((date > now()))
);

CREATE TABLE "Profile_picture" (
    id integer NOT NULL,
    id_user integer NOT NULL,
    path text NOT NULL
);

CREATE TABLE "Progress_update" (
    id integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    new_value integer NOT NULL,
    id_user integer NOT NULL,
    id_task integer NOT NULL,
    CONSTRAINT "CK1" CHECK ((new_value > 0)),
    CONSTRAINT "CK2" CHECK ((new_value <= 100))
);

CREATE TABLE "Project" (
    id integer NOT NULL,
    description text,
    start_date timestamp without time zone DEFAULT now() NOT NULL,
    end_date date,
    name text NOT NULL,
    id_coordinator integer NOT NULL,
    state text DEFAULT 'In_progress' NOT NULL,
    privacy boolean DEFAULT false NOT NULL,
    CONSTRAINT "CK1" CHECK ((end_date > start_date)),
    CONSTRAINT "CK2" CHECK ((state = ANY (ARRAY['In_progress'::text, 'Closed'::text, 'Archived'::text])))
);

CREATE TABLE "Project_picture" (
    id integer NOT NULL,
    id_project integer NOT NULL,
    path text NOT NULL
);

CREATE TABLE "Project_team" (
    id_user integer NOT NULL,
    id_project integer NOT NULL
);

CREATE TABLE "Task" (
    id integer NOT NULL,
    budget money,
    deadline date NOT NULL,
    description text,
    name text NOT NULL,
    progress integer DEFAULT 0 NOT NULL,
    state text DEFAULT 'In_progress' NOT NULL,
    id_creator integer NOT NULL,
    id_board integer NOT NULL,
    CONSTRAINT "CK1" CHECK ((progress > 0)),
    CONSTRAINT "CK2" CHECK ((progress <= 100)),
    CONSTRAINT "CK3" CHECK ((state = ANY (ARRAY['In_progress'::text, 'Closed'::text, 'Archived'::text])))
);

CREATE TABLE "User" (
    id integer NOT NULL,
    "e-mail" text NOT NULL,
    full_name text,
    password text NOT NULL,
    "URL" text NOT NULL,
    username text NOT NULL,
    administrator boolean DEFAULT false NOT NULL
);

--
-- Primary Keys and Uniques
--
ALTER TABLE ONLY "Archive_project"
    ADD CONSTRAINT "Archive_project_pkey" PRIMARY KEY (id_administrator);

ALTER TABLE ONLY "Ban_user"
    ADD CONSTRAINT "Ban_user_pkey" PRIMARY KEY (id_user);

ALTER TABLE ONLY "Board"
    ADD CONSTRAINT "Board_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Board_team"
    ADD CONSTRAINT "Board_team_pkey" PRIMARY KEY (id_board, id_user);

ALTER TABLE ONLY "Comment"
    ADD CONSTRAINT "Comment_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Contact"
    ADD CONSTRAINT "Contact_pkey" PRIMARY KEY (id_user, id_contact);

ALTER TABLE ONLY "File"
    ADD CONSTRAINT "File_path_key" UNIQUE (path);

ALTER TABLE ONLY "File"
    ADD CONSTRAINT "File_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Meeting"
    ADD CONSTRAINT "Meeting_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Message"
    ADD CONSTRAINT "Message_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Notification"
    ADD CONSTRAINT "Notification_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Personal_event"
    ADD CONSTRAINT "Personal_event_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Profile_picture"
    ADD CONSTRAINT "Profile_picture_path_key" UNIQUE (path);

ALTER TABLE ONLY "Profile_picture"
    ADD CONSTRAINT "Profile_picture_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Progress_update"
    ADD CONSTRAINT "Progress_update_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Project_picture"
    ADD CONSTRAINT "Project_picture_path_key" UNIQUE (path);

ALTER TABLE ONLY "Project_picture"
    ADD CONSTRAINT "Project_picture_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Project"
    ADD CONSTRAINT "Project_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Project_team"
    ADD CONSTRAINT "Project_team_pkey" PRIMARY KEY (id_user, id_project);

ALTER TABLE ONLY "Task"
    ADD CONSTRAINT "Task_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_URL_key" UNIQUE ("URL");

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_e-mail_key" UNIQUE ("e-mail");

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_username_key" UNIQUE (username);

--
-- Foreign Keys
--
ALTER TABLE ONLY "Archive_project"
    ADD CONSTRAINT "Archive_project_id_administrator_fkey" FOREIGN KEY (id_administrator) REFERENCES "User"(id);

ALTER TABLE ONLY "Archive_project"
    ADD CONSTRAINT "Archive_project_id_project_fkey" FOREIGN KEY (id_project) REFERENCES "Project"(id);

ALTER TABLE ONLY "Ban_user"
    ADD CONSTRAINT "Ban_user_id_administrator_fkey" FOREIGN KEY (id_administrator) REFERENCES "User"(id);

ALTER TABLE ONLY "Ban_user"
    ADD CONSTRAINT "Ban_user_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Board"
    ADD CONSTRAINT "Board_id_creator_fkey" FOREIGN KEY (id_creator) REFERENCES "User"(id);

ALTER TABLE ONLY "Board"
    ADD CONSTRAINT "Board_id_project_fkey" FOREIGN KEY (id_project) REFERENCES "Project"(id);

ALTER TABLE ONLY "Board_team"
    ADD CONSTRAINT "Board_team_id_board_fkey" FOREIGN KEY (id_board) REFERENCES "Board"(id);

ALTER TABLE ONLY "Board_team"
    ADD CONSTRAINT "Board_team_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Comment"
    ADD CONSTRAINT "Comment_id_task_fkey" FOREIGN KEY (id_task) REFERENCES "Task"(id);

ALTER TABLE ONLY "Comment"
    ADD CONSTRAINT "Comment_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Contact"
    ADD CONSTRAINT "Contact_id_contact_fkey" FOREIGN KEY (id_contact) REFERENCES "User"(id);

ALTER TABLE ONLY "Contact"
    ADD CONSTRAINT "Contact_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "File"
    ADD CONSTRAINT "File_id_task_fkey" FOREIGN KEY (id_task) REFERENCES "Task"(id);

ALTER TABLE ONLY "File"
    ADD CONSTRAINT "File_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Meeting"
    ADD CONSTRAINT "Meeting_id_board_fkey" FOREIGN KEY (id_board) REFERENCES "Board"(id);

ALTER TABLE ONLY "Message"
    ADD CONSTRAINT "Message_id_project_fkey" FOREIGN KEY (id_project) REFERENCES "Project"(id);

ALTER TABLE ONLY "Message"
    ADD CONSTRAINT "Message_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Notification"
    ADD CONSTRAINT "Notification_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Personal_event"
    ADD CONSTRAINT "Personal_event_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Profile_picture"
    ADD CONSTRAINT "Profile_picture_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Progress_update"
    ADD CONSTRAINT "Progress_update_id_task_fkey" FOREIGN KEY (id_task) REFERENCES "Task"(id);

ALTER TABLE ONLY "Progress_update"
    ADD CONSTRAINT "Progress_update_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Project"
    ADD CONSTRAINT "Project_id_coordinator_fkey" FOREIGN KEY (id_coordinator) REFERENCES "User"(id);

ALTER TABLE ONLY "Project_picture"
    ADD CONSTRAINT "Project_picture_id_project_fkey" FOREIGN KEY (id_project) REFERENCES "Project"(id);

ALTER TABLE ONLY "Project_team"
    ADD CONSTRAINT "Project_team_id_project_fkey" FOREIGN KEY (id_project) REFERENCES "Project"(id);

ALTER TABLE ONLY "Project_team"
    ADD CONSTRAINT "Project_team_id_user_fkey" FOREIGN KEY (id_user) REFERENCES "User"(id);

ALTER TABLE ONLY "Task"
    ADD CONSTRAINT "Task_id_board_fkey" FOREIGN KEY (id_board) REFERENCES "Board"(id);

ALTER TABLE ONLY "Task"
    ADD CONSTRAINT "Task_id_creator_fkey" FOREIGN KEY (id_creator) REFERENCES "User"(id);