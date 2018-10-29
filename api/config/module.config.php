<?php

return array(
    "restaurants" =>[
        "hydrator"    => Hydrator\Restaurant::class,
        "repository"  => Repository\Restaurant::class,
        "api-methods" => ['GET','POST','PUT','DELETE'],
        "form-post-fields" => ['nom_resto','descr_resto','cp_resto','city_resto','tel_resto','website_resto','thumbnail'],
        "api-get-hidden-fields" => []
    ],
    "users" =>[
        "hydrator"         => Hydrator\User::class,
        "repository"       => Repository\User::class,
        "api-methods"      => ['GET','POST','PUT','DELETE'],
        "form-post-fields" => ['prenom_user','nom_user','isadmin','promo_user','mail_user','secret_user','confirm_secret_user'],
        "api-get-hidden-fields" => ["secret_user"]
    ],
    "categories" =>[
        "hydrator"         => Hydrator\Categorie::class,
        "repository"       => Repository\Categorie::class,
        "api-methods"      => ['GET'],
        "form-post-fields" => [],
        "api-get-hidden-fields" => []
    ],
);