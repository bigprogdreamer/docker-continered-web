use flowers;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(40) NOT NULL,
    password_a VARCHAR(40) NOT NULL
);

CREATE TABLE Shipment (
    shipment_id INT PRIMARY KEY,
    date_of_shipment DATE NOT NULL,
    quantity INT NOT NULL,
    sum DECIMAL(10, 2) NOT NULL,
    shipment_place VARCHAR(50) NOT NULL
);

CREATE TABLE Goods_type (
    goods_type_id INT PRIMARY KEY,
    goods_name VARCHAR(30) NOT NULL
);

CREATE TABLE Goods (
    goods_id INT PRIMARY KEY,
    quantity INT NOT NULL,
    goods_type_id INT NOT NULL,
    price_per_item INT NOT NULL,
    FOREIGN KEY (goods_type_id) REFERENCES Goods_type (goods_type_id)
);


CREATE TABLE Goods_shipment (
    goods_shipment_id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    goods_id INT NOT NULL,
    quantity INT NOT NULL,
    purchase_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (shipment_id) REFERENCES Shipment (shipment_id),
    FOREIGN KEY (goods_id) REFERENCES Goods (goods_id)
);


CREATE TABLE Flower (
    goods_id INT PRIMARY KEY,
    flower_type VARCHAR(20) NOT NULL,
    color VARCHAR(30) NOT NULL,
    aroma VARCHAR(30) NOT NULL,
    height VARCHAR(30) NOT NULL,
    FOREIGN KEY (goods_id) REFERENCES Goods (goods_id)
);

CREATE TABLE Bouquet (
    goods_id INT PRIMARY KEY,
    size VARCHAR(20) NOT NULL,
    name VARCHAR(30) NOT NULL,
    flower_quantity INT NOT NULL,
    FOREIGN KEY (goods_id) REFERENCES Goods (goods_id)
);

CREATE TABLE Flowers_in_Bouquet (
    flower_id INT NOT NULL,
    quantity INT NOT NULL,
    bouquet_id INT NOT NULL,
    PRIMARY KEY (flower_id, bouquet_id),
    FOREIGN KEY (flower_id) REFERENCES Flower (goods_id),
    FOREIGN KEY (bouquet_id) REFERENCES Bouquet (goods_id)
);

CREATE TABLE employee (
    employee_id INT PRIMARY KEY,
    gender VARCHAR(7) NOT NULL,
    age INT NOT NULL,
    degree VARCHAR(30),
    work_time INT NOT NULL,
    salary DECIMAL(10, 2) NOT NULL
);

CREATE TABLE client (
    user_id INT PRIMARY KEY,
    client_name VARCHAR(30) NOT NULL,
    age INT NOT NULL,
    city VARCHAR(20) NOT NULL,
    gender VARCHAR(7) NOT NULL,
    total_spent DECIMAL(10, 2) NOT NULL,
    discount INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE cheque (
    cheque_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    employee_id INT NOT NULL,
    time_bought DATETIME NOT NULL,
    payment_method VARCHAR(10) NOT NULL,
    total_summ DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client (user_id),
    FOREIGN KEY (employee_id) REFERENCES employee (employee_id)
);

CREATE TABLE client_bought (
    cheque_id INT NOT NULL,
    goods_d INT NOT NULL,
    quantity INT NOT NULL,
    cur_sum DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (cheque_id, goods_d),
    FOREIGN KEY (cheque_id) REFERENCES cheque (cheque_id),
    FOREIGN KEY (goods_d) REFERENCES Goods (goods_id)
);

CREATE TABLE sold_goods (
    sold_id INT NOT NULL,
    goods_id INT NOT NULL,
    amount INT NOT NULL,
    total_sum DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (sold_id),
    FOREIGN KEY (sold_id) REFERENCES cheque (cheque_id),
    FOREIGN KEY (goods_id) REFERENCES Goods (goods_id)
);

-- Insert data into Goods_type
