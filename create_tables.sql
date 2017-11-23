create table ILLUSTRATION
(
 idIllu number(6),
 type varchar2(5) NOT NULL,
 lien varchar2(60) NOT NULL,
 PRIMARY KEY (idIllu),
 CONSTRAINT ILLU_TYPE CHECK (type IN ('image','video')),
 UNIQUE(lien)
 );

create table INGREDIENT
(
 idIngr number(6),
 nomIngr varchar2(15) NOT NULL,
 typeIngr varchar(2) NOT NULL,
 PRIMARY KEY (idIngr),
 CONSTRAINT ING_TYPEINGR CHECK (typeIngr IN ('u', 'g', 'mL')),
 UNIQUE(nomIngr)
 );

create table INFORMATIONS_NUTRITIONNELLES
(
 idIngr number(6),
 calories number(7,2) NOT NULL,
 lipides number(7,2) NOT NULL,
 glucides number(7,2) NOT NULL,
 protides number(7,2) NOT NULL,
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 PRIMARY KEY (idIngr)
);

create table UTILISATEUR
(
 idUtilisateur number(6),
 login varchar2(15) NOT NULL,
 nom varchar2(30) NOT NULL,
 prenom varchar2(30) NOT NULL,
 email varchar2(30) NOT NULL,
 mdp varchar2(15) NOT NULL,
 PRIMARY KEY (idUtilisateur),
 CONSTRAINT UTI_EMAIL CHECK (email LIKE '%.%@%.%'),
 UNIQUE(login,email,mdp)
 );

create table FRIGO
(
 idIngr number(6),
 idUtilisateur number(6),
 quantite number(7,2) NOT NULL,
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idIngr,idUtilisateur)
);

create table RECETTE
(
 idRecette number(6),
 nomRecette varchar2(100) NOT NULL,
 descriptif varchar2(200) NOT NULL,
 idUtilisateur number(6) NOT NULL,
 auteur varchar2(15) NOT NULL,
 difficulte varchar2(11) NOT NULL,
 prix number(1),
 nbPersonne number(2) NOT NULL,
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idRecette),
 CONSTRAINT RE_DIFFICULTE CHECK (difficulte IN ('Tres facile','Facile','Moyen','Difficile')),
 CONSTRAINT RE_PRIX CHECK (prix >= 1 AND prix <= 5),
 UNIQUE(nomRecette)
 ); 

create table ILLUSTRATION_RECETTE
(
 idIllu number(6),
 idRecette number(6),
 FOREIGN KEY (idIllu) REFERENCES ILLUSTRATION (idIllu),
 FOREIGN KEY (idRecette) REFERENCES RECETTE (idRecette),
 PRIMARY KEY (idIllu,idRecette)
);

create table ETAPE
(
 idEtape number(6),
 idRecette number(6) NOT NULL,
 idIngr number(6) NOT NULL,
 quantite number(7,2) NOT NULL,
 temps number(7,2) NOT NULL,
 type varchar2(7) NOT NULL,
 description varchar2(300) NOT NULL,
 FOREIGN KEY (idRecette) REFERENCES RECETTE (idRecette),
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 PRIMARY KEY (idEtape),
 CONSTRAINT ET_TYPE CHECK (type IN ('cuisson','repos','autre'))
);

create table REGIME
(
 idRegime number(6),
 nom varchar(15) NOT NULL,
 PRIMARY KEY (idRegime)
);

create table INGREDIENT_REGIME
(
 idIngr number(6),
 idRegime number(6),
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 FOREIGN KEY (idRegime) REFERENCES REGIME (idRegime),
 PRIMARY KEY (idIngr,idRegime)
);

create table CATEGORIE
(
 idCate number(6),
 categorie varchar(15) NOT NULL,
 PRIMARY KEY (idCate)
);

create table INGREDIENT_CATEGORIE
(
 idIngr number(6),
 idCate number(6),
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 FOREIGN KEY (idCate) REFERENCES CATEGORIE (idCate),
 PRIMARY KEY (idIngr,idCate)
);

create table REPAS
(
 idRepas number(6),
 idUtilisateur number(6) NOT NULL,
 date_ date NOT NULL,
 heure date NOT NULL,
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idRepas)
);

create table ARCHIVE_REPAS
(
 idRepas number(6),
 idUtilisateur number(6) NOT NULL,
 date_ date NOT NULL,
 heure date NOT NULL,
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idRepas)
);

create table REPAS_RECETTE
(
 idRecette number(6),
 idRepas number(6),
 FOREIGN KEY (idRecette) REFERENCES RECETTE (idRecette),
 FOREIGN KEY (idRepas) REFERENCES REPAS (idRepas),
 PRIMARY KEY(idRecette,idRepas)
);

create table ARCHIVE_REPAS_RECETTE
(
 idRecette number(6),
 idRepas number(6),
 FOREIGN KEY (idRecette) REFERENCES RECETTE (idRecette),
 FOREIGN KEY (idRepas) REFERENCES REPAS (idRepas),
 PRIMARY KEY(idRecette,idRepas)
);

create table LISTE
(
 idListe number(6),
 idUtilisateur number(6) NOT NULL,
 date_ date NOT NULL,
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idListe)
);

create table ARCHIVE_LISTE
(
 idListe number(6),
 idUtilisateur number(6) NOT NULL,
 date_ date NOT NULL,
 FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR (idUtilisateur),
 PRIMARY KEY (idListe)
);

create table COURSES
(
 idIngr number(6),
 idListe number(6),
 quantite number(7,2) NOT NULL,
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 FOREIGN KEY (idListe) REFERENCES LISTE (idListe),
 PRIMARY KEY(idIngr,idListe)
);

create table ARCHIVE_COURSES
(
 idIngr number(6),
 idListe number(6),
 quantite number(7,2) NOT NULL,
 FOREIGN KEY (idIngr) REFERENCES INGREDIENT (idIngr),
 FOREIGN KEY (idListe) REFERENCES LISTE (idListe),
 PRIMARY KEY(idIngr,idListe)
);
