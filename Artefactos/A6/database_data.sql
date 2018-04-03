--- USERS ---
-------------

INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (1, 'up201405655@fe.up.pt', 'Teresa Valério', 'teresaMaya19', 444, 'TeresaValerio', true)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (2, 'up201402784@fe.up.pt', 'Inês Gonçalves', 'inesggtunafe8', 123, 'InesGoncalves', true)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (3, 'up201405085@fe.up.pt', 'Sara Gomes', 'sara23bolota', 635,'SaraGomes', true)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (4, 'joana.monteiro@hotmail.com', 'Joana Monteiro', 'QWERTY', 883,'JoanaMonteiro45', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (5,'maria.costa12@hotmail.com', 'Maria João Costa', 'palavrapasse123', 713,'MJCosta14')
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (6,'joaoo_santos@hotmail.com', 'João Costa Santos', 'SG234StbtQ', 790,'JoaoCS18')
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (7,'luis134castro@hotmail.com', 'Luís Castro', 'BB13fsRg6', 253,'LuisCastro')
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (8,'up201404541@fe.up.pt', 'Francisca Seabra', 'BETHDDD', 662,'FSeabra')
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (9,'lacinia.orci.consectetuer@velarcu.ca','Noelle Moran','PMR97BRV5EC', 621,'NoelleMoran44', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (10, 'ipsum.nunc.id@scelerisquemollis.edu' ,'MacKenzie Garrison', 'YUY23IUO9RC', 412,'MKenzieG', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (11, 'urna.Vivamus.molestie@Fusce.net', 'Isadora Hewitt', 'BUE71FOD5OI', 914,'HIsadora23')
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (12, 'tincidunt@tinciduntduiaugue.com', 'Lacota Page', 'GPB35FPL2TB', 515,'LacotaPagee', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (13, 'ac.risus.Morbi@mauris.co.uk', 'Priscilla Silva', 'UPK14PEJ2DZ',328 ,'SilvaP47', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (14, 'eu@tellus.net', 'Lynn Burch', 'IGU81EUU7UB', 555,'lynn29', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (15, 'nascetur.ridiculus@nonmassa.net', 'Jocelyn Fulton', 'IEV88RCI7LT', 181,'Fulton')
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (16, 'sem@consequatauctornunc.co.uk', 'Tashya Deleon', 'LZJ76NCB9QP', 741,'deleonTashya', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username, administrator) VALUES (17, 'et.euismod.et@pharetraNamac.net', 'Lillian Snow', 'MYX34BPA2RK', 301,'lillian', false)
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (18, 'cursus.Nunc@vitaeeratVivamus.edu', 'Margaret Mack', 'NRZ16ICN4NL', 215,'Margarety')
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (19, 'vel.faucibus.id@lacinia.edu' ,'Martha Cain', 'OGM48BTU8UO',590 ,'MarthaCain') 
INSERT INTO "User" (id, e_mail, full_name, password, url, username) VALUES (20, 'fi1996@gmail.com' ,'Filipa Soares', 'GLsn36d',506 ,'FiSoares45')


--- PROJECTS ---
----------------

INSERT INTO "Project" (id, description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (1, 'Projeto de LIEB para deteção de apneia do sono', TIMESTAMP '2018/04/04', timestamp '2018/05/18', 'Hypnos', 1, 'In_progress', true)
INSERT INTO "Project" (id, end_date, name, id_coordinator, project_state) VALUES (2, TIMESTAMP '2018/05/25 24:00:00', 'Fotopletismógrafo portátil', 1, 'In_progress')
INSERT INTO "Project" (id, end_date, name, id_coordinator) VALUES (3, TIMESTAMP '2018/06/10 9:00:00', 'Estudo da doença de Alzheimer através de análise de imagens do cérebro', 3)
INSERT INTO "Project" (id, description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (4, 'Deteção de emoções através da análise de sinais de EEG', TIMESTAMP '2018/04/04', timestamp '2018/05/18', 'EEG feelings', 4, 'In_progress', true)
INSERT INTO "Project" (id, end_date, name, id_coordinator, project_state, privacy) VALUES (5, TIMESTAMP '2018/05/30', 'Projeto MINV', 20, 'In_progress', false)


--- PROJECT'S TEAMS ---
-----------------------

INSERT INTO "Project_team" (id_user, id_project) VALUES (3,1)
INSERT INTO "Project_team" (id_user, id_project) VALUES (8,1)
INSERT INTO "Project_team" (id_user, id_project) VALUES (3,2)
INSERT INTO "Project_team" (id_user, id_project) VALUES (16,3)
INSERT INTO "Project_team" (id_user, id_project) VALUES (5,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (6,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (7,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (8,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (9,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (10,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (11,4)
INSERT INTO "Project_team" (id_user, id_project) VALUES (1,5)
INSERT INTO "Project_team" (id_user, id_project) VALUES (3,5)


--- PROJECT'S BOARDS ---
------------------------

INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (1, "Pesquisa de fundamentos teóricos que servirão de base à implementação de código", "Pesquisa", 1, 1)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (2, "Pesquisa de possíveis técnicas a adotar", "Pesquisa", 3, 3)
 

--- BOARD'S TASKS ---
---------------------
 
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 24/03/18, "Pesquisa em várias fontes bibliográficas relativamente ao que causa a apneia e como poderá ser detetada" , "Pesquisa sobre apneia", 10, "In_progress", 1, 1)
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 22/03/18, "Pesquisa sobre o que é a doença de Alzheimer e que efeitos tem no cérebro humano" , "Pesquisa sobre Alzheimer", 30, "In_progress", 3, 2)
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 29/03/18, "Pesquisa sobre possíveis técnicas de análise de imagem a adotar, tendo em conta estudos previamente realizados" , "Pesquisa sobre técnicas de análise de imagem", 20, "In_progress", 3, 2)