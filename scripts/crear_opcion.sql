CREATE TABLE opcion
(
    id INT NOT NULL
    AUTO_INCREMENT,
nombre VARCHAR
    (255) NOT NULL,
menu_id INT NOT NULL,
orden INT NULL,
endpoint VARCHAR
    (100) NULL,
icon VARCHAR
    (100) NULL,
PRIMARY KEY
    (id),
FOREIGN KEY
    (menu_id) REFERENCES menu
    (id)
);