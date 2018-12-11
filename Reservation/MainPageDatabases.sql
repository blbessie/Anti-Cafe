CREATE TABLE GameRecord (
    id INT(4) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    score INT(4) NOT NULL,
    playtime VARCHAR(30) NOT NULL
);

CREATE TABLE Reservations (
    reservNum INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(30) NOT NULL,
    tableNum INT(4) NOT NULL,
    numofPeople INT(4) NOT NULL,
    duration DOUBLE(4,1) NOT NULL,
    time VARCHAR(30) NOT NULL,
    status VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
);

CREATE TABLE TimeTable (
    i INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    timeslot VARCHAR(30) NOT NULL,
    table1 VARCHAR(1) NOT NULL,
    table2 VARCHAR(1) NOT NULL
);

INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('9:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('10:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('11:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('12:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('13:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('14:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('15:00', 'F', 'F');
INSERT INTO TimeTable (timeslot, table1, table2)
VALUES ('16:00', 'F', 'F');
