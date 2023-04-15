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
    department VARCHAR,                                            -- department of the user
    role VARCHAR CHECK (role IN ('client', 'agent', 'admin'))      -- role of the user
);

CREATE TABLE departments (
    id INTEGER PRIMARY KEY,                                        -- department id
    name VARCHAR                                                   -- name of the department
);

-- many-to-many relationship between users and departments
CREATE TABLE users_departments (
    user VARCHAR REFERENCES user(username),                        -- username of the user
    department_id INTEGER REFERENCES department(id)                -- department id
);

CREATE TABLE tickets (
  id INTEGER PRIMARY KEY,                                          -- ticket id
  client INTEGER REFERENCES user(username),                        -- client id
  agent INTEGER REFERENCES user(username),                         -- agent id 
  status VARCHAR CHECK(status IN ('open', 'assigned', 'closed')),  -- status of the ticket
  department VARCHAR,                                              -- ticket department
  title VARCHAR,                                                   -- title of the article
  date INTEGER,                                                    -- date when the article was published in epoch format
  introduction VARCHAR,                                            -- an introductory paragraph
  fullVARCHAR VARCHAR                                              -- the rest of the VARCHAR
);

CREATE TABLE ticket_hashtags (
  id INTEGER PRIMARY KEY,                                          -- ticket_hashtag id
  ticket_id INTEGER REFERENCES ticket(id),                         -- ticket id
  hashtag_name VARCHAR                                             -- hashtag name
);

CREATE TABLE ticket_history (
  id INTEGER PRIMARY KEY,                                          -- ticket_history id
  ticket_id INTEGER REFERENCES ticket(id),                         -- ticket id
  user INTEGER REFERENCES user(username),                          -- user id
  action VARCHAR,                                                  -- action
  action_date VARCHAR                                              -- action date
);