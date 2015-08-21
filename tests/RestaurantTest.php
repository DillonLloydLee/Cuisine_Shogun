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

        function test_getId() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $result = $test_restaurant->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $result = $test_restaurant->getCuisineId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $result = Restaurant::getAll();

            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $name2 = "Water the lawn";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $review, $rating);
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $name2 = "Water the lawn";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $review, $rating);
            $test_restaurant2->save();
            Restaurant::deleteAll();

            $result = Restaurant::getAll();

            $this->assertEquals([], $result);
        }

        function test_find() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();
            var_dump($test_restaurant);
            $name2 = "Water the lawn";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $review, $rating);
            $test_restaurant2->save();

            $result = Restaurant::find($test_restaurant->getId());

            $this->assertEquals($test_restaurant, $result);
        }

        function test_getReview() {
            $name = "Home stuff";
            $id = null;
            $review = '0000-00-00';
            $review = "1984-02-32";
            $rating = 0;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name1 = "Wash the dog";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name1, $id, $cuisine_id, $review, $rating);
            $test_restaurant->save();

            $result = $test_restaurant->getReview();

            $this->assertEquals("1984-02-32", $result);
        }

    }
 ?>
