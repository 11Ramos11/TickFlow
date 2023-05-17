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
    role TEXT CHECK (role == 'Client' OR role == 'Agent' OR role == 'Admin') DEFAULT ('Client'),
    department Integer,
    FOREIGN KEY (department) REFERENCES Department(id)
);

DROP TABLE IF EXISTS Ticket;

CREATE TABLE Ticket (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    status TEXT NOT NULL CHECK (status == 'Pending' OR status == 'Open' OR status == 'Closed') DEFAULT ('Pending'),
    priority TEXT NOT NULL CHECK (priority == 'Immediate' OR priority == 'Urgent' OR priority == 'Normal'),
    subject TEXT NOT NULL,
    description TEXT NOT NULL,
    creationDate DATE NOT NULL,
    creationTime TIME NOT NULL,
    author INTEGER NOT NULL,
    assignedTo INTEGER,
    department INTEGER,
    FOREIGN KEY (author) REFERENCES User(id),
    FOREIGN KEY (assignedTo) REFERENCES User(id),
    FOREIGN KEY (department) REFERENCES Department(id)
);

DROP TABLE IF EXISTS Change;

CREATE TABLE Change (
    id INTEGER CHECK (id >= 1) PRIMARY KEY AUTOINCREMENT,
    fieldChanged TEXT NOT NULL CHECK (fieldChanged == 'status' OR fieldChanged == 'priority' OR fieldChanged == 'subject' OR fieldChanged == 'description' OR fieldChanged == 'assignedTo' OR fieldChanged == 'department'),
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
    ticket INTEGER NOT NULL,
    hashtag INTEGER NOT NULL,
    PRIMARY KEY (ticket, hashtag),
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


INSERT INTO Department (id, name) VALUES
  (1, 'Sales Department'),
  (2, 'Marketing Department'),
  (3, 'Information Technology Department'),
  (4, 'Human Resources Department');

INSERT INTO FAQ (id, question, answer, department) VALUES
  (1, 'What is the process for requesting vacation time?', 'To request vacation time, please submit a request through the HR portal at least two weeks in advance.', 1),
  (2, 'How do I access the company directory?', 'You can access the company directory through the employee portal. If you do not have access, please contact HR.', 1),
  (3, 'What is the dress code for client meetings?', 'The dress code for client meetings is business professional.', 1),
  (4, 'What is the process for requesting IT support?', 'To request IT support, please submit a ticket through the IT portal. Urgent issues should be reported by phone.', 2),
  (5, 'How do I access the VPN?', 'To access the VPN, please download and install the VPN client from the IT portal. If you do not have access, please contact IT.', 2),
  (6, 'What is the process for requesting new software?', 'To request new software, please submit a request through the IT portal. Please include a description of the software and its intended use.', 2),
  (7, 'What is the process for requesting time off?', 'To request time off, please submit a request through the HR portal at least two weeks in advance.', 3),
  (8, 'What is the policy for remote work?', 'The policy for remote work is determined by department managers. Please check with your manager to determine if remote work is an option for your role.', 3),
  (9, 'How do I request a training session?', 'To request a training session, please contact your department manager. Your manager will work with HR to arrange the training.', 3),
  (10, 'What is the process for requesting travel reimbursement?', 'To request travel reimbursement, please submit a request through the HR portal within 30 days of your trip. Please include all receipts and documentation.', 4),
  (11, 'How do I book travel for business trips?', 'To book travel for business trips, please contact the travel coordinator in the HR department. The travel coordinator will work with you to arrange travel and lodging.', 4),
  (12, 'What is the process for requesting a purchase order?', 'To request a purchase order, please submit a request through the purchasing portal. Please include a description of the item or service being requested, as well as the cost.', 4);

INSERT INTO User (id, name, email, password, role, department) VALUES 
  (1, 'John Smith', 'john.smith@tickflow.com', 'password1', 'Admin', 1),
  (2, 'Jane Doe', 'jane.doe@tickflow.com', 'password2', 'Client', 1),
  (3, 'Bob Johnson', 'bob.johnson@tickflow.com', 'password3', 'Agent', 1),
  (4, 'Alice Williams', 'alice.williams@tickflow.com', 'password4', 'Client', 2),
  (5, 'Charlie Brown', 'charlie.brown@tickflow.com', 'password5', 'Agent', 2),
  (6, 'Emily Davis', 'emily.davis@tickflow.com', 'password6', 'Agent', 2),
  (7, 'George Rodriguez', 'george.rodriguez@tickflow.com', 'password7', 'Agent', 3),
  (8, 'Megan Lee', 'megan.lee@tickflow.com', 'password8', 'Agent', 3),
  (9, 'David Kim', 'david.kim@tickflow.com', 'password9', 'Agent', 3),
  (10, 'Karen Chen', 'karen.chen@tickflow.com', 'password10', 'Agent', 3),
  (11, 'Tom Brown', 'tom.brown@tickflow.com', 'password11', 'Agent', 4),
  (12, 'Emma Wilson', 'emma.wilson@tickflow.com', 'password12', 'Agent', 4),
  (13, 'Chris Lee', 'chris.lee@tickflow.com', 'password13', 'Agent', 4),
  (14, 'Lisa Miller', 'lisa.miller@tickflow.com', 'password14', 'Client', 3),
  (15, 'Mike Davis', 'mike.davis@tickflow.com', 'password15', 'Client', 3),
  (16, 'Sarah Wilson', 'sarah.wilson@tickflow.com', 'password16', 'Client', 3),
  (17, 'Steven Miller', 'steven.miller@tickflow.com', 'password17', 'Client', 4),
  (18, 'Amy Jones', 'amy.jones@tickflow.com', 'password18', 'Client', 4),
  (19, 'Kevin Davis', 'kevin.davis@tickflow.com', 'password19', 'Client', 4);

INSERT INTO Ticket (id, status, priority, subject, description, creationDate, creationTime, author, assignedTo, department) VALUES
  (1, 'Open', 'Normal', 'Printer Not Working', 'I am unable to print from my computer. Please help me resolve the issue.', '2023-04-22', '10:00:00', 4, 7, 3),
  (2, 'Pending', 'Immediate', 'Website Down', 'Our website seems to be down. We need to get it back up and running as soon as possible.', '2023-04-22', '11:30:00', 12, NULL, 3),
  (3, 'Open', 'Urgent', 'Email Account Issue', 'I am having trouble accessing my email account. Please help me resolve the issue as soon as possible.', '2023-04-22', '12:45:00', 5, 8, 3),
  (4, 'Open', 'Normal', 'Need New Laptop', 'My current laptop is old and slow. I need a new laptop to be able to work efficiently.', '2023-04-22', '14:00:00', 3, 12, 4),
  (5, 'Pending', 'Urgent', 'Cannot Access Shared Drive', 'I am unable to access the Marketing shared drive. This is causing a delay in my work. Please help me resolve the issue as soon as possible.', '2023-04-22', '15:15:00', 1, NULL, 2),
  (6, 'Open', 'Normal', 'Need Additional Monitor', 'I need an additional monitor to be able to work more efficiently.', '2023-04-22', '16:30:00', 8, 11, 4),
  (7, 'Closed', 'Immediate', 'Server Down', 'One of our servers is down. This is affecting multiple employees. We need to get it back up and running as soon as possible.', '2023-04-22', '17:45:00', 2, 10, 3),
  (8, 'Open', 'Normal', 'New Software Request', 'I need new software installed on my computer to be able to complete a project. Please install the software for me.', '2023-04-23', '09:00:00', 5, 9, 3),
  (9, 'Pending', 'Urgent', 'VPN Connection Issue', 'I am unable to connect to the VPN. This is preventing me from accessing important files. Please help me resolve the issue as soon as possible.', '2023-04-23', '10:30:00', 7, NULL, 3),
  (10, 'Open', 'Normal', 'Need New Desk Chair', 'My current desk chair is causing me back pain. I need a new chair to be able to work comfortably.', '2023-04-23', '12:00:00', 6, 13, 4);

INSERT INTO Message (content, creationDate, creationTime, author, ticket) VALUES 
  ('Hi, we are pleased to inform you that a technician is already on his way to fix the respective printer. We will notify you once it''s fixed.', '2023-04-22', '10:30:23', 7, 1),
  ('Thank you!', '2023-04-22', '10:31:04', 4, 1),
  ('Servers are already back up and running!', '2023-04-22', '17:47:12', 10, 7);

INSERT INTO Change (fieldChanged, newValue, oldValue, editDate, editTime, ticket) VALUES 
  ('status', 'Closed', 'Open', '2023-04-22', '17:47:12', 7),
  ('status', 'Open', 'Pending', '2023-04-22', '10:29:21', 1),
  ('status', 'Open', 'Pending', '2023-04-22', '12:46:04', 3),
  ('status', 'Open', 'Pending', '2023-04-22', '14:12:53', 4),
  ('status', 'Open', 'Pending', '2023-04-22', '16:36:12', 6),
  ('status', 'Open', 'Pending', '2023-04-23', '09:12:43', 8),
  ('status', 'Open', 'Pending', '2023-04-23', '13:23:17', 10);

INSERT INTO Hashtag (id, name) VALUES 
  (1, 'printer'),
  (2, 'website'),
  (3, 'email'),
  (4, 'laptop'),
  (5, 'drive'),
  (6, 'monitor'),
  (7, 'server'),
  (8, 'software'),
  (9, 'vpn'),
  (10, 'chair'),
  (11, 'hardware'),
  (12, 'network'),
  (13, 'account');

INSERT INTO Ticket_Hashtag (ticket, hashtag) VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5),
  (6, 6),
  (7, 7),
  (8, 8),
  (9, 9),
  (10, 10),
  (1, 11),
  (6, 11),
  (5, 12),
  (7, 12),
  (9, 12),
  (3, 13);