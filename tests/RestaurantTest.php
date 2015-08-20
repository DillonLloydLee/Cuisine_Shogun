<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Task.php";

    $server = "mysql:host=localhost;dbname=cuisine_shogun_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function
    }





?>
