<?php
    class Restaurant {
        private $rest_id;
        private $name;
        private $cuis_id;
        private $review;
        private $rating;

        function __construct($rest_id = null, $name, $cuis_id,
        $review = "No review given", $rating = 3) {
            $this->rest_id = $rest_id;
            $this->name = $name;
            $this->cuis_id = $cuis_id;
            $this->rating = $review;
            $this->rating = $rating;
        }

        function getRestId() {
            return $this->rest_id;
        }

        function setName($name) {
            $this->name = (string) $name;
        }

        function getName() {
            return $this->name;
        }

        function getCuisId() {
            return $this->cuis_id;
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
            $GLOBALS["DB"]->exec("INSERT INTO restaurants (name,
            cuis_id, review, rating) VALUES ('{this->getName()}',
            {$this->getCuisId()}, '{$this->getReview()}',
            {$this->getRating()});");
            $this->rest_id = $GLOBALS["DB"]->lastInsertId();
        }

        static function getAll() {
            $returned_rests = $GLOBALS["DB"]->query("SELECT
            * FROM restaurants;");
            $rests = array();
            foreach($returned_rests as $rest) {
                $rest_id = $rest["rest_id"];
                $name = $rest["name"];
                $cuis_id = $rest["cuis_id"];
                $review = $rest["cuis_id"];
                $rating = $rest["rating"];
                $new_rest = new Restaurant($rest_id, $name, $cuis_id,
                $review, $rating);
                array_push($rests, $new_rest);
            }
            return $rests;
        }

        static function deleteAll() {
            $GLOBALS["DB"]->exec("DELETE FROM restaurants;");
        }

        static function find($search_id) {
            $found_rest = null;
            $rests = Restaurant::getAll();
            foreach($rests as $rest) {
                $id = $rest->getRestId();
                if ($id == $search_id) {
                    $found_task = $rest;
                }
            }
            return $found_rest;

        }
    }
?>
