ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';

CREATE TABLE WebsiteUsers ( 
    fname VARCHAR(50) NOT NULL, 
    lname VARCHAR(50) NOT NULL, 
    email VARCHAR(40) NOT NULL, 
    userName VARCHAR(40) NOT NULL,
    userID int(9) NOT NULL auto_increment, 
    pass VARCHAR(40) NOT NULL, 
    points int(9),
    PRIMARY KEY(userID) 
    );

