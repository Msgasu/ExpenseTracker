DROP DATABASE IF EXISTS MS_2025;
CREATE DATABASE IF NOT EXISTS MS_2025;
USE MS_2025;

-- Users Table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    DOB DATE NOT NULL,
    PhoneNumber INT UNIQUE,
    Passwd VARCHAR(255) NOT NULL
);

-- category table
CREATE TABLE Category (
    CategoryID INT PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(255) NOT NULL,
    CategoryIcon VARCHAR(255),
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Budget Table

CREATE TABLE Budget (
    BudgetID INT PRIMARY KEY AUTO_INCREMENT,
    Amount DECIMAL(10, 2) NOT NULL,
    AmountLeft DECIMAL(10, 2),
    CategoryID INT, 
	UserID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID) 
);

-- Transaction Table
CREATE TABLE Transaction (
    TransactionID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Amount DECIMAL(10, 2),
    TransactionDate DATE,
    Description TEXT,
    CategoryName TEXT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);