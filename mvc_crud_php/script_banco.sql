DROP TABLE pessoa;
drop table cidade;
drop table estado;

CREATE TABLE pessoa (
id	SERIAL PRIMARY KEY,
nome	VARCHAR(200) NOT NULL,
usuario	VARCHAR(50) NOT NULL,
senha	VARCHAR(20) NOT NULL,
email varchar(100) not null,
idCid int references cidade(idCid)
    on update restrict
    on delete restrict

);

create table estado(
idEstado serial primary key,
nomeEstado varchar(100)not null
)
create table cidade(
idCid serial primary key,
nomeCid varchar(100)not null,
idEstado int references estado(idEstado)
	on update restrict
	on delete restrict
)
insert into cidade values(default, 'Jales', 1)
insert into cidade values(default, 'Fernandopolis', 1)

insert into estado values (default, 'São Paulo')

INSERT INTO pessoa VALUES (DEFAULT, 'Maria Josefina Souza', 'mariasouza', 1234, 'maria@baidu.com',1);

INSERT INTO pessoa VALUES (DEFAULT, 'José dos Santos Silva', 'josesilva', 2468, 'jose@baidu.com','rua 1', 2);

INSERT INTO pessoa VALUES (DEFAULT, 'Vagner dos Santos', 'vagnersantos', 1357,'vagner@baidu.com','rua 2', 2);

SELECT * FROM estado

