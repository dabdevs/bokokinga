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
	description TEXT,
	price DECIMAL
  (10,2) NOT NULL,
	quantity INT NOT NULL,
  image1 VARCHAR(255) NOT NULL,
  image2 VARCHAR(255) NOT NULL,
  image3 VARCHAR(255) NOT NULL,
  image4 VARCHAR(255) NOT NULL,
	category_id INT NOT NULL,
	FOREIGN KEY
  (category_id) REFERENCES categories
  (id)
);

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


  CREATE TABLE homemage
  (
    logo VARCHAR(255) DEFAULT 'logo.jpg',
    title VARCHAR(100) DEFAULT NULL,
    subtitle VARCHAR(100) DEFAULT NULL,
    banner VARCHAR(255) DEFAULT 'left-banner-image.jpg',
    latest1 INT NOT NULL,
    FOREIGN KEY (latest1) REFERENCES categories (id),
    latest2 INT NOT NULL,
    FOREIGN KEY (latest2) REFERENCES categories (id),
    latest3 INT NOT NULL,
    FOREIGN KEY (latest3) REFERENCES categories (id),
    latest4 INT NOT NULL,
    FOREIGN KEY (latest4) REFERENCES categories (id)
  );


