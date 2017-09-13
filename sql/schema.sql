CREATE TABLE cakephp.users (
    userid int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    modified_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    username varchar(128),
    access_token varchar(128),
    access_token_secret varchar(128),
    usertype varchar(128)
);

SHOW TABLES FROM cakephp;
