<?php
    class Restaurant {
        private $name;
        private $cuisine_id;
        private $id;
        private $review;
        private $rating;

        function __construct($name, $id = null, $cuisine_id, $review = "Restaurant not yet reviewed.", $rating = 0) {
            $this->name = $name;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
            $this->review = $review;
            $this->rating = $rating;
        }

        function setName($name) {
            $this->name = (string) $name;
        }

        function getName() {
            return $this->name;
        }

        function getId() {
            return $this->id;
        }

        function getCuisineId() {
            return $this->cuisine_id;
        }

        function setReview($review) {
            $this->review = $review;
        }

        function getReview() {
            return $this->review;
        }

        function setRating($rating) {
            $this->rating = $rating;
        }

        function getRating() {
            return $this->rating;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, review, rating) VALUES ('{$this->getName()}', {$this->getCuisineId()}, '{$this->getReview()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $review = $restaurant["review"];
                $rating = $restaurant["rating"];
                $new_restaurant = new Restaurant($name, $id, $cuisine_id, $review, $rating);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id) {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_task = $restaurant;
                }
            }
            return $found_restaurant;
        }

    }
?>
