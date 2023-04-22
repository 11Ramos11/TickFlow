INSERT INTO Department (id, name)
VALUES
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

INSERT INTO User (id, name, email, password, permissions, department) VALUES 
  (1, 'John Smith', 'john.smith@company.com', 'password1', 'Admin', 1),
  (2, 'Jane Doe', 'jane.doe@company.com', 'password2', 'Client', 1),
  (3, 'Bob Johnson', 'bob.johnson@company.com', 'password3', 'Agent', 1),
  (4, 'Alice Williams', 'alice.williams@company.com', 'password4', 'Client', 2),
  (5, 'Charlie Brown', 'charlie.brown@company.com', 'password5', 'Agent', 2),
  (6, 'Emily Davis', 'emily.davis@company.com', 'password6', 'Client', 2),
  (7, 'George Rodriguez', 'george.rodriguez@company.com', 'password7', 'Agent', 3),
  (8, 'Megan Lee', 'megan.lee@company.com', 'password8', 'Client', 3),
  (9, 'David Kim', 'david.kim@company.com', 'password9', 'Client', 3),
  (10, 'Karen Chen', 'karen.chen@company.com', 'password10', 'Client', 3),
  (11, 'Tom Brown', 'tom.brown@company.com', 'password11', 'Client', 4),
  (12, 'Emma Wilson', 'emma.wilson@company.com', 'password12', 'Agent', 4),
  (13, 'Chris Lee', 'chris.lee@company.com', 'password13', 'Client', 4);

INSERT INTO Ticket (id, status, priority, subject, description, creationDate, creationTime, author, assignedTo, department) VALUES
(1, 'Opened', 'Normal', 'Printer Not Working', 'I am unable to print from my computer. Please help me resolve the issue.', '2023-04-22', '10:00:00', 4, 7, 3),
(2, 'Pending', 'Immediate', 'Website Down', 'Our website seems to be down. We need to get it back up and running as soon as possible.', '2023-04-22', '11:30:00', 12, 8, 3),
(3, 'Opened', 'Urgent', 'Email Account Issue', 'I am having trouble accessing my email account. Please help me resolve the issue as soon as possible.', '2023-04-22', '12:45:00', 5, 8, 3),
(4, 'Opened', 'Normal', 'Need New Laptop', 'My current laptop is old and slow. I need a new laptop to be able to work efficiently.', '2023-04-22', '14:00:00', 3, 12, 4),
(5, 'Pending', 'Urgent', 'Cannot Access Shared Drive', 'I am unable to access the Marketing shared drive. This is causing a delay in my work. Please help me resolve the issue as soon as possible.', '2023-04-22', '15:15:00', 1, 6, 2),
(6, 'Opened', 'Normal', 'Need Additional Monitor', 'I need an additional monitor to be able to work more efficiently.', '2023-04-22', '16:30:00', 8, 11, 4),
(7, 'Closed', 'Immediate', 'Server Down', 'One of our servers is down. This is affecting multiple employees. We need to get it back up and running as soon as possible.', '2023-04-22', '17:45:00', 2, 10, 3),
(8, 'Opened', 'Normal', 'New Software Request', 'I need new software installed on my computer to be able to complete a project. Please install the software for me.', '2023-04-23', '09:00:00', 5, 9, 3),
(9, 'Pending', 'Urgent', 'VPN Connection Issue', 'I am unable to connect to the VPN. This is preventing me from accessing important files. Please help me resolve the issue as soon as possible.', '2023-04-23', '10:30:00', 7, 10, 3),
(10, 'Opened', 'Normal', 'Need New Desk Chair', 'My current desk chair is causing me back pain. I need a new chair to be able to work comfortably.', '2023-04-23', '12:00:00', 6, 13, 4);

INSERT INTO Message (id, content, creationDate, creationTime, author, ticket) VALUES 
(1, 'Hi, we are pleased to inform you that a technician is already on his way to fix the respective printer. We will notify you once it''s fixed.', '2023-04-22', '10:30:00', 7, 1),
(2, 'Thank you!', '2023-04-22', '10:31:00', 4, 1),
(3, 'Servers are already back up and running!', '2023-04-22', '17:47:12', 10, 3);

