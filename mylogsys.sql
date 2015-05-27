create database mylogsys;
use mylogsys;

create table myuser
(
    username varchar(16) not null ,
    passwd char(40) not null,
    email varchar(100) not null,
    primary key (username)
);

grant select,update,insert,delete
on mylogsys.*
to ml_user@localhost identified by 'mlpasswd123';

/*

1.database写成datebase
2.user表名不允许
3.primary key的写法为单独一行
4.create table的括号不是花括号
5.注意分号

*/
