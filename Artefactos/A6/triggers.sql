-- Verificar que ainda não há esse email registado --
-----------------------------------------------------

CREATE FUNCTION check_exist_email() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT "e-mail" FROM "User" WHERE NEW.e-mail = "e-mail") THEN
        RAISE EXCEPTION 'The e-mail you are trying to use is already registred'
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_exist_email
    BEFORE INSERT ON "User"
    FOR EACH ROW
        EXECUTE PROCEDURE check_exist_user();


-- Verificar que ainda não há esse username registado --
--------------------------------------------------------

CREATE FUNCTION check_exist_username() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM "User" WHERE NEW.username = username) THEN
        RAISE EXCEPTION 'The username you are trying to use is already in use'
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_exist_username
    BEFORE INSERT ON "User"
    FOR EACH ROW
        EXECUTE PROCEDURE check_exist_username();        


-- Verificar se já não existe uma board com esse nome dentro do projeto --
--------------------------------------------------------------------------

CREATE FUNCTION check_exist_board() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT name FROM Board WHERE Board.id_project=$projectId AND NEW.name=name) THEN
        RAISE EXCEPTION 'This project already has a board with that name'
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_exist_board
    BEFORE INSERT ON Board
    FOR EACH ROW
        EXECUTE PROCEDURE check_exist_board();


-- Verificar se determinado utilizador que se quer adicionar à team já não está lá --
-------------------------------------------------------------------------------------

CREATE FUNCTION check_exist_worker() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT name FROM Project_team WHERE Project_team.id_project=$projectId AND NEW.id_worker=id_worker) THEN
        RAISE EXCEPTION 'This user already belongs to this team'
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_exist_worker
    BEFORE INSERT ON Project_team
    FOR EACH ROW
        EXECUTE PROCEDURE check_exist_worker();


-- Verificar se determinado utilizador já não pertente à lista de contactos --
-------------------------------------------------------------------------------------

CREATE FUNCTION check_exist_contact() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT name FROM Contact WHERE Contact.id_user=$userId AND NEW.id_contact=id_contact AND NEW.id_contact=$userId) THEN
        RAISE EXCEPTION 'This user already is on your contact list'
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_exist_contact
    BEFORE INSERT ON Contact
    FOR EACH ROW
        EXECUTE PROCEDURE check_exist_contact();        