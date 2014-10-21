
CREATE TABLE IF NOT EXISTS steps (
  `step_id` INT NOT NULL,
  `step_order` INT NOT NULL,
  `title` VARCHAR(250) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`step_id`)
);

CREATE TABLE IF NOT EXISTS users (
  `user_id` VARCHAR(100) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `active` INT(1) NOT NULL,
  `registration` INT(12) NOT NULL,
  `name` VARCHAR(250),
  `password` VARCHAR(5000),
  PRIMARY KEY(`user_id`)
);

CREATE TABLE IF NOT EXISTS checklist (
  `user_id` VARCHAR(100) NOT NULL,
  `step_id` INT NOT NULL,
  PRIMARY KEY(`user_id`,`step_id`),
  FOREIGN KEY(`user_id`) REFERENCES users(`user_id`),
  FOREIGN KEY(`step_id`) REFERENCES steps(`step_id`)
);

