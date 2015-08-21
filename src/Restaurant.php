<?php
    class Restaurant {
        private $id;
        private $name;
        private $cuisine_id;
        private $review;
        private $rating;

        function __construct($id = null, $name, $cuisine_id,
        $review = "No review given", $rating = 3) {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->rating = $review;
            $this->rating = $rating;
        }

        function getId() {
            return $this->id;
        }

        function setName($name) {
            $this->name = (string) $name;
        }

        function getName() {
            return $this->name;
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
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, review, rating) VALUES ('{$this->getName()}', {$this->getCuisineId()}, '{$this->getReview()}', '{$this->getRating()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_rests = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $rests = array();
            foreach($returned_rests as $rest) {
                $id = $rest['id'];
                $name = $rest['name'];
                $cuisine_id = $rest['cuisine_id'];
                $review = $rest['review'];
                $rating = $rest["rating"];
                $new_rest = new Restaurant($id, $name, $cuisine_id, $review, $rating);
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
                    $found_rest = $rest;
                }
            }
            return $found_rest;

        }
    }
?>
