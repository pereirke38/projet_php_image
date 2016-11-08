CREATE TABLE image (
id int primary key,
path varchar(1024),
category varchar(64),
comment varchar(1024),
userId int,
FOREIGN KEY (userId) REFERENCES utilisateur(id)
);

CREATE TABLE utilisateur (
id integer primary key AUTOINCREMENT,
pseudo varchar(255),
password varchar(255)
);
