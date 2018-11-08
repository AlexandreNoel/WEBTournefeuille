<?php

return array(
    "restaurants" =>[
        "entity"      => Entity\Restaurant::class,
        "hydrator"    => Hydrator\Restaurant::class,
        "repository"  => Repository\Restaurant::class,
        "service"     => Service\Restaurant::class,
        "api-methods" => ['GET','POST','PUT','DELETE'],
        "POST-action" => "../public/restaurant-add.php",
        "PUT-action"  => "../public/restaurant-update.php",
        "GET-hidden-fields" => []
    ],
    "users" =>[
        "entity"           => Entity\User::class,
        "hydrator"         => Hydrator\User::class,
        "repository"       => Repository\User::class,
        "service"          => Service\User::class,
        "api-methods"      => ['GET','POST','PUT','DELETE'],
        "POST-action"      => "../public/user-register.php",
        "PUT-action"       => "../public/user-update.php",
        "GET-hidden-fields" => ["secret_user"]
    ],
    "categories" =>[
        "entity"           => Entity\Categorie::class,
        "hydrator"         => Hydrator\Categorie::class,
        "repository"       => Repository\Categorie::class,
        "service"          => Service\Categorie::class,
        "api-methods"      => ['GET','POST','PUT','DELETE'],
        "POST-action"      => "",
        "PUT-action"       => "",
        "GET-hidden-fields" => []
    ],
    "badges" => [
        "entity" => Entity\Badge::class,
        "hydrator" => Hydrator\Badge::class,
        "repository" => Repository\Badge::class,
        "service" => Service\Badge::class,
        "api-methods" => ['GET', 'POST', 'PUT', 'DELETE'],
        "POST-action" => "",
        "PUT-action" => "",
        "GET-hidden-fields" => []
    ],

    "comments" =>[
        "entity"           => Entity\Comment::class,
        "hydrator"         => Hydrator\Comment::class,
        "repository"       => Repository\Comment::class,
        "api-methods"      => ['GET','POST','DELETE'],
        "POST-action"      => "../public/restaurant-addComment.php",
        "PUT-action"       => "",
        "GET-hidden-fields" => []
    ],
);