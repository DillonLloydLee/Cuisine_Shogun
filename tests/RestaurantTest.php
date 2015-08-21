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

    class RestaurantTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getRestId() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);
            $test_rest->save();

            $result = $test_rest->getRestId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisId() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);
            $test_rest->save();

            $result = $test_rest->getCuisId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);
            $test_rest->save();

            $result = Restaurant::getAll();

            $this->assertEquals($test_rest, $result);
        }

        function test_save() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);

            $name2 = "Bar Mingo";
            $test_rest2 = new Restaurant($id, $name2, $cuis_id,
            $review, $rating);
            $test_rest2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_rest, $test_rest2], $result);
        }

        function test_deleteAll() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);

            $name2 = "Bar Mingo";
            $test_rest2 = new Restaurant($id, $name2, $cuis_id,
            $review, $rating);
            $test_rest2->save();

            Restaurant::deleteAll();

            $result = Restaurant::getAll();

            $this->assertEquals([], $result);
        }

        function test_find() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = null;
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);

            $name2 = "Bar Mingo";
            $test_rest2 = new Restaurant($id, $name2, $cuis_id,
            $review, $rating);
            $test_rest2->save();

            $result = Restaurant::find($test_rest->getRestId());

            $this->assertEquals([$test_rest], $result);
        }

        function test_getReview() {
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            $name = "Serratto";
            $cuis_id = $test_cuisine->getCuisId();
            $review = "This restaurant sucks.";
            $rating = null;
            $test_rest = new Restaurant($id, $name, $cuis_id,
            $review, $rating);

            $result = $test_rest->getReview();

            $this->assertEquals("This restaurant sucks.", $result);
        }

    }
?>
