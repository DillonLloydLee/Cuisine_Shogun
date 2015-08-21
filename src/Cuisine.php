<?php
    class Cuisine {
        private $name;
        private $id;

        function __construct($name, $id = null) {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($name) {
            $this->name = (string) $name;
        }

        function getName() {
            return $this->name;
        }

        function setId($id) {
            $this->id = $id;
        }

        function getId() {
            return $this->id;
        }

        function getRestaurants() {
            $restaurants = array();
            $returned_restaurants = $GLOBALS["DB"]->query("SELECT *
            FROM restaurants WHERE id = {$this->getId()};");
            foreach ($returned_restaurants as $rest) {
                $name = $rest["name"];
                $id = $rest["id"];
                $cuisine_id = $rest["cuisine_id"];
                $review = $rest["review"];
                $rating = $rest["rating"];
                $new_restaurant = new Restaurant($name, $id, $cuisine_id, $review, $rating);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function save() {
            $GLOBALS["DB"]->exec("INSERT INTO cuisines (name)
            VALUES ('{$this->getName()}');");
            $result_id = $GLOBALS["DB"]->lastInsertId();
            $this->setId($result_id);
        }

        static function getAll() {
            $returned_cuisines = $GLOBALS["DB"]->query("SELECT *
            FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $name = $cuisine["name"];
                $id = $cuisine["id"];
                $new_cuisine = new Cuisine($name, $id);
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
