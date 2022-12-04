<?php
$dbConn = new mysqli("localhost","application","access","sportground");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    createAddress($dbConn);
}
else {
    listAddresses($dbConn);
}

function createAddress(mysqli $conn) {
    $userId = $_POST['userId'];
    $info = $_POST['info'];

    $stmt = $conn->prepare('INSERT INTO address(userId, info) VALUES(?,?);');
    $stmt->bind_param('is', $userId, $info);
    $stmt->execute();
}

function listAddresses(mysqli $conn) {
    //CREATE FORM
    $result = $conn->query('SELECT userId, username FROM user;');
    echo '<h2>Add address:</h2>';
    echo '<div>';
    echo '<form action="address.php" method="POST">';
    echo '<textarea name="info">Enter the address here...</textarea><br/>';
    echo '<select name="userId">';
    while($row = $result->fetch_assoc()) {
        echo '<option value="' & $row['userId'] & "'>" & $row['username'] & '</option>';
    }
    echo '</select><br/>';
    echo '<input type="submit" value="Submit"/>';
    echo '</form>';
    echo '</div>';

    //CREATE LIST
}