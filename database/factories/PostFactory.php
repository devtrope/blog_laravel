<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Création du dossier posts s'il n'existe pas encore
        $path = public_path('storage/posts');

        if (!File::isDirectory($path))
            File::makeDirectory($path, 0777, true, true);

        //Bibliothèque externe pour contourner le problème de Faker avec les images
        //car le site utilisé est down depuis quelques temps (problème depuis 2020 au moins)
        $imageFaker = new ImageFaker(new Picsum());

        return [
            'title' => fake()->sentence(),
            'content' => nl2br(fake()->paragraphs(30, true)),
            'category' => fake()->word(),
            'picture' => 'posts/'.$imageFaker->image(public_path('storage/posts'), 640, 480, false)
        ];
    }
}
