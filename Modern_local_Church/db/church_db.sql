-- MySQL schema for Gideon's Church Website
-- Run in your MySQL client/PhpMyAdmin.

CREATE DATABASE IF NOT EXISTS church_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE church_db;

CREATE TABLE IF NOT EXISTS sermons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sermon_date DATE NOT NULL,
  speaker VARCHAR(120) NOT NULL,
  topic VARCHAR(190) NOT NULL,
  title VARCHAR(190) NOT NULL,
  audio_url VARCHAR(255) NULL,
  video_url VARCHAR(255) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Sample data (optional)
INSERT INTO sermons (sermon_date, speaker, topic, title, audio_url, video_url)
VALUES
  ('2026-01-10','Pastor John','Faith','Faith that Moves Mountains',NULL,NULL),
  ('2026-01-17','Pastor Mary','Prayer','Praying Without Ceasing',NULL,NULL)
ON DUPLICATE KEY UPDATE id=id;

CREATE TABLE IF NOT EXISTS connect_cards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(50) NULL,
  message TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

