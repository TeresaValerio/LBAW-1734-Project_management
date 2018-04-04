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

INSERT INTO "Project" (id, description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (1, 'Projeto de LIEB para deteção de apneia do sono', TIMESTAMP '2018/03/04', timestamp '2019/05/18', 'Hypnos', 1, 'In_progress', true)
INSERT INTO "Project" (id, start_date, end_date, name, id_coordinator, project_state) VALUES (2, TIMESTAMP '2018/02/20', TIMESTAMP '2019/05/25 24:00:00', 'Fotopletismógrafo portátil', 1, 'In_progress')
INSERT INTO "Project" (id, start_date, end_date, name, id_coordinator) VALUES (3, TIMESTAMP '2018/03/1', TIMESTAMP '2019/06/10 9:00:00', 'Estudo da doença de Alzheimer através de análise de imagens do cérebro', 3)
INSERT INTO "Project" (id, description, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (4, 'Deteção de emoções através da análise de sinais de EEG', TIMESTAMP '2018/03/14', timestamp '2019/09/18', 'EEG feelings', 4, 'In_progress', true)
INSERT INTO "Project" (id, start_date, end_date, name, id_coordinator, project_state, privacy) VALUES (5, TIMESTAMP '2018/02/15', TIMESTAMP '2019/05/30', 'Projeto MINV', 20, 'In_progress', false)


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

INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (1, 'Pesquisa de fundamentos teóricos que servirão de base à implementação de código', 'Pesquisa', 1, 1)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (2, 'Pesquisa sobre funcionamento da fotopletismografia e métodos a adotar', 'Pesquisa', 3, 2)
INSERT INTO "Board" (id, name, id_creator, id_project) VALUES (3, 'Construção circuito', 3, 2)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (4, 'Pesquisa de possíveis técnicas a adotar', 'Pesquisa', 3, 3)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (5, 'Procurar artigos sobre projetos semelhantes', 'Artigos', 7, 4)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (6, 'Pesquisar acerca do EEC e possíveis maneiras de o analisar', 'Pesquisa EEG', 9, 4)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (7, 'Pesquisa de artigos relacionados com o tema', 'Pesquisa bibliográfica', 1, 5)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (8, 'Elaboração do questionário sob a forma de Google Form', 'Questionário', 20, 5)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (9, 'Elaboração do guião da entrevista', 'Entrevista', 3, 5)


--- BOARD'S TASKS ---
---------------------

INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(1, TIMESTAMP '2019/05/1', 'Pesquisa em várias fontes bibliográficas relativamente ao que causa a apneia e como poderá ser detetada' , 'Pesquisa sobre apneia', 10, 'In_progress', 1, 1)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(2, TIMESTAMP '2019/05/10', 'Pesquisa sobre fotopletismografia (como funciona, que método utilizar, etc)' , 'Pesquisa fotopletismografia', 40, 'In_progress', 3, 2)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(3, TIMESTAMP '2019/05/15', 'Pesquisar melhor sensor a utilizar e possíveis circuitos a implementar' , 'Pesquisa circuito', 30, 'In_progress', 3, 2)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(4, TIMESTAMP '2019/05/10', 'Pesquisa sobre o que é a doença de Alzheimer e que efeitos tem no cérebro humano' , 'Pesquisa sobre Alzheimer', 30, 'In_progress', 3, 3)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(5, TIMESTAMP '2019/05/20', 'Pesquisa sobre possíveis técnicas de análise de imagem a adotar e base de dados a utilizar' , 'Técnicas de análise de imagem', 20, 'In_progress', 3, 3)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(6, TIMESTAMP '2019/06/24', 'O que é o EEG, como é obtido e que informação nos dá?', 'Fundamentos EEG', 60, 'In_progress', 8, 4)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(7, TIMESTAMP '2019/06/30', 'Pesquisa de processamentos a adotar para analisar o sinal EEG', 'Processamento EEG', 10, 'In_progress', 6, 4)
INSERT INTO "Task" (id, deadline, description, name, progress, task_state, id_creator, id_board) VALUES(8, TIMESTAMP '2019/04/22', 'Pesquisa sobre a estrutura que um questionário deve ter (quantidade/tipo de perguntas, etc)', 'Estrutura questionário', 40, 'In_progress', 1, 8)
INSERT INTO "Task" (id, deadline, name, progress, task_state, id_creator, id_board) VALUES(9, TIMESTAMP '2019/04/30', 'Elaboração questionário', 10, 'In_progress', 20, 8)
INSERT INTO "Task" (id, deadline, name, progress, task_state, id_creator, id_board) VALUES(10, TIMESTAMP '2019/04/25', 'Como fazer uma entrevista?', 50, 'In_progress', 3, 9)
INSERT INTO "Task" (id, deadline, name, progress, task_state, id_creator, id_board) VALUES(11, TIMESTAMP '2019/04/27', 'Guião da entervista', 10, 'In_progress', 1, 9)
INSERT INTO "Task" (id, deadline, name, progress, task_state, id_creator, id_board) VALUES(12, TIMESTAMP '2019/05/10', 'Realização das entervista', 10, 'In_progress', 20, 9)


--- BOARD'S TEAMS ---
---------------------

INSERT INTO "Board_team" VALUES (3,1)
INSERT INTO "Board_team" VALUES (2,1)
INSERT INTO "Board_team" VALUES (4,16)
INSERT INTO "Board_team" VALUES (5,5)
INSERT INTO "Board_team" VALUES (5,1)
INSERT INTO "Board_team" VALUES (5,8)
INSERT INTO "Board_team" VALUES (5,11)
INSERT INTO "Board_team" VALUES (6,6)
INSERT INTO "Board_team" VALUES (6,1)
INSERT INTO "Board_team" VALUES (6,8)
INSERT INTO "Board_team" VALUES (6,9)
INSERT INTO "Board_team" VALUES (6,10)
INSERT INTO "Board_team" VALUES (6,11)


--- COMMENTS ---
----------------

INSERT INTO "Comment" (id, comment, date, id_user, id_task) VALUES (1, 'SFH7050 já não pode ser utilizado!', TIMESTAMP '2018/03/25 12:50:04', 1, 3)
INSERT INTO "Comment" (id, comment, date, id_user, id_task) VALUES (2, 'Não está a ser possível fazer o download da base de dados', TIMESTAMP '2018/03/19 19:24:34', 3, 5)
INSERT INTO "Comment" (id, comment, date, id_user, id_task) VALUES (3, 'Ver apontamentos da aula prática!', TIMESTAMP '2018/03/27 17:58:02', 20, 8)


--- MEETINGS ---
----------------

INSERT INTO "Meeting" (id, date, place, id_board) VALUES (1, TIMESTAMP '2018/04/10 11:00:00', 'Departamento de Bioenganheria', 1)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (2, TIMESTAMP '2018/04/17 09:30:00', 'Departamento de Bioenganheria', 1)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (3, TIMESTAMP '2018/04/07 14:00:00', 'I007', 2)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (4, TIMESTAMP '2018/06/20 14:00:00', 'I007', 3)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (5, TIMESTAMP '2018/04/20 15:30:00', 'INESC', 4)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (6, TIMESTAMP '2018/04/23 10:30:00', 'B118', 5)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (7, TIMESTAMP '2018/04/20 10:00:00', 'B005', 6)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (8, TIMESTAMP '2018/04/06 17:00:00', 'Sala de bio', 7)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (9, TIMESTAMP '2018/04/10 15:00:00', 'B223', 8)
INSERT INTO "Meeting" (id, date, place, id_board) VALUES (10, TIMESTAMP '2018/04/13 09:20:00', 'B019', 9)


--- MESSAGE ---
---------------

INSERT INTO "Message" (id, date, message, id_user, id_project) VALUES (1,TIMESTASMP '2018/04/02 15:02:46', 'Não esquecer que a interface do programa deve ser feita em Java!!', 3, 1)
INSERT INTO "Message" (id, date, message, id_user, id_project) VALUES (2,TIMESTASMP '2018/03/21 10:24:06', 'Ter em conta que o circuito deve ser de dimensões reduzidas, uma vez que deve ser portátil', 1, 2)


--- PERSONAL EVENTS ---
-----------------------

INSERT INTO "Personal_Event" (id, date, name, id_user) VALUES (1, TIMESTAMP '2018/04/14', 'Aniversário mãe', 1)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (2, TIMESTAMP '2018/04/10', 'Almoço com o António', 'Casa do António', 2)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (3, TIMESTAMP '2018/04/17 13:20:00', 'Ir buscar o João ao Aeroporto', 7)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (4, TIMESTAMP '2018/04/21 18:00:00', 'Levar o João ao Aeroporto', 7)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (5, TIMESTAMP '2018/04/10 18:30:00', 'Café com a Maria', 5)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (6, TIMESTAMP '2018/05/18', 'Visitar a Joana', 5)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (7, TIMESTAMP '2018/05/06', 'Dia da mãe!!', 8)
INSERT INTO "Personal_Event" (id, date, name, place, id_user) VALUES (8, TIMESTAMP '2018/05/05', 'Aniversário da Maya', 3)

