<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

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
            $name = "Italian";
            $rest_id = null;
            $test_cuisine = new Cuisine($name, $rest_id);
            $test_cuisine->save();

            $test_cuis_id = $test_cuisine->getId();
            $review = "It Sucks.";
            $rating = 5;

            $name = "Bar Mingo";
            $test_rest = new Restaurant($rest_id, $name, $test_cuis_id,
            $review, $rating);
            $test_rest->save();

            $name2 = "Serratto";
            $test_rest2 = new Restaurant($rest_id, $name2, $test_cuis_id,
            $review, $rating);
            $test_rest2->save();

            $result = $test_cuisine->getRestaurants();

            $this->assertEquals([$test_rest, $test_rest2], $result);
        }

        function test_getName() {
            $name = "Italian";
            $test_cuisine = new Cuisine($name);

            $result = $test_cuisine->getName();

            $this->assertEquals($name, $result);
        }

        function test_save() {
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $result = Cuisine::getAll();

            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll() {
            $name = "Italian";
            $name2 = "French";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll() {
            $name = "Italian";
            $name2 = "French";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();
            Cuisine::deleteAll();

            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function test_find() {
            $name = "Italian";
            $name2 = "French";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            $result = Cuisine::find($test_cuisine->getId());

            $this->assertEquals($test_cuisine, $result);
        }

    }
?>
