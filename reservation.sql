CREATE TABLE TableReservation (
    tablenum INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reserver VARCHAR(30),
    maxpeople INT(4) NOT NULL,
    isreserved CHAR(1) NOT NULL,
    reg_date TIMESTAMP
);

CREATE TABLE Reservations (
    reservNum INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(30) NOT NULL,
    tableNum INT(4) NOT NULL,
    numofPeople INT(4) NOT NULL,
    duration DOUBLE(4,1) NOT NULL,
    time VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
);