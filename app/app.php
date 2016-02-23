<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Pokemon.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/pokemon", function() use ($app) {
        return $app['twig']->render('pokemon.html.twig',
        array('pokemons' => Pokemon::getAll()));
    });

    $app->post("/pokemon", function() use ($app) {
        $new_pokemon = new Pokemon($_POST['name'], $_POST['type']);
        $new_pokemon->save();
        return $app['twig']->render('pokemon.html.twig', array('new_pokemon' => Pokemon::getAll()));
    });

    $app->post("/delete", function() use ($app) {
        Pokemon::deleteAll();
        return $app['twig']->render('pokemon.html.twig');
    });

    return $app;
?>
