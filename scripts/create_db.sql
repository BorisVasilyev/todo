create database todo_db;

connect todo_db;

create table users(login varchar(100), password varchar(100));

create table tasks(userLogin varchar(100), name varchar(100), description varchar(200), isDone bool);

