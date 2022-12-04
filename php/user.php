<?php
$dbConn = new mysqli("localhost","application","access","sportground");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    createUser($dbConn);
}
else {
    listUsers($dbConn);
}


function createUser(mysqli $conn) {
    $username = $_POST['username'];
    $names = $_POST['names'];

    $stmt = $conn->prepare('INSERT INTO user(username, names) VALUES(?, ?)');
    $stmt->bind_param('ss', $username, $names);
    $stmt->execute();
}

function listUsers(mysqli $conn) {
    //CREATE A FORM
    echo '<h2>Create new user:</h2>';
    echo '<div><form action="user.php" method="POST">';
    echo '<label for="username">Username:&nbsp;</label><input type="text" name="username" value=""/><br/>';
    echo '<label for="names">Names:&nbsp;</label><input type="text" name="names" value=""/><br/>';
    echo '<input type="submit" value="Submit" />';
    echo '</form></div>';
    //QUERY ALL USERS FROM THE DB AND LIST THEM
    echo '<hr/>';
    echo '<h2>Existing users:</h2>';
    echo '<div>';

    $result = $conn->query('SELECT userId, username, names FROM user;');
    while($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<label>UserId:</label>' & $row['userId'];
        echo '<label>Username:</label>' & $row['username'];
        echo '<label>Names:</label>' & $row['names'];
        echo '</div>';
    }

    echo '</div>';
}
