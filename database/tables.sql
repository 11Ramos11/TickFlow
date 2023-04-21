PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Department;

CREATE TABLE Department (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    name TEXT NOT NULL
);

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    permissions TEXT NOT NULL,
    department Integer NOT NULL,
    FOREIGN KEY (department) REFERENCES Department(id)
);

DROP TABLE IF EXISTS Ticket;

CREATE TABLE Ticket (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    priority TEXT NOT NULL,
    status TEXT NOT NULL,
    subject TEXT NOT NULL,
    description TEXT NOT NULL,
    creationDate DATE NOT NULL,
    creationTime TIME NOT NULL,
    author INTEGER NOT NULL,
    assignedTo INTEGER NOT NULL,
    department INTEGER,
    FOREIGN KEY (author) REFERENCES User(id),
    FOREIGN KEY (assignedTo) REFERENCES User(id),
    FOREIGN KEY (department) REFERENCES Department(id)
);

CREATE TABLE Change (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    fieldChanged TEXT NOT NULL,
    newValue TEXT NOT NULL,
    oldValue TEXT NOT NULL,
    editDate DATE NOT NULL,
    editTime TIME NOT NULL,
    ticket INTEGER NOT NULL,
    FOREIGN KEY (ticket) REFERENCES Ticket(id)
);

DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    content TEXT NOT NULL,
    creationDate DATE NOT NULL,
    creationTime TIME NOT NULL,
    author INTEGER NOT NULL,
    ticket INTEGER NOT NULL,
    FOREIGN KEY (author) REFERENCES User(id),
    FOREIGN KEY (ticket) REFERENCES Ticket(id)
);

DROP TABLE IF EXISTS Hashtag;

CREATE TABLE Hashtag (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    priority TEXT NOT NULL,
    status TEXT NOT NULL,
    subject TEXT NOT NULL,
    description TEXT NOT NULL,
    creationDate DATE NOT NULL,
    creationTime TIME NOT NULL 
);

CREATE TABLE Ticket_Hashtag (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    ticket INTEGER NOT NULL,
    hashtag INTEGER NOT NULL,
    FOREIGN KEY (ticket) REFERENCES Ticket(id),
    FOREIGN KEY (hashtag) REFERENCES Hashtag(id)
);

DROP TABLE IF EXISTS FAQ;

CREATE TABLE FAQ (
    id INTEGER CHECK (id >= 1) PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    department INTEGER NOT NULL,
    FOREIGN KEY (department) REFERENCES Department(id)
);
