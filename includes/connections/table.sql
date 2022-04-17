CREATE TABLE IF NOT EXISTS `category` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    `description` VARCHAR(225) NOT NULL,
    `added_by` INT NOT NULL,
    `date_created` VARCHAR(225) NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `carmake` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    `description` VARCHAR(225) NOT NULL,
    `added_by` VARCHAR(225) NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `position` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    `added_by` VARCHAR(225) NOT NULL,
    `date_created` DATETIME NOT NULL,
    `date_updated` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `colour` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    `value` VARCHAR(225) NOT NULL,
    `added_by` VARCHAR(225) NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `status` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `country` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `vehicle` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(225) NOT NULL,
    `category_id` INT NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `category_id_fk_idx` (`category_id` ASC), 
    FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `vehiclestore` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `vehicle_id` INT NOT NULL,
    `quantity` INT NOT NULL,   
    `model` VARCHAR(225) NOT NULL,
    `unit_buying_price` INT NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `vehicle_id_fk_idx` (`vehicle_id` ASC), 
    FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
    FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `vehiclesales` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `vehiclestore_id` INT NOT NULL,
    `color_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `chasis_no` VARCHAR(225) NOT NULL,
    `unit_selling_price` INT NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `color_id_fk_idx` (`color_id` ASC),  
    INDEX `vehiclestore_id_fk_idx` (`vehiclestore_id` ASC), 
    FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
    FOREIGN KEY (`vehiclestore_id`) REFERENCES `vehiclestore` (`id`)
)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` INT NOT NULL,
    `position_id` INT NOT NULL,
    `added_by` INT NOT NULL,
    `date_created` DATETIME NOT NULL,
    `date_updated` DATETIME NOT NULL,
    `sold_by` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `position_id_fk_idx` (`position_id` ASC),  
     INDEX `sold_by_fk_idx` (`sold_by` ASC),  
    FOREIGN KEY (`position_id`) REFERENCES `position` (`id`) 
    FOREIGN KEY (`sold_by`) REFERENCES `user` (`id`)
)
ENGINE = InnoDB;