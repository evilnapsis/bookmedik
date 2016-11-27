/*
* BookMedik Database
* @author Evilnapsis
*/
create database bookmedik;
use bookmedik; 
set sql_mode='';
create table user (
	id int not null auto_increment primary key,
	username varchar(50),
	name varchar(50),
	lastname varchar(50),
	email varchar(255),
	password varchar(60),
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	created_at datetime
);

insert into user (username,password,is_admin,is_active,created_at) value ("admin",sha1(md5("admin")),1,1,NOW());


create table pacient (
	id int not null auto_increment primary key,
	no varchar(50),
	name varchar(50),
	lastname varchar(50),
	gender varchar(1),
	day_of_birth date,
	email varchar(255),
	address varchar(255),
	phone varchar(255),
	image varchar(255),
	sick varchar(500),
	medicaments varchar(500),
	alergy varchar(500),
	is_favorite boolean not null default 1,
	is_active boolean not null default 1,
	created_at datetime
);

create table category (
	id int not null auto_increment primary key,
	name varchar(200)
	);

insert into category (name) value ("Modulo 1");


create table medic (
	id int not null auto_increment primary key,
	no varchar(50),
	name varchar(50),
	lastname varchar(50),
	gender varchar(1),
	day_of_birth date,
	email varchar(255),
	address varchar(255),
	phone varchar(255),
	image varchar(255),
	is_active boolean not null default 1,
	created_at datetime,
	category_id int,
	foreign key (category_id) references category(id)
);



create table status (
	id int not null auto_increment primary key,
	name varchar(100)
);

insert into status (id,name) values (1,"Pendiente"), (2,"Aplicada"),(3,"No asistio"),(4,"Cancelada");

create table payment (
	id int not null auto_increment primary key,
	name varchar(100)
);

insert into payment (id,name) values  (1,"Pendiente"),(2,"Pagado"),(3,"Anulado");

create table reservation(
	id int not null auto_increment primary key,
	title varchar(100),
	note text,
	message text,
	date_at varchar(50),
	time_at varchar(50),
	created_at datetime,
	pacient_id int,
	symtoms text,
	sick text,
	medicaments text,
	user_id int,
	medic_id int,
	price double,
	is_web boolean not null default 0,
	payment_id int not null default 1,
	foreign key (payment_id) references payment(id),
	status_id int not null default 1,
	foreign key (status_id) references status(id),
	foreign key (user_id) references user(id),
	foreign key (pacient_id) references pacient(id),
	foreign key (medic_id) references medic(id)
);
