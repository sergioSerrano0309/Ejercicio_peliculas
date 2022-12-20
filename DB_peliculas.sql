CREATE schema IF NOT EXISTS cartelera;

USE cartelera;

CREATE TABLE if not exists peliculas(
	id INTEGER AUTO_INCREMENT PRIMARY KEY not null,
    titulo VARCHAR(200) DEFAULT NULL,
    año INTEGER DEFAULT NULL,
    duración INTEGER DEFAULT NULL,
    sinposis VARCHAR (500) DEFAULT NULL,
    imagen VARCHAR (100) DEFAULT NULL,
    votos INTEGER default 0,
    id_categoria INTEGER DEFAULT NULL,
	FOREIGN KEY (id_categoria) 
		REFERENCES categorias (id)
);

create table if not exists categorias(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	categoria VARCHAR(50)
);

CREATE TABLE actor(
	id INT auto_increment PRIMARY KEY,
	nombre varchar(50)
);

CREATE TABLE actor_pelicula(
	id_actor int,
    id_pelicula int,
	primary key(id_actor, id_pelicula),
    foreign key (id_actor)
		references actor (id),
	foreign key (id_pelicula)
		references peliculas (id)
);

CREATE TABLE director(
	id int auto_increment PRIMARY KEY,
    nombre varchar(50)
);

CREATE TABLE director_pelicula(
	id_director int,
    id_pelicula int,
    primary key(id_director, id_pelicula),
    foreign key (id_director)
		references director (id),
	foreign key (id_pelicula)
		references peliculas (id)
);

INSERT INTO peliculas (id, titulo, año, duración, sinopsis, imagen, id_categoria) VALUES (1, 'El Exorcista', 1973, 132, 'Regan, una niña de doce años, es víctima de fenómenos paranormales. Su madre, aterrorizada, tras someter a su hija a múltiples análisis médicos que no ofrecen ningún resultado, acude a un sacerdote con estudios de psiquiatría. Éste está convencido de que la niña es víctima de una posesión diabólica. Por eso, con la ayuda de otro sacerdote, decide practicar un exorcismo.', '1.jpeg', 1);
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Viernes 13', 1980, 95, 'El campamento de verano de Crystal Lake reabre sus puertas tras permanecer varios años cerrado a raíz de un accidente. A partir de ese momento, comienza a aparecer gente muerta en extrañas circunstancias.', '2.jpeg', 1);
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('El Resplandor', 1980, 146, 'Jack Torrance es un hombre que se muda con su familia a un hotel aislado que debe cuidar, con la esperanza de salir del bloqueo creativo de su escritura. Mientras Jack no puede escapar del bloqueo, las visiones psíquicas de su hijo van en aumento.', '3.jpeg', 1);
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Psicosis', 1960, 109, 'La secretaria de una empresa inmobiliaria, Marion Crane, no puede casarse con su amante, Sam Loomis. El destino pone en sus manos 40.000 dólares en efectivo que su jefe le confía para depositarlos en el banco. Marion decide apoderarse de esa suma para comenzar con Sam una nueva vida. De camino a California, cae la noche y una fuerte tormenta le obliga a buscar alojamiento en un solitario motel de carretera dirigido por un joven tímido, extraño y algo demente, Norman Bates, y por su madre.', '4.jpeg', 1);
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('La noche de los muertos vivientes', 1968, 96, 'Las radiaciones procedentes de un satélite provocan un fenómeno terrorífico: los muertos salen de sus tumbas y atacan a los hombres para alimentarse. La acción comienza en un cementerio de Pennsylvania, donde Barbara, después de ser atacada por un muerto viviente, huye hacia una granja. Allí también se ha refugiado Ben. Ambos construirán barricadas para defenderse de una multitud de despiadados zombies que sólo pueden ser vencidos con un golpe en la cabeza.', '5.jpeg', 1);
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Zoolander','2001','89','Derek Zoolander ha sido el modelo masculino más cotizado durante los últimos tres años. Cuando le arrebatan la corona, decide retirarse, hasta que un diseñador le pide que desfile para él, involucrándolo al mismo tiempo en una trama de asesinato.','6.jpeg','2');
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Hermanos por pelotas','2008','98','Dos hombres perezosos e inmaduros se vuelven rivales cuando su madre y padre se casan y los obligan a vivir como hermanos en la misma casa.','7.jpeg','2');
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Tiempos modernos','1936','87','Una demoledora y feroz crítica de la sociedad industrial, dirigida e interpretada con brío por un imaginativo y corrosivo Charles Chaplin.','8.jpeg','2');
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Resacón en Las Vegas','2009','100','Cuatro amigos celebran la despedida de soltero de uno de ellos en Las Vegas. Pero, cuando a la mañana siguiente no pueden encontrar al novio y no recuerdan nada, deberán intentar volver sobre sus pasos, antes de que llegue la hora de la boda.','9.jpeg','2');
INSERT INTO peliculas (titulo, año, duración, sinopsis, imagen, id_categoria) Values ('Borat','2006','84','El reportero de Kazajistán Borat Sagdiyev es enviado a Estados Unidos por el Gobierno de su país para realizar un reportaje de la que, para Borat, es la nación más maravillosa de la Tierra. El Gobierno pretende que el documental permita mejorar algunos problemas de Kazajistán.','10.jpeg','2');

insert into categorias(categoria) values ('Terror');
insert into categorias(categoria) values ('Comedia');

/*Actores El Exorcista*/
insert into actor(nombre) values ("Jason Miller");
insert into actor(nombre) values ("Linda Blair");
insert into actor(nombre) values ("Ellen Burstyn");
insert into actor(nombre) values ("Max Von Sydow");

/*Actores Viernes 13*/
insert into actor(nombre) values ("Ari Lehman");
insert into actor(nombre) values ("Kevin Bacon");
insert into actor(nombre) values ("Adrienne King");

/*Actores El Resplandor*/

insert into actor(nombre) values ("Jack Nicholson");
insert into actor(nombre) values ("Shelley Duval");
insert into actor(nombre) values ("Danny Lloyd");

/*Actores Psicosis*/

insert into actor(nombre) values ("Anthony Perkinds");
insert into actor(nombre) values ("Janet Leigh");
insert into actor(nombre) values ("Patricia Hitchcock");

/*Actores La noche de los muertos vivientes*/

insert into actor(nombre) values ("Duane L. Jones");
insert into actor(nombre) values ("Judith O'Dea");
insert into actor(nombre) values ("Marilyn Eastman");

/*Actores Zoolander*/
insert into actor(nombre) values ("Ben Stiller");
insert into actor(nombre) values ("Owen Wilson");
insert into actor(nombre) values ("Will Ferrel");

/*Actores Hermanos por pelotas*/
/*Will Ferrer (lo he añadido antes)*/
insert into actor(nombre) values ("John C. Reilly");
insert into actor(nombre) values ("Richard Jenkins");

/*Actores Tiempos Modernos*/
insert into actor(nombre) values ("Charles Chaplin");
insert into actor(nombre) values ("Paulette Goddard");
insert into actor(nombre) values ("Henry Bergman");

/*Actores Resacón en Las Vegas*/
insert into actor(nombre) values ("Bradley Cooper");
insert into actor(nombre) values ("Zach Galifianakis");
insert into actor(nombre) values ("Ed Helms");
insert into actor(nombre) values ("Ken Jeong");

/*Actores Borat*/
insert into actor(nombre) values ("Sacha Baron Cohen");
insert into actor(nombre) values ("Pamela Anderson");
insert into actor(nombre) values ("Maria Bakalova");
insert into actor(nombre) values ("Tom Hanks");

insert into actor_pelicula (id_actor,id_pelicula) values (1, 1);
insert into actor_pelicula (id_actor,id_pelicula) values (2, 1);
insert into actor_pelicula (id_actor,id_pelicula) values (3, 1);
insert into actor_pelicula (id_actor,id_pelicula) values (4, 1);
insert into actor_pelicula (id_actor,id_pelicula) values (5, 2);
insert into actor_pelicula (id_actor,id_pelicula) values (6, 2);
insert into actor_pelicula (id_actor,id_pelicula) values (7, 2);
insert into actor_pelicula (id_actor,id_pelicula) values (8, 3);
insert into actor_pelicula (id_actor,id_pelicula) values (9, 3);
insert into actor_pelicula (id_actor,id_pelicula) values (10, 3);
insert into actor_pelicula (id_actor,id_pelicula) values (11, 4);
insert into actor_pelicula (id_actor,id_pelicula) values (12, 4);
insert into actor_pelicula (id_actor,id_pelicula) values (13, 4);
insert into actor_pelicula (id_actor,id_pelicula) values (14, 5);
insert into actor_pelicula (id_actor,id_pelicula) values (15, 5);
insert into actor_pelicula (id_actor,id_pelicula) values (16, 5);
insert into actor_pelicula (id_actor,id_pelicula) values (17, 6);
insert into actor_pelicula (id_actor,id_pelicula) values (18, 6);
insert into actor_pelicula (id_actor,id_pelicula) values (19, 6);
insert into actor_pelicula (id_actor,id_pelicula) values (19, 7);
insert into actor_pelicula (id_actor,id_pelicula) values (20, 7);
insert into actor_pelicula (id_actor,id_pelicula) values (21, 7);
insert into actor_pelicula (id_actor,id_pelicula) values (22, 8);
insert into actor_pelicula (id_actor,id_pelicula) values (23, 8);
insert into actor_pelicula (id_actor,id_pelicula) values (24, 8);
insert into actor_pelicula (id_actor,id_pelicula) values (25, 9);
insert into actor_pelicula (id_actor,id_pelicula) values (26, 9);
insert into actor_pelicula (id_actor,id_pelicula) values (27, 9);
insert into actor_pelicula (id_actor,id_pelicula) values (28, 9);
insert into actor_pelicula (id_actor,id_pelicula) values (29, 10);
insert into actor_pelicula (id_actor,id_pelicula) values (30, 10);
insert into actor_pelicula (id_actor,id_pelicula) values (31, 10);
insert into actor_pelicula (id_actor,id_pelicula) values (32, 10);

/*DIRECTORES*/
insert into director(nombre) values ("William Friedkin");
insert into director(nombre) values ("Sean S. Cunningham");
insert into director(nombre) values ("Stanley Kubrick");
insert into director(nombre) values ("Alfred Hitchcock");
insert into director(nombre) values ("George A. Romera");
insert into director(nombre) values ("Ben Stiller");
insert into director(nombre) values ("Adam McKay");
insert into director(nombre) values ("Charles Chaplin");
insert into director(nombre) values ("Todd Phillips");
insert into director(nombre) values ("Larry Charles");


insert into director_pelicula (id_director,id_pelicula) values (1, 1);
insert into director_pelicula (id_director, id_pelicula) values (2, 2);
insert into director_pelicula (id_director, id_pelicula) values (3, 3);
insert into director_pelicula (id_director, id_pelicula) values (4, 4);
insert into director_pelicula (id_director, id_pelicula) values (5,5);
insert into director_pelicula (id_director, id_pelicula) values (6,6);
insert into director_pelicula (id_director, id_pelicula) values (7,7);
insert into director_pelicula (id_director, id_pelicula) values (8,8);
insert into director_pelicula (id_director, id_pelicula) values (9,9);
insert into director_pelicula (id_director, id_pelicula) values (10,10);


