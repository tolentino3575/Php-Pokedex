<?php
    class Pokemon
    {
        private $name;
        private $id;
        private $type;

        function __construct($name, $type, $id=null)
        {
            $this->name = $name;
            $this->type = $type;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO pokemon (name, type) VALUES ('{$this->getName()}', '{$this->getType()}');");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_pokemon = $GLOBALS['DB']->query("SELECT * FROM pokemon;");
            $pokemons = array();
            foreach($returned_pokemon as $pokemon) {
                $name = $pokemon['name'];
                $type = $pokemon['type'];
                $id = $pokemon['id'];
                $new_pokemon = new Pokemon($name, $type, $id);
                array_push($pokemons, $new_pokemon);
                }
                return $pokemons;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM pokemon;");
            }

            static function find($search_id)
            {
                $found_pokemon = null;
                $pokemons = Pokemon::getAll();
                foreach($pokemons as $pokemon) {
                    $pokemon_id = $pokemon->getId();
                    if ($pokemon_id == $search_id) {
                        $found_pokemon = $pokemon;
                    }
                }
                return $found_pokemon;
            }
        }

?>
