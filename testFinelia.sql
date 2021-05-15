drop database if exists test_finelia;
create database test_finelia;
use test_finelia;

drop table if exists notes;
drop table if exists matieres;
drop table if exists etudiants;

create table etudiants (
`id_etudiant` int(10) NOT NULL auto_increment,
`name` varchar(50) NOT NULL,
`fname` varchar(50) NOT NULL,
`mail` varchar(50) NOT NULL,
`password` varchar(50) NOT NULL,
PRIMARY KEY (id_etudiant)
);
insert into etudiants (`name`,`fname`, `mail`,`password`)
values ("Basile", "PULIN", "basile.pulin@gmail.com" ,"1234") ;
insert into etudiants (`name`,`fname`, `mail`,`password`)
values ("test", "test", "test@gmail.com" ,"test") ;


create table matieres (
`id_matiere` int(10) NOT NULL auto_increment,
`name` varchar(50) NOT NULL,
`coefficient` int(10) NOT NULL,
PRIMARY KEY (id_matiere)
);
insert into matieres (`name`,`coefficient`)
values ("UX Design", 3) ;
insert into matieres (`name`,`coefficient`)
values ("Programmation Java", 5) ;
insert into matieres (`name`,`coefficient`)
values ("Sécurité informatique", 2) ;
insert into matieres (`name`,`coefficient`)
values ("Programmation Web", 4) ;


create table notes (
`id_note` int(10) NOT NULL auto_increment,
`value` int(10) NOT NULL,
`max` int(10) NOT NULL,
`coefficient` int(10) NOT NULL,
`matiere` int(10) NOT NULL,
`etudiant` int(10) NOT NULL,
PRIMARY KEY (id_note),
CONSTRAINT matiere_fk FOREIGN KEY (`matiere`) REFERENCES matieres(id_matiere),
CONSTRAINT etudiant_fk FOREIGN KEY (`etudiant`) REFERENCES etudiants(id_etudiant)
) ENGINE=INNODB;
insert into notes (`value`,`max`,`coefficient`,`matiere`,`etudiant`)
values (15,20,1,2,1);
insert into notes (`value`,`max`,`coefficient`,`matiere`,`etudiant`)
values (10,20,1,2,1);
insert into notes (`value`,`max`,`coefficient`,`matiere`,`etudiant`)
values (11,20,1,1,1);
insert into notes (`value`,`max`,`coefficient`,`matiere`,`etudiant`)
values (11,20,1,1,2);



