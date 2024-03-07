CREATE TABLE user_messages (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  telephone varchar(20) NOT NULL,
  country varchar(255) DEFAULT NULL,
  state varchar(255) DEFAULT NULL,
  city varchar(255) DEFAULT NULL,
  street varchar(255) NOT NULL,
  subject varchar(255) NOT NULL,
  message text NOT NULL,
  timestamp timestamp NOT NULL DEFAULT current_timestamp()
);
