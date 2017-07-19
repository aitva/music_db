# music_db is a database to store all we like about music.

# DEBUG: drop db if exists.
DROP DATABASE IF EXISTS `music_db`;

CREATE DATABASE `music_db`;

USE `music_db`;

CREATE TABLE `group` (
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `name`      VARCHAR(64) NOT NULL,
    `start`     DATE NOT NULL,
    `end`       DATE,
    `origin`    VARCHAR(64)
);

CREATE TABLE `member` (
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(64) NOT NULL,
    `lastname`  VARCHAR(128) NOT NULL,
    `nickname`  VARCHAR(64),
    `role`      VARCHAR(64) NOT NULL,
    `birth`     DATE NOT NULL,
    `death`     DATE
);

CREATE TABLE `award` (
    `id`    INT AUTO_INCREMENT PRIMARY KEY,
    `name`  VARCHAR(64) NOT NULL
);

CREATE TABLE `album` (
    `id`    INT AUTO_INCREMENT PRIMARY KEY,
    `name`  VARCHAR(64) NOT NULL,
    `date`  DATE NOT NULL,
    `label` VARCHAR(128) NOT NULL,
    `genre` VARCHAR(128),
    `sales` INT
);

# Ajoute une colone au tableau album.
ALTER TABLE `album` ADD `group_id` INT NOT NULL;
# Ajoute une clef étrangère au tableau album.
# La clef étrangère est group_id et pointe sur le tableau group et la colone id.
ALTER TABLE `album` ADD FOREIGN KEY (`group_id`) REFERENCES `group`(`id`);

ALTER TABLE `award` ADD `album_id` INT NOT NULL;
ALTER TABLE `award` ADD FOREIGN KEY (`album_id`) REFERENCES `album`(`id`);

# La table album_member permet de créer un lien entre les tables album et membre.
CREATE TABLE `album_member` (
    `album_id` INT NOT NULL,
    `member_id` INT NOT NULL,
    FOREIGN KEY (`album_id`) REFERENCES `album`(`id`),
    FOREIGN KEY (`member_id`) REFERENCES `member`(`id`),
    PRIMARY KEY (`album_id`, `member_id`)
);

# Add data to the database.
INSERT INTO `group` (`name`, `start`, `end`, `origin`) VALUES
    ("Led Zeppelin", DATE("1968-01-01"), DATE("1980-01-01"), "UK"),
    ("The Beatles", DATE("1960-01-01"), DATE("1970-01-01"), "UK"),
    ("PNL", DATE("2004-01-01"), NULL, "FR");

INSERT INTO `member` (`firstname`, `lastname`, `nickname`, `role`, `birth`, `death`) VALUES
    ("Tarik", "Andrieu", NULL, "singer", DATE("1986-01-01"), NULL),
    ("Nabil", "Andrieu", NULL, "singer", DATE("1989-01-01"), NULL),
    ("James", "Page", "Jimmy", "guitar player", DATE("1957-01-01"), NULL),
    ("Robert", "Plant", NULL, "singer", DATE("1966-01-01"), NULL),
    ("John", "Baldwin", "John Paul Jones", "bass player", DATE("1946-01-01"), NULL),
    ("John", "Bonham", "Bonzo", "drummer", DATE("1948-01-01"), DATE("1980-01-01")),
    ("John", "Lennon", NULL, "singer", DATE("1940-01-01"), DATE("1980-01-01")),
    ("James", "McCartney", "Macca", "guitar player", DATE("1942-01-01"), NULL),
    ("George", "Harrison", NULL, "bass player", DATE("1943-01-01"), DATE("2001-01-01")),
    ("Richard", "Starkey", NULL, "drummer", DATE("1940-01-01"), NULL);

INSERT INTO `album` (`name`, `date`, `label`, `genre`, `sales`, `group_id`) VALUES
    ("Led Zeppelin IV", DATE("1971-11-08"), "Atlantic Records", "hard rock", 23000000, 1),
    ("Led Zeppelin", DATE("1969-01-12"), "Atlantic Records", "hard rock", 10000000, 1),
    ("Physical Graffiti", DATE("1975-02-24"), "Swan Song Records", "hard rock", 16000000, 1),
    ("Please Please Me", DATE("1963-03-22"), "Parlophone", "pop", 1000000, 2),
    ("With The Beatles", DATE("1963-11-22"), "Parlophone", "pop", 500000, 2),
    ("A Hard Day's Night", DATE("1964-06-26"), "Parlophone", "pop", 4000000, 2),
    ("Le Monde Chico", DATE("2015-10-30"), "QLF Records", "cloud rap", 200000, 3),
    ("Dans La Légende", DATE("2016-09-16"), "QLF Records", "cloud rap", 500000, 3);

INSERT INTO `award` (`name`, `album_id`) VALUES
    ("Gold", 1),
    ("Platinum", 1),
    ("Multi-Platinum", 1),
    ("Gold", 2),
    ("Platinum", 2),
    ("Multi-Platinum", 2),
    ("Gold", 3),
    ("Platinum", 3),
    ("Multi-Platinum", 3),
    ("Gold", 4),
    ("Platinum", 4),
    ("Gold", 5),
    ("Gold", 6),
    ("Platinum", 6),
    ("Multi-Platinum", 6),
    ("Gold", 7),
    ("Gold", 8),
    ("Platinum", 8),
    ("Diamon", 8);
