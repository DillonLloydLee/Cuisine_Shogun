<?php
    class Restaurant {
        private $rest_id;
        private $name;
        private $cuis_id;
        private $rating;
        private $rating;

        function __construct($rest_id = null, $name, $cuis_id,
        $rating = "No review given", $rating = 3) {
            $this->rest_id = $rest_id;
            $this->name = $name;
            $this->cuis_id = $cuis_id;
            $this->rating = $rating;
            $this->rating = $rating;
        }

        function getRestId() {
            $return $this->rest_id;
        }

        function setName() {
            $this->name = $name;
        }

        function getName() {
            $return $this->name;
        }

        function getCuisineId() {
            $return $this->cuis_id;
        }

        function setReview() {
            $this->rating = $rating;
        }

        function getReview() {
            $return $this->rating;
        }

        function setRating() {
            $this->rating = $rating;
        }

        function getReviewStars() {
            $return $this->rating;
        }

        function save() {
            $GLOBALS["DB"]->exec("INSERT INTO restaurants (name,
            cuis_id, review, rating) VALUES ('{this->getName()}',
            {$this->getCuisineId()}, '{$this->getReview()}',
            {$this->getRating()});");
            $this->rest_id = $GLOBALS["DB"]->lastInsertId();
        }

        static function getAll() {
            $returned_restaurants = $GLOBALS["DB"]->query("SELECT
            * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $rest_id = $restaurant["rest_id"];
                $name = $restaurant["name"];
                $cuis_id = $restaurant["cuis_id"];
                $review = $restaurant["cuis_id"];
                $rating = $restaurant["rating"];
                $new_rest = new Restaurant($rest_id, $name, $cuis_id,
                $review, $rating);
                array_push($restaurants, $new_rest);
            }
            return $restaurants;
        }

        static function deleteAll() {
            $GLOBALS["DB"]->exec("DELETE FROM restaurants;");
        }

        static function find($search_id) {
            $found_rest = null;

        }


    }



?>
