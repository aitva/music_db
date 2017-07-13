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