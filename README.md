# Kiosk
## 1) Xampp Control Panel에서 Apache, MYSQL Start 
## 2) xampp control shell > mysql -uroot -p > kiosk 데이터베이스 생성 > menu 테이블 생성 

CREATE TABLE menu (
    ->     id VARCHAR(5) PRIMARY KEY,
    ->     name VARCHAR(50) NOT NULL,
    ->     price INT NOT NULL,
    ->     available CHAR(1) NOT NULL DEFAULT 'o',
    ->     category VARCHAR(50) NOT NULL,
    ->     image_url VARCHAR(255) NOT NULL,
    ->     quantity INT NOT NULL
    -> ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

![image](https://github.com/user-attachments/assets/14d3632b-0d91-480c-9669-03b4fdab48a3)

## 3) Start.html 실행
