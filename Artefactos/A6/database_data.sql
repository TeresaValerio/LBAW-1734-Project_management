INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (1,up201405655@fe.up.pt, "Teresa Valério", teresaMaya19, TeresaValerio, 1)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (2,up201402784@fe.up.pt, "Inês Gonçalves", inesggtunafe8, InesGoncalves, 1)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (3,up201405085@fe.up.pt, "Sara Gomes", sara23bolota, SaraGomes, 1)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (4,joana.monteiro@hotmail.com, "Joana Monteiro", QWERTY, JoanaMonteiro45, 0)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (5,maria.costa12@hotmail.com, "Maria João Costa", palavrapasse123, MJCosta14)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (6,joaoo_santos@hotmail.com, "João Costa Santos", SG234StbtQ, JoaoCS18)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (7,luis134castro@hotmail.com, "Luís Castro", BB13fsRg6, LuisCastro)
INSERT INTO "User" (id, "e-mail", full_name, password, URL, username, administrator) VALUES (8,up201404541@fe.up.pt, "Francisca Seabra", BB13fsRg6, LuisCastro)


INSERT INTO "Project" (id, description, start_date, end_date, name, id_coordinator, state, privacy) VALUES (1, "Projeto de LIEB para deteção de apneia do sono", 25/03/18, 15/05/18, Hypnos, 1, "In_progress", 1)
INSERT INTO "Project" (id, end_date, name, id_coordinator) VALUES (2, 25/05/18, "Fotopletismógrafo portátil", 1, "In_progress")
INSERT INTO "Project" (id, end_date, name, id_coordinator) VALUES (3, 10/06/18, "Estudo da doença de Alzheimer através de análise de imagens do cérebro", 3)

INSERT INTO "Project_team" (id_user, id_project) VALUES (3,1)
INSERT INTO "Project_team" (id_user, id_project) VALUES (8,1)

INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (1, "Pesquisa de fundamentos teóricos que servirão de base à implementação de código", "Pesquisa", 1, 1)
INSERT INTO "Board" (id, description, name, id_creator, id_project) VALUES (2, "Pesquisa de possíveis técnicas a adotar", "Pesquisa", 3, 3)
 
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 24/03/18, "Pesquisa em várias fontes bibliográficas relativamente ao que causa a apneia e como poderá ser detetada" , "Pesquisa sobre apneia", 10, "In_progress", 1, 1)
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 22/03/18, "Pesquisa sobre o que é a doença de Alzheimer e que efeitos tem no cérebro humano" , "Pesquisa sobre Alzheimer", 30, "In_progress", 3, 2)
INSERT INTO "Task" (id, deadline, description, name, progress, state, id_creator, id_board) VALUES(1, 29/03/18, "Pesquisa sobre possíveis técnicas de análise de imagem a adotar, tendo em conta estudos previamente realizados" , "Pesquisa sobre técnicas de análise de imagem", 20, "In_progress", 3, 2)