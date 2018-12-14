CREATE TABLE WebsiteUsers ( 
    userID int(9) NOT NULL auto_increment,    
    fname VARCHAR(50) NOT NULL, 
    lname VARCHAR(50) NOT NULL, 
    email VARCHAR(40) NOT NULL, 
    userName VARCHAR(40) NOT NULL,
    pass VARCHAR(100) NOT NULL, 
    points int(9),
    PRIMARY KEY(userID) 
    );

