create table contact(
    id int auto_increment primary key,
    fname varchar(100),
    lname varchar(100),
    email varchar(100),
    message varchar(100),
    submitted_date varchar(100) default CURRENT_TIMESTAMP
)