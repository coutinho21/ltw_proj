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
  client INTEGER REFERENCES users(username),                       -- client id
  agent INTEGER REFERENCES users(username),                        -- agent id 
  status VARCHAR,                                                  -- status of the ticket
  department VARCHAR REFERENCES departments(id),                   -- ticket department
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