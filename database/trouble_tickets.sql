.mode columns
.headers on

DROP TABLE IF EXISTS ticket_history;
DROP TABLE IF EXISTS ticket_hashtag;
DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS user;


CREATE TABLE users (
    username VARCHAR PRIMARY KEY UNIQUE,                           -- username of the user
    name VARCHAR,                                                  -- name of the user
    email VARCHAR UNIQUE,                                          -- email address
    password VARCHAR,                                              -- password hash
    role VARCHAR CHECK (role IN ('client', 'agent', 'admin'))      -- role of the user
);

CREATE TABLE departments (
    id INTEGER PRIMARY KEY,                                        -- department id
    name VARCHAR                                                   -- name of the department
);

-- many-to-many relationship between users and departments
CREATE TABLE users_departments (
    user VARCHAR REFERENCES users(username),                       -- username of the user
    department_id INTEGER REFERENCES departments(id)               -- department id
);

CREATE TABLE tickets (
  id INTEGER PRIMARY KEY,                                          -- ticket id
  client VARCHAR REFERENCES users(username),                       -- client username
  agent VARCHAR REFERENCES users(username),                        -- agent username
  status_id INTEGER REFERENCES status(id),                         -- status of the ticket
  department_id INTEGER REFERENCES departments(id),                -- ticket department
  title VARCHAR,                                                   -- title of the article
  date INTEGER,                                                    -- date when the article was published in epoch format
  introduction VARCHAR,                                            -- an introductory paragraph
  description VARCHAR                                              -- the rest of the VARCHAR
);

CREATE TABLE hashtags (
  id INTEGER PRIMARY KEY,                                          -- ticket_hashtag id
  name VARCHAR                                                     -- hashtag name
);

CREATE TABLE ticket_history (
  id INTEGER PRIMARY KEY,                                          -- ticket_history id
  ticket_id INTEGER REFERENCES tickets(id),                        -- ticket id
  user INTEGER REFERENCES users(username),                         -- user id
  action VARCHAR,                                                  -- action description
  action_date VARCHAR                                              -- action date
);

CREATE TABLE ticket_replies (
  id INTEGER PRIMARY KEY,                                          -- ticket_reply id
  ticket_id INTEGER REFERENCES tickets(id),                        -- ticket id
  user INTEGER REFERENCES users(username),                         -- user id
  reply VARCHAR,                                                   -- reply
  reply_date INTEGER                                               -- reply date
);

-- many-to-many relationship between tickets and hashtags
CREATE TABLE tickets_hashtags (
  ticket_id INTEGER REFERENCES tickets(id),                        -- ticket id
  hashtag_id INTEGER REFERENCES hashtags(id)                       -- hashtag id
);

CREATE TABLE faqs (
  id INTEGER PRIMARY KEY,                                          -- faq id
  question VARCHAR,                                                -- frequently asked question
  answer VARCHAR                                                   -- the answer to that question
);

CREATE TABLE status (
  id INTEGER PRIMARY KEY,                                          -- status id
  name VARCHAR                                                     -- status name
);



INSERT INTO tickets (client, status_id, department_id, title, date, introduction, description) VALUES ('john.doe', 1, 1, 'Cannot log into my account', 1681862400, 'I am having trouble logging into my account. I have tried resetting my password but it still does not work.', 'I need help resolving this issue as soon as possible.');
INSERT INTO tickets (client, status_id, department_id, title, date, introduction, description) VALUES ('jane.doe', 1, 2, 'Issue with order', 1681516800, 'I placed an order but it has not arrived yet. Can you please check on the status of my order?', 'I need this order as soon as possible for an important event.');
INSERT INTO departments (name) VALUES ('IT Support');
INSERT INTO departments (name) VALUES ('Customer Service');
INSERT INTO departments (name) VALUES ('Sales');
INSERT INTO status (name) VALUES ('open');
INSERT INTO status (name) VALUES ('assigned');
INSERT INTO status (name) VALUES ('closed');
INSERT INTO faqs (question, answer) VALUES ('What is your return policy?','Our return policy allows customers to return items within 30 days of purchase.');
INSERT INTO faqs (question, answer) VALUES ('Do you offer international shipping?','Yes, we offer international shipping to select countries.');
INSERT INTO faqs (question, answer) VALUES ('How do I reset my password?','You can reset your password by clicking on the ""forgot password"" link on the login page.');
INSERT INTO faqs (question, answer) VALUES ('What payment methods do you accept?','We accept all major credit cards, as well as PayPal and Apple Pay.');
INSERT INTO faqs (question, answer) VALUES ('Can I track my order?','Yes, you can track your order by logging into your account and clicking on the ""Order History"" tab.');
INSERT INTO faqs (question, answer) VALUES ('How do I create an account?',"To create an account on our website, follow these steps: 1. Visit our website homepage. 2. Click on the 'Sign Up' button at the top right corner. 3. Fill out the registration form with your details, including your name, email address, and password. 4. Review the terms and conditions, and if you agree, check the box. 5. Click the 'Submit' button to create your account. Once you've completed these steps, you'll receive a confirmation email with further instructions. Make sure to check your spam folder if you don't see the email in your inbox. If you encounter any issues during the registration process, please contact our support team for assistance.");
INSERT INTO faqs (question, answer) VALUES ('What is your refund policy?',"Our refund policy allows for refunds within 30 days of purchase. If you are not satisfied with your purchase, please contact our customer support team to initiate the refund process. We will review your request and provide further instructions on returning the product and receiving a refund. Please note that certain conditions and restrictions may apply.");
INSERT INTO faqs (question, answer) VALUES ('How long does shipping take?',"Shipping times vary depending on your location and the shipping method chosen. Typically, orders are processed and shipped within 1-2 business days. Once shipped, the estimated delivery time is usually between 3-7 business days for domestic orders. International shipping may take longer, depending on the destination country. You can track your order using the tracking number provided in the shipping confirmation email.");
INSERT INTO faqs (question, answer) VALUES ('How do I return an item?','You can return an item by logging into your account and clicking on the "Return" button next to the item you wish to return.');
INSERT INTO hashtags (name) VALUES ('#bug');
INSERT INTO tickets_hashtags (ticket_id, hashtag_id) VALUES (1, 1);
INSERT INTO users_departments (user, department_id) VALUES ('coutinho21', 1);
INSERT INTO users_departments (user, department_id) VALUES ('anacarol.rsa', 2);
INSERT INTO users_departments (user, department_id) VALUES ('rui_carvalho', 1);
INSERT INTO users (username,name,email,password,role) VALUES ('coutinho21','Guilherme Coutinho','guilhermecscoutinho@gmail.com','$2y$10$8bxNtXvNopK5XyUyzBm1j.z/4aCTiHJRxKxBVj8hooYC3YmcIBcTe','admin');
INSERT INTO users (username,name,email,password,role) VALUES ('anacarol.rsa','Carolina Almeida','anacarol.rsalmeida@gmail.com','$2y$10$ZrF7Zk2/Y5L35f.FBuMQ5.xKh6fTUrNagEaNYegLX76MYWkG0VwXe','admin');
INSERT INTO users (username,name,email,password,role) VALUES ('rui_carvalho','Rui Carvalho','ruipedrobc@gmail.com','$2y$10$tYRVJaB6gAfkHo1Pz0vkWuk.BupewS5Z10dGn41WofdedMOYpmtGy','admin');
INSERT INTO users (username,name,email,password,role) VALUES ('john.doe','John Doe','johndoe@example.com','$2y$10$fHk0o5TsBnaprtsIAYYJd.eiXGeKPvm/SPWzFhD2TroqyMgJSdgFi','client');
INSERT INTO users (username,name,email,password,role) VALUES ('jane.doe','Jane Doe','janedoe@example.com','$2y$10$fHk0o5TsBnaprtsIAYYJd.eiXGeKPvm/SPWzFhD2TroqyMgJSdgFi','client');