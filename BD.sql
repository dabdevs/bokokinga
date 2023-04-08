CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR (50) NOT NULL UNIQUE,
  email VARCHAR (100) NOT NULL UNIQUE,
  firstname VARCHAR (100) NOT NULL,
  lastname VARCHAR (100) NOT NULL,
  password VARCHAR (100) NOT NULL,
  active BOOLEAN DEFAULT 1,
  role ENUM ('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
);

INSERT INTO
  `users` (
    `username`,
    `email`,
    `firstname`,
    `lastname`,
    `password`,
    `role`
  )
VALUES
  (
    'user',
    'user@bokokinga.com',
    'User',
    'User',
    'ee11cbb19052e40b07aac0ca060c23ee',
    'USER'
  ),
  (
    'dabdevs',
    'ajean@bokokinga.com',
    'Alain',
    'Jean',
    '21232f297a57a5a743894a0e4a801fc3',
    'ADMIN'
  ),
  (
    'christine',
    'cjean@bokokinga.com',
    'Christine',
    'Jean',
    '21232f297a57a5a743894a0e4a801fc3',
    'ADMIN'
  );

CREATE TABLE categories (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (150) UNIQUE NOT NULL,
  description VARCHAR (255) DEFAULT NULL,
  image VARCHAR (255) DEFAULT 'category-default.png',
  parent_id INT DEFAULT NULL
);

INSERT INTO
  categories (`id`,`name`,`description`,`image`)
VALUES
  (1,'Decoración', 'Decora tu hogar con productos eco friendly', 'decoration.jpg'),
  (2,'Joyería', 'Joyas confeccionadas con productos reciclados', 'jewelry.jpg'),
  (3,'Ropa', 'Ropa pintada y/o diseñada a mano','clothes.jpg'),
  (4,'Accesorios', 'Todo tipo de accesorios', 'accessories.jpg');


CREATE TABLE customers (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR (50) NOT NULL,
  lastname VARCHAR (50) NOT NULL,
  email VARCHAR (100) NOT NULL UNIQUE,
  password VARCHAR (100) NOT NULL
);

CREATE TABLE products (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (100) NOT NULL,
  description TEXT DEFAULT NULL,
  price DECIMAL (10, 2) NOT NULL,
  quantity INT NOT NULL,
  image1 VARCHAR(255) NOT NULL,
  image2 VARCHAR(255) DEFAULT NULL,
  image3 VARCHAR(255) DEFAULT NULL,
  image4 VARCHAR(255) DEFAULT NULL,
  category_id INT NOT NULL,
  tags VARCHAR(150) DEFAULT NULL,
  FOREIGN KEY (category_id) REFERENCES categories (id)
);

INSERT INTO
  products(name, price, quantity, image1, category_id, tags)
VALUES
(
    'Uñas acrílicas hojas verdes',
    12.99,
    50,
    'unas-hojas-verdes.jpg',
    4,
    'reciclable-papel-eco'
  ),
  (
    'Uñas Spider Amarrillo',
    8.99,
    15,
    'unas-spider-amarrillo.jpg',
    4,
    'reciclable-eco'
  ),
  (
    'Uñas I love You Rojo',
    4.50,
    100,
    'unas-iloveu.jpg',
    4,
    ''
  ),
  (
    'Necklace Oro Africa',
    49.75,
    10,
    'necklace-oro-africa.jpg.jpg',
    2,
    'metal'
  ),
  (
    'Jacket Verde Sun',
    89.99,
    30,
    'jacket-verde-sun.jpg',
    3,
    'tela-arte'
  ),
  (
    'Lentes Aviator Marron',
    12.99,
    150,
    'lentes-aviator-marron.jpg',
    4,
    'importado'
  ),
  (
    'Pañuelo No time for fake people',
    4.99,
    150,
    'panuelo-no-time-for-fake-people.jpg',
    3,
    ''
  ),
  (
    'I dont smoke t-shirt',
    20,
    250,
    'i-dont-smoke-tshirt.jpg',
    3,
    ''
  ),
  (
    'Anillo redondo piedra azul',
    4.99,
    215,
    'anillo-redondo-piedra-azul.jpg',
    2,
    'metal-plata'
  ),
  (
    'Escalera apoya toalla',
    46.99,
    215,
    'escalera-apoya-toalla.jpg',
    1,
    'madera-eco'
  ),
  (
    'Antique painting plate',
    46.99,
    215,
    'antique-painting-plate.jpg',
    1,
    'metal'
  );

CREATE TABLE orders (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL (10, 2) NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers (id)
);

CREATE TABLE order_item (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL (10, 2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders (id),
  FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE shopping_cart (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL (10, 2) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES customers (id),
  FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE configurations (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  value VARCHAR(100) DEFAULT NULL,
  active BOOLEAN DEFAULT 1
);

INSERT INTO
  configurations(name, value)
VALUES
('logo', 'logo.png'),
('banner_title', 'Bokokinga'),
('banner_subtitle', 'Tu eslogan!'),
('latest_products_category_1', 1), /* Configuration to display latest products from a specific category on first row. The value is the id of the category to filter the products from. */
('latest_products_category_2', 2), /* Configuration to display latest products from a specific category on second row. The value is the id of the category to filter the products from. */
('latest_products_category_3', 3); /* Configuration to display latest products from a specific category on third row. The value is the id of the category to filter the products from. */