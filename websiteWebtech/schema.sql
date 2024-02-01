CREATE DATABASE kimi;
USE kimi;

-- Create the users table
CREATE TABLE Users
(
    id         INT          NOT NULL AUTO_INCREMENT,
    admin      BOOLEAN      NOT NULL DEFAULT FALSE,
    email      VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(255) NOT NULL,
    last_name  VARCHAR(255) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- Create the locations table
CREATE TABLE Locations
(
    id          INT           NOT NULL AUTO_INCREMENT,
    name        VARCHAR(255)  NOT NULL,
    description VARCHAR(255)  NOT NULL,
    address     VARCHAR(255)  NOT NULL,
    latitude    DECIMAL(9, 6) NOT NULL,
    longitude   DECIMAL(9, 6) NOT NULL,
    PRIMARY KEY (id)
);

-- Populate the locations table
INSERT INTO Locations
VALUES (1, 'Roeterseiland', 'Roeterseiland Campus', 'Roetersstraat 11, 1018 WB Amsterdam', 52.364, 4.911);
INSERT INTO Locations
VALUES (2, 'Science Park', 'Amsterdam Science Park 904', 'Science Park 904, 1098 XH Amsterdam', 52.354, 4.956);

-- Create the tables table
CREATE TABLE Tables
(
    id          INT     NOT NULL AUTO_INCREMENT,
    location_id INT     NOT NULL,
    max_seats   INT     NOT NULL,
    booked      BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id),
    FOREIGN KEY (location_id) REFERENCES Locations (id)
);

-- Populate the tables table
INSERT INTO Tables
VALUES (1, 1, 6, false);
INSERT INTO Tables
VALUES (2, 1, 6, false);
INSERT INTO Tables
VALUES (3, 1, 4, false);
INSERT INTO Tables
VALUES (4, 1, 4, false);
INSERT INTO Tables
VALUES (5, 1, 4, false);
INSERT INTO Tables
VALUES (6, 1, 4, false);
INSERT INTO Tables
VALUES (7, 1, 2, false);
INSERT INTO Tables
VALUES (8, 1, 2, false);
INSERT INTO Tables
VALUES (9, 1, 2, false);
INSERT INTO Tables
VALUES (10, 1, 2, false);

INSERT INTO Tables
VALUES (11, 2, 6, false);
INSERT INTO Tables
VALUES (12, 2, 6, false);
INSERT INTO Tables
VALUES (13, 2, 4, false);
INSERT INTO Tables
VALUES (14, 2, 4, false);
INSERT INTO Tables
VALUES (15, 2, 4, false);
INSERT INTO Tables
VALUES (16, 2, 4, false);
INSERT INTO Tables
VALUES (17, 2, 2, false);
INSERT INTO Tables
VALUES (18, 2, 2, false);
INSERT INTO Tables
VALUES (19, 2, 2, false);
INSERT INTO Tables
VALUES (20, 2, 2, false);

-- Create the reservations table
CREATE TABLE Reservations
(
    id         INT      NOT NULL AUTO_INCREMENT,
    user_id    INT      NOT NULL,
    table_id   INT      NOT NULL,
    start_time DATETIME NOT NULL,
    end_time   DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (table_id) REFERENCES Tables (id)
);

-- Create the menu table
CREATE TABLE Menu
(
    id          INT NOT NULL AUTO_INCREMENT,
    location_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (location_id) REFERENCES Locations (id)
);

-- Create the menu items table
CREATE TABLE MenuItems
(
    id          INT           NOT NULL AUTO_INCREMENT,
    menu_id     INT           NOT NULL,
    name        VARCHAR(255)  NOT NULL,
    description VARCHAR(1000) NOT NULL,
    price       DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (menu_id) REFERENCES Menu (id)
);