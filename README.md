# UniHup





#### Group Members:



* Rimah Al-Dossari - 222411048



* Hawra Al-sultan - 222411184



* Alaa Al-Mubarak - 223002960



* Batool alghulam - 220015821



#### Project Description:


UniHub is a student to student service platform that connects university students who need academic assistance with fellow students who can provide services.

* Services:

  * Presentation Design:Professional PowerPoint design for academic projects

  * Academic Translation :Translation services for essays and research papers

  * Programming Help:Coding assistance for programming tasks

* Key Features:

  * User Registration & Login - Create an account and securely login.

  * Service Request Submission - Submit detailed requests for any of the three services.

  * Request Tracking - View all submitted requests with status.

  * Dashboard - Personal welcome page after login.



#### Required Environment:



Web Server, PHP, Database, Web Browser



#### Development Environment Setup:



1. Database Configuration:

   The database (unihub2) and tables will auto-create on first run. For manual setup:

   1. Open setup.php in a text editor
   2. Remove the comment block /\* \*/
   3. Run setup.php
   4. Database and tables will be created automatically

   

   

2. Default Database Credentials:

   

* Host: localhost
* Username: root
* Password: (empty by default)
* Database: unihub2

  

  

  

  #### Setup.php:

  

1. setup.php Run this once to create database and tables

   

2. Connect to MySQL

   $conn = mysqli\_connect('localhost', 'root', '');

   

   if (!$conn) {

       die("Failed to connect to MySQL: " . mysqli\_connect\_error());

   }

   

   

3. Create database

   if (mysqli\_query($conn, "CREATE DATABASE IF NOT EXISTS unihub2")) {

       echo "Database 'unihub2' created<br>";

   } else {

       echo "Error creating database: " . mysqli\_error($conn) . "<br>";

   }

   

4. Select database

   mysqli\_select\_db($conn, 'unihub2');

   

5. Create users table

   $sql = "CREATE TABLE IF NOT EXISTS users (

       id INT PRIMARY KEY AUTO\_INCREMENT,

       name VARCHAR(100) NOT NULL,

       email VARCHAR(100) UNIQUE NOT NULL,

       password VARCHAR(255) NOT NULL,

       created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP

   )";

   

   if (mysqli\_query($conn, $sql)) {

       echo " Users table created<br>";

   } else {

       echo " Error creating users table: " . mysqli\_error($conn) . "<br>";

   }

   

6. Create service\_requests table

   $sql = "CREATE TABLE IF NOT EXISTS service\_requests (

       id INT AUTO\_INCREMENT PRIMARY KEY,

       user\_id INT NOT NULL,

       service\_type VARCHAR(20) NOT NULL,

       topic VARCHAR(255),

       details TEXT,

       status VARCHAR(20) DEFAULT 'pending',

       created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP,

       CONSTRAINT fk\_service\_user FOREIGN KEY (user\_id) REFERENCES users(id)

         ON DELETE CASCADE

         ON UPDATE CASCADE

   )";

   

   if (mysqli\_query($conn, $sql)) {

       echo " Service requests table created<br>";

   } else {

       echo " Error creating service\_requests table: " . mysqli\_error($conn) . "<br>";

   }

   

7. Close connection

   mysqli\_close($conn);

