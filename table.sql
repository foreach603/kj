create table kj_category(
    id int(10) not null auto_increment,
    catname VARCHAR(30) NOT NULL,
    pid decimal(10, 0) not null,
    ord decimal(10, 0) not null,
    primary key(`id`)
) default charset = utf8;

insert into kj_category values(1, 'one', '0', '3');
insert into kj_category values(2, 'two', '0', '0');
insert into kj_category values(3, 'three', '0', '0');
insert into kj_category values(4, 'four', '0', '0');

insert into kj_category values(5, 'a1', '1', '3');
insert into kj_category values(6, 'b1', '1', '0');
insert into kj_category values(7, 'a2', '2', '0');
insert into kj_category values(8, 'b2', '2', '0');

insert into kj_category values(9, 'aaa', '5', '3');
insert into kj_category values(10, 'bbb', '5', '0');
insert into kj_category values(11, 'ccc', '8', '0');
insert into kj_category values(12, 'ddd', '8', '0');

create table kj_book(
    id int(10) not null auto_increment,
    name VARCHAR(30) NOT NULL,
    description VARCHAR(30) default null,
    price decimal(10, 2) not null,
    stock decimal(10,0) default null,
    cid decimal(10,0) default null,
    filename VARCHAR(200) default null,
    primary key(`id`)
) default charset = utf8;
