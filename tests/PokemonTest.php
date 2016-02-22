<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pokemon.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class PokemonTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Pokemon::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Pikachu";
            $type = "Electric";
            $test_Inventory = new Pokemon($name, $type);

            //Array
            $result = $test_Inventory->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getType()
        {
            //Arrange
            $name = "Pikachu";
            $type = "Electric";
            $test_Inventory = new Pokemon($name, $type);

            //Array
            $result = $test_Inventory->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Pikachu";
            $type = "Electric";
            $id = 1;
            $test_Inventory = new Pokemon($name, $type, $id);

            //Array
            $result = $test_Inventory->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            //Arrange
            $name = "Pikachu";
            $type = "Electric";
            $name2 = "Charmander";
            $type2 = "Fire";
            $test_Inventory = new Pokemon($name, $type);
            $test_Inventory->save();
            $test_Inventory2 = new Pokemon($name2, $type2);
            $test_Inventory2->save();

            //Act
            $result = Pokemon::getAll();
            // var_dump($test_Inventory, $test_Inventory2);

            //Assert
            $this->assertEquals([$test_Inventory, $test_Inventory2], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Pikachu";
            $type = "Electric";
            $name2 = "Charmander";
            $type2 = "Fire";
            $test_Inventory = new Pokemon($name, $type);
            $test_Inventory->save();
            $test_Inventory2 = new Pokemon($name2, $type2);
            $test_Inventory2->save();

            //Act
            $result = Pokemon::find($test_Inventory->getId());

            //Assert
            $this->assertEquals($test_Inventory, $result);
        }

    }



?>
