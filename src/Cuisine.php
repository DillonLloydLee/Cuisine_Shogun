<?php
    class Cuisine {
        private $type;
        private $id;

        function __construct($type, $id = null) {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($type) {
            $this->type = (string) $type;
        }

        function getType() {
            return $this->type;
        }

        function setId($id) {
            $this->id = $id;
        }

        function getId() {
            return $this->id;
        }

        function getRests() {
            $rests = array();
            $returned_rests = $GLOBALS["DB"]->query("SELECT *
            FROM restaurants WHERE id = {$this->getId()};");
            foreach ($returned_rests as $rest) {
                $rest_id = $rest["rest_id"];
                $name = $rest["name"];
                $id = $rest["id"];
                $review = $rest["review"];
                $rating = $rest["rating"];
                $new_rest = new Restaurant($rest_id, $name,
                $id, $review, $rating);
                array_push($rests, $new_rest);
            }
            return $rests;
        }

        function save() {
            $GLOBALS["DB"]->exec("INSERT INTO cuisines (type)
            VALUES ('{$this->getType()}');");
            $result_id = $GLOBALS["DB"]->lastInsertId();
            $this->setId($result_id);
        }

        static function getAll() {
            $returned_cuisines = $GLOBALS["DB"]->query("SELECT *
            FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $type = $cuisine["type"];
                $id = $cuisine["id"];
                $new_cuisine = new Cuisine($type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll() {
            $GLOBALS["DB"]->exec("DELETE FROM cuisines;");
        }

        static function find($search_id) {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $id = $cuisine->getId();
                if ($id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
        return $found_cuisine;

        }
    }
?>
