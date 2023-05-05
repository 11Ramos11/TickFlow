PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Department;

CREATE TABLE Department (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL
);

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT CHECK (role == 'Client' OR role == 'Agent' OR role == 'Admin'),
    department Integer,
    FOREIGN KEY (department) REFERENCES Department(id)
);

DROP TABLE IF EXISTS Ticket;

CREATE TABLE Ticket (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    status TEXT NOT NULL CHECK (status == 'Pending' OR status == 'Opened' OR status == 'Closed'),
    priority TEXT NOT NULL CHECK (priority == 'Immediate' OR priority == 'Urgent' OR priority == 'Normal'),
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

DROP TABLE IF EXISTS Change;

CREATE TABLE Change (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
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
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
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
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

DROP TABLE IF EXISTS Ticket_Hashtag;

CREATE TABLE Ticket_Hashtag (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    ticket INTEGER NOT NULL,
    hashtag INTEGER NOT NULL,
    FOREIGN KEY (ticket) REFERENCES Ticket(id),
    FOREIGN KEY (hashtag) REFERENCES Hashtag(id)
);

DROP TABLE IF EXISTS FAQ;

CREATE TABLE FAQ (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    department INTEGER NOT NULL,
    FOREIGN KEY (department) REFERENCES Department(id)
);
