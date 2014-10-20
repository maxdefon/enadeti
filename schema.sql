
CREATE TABLE IF NOT EXISTS steps (
    `step_id`  INT NOT NULL,
    `step_order` INT NOT NULL,
    `title` VARCHAR(250) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`step_id`)
);


