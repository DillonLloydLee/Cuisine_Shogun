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

    class CuisineTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getRestaurants() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            
        }
    }





?>
