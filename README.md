# Homework

Student: `Yang Yinfang` <br>
Student Number: `1111111`


## Project Description

The website represents a shop. Products are being sold to users, information about the purchases is persisted. 

### Functionalities
* Creating users (clients)
* Creating addresses for users
* Creating products
* Creating purchases

### Database Layer

//TODO Entity Relationship Diagram
// 4 main tables, 1 many to many table (purchase_product)

### Endpoints
* `user.php`
  * `GET` - lists all users and a form to add new users
  * `POST` - handles the submission of the form in the `GET`
* `address.php`
  * `GET` - lists all addresses and the users to which they belong. As well as a form to add addresses
  * `POST` - handles the submission of the form in the `GET`
* `product.php` - you can do this the same way as the other 2 above @Yang
  * `GET` - lists all addresses and the users to which they belong. As well as a form to add addresses
  * `POST` - handles the submission of the form in the `GET`
* `purchase.php`
  * `GET` - lists all purchases, the user and his address and the products he has selected. 
As well as a form to add purchases
  * `POST` - handles the submission of the form in the `GET`

### TODOs
* @Yang - you can make the UI pretty
* @Yang - you can add the product.php and implement it as the address and user one
* @Yang - you can make the purchase form work with unlimited number of products (maybe a bit of JS will be needed)
