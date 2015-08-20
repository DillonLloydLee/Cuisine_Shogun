<?php
    class Restaurant {
        private $restaurant_id;
        private $name;
        private $cuisine_id;
        private $rating;
        private $rating;

        function __construct($restaurant_id = null, $name, $cuisine_id,
        $rating = "No review given", $rating = 3) {
            $this->restaurant_id = $restaurant_id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->rating = $rating;
            $this->rating = $rating;
        }

        function getRestaurantId() {
            $return $this->restaurant_id;
        }

        function setName() {
            $this->name = $name;
        }

        function getName() {
            $return $this->name;
        }

        function getCuisineId() {
            $return $this->cuisine_id;
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
            cuisine_id, review, rating) VALUES ("{this->getName()}",
            {$this->getCuisineId()}, "{$this->getReview()}",
            {$this->getRating()});");
            $this->restaurant_id = $GLOBALS["DB"]->lastInsertId();
        }


    }



?>
