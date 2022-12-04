<?php
  $dbConn = mysqli_connect("localhost","application","access","sportground");

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $accountType = $_POST["accountType"];
  $member_number = $_POST["member_number"];
  $date = $_POST["date"];
  $time = $_POST["time"];
  $ground = $_POST["ground"];
  $sport = $_POST["sport"];

  
//   $sky = $_POST['search'];
//   $query = mysqli_query($dbConn," SELECT `product`.Product_ID, 
//   `manufacturer`.name as Manufacturer_name, 
//   `product`.Manufacturer,
//   `product`.Product_name, 
//   `product`.Price
//   FROM `product` join `manufacturer` on `product`.Manufacturer = `manufacturer`.Id
//   WHERE `manufacturer`.name LIKE '%$sky%'");


//   while ($row = mysqli_fetch_array($query)) {
//   print("<p>".$row["Product_name"]."</p>");
//   print("<p>".$row["Price"]."</p>");
//   print("<p>".$row["Manufacturer_name"]."</p>");
//   }
  
//   mysqli_query($dbConn, "INSERT INTO `search_log`(`Search_Word`) VALUES ('$sky')");
?>