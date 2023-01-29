Use s3436174_wp_a2;

DROP TABLE IF EXISTS user;

CREATE TABLE user(
    email VARCHAR(255) NOT NULL PRIMARY KEY, 
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30)NOT NULL,
    phone VARCHAR(20) NOT NULL,
    birthday VARCHAR(20) NOT NULL,
    studentStatus VARCHAR(255) NOT NULL,
    employmentStatus VARCHAR(255) NOT NULL,
    passwordHash VARCHAR(255) NOT NULL
);