CREATE TABLE sport_users (
	nom varchar(255) NOT null, 
	prenom varchar(255) NOT null,
	login varchar(255) PRIMARY KEY,
	pwd varchar(255) NOT null,
	email varchar(255) NOT null unique,
	avatar varchar(255)
);

CREATE TABLE sport_equipes (
	id integer PRIMARY KEY AUTO_INCREMENT,
	nom varchar(255) NOT null unique, 
	pwd varchar(255),
	sports varchar(255) NOT null,
	ville varchar(255) NOT null,
	description varchar(140),
	mixite varchar(255) NOT null,
	logo varchar(255),
	photo varchar(255),
	administrateur varchar(255) NOT null,
	foreign key(administrateur) references sport_users(login)
);

CREATE TABLE sport_liste_membres (
	idEquipe integer,
	login varchar(255),
	entraineur boolean not null,
	PRIMARY KEY (idEquipe,login),
	foreign key(idEquipe) references sport_equipes(id),
	foreign key(login) references sport_users(login)
);

CREATE TABLE sport_evenements (
	idEquipe integer not null,
	dateEvenement date not null,
	typeEvenement varchar(50) not null,
	lieu varchar(50) not null,
	description varchar(140),
	foreign key(idEquipe) references sport_equipes(id),
	PRIMARY KEY (idEquipe,dateEvenement)
);

CREATE TABLE sport_evenements_participants (
	login varchar(255),
	idEquipe integer not null,
	dateEvenement date not null,
	seraPresent boolean not null,
	foreign key(login) references sport_users(login),
	foreign key(idEquipe) references sport_equipes(id),
	foreign key(idEquipe,dateEvenement) references sport_evenements(idEquipe,dateEvenement),
	PRIMARY KEY (login,idEquipe,dateEvenement)
);

CREATE TABLE sport_invitations (
	idEquipe integer not null,
	login varchar(255) not null,
	foreign key(idEquipe) references sport_equipes(id),
	foreign key(login) references sport_users(login),
	PRIMARY KEY (idEquipe,login)
);

DELIMITER //

CREATE TRIGGER delete_liste_membres_and_invitations_after_delete_equipe
BEFORE DELETE ON sport_equipes FOR EACH ROW

BEGIN
   DELETE FROM sport_liste_membres 
   WHERE idEquipe = OLD.id;

   DELETE FROM sport_invitations 
   WHERE idEquipe = OLD.id;
END; //

DELIMITER ;

DELIMITER //

CREATE TRIGGER delete_invitations_after_insert_liste_membres
BEFORE INSERT ON sport_liste_membres FOR EACH ROW

BEGIN
   DELETE FROM sport_invitations  
   WHERE idEquipe = NEW.idEquipe and login = NEW.login;
END; //

DELIMITER ;

