create database bookmedik;
use bookmedik; 

create table user (
	id int not null auto_increment primary key,
	username varchar(50) not null,
	name varchar(50) not null,
	lastname varchar(50) not null,
	email varchar(255) not null,
	password varchar(60) not null,
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	created_at datetime
);

create table pacient (
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50),
	email varchar(255) not null,
	address varchar(255),
	phone varchar(255),
	image varchar(255),
	is_active boolean not null default 1,
	created_at datetime not null
);

create table category (
	id int not null auto_increment primary key,
	name varchar(200) not null
	);

insert into category (name) value ("Modulo 1");


create table medic (
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50),
	email varchar(255) not null,
	address varchar(255),
	phone varchar(255),
	image varchar(255),
	is_active boolean not null default 1,
	created_at datetime not null,
	category_id int,
	foreign key (category_id) references category(id)
);


insert into user (username,password,is_admin,created_at) value ("admin",sha1(md5("admin")),1,NOW());


create table reservation(
	id int not null auto_increment primary key,
	title varchar(100) not null,
	note text not null,
	message text not null,
	date_at varchar(50) not null,
	time_at varchar(50) not null,
	created_at datetime not null,
	pacient_id int not null,
	user_id int not null,
	medic_id int not null,
	is_web boolean not null default 0,
	foreign key (user_id) references user(id),
	foreign key (pacient_id) references pacient(id),
	foreign key (medic_id) references medic(id)
);
