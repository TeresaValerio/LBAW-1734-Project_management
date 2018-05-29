DROP TABLE IF EXISTS Board CASCADE;
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
DROP TABLE IF EXISTS Projects CASCADE;
DROP TABLE IF EXISTS Project_picture CASCADE;
DROP TABLE IF EXISTS Project_team CASCADE;
DROP TABLE IF EXISTS Task CASCADE;
DROP DOMAIN IF EXISTS state CASCADE;

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

CREATE TABLE Projects (
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
    ADD CONSTRAINT Profile_picture_key PRIMARY KEY (id);

ALTER TABLE ONLY Progress_update
    ADD CONSTRAINT Progress_update_key PRIMARY KEY (id);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_path_key UNIQUE (path);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_key PRIMARY KEY (id);

ALTER TABLE ONLY Projects
    ADD CONSTRAINT Projects_key PRIMARY KEY (id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_key PRIMARY KEY (id_user, id_project);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_key PRIMARY KEY (id);

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
    ADD CONSTRAINT Board_id_project_fkey FOREIGN KEY (id_project) REFERENCES Projects(id);

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
    ADD CONSTRAINT Message_id_project_fkey FOREIGN KEY (id_project) REFERENCES Projects(id);

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

ALTER TABLE ONLY Projects
    ADD CONSTRAINT Project_id_coordinator_fkey FOREIGN KEY (id_coordinator) REFERENCES Users(id);

ALTER TABLE ONLY Projects
    ADD CONSTRAINT Project_user_archived_fkey FOREIGN KEY (user_archived) REFERENCES Users(id);

ALTER TABLE ONLY Project_picture
    ADD CONSTRAINT Project_picture_id_project_fkey FOREIGN KEY (id_project) REFERENCES Projects(id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_id_project_fkey FOREIGN KEY (id_project) REFERENCES Projects(id);

ALTER TABLE ONLY Project_team
    ADD CONSTRAINT Project_team_id_user_fkey FOREIGN KEY (id_user) REFERENCES Users(id);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_id_board_fkey FOREIGN KEY (id_board) REFERENCES Board(id);

ALTER TABLE ONLY Task
    ADD CONSTRAINT Task_id_creator_fkey FOREIGN KEY (id_creator) REFERENCES Users(id);

ALTER TABLE ONLY Users
    ADD CONSTRAINT User_user_ban_fkey FOREIGN KEY (user_ban) REFERENCES Users(id);

--
-- Indexes
--

-- User info
-- Index relation: user; index attribute: email
-- Type: hash; cardinality: high (unique key); clustering: no
CREATE INDEX email_user ON Users USING hash(e_mail);

-- Projects of a given user
-- Index relation: Project_team; index attribute: id_user
-- Type: hash; cardinality: medium; clustering: yes
CREATE INDEX user_project ON Project_team USING hash(id_user);

-- Boards of a given project
-- Index relation: Board; index attribute: id_project
-- Type: hash; cardinality: medium; clustering: yes
CREATE INDEX project_boards ON Board USING hash(id_project);

-- Messages by date and project
-- Index relation: message; index attribute: date, project
-- Index type: B-tree; cardinality: medium; clustering: yes
CREATE INDEX message_date ON Message USING btree(date, id_project);

-- Search projects
-- Index relation: project; index attribute: title
-- Type: GiST; clustering: no
CREATE INDEX search_project ON Projects USING GIST (to_tsvector('english', name || ' ' || description));

-- Search users
-- Index relation: user; index attribute: username
-- Type:GiST; clustering: no
CREATE INDEX search_user ON Users USING btree(username);
--


-- Popular
--
--- USERS ---
-------------

INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('up201405655@fe.up.pt', 'Teresa Valério', 'teresaMaya19', 444, 'TeresaValerio', true);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('up201402784@fe.up.pt', 'Inês Gonçalves', 'inesggtunafe8', 123, 'InesGoncalves', true);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('up201405085@fe.up.pt', 'Sara Gomes', 'sara23bolota', 635,'SaraGomes', true);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('joana.monteiro@hotmail.com', 'Joana Monteiro', 'QWERTY', 883,'JoanaMonteiro45', false);
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('maria.costa12@hotmail.com', 'Maria João Costa', 'palavrapasse123', 713,'MJCosta14');
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('joaoo_santos@hotmail.com', 'João Costa Santos', 'SG234StbtQ', 790,'JoaoCS18');
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('luis134castro@hotmail.com', 'Luís Castro', 'BB13fsRg6', 253,'LuisCastro');
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('up201404541@fe.up.pt', 'Francisca Seabra', 'BETHDDD', 662,'FSeabra');
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('lacinia.orci.consectetuer@velarcu.ca','Noelle Moran','PMR97BRV5EC', 621,'NoelleMoran44', false);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('ipsum.nunc.id@scelerisquemollis.edu' ,'MacKenzie Garrison', 'YUY23IUO9RC', 412,'MKenzieG', false);
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('urna.Vivamus.molestie@Fusce.net', 'Isadora Hewitt', 'BUE71FOD5OI', 914,'HIsadora23');
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('tincidunt@tinciduntduiaugue.com', 'Lacota Page', 'GPB35FPL2TB', 515,'LacotaPagee', false);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('ac.risus.Morbi@mauris.co.uk', 'Priscilla Silva', 'UPK14PEJ2DZ',328 ,'SilvaP47', false);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('eu@tellus.net', 'Lynn Burch', 'IGU81EUU7UB', 555,'lynn29', false);
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('nascetur.ridiculus@nonmassa.net', 'Jocelyn Fulton', 'IEV88RCI7LT', 181,'Fulton');
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('sem@consequatauctornunc.co.uk', 'Tashya Deleon', 'LZJ76NCB9QP', 741,'deleonTashya', false);
INSERT INTO Users (e_mail, full_name, password, url, username, administrator) VALUES ('et.euismod.et@pharetraNamac.net', 'Lillian Snow', 'MYX34BPA2RK', 301,'lillian', false);
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('cursus.Nunc@vitaeeratVivamus.edu', 'Margaret Mack', 'NRZ16ICN4NL', 215,'Margarety');
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('vel.faucibus.id@lacinia.edu' ,'Martha Cain', 'OGM48BTU8UO',590 ,'MarthaCain');
INSERT INTO Users (e_mail, full_name, password, url, username) VALUES ('fi1996@gmail.com' ,'Filipa Soares', 'GLsn36d',506 ,'FiSoares45');


--- PROJECTS ---
----------------

INSERT INTO Projects (description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES ('Projeto de LIEB para deteção de apneia do sono', TIMESTAMP '2018/03/04', timestamp '2019/05/18', 'Hypnos', 1, 'In_progress', true);
INSERT INTO Projects (start_date, end_date, name, id_coordinator, project_state) VALUES (TIMESTAMP '2018/02/20', TIMESTAMP '2019/05/25 24:00:00', 'Fotopletismógrafo portátil', 2, 'In_progress');
INSERT INTO Projects (start_date, end_date, name, id_coordinator) VALUES (TIMESTAMP '2018/03/1', TIMESTAMP '2019/06/10 9:00:00', 'Estudo da doença de Alzheimer através de análise de imagens do cérebro', 3);
INSERT INTO Projects (description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES ('Deteção de emoções através da análise de sinais de EEG', TIMESTAMP '2018/03/14', timestamp '2019/09/18', 'EEG feelings', 4, 'In_progress', true);
INSERT INTO Projects (start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (TIMESTAMP '2018/02/15', TIMESTAMP '2019/05/30', 'Projeto MINV', 20, 'In_progress', false);

--- PROJECT'S TEAMS ---
-----------------------

INSERT INTO Project_team (id_user, id_project) VALUES (3,1);
INSERT INTO Project_team (id_user, id_project) VALUES (8,1);
INSERT INTO Project_team (id_user, id_project) VALUES (3,2);
INSERT INTO Project_team (id_user, id_project) VALUES (16,3);
INSERT INTO Project_team (id_user, id_project) VALUES (5,4);
INSERT INTO Project_team (id_user, id_project) VALUES (6,4);
INSERT INTO Project_team (id_user, id_project) VALUES (7,4);
INSERT INTO Project_team (id_user, id_project) VALUES (8,4);
INSERT INTO Project_team (id_user, id_project) VALUES (9,4);
INSERT INTO Project_team (id_user, id_project) VALUES (10,4);
INSERT INTO Project_team (id_user, id_project) VALUES (11,4);
INSERT INTO Project_team (id_user, id_project) VALUES (1,5);
INSERT INTO Project_team (id_user, id_project) VALUES (3,5);


--- PROJECT'S BOARDS ---
------------------------

INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Pesquisa de fundamentos teóricos que servirão de base à implementação de código', 'Pesquisa', 1, 1);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Pesquisa sobre funcionamento da fotopletismografia e métodos a adotar', 'Pesquisa', 3, 2);
INSERT INTO Board (name, id_creator, id_project) VALUES ('Construção circuito', 3, 2);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Pesquisa de possíveis técnicas a adotar', 'Pesquisa', 3, 3);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Procurar artigos sobre projetos semelhantes', 'Artigos', 7, 4);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Pesquisar acerca do EEC e possíveis maneiras de o analisar', 'Pesquisa EEG', 9, 4);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Pesquisa de artigos relacionados com o tema', 'Pesquisa bibliográfica', 1, 5);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Elaboração do questionário sob a forma de Google Form', 'Questionário', 20, 5);
INSERT INTO Board (description, name, id_creator, id_project) VALUES ('Elaboração do guião da entrevista', 'Entrevista', 3, 5);


--- BOARD'S TASKS ---
---------------------

INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/1', 'Pesquisa em várias fontes bibliográficas relativamente ao que causa a apneia e como poderá ser detetada' , 'Pesquisa sobre apneia', 10, 'In_progress', 1, 1);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/10', 'Pesquisa sobre fotopletismografia (como funciona, que método utilizar, etc)' , 'Pesquisa fotopletismografia', 40, 'In_progress', 3, 2);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/15', 'Pesquisar melhor sensor a utilizar e possíveis circuitos a implementar' , 'Pesquisa circuito', 30, 'In_progress', 3, 2);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/10', 'Pesquisa sobre o que é a doença de Alzheimer e que efeitos tem no cérebro humano' , 'Pesquisa sobre Alzheimer', 30, 'In_progress', 3, 3);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/20', 'Pesquisa sobre possíveis técnicas de análise de imagem a adotar e base de dados a utilizar' , 'Técnicas de análise de imagem', 20, 'In_progress', 3, 3);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/06/24', 'O que é o EEG, como é obtido e que informação nos dá?', 'Fundamentos EEG', 60, 'In_progress', 8, 4);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/06/29', 'Pesquisa de processamentos a adotar para analisar o sinal EEG', 'Processamento EEG', 10, 'In_progress', 6, 4);
INSERT INTO Task (deadline, description, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/04/22', 'Pesquisa sobre a estrutura que um questionário deve ter (quantidade/tipo de perguntas, etc)', 'Estrutura questionário', 40, 'In_progress', 1, 8);
INSERT INTO Task (deadline, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/04/30', 'Elaboração questionário', 10, 'In_progress', 20, 8);
INSERT INTO Task (deadline, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/04/25', 'Como fazer uma entrevista?', 50, 'In_progress', 3, 9);
INSERT INTO Task (deadline, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/04/27', 'Guião da entervista', 10, 'In_progress', 1, 9);
INSERT INTO Task (deadline, name, progress, task_state, id_creator, id_board) VALUES(TIMESTAMP '2019/05/10', 'Realização das entervista', 10, 'In_progress', 20, 9);


--- BOARD'S TEAMS ---
---------------------

INSERT INTO Board_team VALUES (3,1);
INSERT INTO Board_team VALUES (2,1);
INSERT INTO Board_team VALUES (4,16);
INSERT INTO Board_team VALUES (5,5);
INSERT INTO Board_team VALUES (5,1);
INSERT INTO Board_team VALUES (5,8);
INSERT INTO Board_team VALUES (5,11);
INSERT INTO Board_team VALUES (6,6);
INSERT INTO Board_team VALUES (6,1);
INSERT INTO Board_team VALUES (6,8);
INSERT INTO Board_team VALUES (6,9);
INSERT INTO Board_team VALUES (6,10);
INSERT INTO Board_team VALUES (6,11);


--- COMMENTS ---
----------------

INSERT INTO Comment (comment, date, id_user, id_task) VALUES ('SFH7050 já não pode ser utilizado!', TIMESTAMP '2018/03/25 12:50:04', 1, 3);
INSERT INTO Comment (comment, date, id_user, id_task) VALUES ('Não está a ser possível fazer o download da base de dados', TIMESTAMP '2018/03/19 19:24:34', 3, 5);
INSERT INTO Comment (comment, date, id_user, id_task) VALUES ('Ver apontamentos da aula prática!', TIMESTAMP '2018/03/27 17:58:02', 20, 8);

--- MEETINGS ---
----------------

INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/10 11:00:00', 'Departamento de Bioenganheria', 1);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/17 09:30:00', 'Departamento de Bioenganheria', 1);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/05 14:00:00', 'I007', 2);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/06/20 14:00:00', 'I007', 3);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/20 15:30:00', 'INESC', 4);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/24 10:30:00', 'B118', 5);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/20 10:00:00', 'B005', 6);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/06 17:00:00', 'Sala de bio', 7);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/10 15:00:00', 'B223', 8);
INSERT INTO Meeting (date, place, id_board) VALUES (TIMESTAMP '2019/04/13 09:20:00', 'B019', 9);


--- MESSAGE ---
---------------

INSERT INTO Message (date, message, id_user, id_project) VALUES (TIMESTAMP '2018/04/02 15:02:46', 'Não esquecer que a interface do programa deve ser feita em Java!!', 3, 1);
INSERT INTO Message (date, message, id_user, id_project) VALUES (TIMESTAMP '2018/03/21 10:24:06', 'Ter em conta que o circuito deve ser de dimensões reduzidas, uma vez que deve ser portátil', 1, 2);


--- PERSONAL EVENTS ---
-----------------------

INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/04/12', 'Aniversário mãe', 1);
INSERT INTO Personal_event (date, name, place, id_user) VALUES (TIMESTAMP '2019/04/10', 'Almoço com o António', 'Casa do António', 2);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/04/17 13:20:00', 'Ir buscar o João ao Aeroporto', 7);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/04/20 18:00:00', 'Levar o João ao Aeroporto', 7);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/04/10 18:30:00', 'Café com a Maria', 5);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/05/18', 'Visitar a Joana', 5);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/05/06', 'Dia da mãe!!', 8);
INSERT INTO Personal_event (date, name, id_user) VALUES (TIMESTAMP '2019/05/07', 'Aniversário da Maya', 3);


--- CONTACT ---
---------------

INSERT INTO Contact (id_user, id_contact) VALUES (1,2);
INSERT INTO Contact (id_user, id_contact) VALUES (1,3);
INSERT INTO Contact (id_user, id_contact) VALUES (1,4);
INSERT INTO Contact (id_user, id_contact) VALUES (1,8);
INSERT INTO Contact (id_user, id_contact) VALUES (2,3);
INSERT INTO Contact (id_user, id_contact) VALUES (2,1);
INSERT INTO Contact (id_user, id_contact) VALUES (2,5);
INSERT INTO Contact (id_user, id_contact) VALUES (3,16);
INSERT INTO Contact (id_user, id_contact) VALUES (4,6);
INSERT INTO Contact (id_user, id_contact) VALUES (4,7);
INSERT INTO Contact (id_user, id_contact) VALUES (4,9);
INSERT INTO Contact (id_user, id_contact) VALUES (4,11);
INSERT INTO Contact (id_user, id_contact) VALUES (5,6);
INSERT INTO Contact (id_user, id_contact) VALUES (5,9);
INSERT INTO Contact (id_user, id_contact) VALUES (6,4);
INSERT INTO Contact (id_user, id_contact) VALUES (6,10);
INSERT INTO Contact (id_user, id_contact) VALUES (7,11);
INSERT INTO Contact (id_user, id_contact) VALUES (8,5);
INSERT INTO Contact (id_user, id_contact) VALUES (8,9);


--- FILE ---
------------

INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('Referências bibliográficas apneia','https://docs.google.com/document/d/1KZ00yc2JSSUsC3EdrPWqTRZqUhBn4oIB-IR61YU7EHs/edit' , TIMESTAMP '2018/04/03 10:35:07', 1, 1 );
INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('Fotopletismografia','http://www.peb.ufrj.br/teses/Tese0030_2006_03_29.pdf' , TIMESTAMP '2018/04/03 10:35:07', 1, 2 );
INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('Datasheet SFH7050','https://www.mouser.com/ds/2/311/SFH%207050,%20Lead%20(Pb)%20Free%20Product%20-%20RoHS%20Compliant-608232.pdf' , TIMESTAMP '2018/03/21 19:14:44', 1, 3 );
INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('Datasheet TCRT1000','https://www.vishay.com/docs/83752/tcrt1000.pdf' , TIMESTAMP '2018/03/29 22:51:00', 1, 3 );
INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('EEG','https://pt.wikipedia.org/wiki/Eletroencefalografia' , TIMESTAMP '2018/03/17 20:58:12', 8, 6 );
INSERT INTO File (description, path, publish_date, id_user, id_task) VALUES ('EEG','https://docs.google.com/forms/d/e/1FAIpQLSfa60Ny5pTFxZGpUwyCp6_LiL5hKLWMZExoCpicrAqdcdR2uw/viewform' , TIMESTAMP '2018/03/03 17:49:22', 20, 9 );


--- NOTIFICATION ---
--------------------

INSERT INTO Notification (date, notification, read, id_user) VALUES (TIMESTAMP '2018/03/04', 'Foi adicionado a um novo projeto "Hypnos" ', false, 3);
INSERT INTO Notification (date, notification, read, id_user) VALUES (TIMESTAMP '2018/03/04', 'Foi adicionado a um novo projeto "Hypnos" ', false, 8);
INSERT INTO Notification (date, notification, read, id_user) VALUES (TIMESTAMP '2018/03/02', 'Um utilizador deseja adiciona um novo colaborador ao seu projeto "Estudo da doença de Alzheimer através de análise de imagens do cérebro" ', false, 3);
INSERT INTO Notification (date, notification, read, id_user) VALUES (TIMESTAMP '2018/03/04', 'Utilizador "Joana Monteiro" pediu para o adicionar à sua lista de contactos', false, 6);
INSERT INTO Notification (date, notification, read, id_user) VALUES (TIMESTAMP '2018/03/04', 'Utilizador "Noelle Moran" pediu para o adicionar à sua lista de contactos', false, 8);


--- PROGRESS UPDATE ---
-----------------------

INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/04/03 10:40:45', 30, 1, 1);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/04/03 10:37:23', 60, 3, 2);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/04/04 11:07:15', 80, 3, 2);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/03/21 19:16:35', 50, 1, 3);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/03/29 22:52:05', 70, 1, 3);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/03/27 14:46:35', 70, 8, 6);
INSERT INTO Progress_update (date, new_value, id_user, id_task) VALUES (TIMESTAMP '2018/03/03 18:35:17', 40, 20, 8);


--- PROFILE PICTURES ---
------------------------

INSERT INTO Profile_picture (id_user, path) VALUES (1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsAUelg7yg0mepGMf-N93hh6E9XrLnKwsKa4YEQ6swhDknk4F9eQ');
INSERT INTO Profile_picture (id_user, path) VALUES (2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHMdytMDJqBYz4eR2PpDUBMepUR7SxtOmPCNdIO5SUMQ2vdeH8');
INSERT INTO Profile_picture (id_user, path) VALUES (3, 'https://cdn4.iconfinder.com/data/icons/green-shopper/1068/user.png');
INSERT INTO Profile_picture (id_user, path) VALUES (4, 'http://icons.iconarchive.com/icons/paomedia/small-n-flat/1024/user-male-icon.png');
INSERT INTO Profile_picture(id_user, path) VALUES (5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMrYqax_J2xys7O57n0QcYyBXR-AGNwPGBmaw6j-xJXHyFwAu5');
INSERT INTO Profile_picture (id_user, path) VALUES (6, 'http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png');
INSERT INTO Profile_picture (id_user, path) VALUES (7, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrLV_ettEako62R_lp4RcYFLKo0WKqxKaGpYlTzoaEeRVZXHnGfw');
INSERT INTO Profile_picture (id_user, path) VALUES (8, 'https://365psd.com/images/istock/previews/9353/93539553-flat-vector-avatar-face-character-person-portrait-user-icon.jpg');
INSERT INTO Profile_picture (id_user, path) VALUES (9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMjO9lsBeDLzlm9780HyMXWa0c07DnpzPy_CCYoc3kqX85WGh4Mw');


--- PROJECT PICTURES ---
------------------------

INSERT INTO Project_picture (id_project, path) VALUES (1, 'https://image.flaticon.com/icons/svg/552/552413.svg');
INSERT INTO Project_picture (id_project, path) VALUES (2, 'https://image.flaticon.com/icons/svg/490/490348.svg');
INSERT INTO Project_picture (id_project, path) VALUES (3, 'https://image.flaticon.com/icons/svg/40/40488.svg');
INSERT INTO Project_picture (id_project, path) VALUES (4, 'https://image.flaticon.com/icons/png/512/228/228437.png');
INSERT INTO Project_picture (id_project, path) VALUES (5, 'https://image.flaticon.com/icons/svg/124/124945.svg');

