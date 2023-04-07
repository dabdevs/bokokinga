CREATE TABLE users
(
  id INT NOT NULL
  AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR
  (50) NOT NULL UNIQUE,
  email VARCHAR
  (100) NOT NULL UNIQUE,
  password VARCHAR
  (100) NOT NULL,
  active BOOLEAN DEFAULT 1,
  role ENUM
  ('user', 'admin') NOT NULL DEFAULT 'user'
);

  CREATE TABLE categories
  (
    id INT NOT NULL
    AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR
    (150) NOT NULL,
  description VARCHAR
    (255) DEFAULT NULL,
  image VARCHAR
    (255) DEFAULT 'category.jpg',
  parent_id INT DEFAULT NULL
);

INSERT INTO categories
  (`id`, `name
`, `image`)
		VALUES
(1, 'Decoración', 'decoration.jpg'),
(2, 'Joyería', 'jewelry.jpg'),
(3, 'Ropa', 'clothes.jpg'),
(4, 'Accesorios', 'accessories.jpg');

    CREATE TABLE customers
    (
      id INT NOT NULL
      AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR
      (50) NOT NULL,
  lastname VARCHAR
      (50) NOT NULL,
  email VARCHAR
      (100) NOT NULL UNIQUE,
  password VARCHAR
      (100) NOT NULL
);

CREATE TABLE products
(
  id INT NOT NULL
  AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR
  (100) NOT NULL,
	description TEXT DEFAULT NULL,
	price DECIMAL
  (10,2) NOT NULL,
	quantity INT NOT NULL,
  image1 VARCHAR(255) NOT NULL,
  image2 VARCHAR(255) DEFAULT NULL,
  image3 VARCHAR(255) DEFAULT NULL,
  image4 VARCHAR(255) DEFAULT NULL,
	category_id INT NOT NULL,
	FOREIGN KEY
  (category_id) REFERENCES categories
  (id)
);

INSERT INTO products(name, price, quantity, image1, category_id)
VALUES('Uñas acrílicas hojas verdes',12.99,50,'unas-hojas-verdes.jpg', 4),
('Uñas Spider Amarrillo',8.99,15,'unas-spider-amarrillo.jpg', 4),
('Uñas I love You Rojo',4.50,100,'unas-iloveu.jpg',4),
('Necklace Oro Africa', 49.75,10,'necklace-oro-africa.jpg.jpg',2),
('Jacket Verde Sun', 89.99,30,'jacket-verde-sun.jpg',3),
('Lentes Aviator Marron', 12.99, 150,'lentes-aviator-marron.jpg',4),
('Pañuelo No time for fake people', 4.99, 150,'panuelo-no-time-for-fake-people.jpg',3),
('I dont smoke t-shirt', 20, 250,'i-dont-smoke-tshirt.jpg',3),
('Anillo redondo piedra azul', 4.99, 215,'anillo-redondo-piedra-azul.jpg', 2),
('Escalera apoya toalla', 46.99, 215,'escalera-apoya-toalla.jpg', 1),
('Antique painting plate', 46.99, 215,'antique-painting-plate.jpg', 1);

        CREATE TABLE orders
        (
          id INT NOT NULL
          AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	total_amount DECIMAL
          (10,
		2) NOT NULL,
	FOREIGN KEY
          (customer_id) REFERENCES customers
          (id)
);

          CREATE TABLE order_item
          (
            id INT NOT NULL
            AUTO_INCREMENT PRIMARY KEY,
	order_id INT NOT NULL,
	product_id INT NOT NULL,
	quantity INT NOT NULL,
	price DECIMAL
            (10,2) NOT NULL,
	FOREIGN KEY
            (order_id) REFERENCES orders
            (id),
	FOREIGN KEY
            (product_id) REFERENCES products
            (id)
);

            CREATE TABLE shopping_cart
            (
              id INT NOT NULL
              AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	product_id INT NOT NULL,
	quantity INT NOT NULL,
	price DECIMAL
              (10,2) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY
              (customer_id) REFERENCES customers
              (id),
	FOREIGN KEY
              (product_id) REFERENCES products
              (id)
);





              INSERT INTO `users` (`
              id`,
              `username
              `, `email`, 
`password`, 
`active`, 
`role`) 
VALUES
              (1, 'admin', 'admin@bokokinga.com', md5
              ('admin'), 1, 'admin'),
              (2, 'dabdevs', 'dabdevs@gmail.com', md5
              ('1234'), 1, 'user');


  CREATE TABLE configurations
  (
    name VARCHAR(255) DEFAULT 'logo.jpg',
    value VARCHAR(100) DEFAULT NULL,
    active BOOLEAN DEFAULT 1
  );

  INSERT INTO configurations(name, value)
  VALUES('logo', 'logo.jpg'),
        ('latest-row-1', 2), 
        ('latest-row-2', 4),
        ('latest-row-3', 1);


