<?php
$dbConn = new mysqli("localhost","application","access","sportground");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    createPurchase($dbConn);
}
else {
    listPurchases($dbConn);
}

function createPurchase(mysqli $conn) {
    //
    $userId = $_POST['userId'];
    $product1Id = $_POST['product1'];
    $product1Quantity = $_POST['product1_quantity'];
    $product2Id = $_POST['product2'];
    $product2Quantity = $_POST['product2_quantity'];
    $product3Id = $_POST['product3'];
    $product3Quantity = $_POST['product3_quantity'];

    $stmtPurchase = $conn->prepare('INSERT INTO purchase(userId) VALUES(?)');
    $stmtPurchase->bind_param('i', $userId);
    $stmtPurchase->execute();

    $purchaseId = $stmtPurchase->insert_id;

    $stmtProduct = $conn->prepare('INSERT INTO purchase_product (purchaseId, productId, quantity) VALUE(?, ?, ?)');
    $stmtProduct->bind_param('iii', $purchaseId, $product1Id, $product1Quantity);
    $stmtProduct->execute();
    $stmtProduct->bind_param('iii', $purchaseId, $product2Id, $product2Quantity);
    $stmtProduct->execute();
    $stmtProduct->bind_param('iii', $purchaseId, $product3Id, $product3Quantity);
    $stmtProduct->execute();
}

function htmlUser(mysqli $conn): string {
    $html = '<select name="userId">';
    $result = $conn->query('SELECT user.userId, user.username, user.name, address.info FROM user LEFT JOIN address ON user.userId = address.userId');

    while($row = $result->fetch_assoc()) {
        $html = $html & '<option value="' & $row['userId'] & '">' & $row['username'] & ' - ' & $row['info'] & '</option>';
    }
    return $html & '</select>';
}

function htmlProduct(mysqli $conn, string $name): string {
    $html = '<select name="' & $name & '">';
    $result = $conn->query('SELECT productId, name, price FROM product');

    while($row = $result->fetch_assoc()) {
        $html = $html & '<option value="' & $row['productId'] & '">' & $row['name'] & ' - ' & $row['price'] & '</option>';
    }
    $html = $html & '</select>';
    return $html & '<input type="text" name="' & $name & '_quantity" />';
}

function listPurchases(mysqli $conn) {
    //CREATE FORM
    $htmlUser = htmlUser($conn);
    $htmlProduct1 = htmlProduct($conn, 'product1');
    $htmlProduct2 = htmlProduct($conn, 'product2');
    $htmlProduct3 = htmlProduct($conn, 'product3');

    $htmlForm = <<<EOD
        <form action="purchase.php" method="POST">
        $htmlUser
        $htmlProduct1
        $htmlProduct2
        $htmlProduct3
        <input type="submit" value="Submit"/>
        </form>
    EOD;
    echo $htmlForm;

    //LIST PURCHASES
    $sql = <<<EOD
        SELECT 
            user.username, 
            user.names, 
            address.info,
            product.name,
            purchase_product.quantity,
            product.price
        FROM purchase
        LEFT JOIN user ON purchase.userId = user.userId
        LEFT JOIN address ON address.userId = user.userId
        LEFT JOIN purchase_product ON purchase.purchaseId = purchase_product.purchaseId
        LEFT JOIN product ON purchase_product.productId = product.productId
        ORDER BY purchase.purchaseId;
    EOD;
    $result = $conn->query($sql);

    echo '<hr>';
    echo '<h2>Purchases:</h2>';
    echo '<div>';
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $names = $row['names'];
        $address = $row['info'];
        $product = $row['name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $totalPrice = $quantity * $price;
        $rowContent = <<<EOD
        <div>
            <label>Username: </label> $username <br/>
            <label>Names: </label> $names <br/>
            <label>Address: </label> $address </br>
            <label>Product: </label> $product </br>
            <label>Quantity: </label> $quantity </br>
            <label>Price: </label> $price </br>
            <label>Total Price: </label> $totalPrice </br>
        </div>
        EOD;
        echo $rowContent;

    }
    echo '</div>';

}