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

CREATE TABLE tickets (
  id INTEGER PRIMARY KEY,                                          -- ticket id
  client_id INTEGER REFERENCES user(id),                           -- client id
  agent_id INTEGER REFERENCES user(id),                            -- agent id 
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
  user_id INTEGER REFERENCES user(id),                             -- user id
  action VARCHAR,                                                  -- action
  action_date VARCHAR                                              -- action date
);