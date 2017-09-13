CREATE USER 'cake'@'localhost' IDENTIFIED BY 'password';
SELECT host, user FROM mysql.user;
CREATE DATABASE cakephp CHARACTER SET utf8;
SHOW DATABASES;
GRANT ALL PRIVILEGES ON cakephp.* TO 'cake'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'cake'@'localhost';
