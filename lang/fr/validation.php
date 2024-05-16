<?php

return [
    'custom' => [
        'title' => [
            'required' => "Veuillez renseigner un titre"
        ],
        'category_id' => [
            'required' => "Veuillez renseigner une catégorie"
        ],
        'picture' => [
            'required' => "Veuillez sélectionner une image",
            'image' => "Le fichier sélectionné n'est pas une image valide",
            'uploaded' => "Veuillez sélectionner une image ne dépassant pas 2Mo",
        ],
        'content' => [
            'required' => "Veuillez renseigner le contenu de l'article"
        ],
        'name' => [
            'required' => "Veuillez renseigner votre nom"
        ],
        'first_name' => [
            'required' => "Veuillez renseigner votre prénom"
        ],
        'email' => [
            'required' => "Veuillez renseigner votre adresse mail",
            'email' => "Veuillez renseigner une adresse mail valide",
            'unique' => "Un compte avec cette adresse mail existe déjà"
        ],
        'password' => [
            'required' => "Veuillez renseigner votre mot de passe",
            'confirmed' => "Vos mots de passe ne correspondent pas"
        ],
        'password_confirmation' => [
            'required' => "Veuillez confirmer votre mot de passe"
        ],
    ]
];