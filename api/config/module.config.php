<?php

return array(
    "restaurants" =>[
        "entity"      => Entity\Restaurant::class,
        "hydrator"    => Hydrator\Restaurant::class,
        "repository"  => Repository\Restaurant::class,
        "service"     => Service\Restaurant::class,
        "api-methods" => ['GET','POST','PUT','DELETE'],
        "POST-action" => "../public/add-restaurant.php",
        "PUT-action"  => "../public/update-restaurant.php",
        "GET-hidden-fields" => []
    ],
    "users" =>[
        "entity"           => Entity\User::class,
        "hydrator"         => Hydrator\User::class,
        "repository"       => Repository\User::class,
        "service"          => Service\User::class,
        "api-methods"      => ['GET','POST','PUT','DELETE'],
        "POST-action"      => "../public/register.php",
        "PUT-action"       => "../public/update-user.php",
        "GET-hidden-fields" => ["secret_user"]
    ],
    "categories" =>[
        "entity"           => Entity\Categorie::class,
        "hydrator"         => Hydrator\Categorie::class,
        "repository"       => Repository\Categorie::class,
        "service"          => Service\Categorie::class,
        "POST-action"      => "",
        "PUT-action"       => "",
        "GET-hidden-fields" => []
    ],
);