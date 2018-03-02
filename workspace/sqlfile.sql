create table customers
(
    customerEmail VARCHAR(50) not null primary key,
    name VARCHAR(50) not null,
    password VARCHAR(50) not null,
    address VARCHAR(100) not null,
    phone VARCHAR(20)
);

create table employees
(
    employeeEmail VARCHAR(50) not null primary key,
    name VARCHAR(50) not null,
    password VARCHAR(50) not null,
    address VARCHAR(100) not null,
    phone VARCHAR(20) not null,
    admin int unsigned not null DEFAULT '0'
);


create table orders
(
    orderid int unsigned not null auto_increment primary key,
    orderDate datetime not null,
    completed int(1) not null,
    card VARCHAR(20) not null,
    address VARCHAR(50) not null,
    email VARCHAR(50),
    customerEmail VARCHAR(50),
    employeeEmail VARCHAR(50),
    FOREIGN KEY (customerEmail) REFERENCES customers(customerEmail),
    FOREIGN KEY (employeeEmail) REFERENCES employees(employeeEmail)
);

create table products
(
    productid int unsigned not null auto_increment primary key,
    productName char(20) not null,
    price float(4,2) not null
);

create table order_has_products
(
    numOfProduct int(4) not null,
    productid int unsigned not null,
    orderid int unsigned not null,
    FOREIGN KEY (orderid) REFERENCES orders(orderid),
    FOREIGN KEY (productid) REFERENCES products(productid),
    primary key(orderid, productid)
);