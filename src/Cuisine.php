<?php
    class Cuisine {
        private $type;
        private $cuis_id;

        function __construct($type, $cuis_id = null) {
            $this->type = $type;
            $this->cuis_id = $cuis_id;
        }

        function setType($type) {
            $this->type = (string) $type;
        }

        function getType() {
            return $this->type;
        }

        function setCuisId($cuis_id) {
            $this->cuis_id = $cuis_id;
        }

        function getCuisId() {
            return $this->cuis_id;
        }

        function getRests() {
            $rests = array();
            $returned_rests = $GLOBALS["DB"]->query("SELECT *
            FROM restaurants WHERE cuis_id = {$this->getCuisId()};");
            foreach ($returned_rests as $rest) {
                $rest_id = $rest["rest_id"];
                $name = $rest["name"];
                $cuis_id = $rest["cuis_id"];
                $review = $rest["review"];
                $rating = $rest["rating"];
                $new_rest = new Restaurant($rest_id, $name,
                $cuis_id, $review, $rating);
                array_push($rests, $new_rest);
            }
            return $rests;
        }

        function save() {
            $GLOBALS["DB"]->exec("INSERT INTO cuisines (type)
            VALUES ('{$this->getType()}');");
            $result_id = $GLOBALS["DB"]->lastInsertId();
            $this->setCuisId($result_id);
        }

        static function getAll() {
            $returned_cuisines = $GLOBALS["DB"]->query("SELECT *
            FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $type = $cuisine["type"];
                $cuis_id = $cuisine["cuis_id"];
                $new_cuisine = Cuisine($type, $cuis_id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function find($search_id) {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuis_id = $cuisine->getCuisId();
                if ($cuis_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;

        }
    }
?>
