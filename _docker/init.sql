CREATE DATABASE IF NOT EXISTS snipr;
USE snipr;

-- Таблица для хранения сокращённых ссылок
CREATE TABLE IF NOT EXISTS links
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    original_url VARCHAR(2048)       NOT NULL,        -- Оригинальная ссылка
    short_code   VARCHAR(255) UNIQUE NOT NULL,        -- Уникальный код для сокращенной ссылки
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Время создания
    expires_at   TIMESTAMP           NULL             -- Время истечения срока действия
);