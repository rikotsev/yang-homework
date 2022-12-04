CREATE TABLE user (
    userId INTEGER,
    username VARCHAR2(255) NOT NULL,
    names VARCHAR2(255),
    PRIMARY KEY(userId)
);

CREATE TABLE address (
    addressId INTEGER AUTO_INCREMENT,
    userId INTEGER NOT NULL,
    info TEXT,
    PRIMARY KEY(addressId),
    FOREIGN KEY (userId) REFERENCES user(userId)
);

CREATE TABLE product (
    productId INTEGER AUTO_INCREMENT,
    name VARCHAR2(255) NOT NULL,
    description TEXT,
    price double NOT NULL,
    PRIMARY KEY(productId)
);

CREATE TABLE purchase_product (
    purchaseId INTEGER NOT NULL,
    productId INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    PRIMARY KEY (purchaseId, productId),
    FOREIGN KEY (productId) REFERENCES product(productId),
    FOREIGN KEY (purchaseId) REFERENCES purchase(purchaseId)
);

CREATE TABLE purchase (
    purchaseId INTEGER AUTO_INCREMENT,
    userId INTEGER NOT NULL,
    purchaseDate TIMESTAMP,
    PRIMARY KEY(purchaseId),
    FOREIGN KEY (userId) REFERENCES user(userId)
);