# music_db is a database to store all we like about music.

# DEBUG: drop db if exists.
DROP DATABASE IF EXISTS music_db;

CREATE DATABASE music_db;

USE music_db;

CREATE TABLE `group` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    start DATE NOT NULL,
    end DATE,
    origin VARCHAR(64)
);

CREATE TABLE `member` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(64) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    nickname VARCHAR(64),
    role VARCHAR(64) NOT NULL,
    birth DATE NOT NULL,
    death DATE
);

CREATE TABLE `award` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL
);

CREATE TABLE `album` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    `date` DATE NOT NULL,
    label VARCHAR(128) NOT NULL,
    genre VARCHAR(128),
    sales INT
);