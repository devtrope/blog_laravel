<?php

return [
    'custom' => [
        'title' => [
            'required' => "Veuillez renseigner un titre"
        ],
        'category' => [
            'required' => "Veuillez renseigner une catégorie"
        ],
        'picture' => [
            'required' => "Veuillez sélectionner une image",
            'image' => "Le fichier sélectionné n'est pas une image valide",
            'uploaded' => "Veuillez sélectionner une image ne dépassant pas 2Mo",
        ],
        'content' => [
            'required' => "Veuillez renseigner le contenu de l'article"
        ]
    ]
];