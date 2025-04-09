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

-- Таблица для хранения кликов по ссылкам
CREATE TABLE IF NOT EXISTS clicks
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    link_id    INT          NOT NULL,               -- Внешний ключ на ссылку
    ip_address VARCHAR(45)  NOT NULL,               -- IP-адрес пользователя
    user_agent VARCHAR(512) NOT NULL,               -- Информация о браузере пользователя
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Время клика
    FOREIGN KEY (link_id) REFERENCES links (id)     -- Связь с таблицей ссылок
);