<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // MIGRAZIONE PER INSERIRE STATICAMENTE LE CATEGORIE
         Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('en');
            $table->string('fr');
            $table->string('icon');
            $table->timestamps();
        });

        $categories = [
            [
                'name' => 'Motori',
                'en' => 'Motors',
                'fr' => 'Moteurs',
                'icon' => '<i class="fa-solid fa-car-rear"></i>'
            ],
            [
                'name' => 'Informatica',
                'en' => 'Computing',
                'fr' => 'Informatique',
                'icon' => '<i class="fa-solid fa-laptop-code"></i>'
            ],
            [
                'name' => 'Elettrodomestici',
                'en' => 'Appliances',
                'fr' => 'Appareils électroménagers',
                'icon' => '<i class="fa-solid fa-plug"></i>'
            ],
            [
                'name' => 'Libri',
                'en' => 'Books',
                'fr' => 'Livres',
                'icon' => '<i class="fa-solid fa-book-bookmark"></i>'
            ],
            [
                'name' => 'Giochi',
                'en' => 'Games',
                'fr' => 'Jeux',
                'icon' => '<i class="fa-solid fa-chess"></i>'
            ],
            [
                'name' => 'Sport',
                'en' => 'Sports',
                'fr' => 'Sports',
                'icon' => '<i class="fa-solid fa-volleyball"></i>'
            ],
            [
                'name' => 'Accessori per animali',
                'en' => 'Pet Accessories',
                'fr' => 'Accessoires pour animaux',
                'icon' => '<i class="fa-solid fa-paw"></i>'
            ],
            [
                'name' => 'Telefoni',
                'en' => 'Phones',
                'fr' => 'Téléphones',
                'icon' => '<i class="fa-solid fa-mobile-screen"></i>'
            ],
            [
                'name' => 'Arredamento',
                'en' => 'Furniture',
                'fr' => 'Mobilier',
                'icon' => '<i class="fa-solid fa-couch"></i>'
            ],
            [
                'name' => 'Immobili',
                'en' => 'Real Estate',
                'fr' => 'Immobilier',
                'icon' => '<i class="fa-solid fa-house"></i>'
            ],
        ];
    //     Schema::create('categories', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->timestamps();
    //     });

    //     $categories = ['Motori','Informatica','Elettrodomestici','libri','Giochi','Sport','Accessori per animali','Telefoni','Arredamento','Immobili'];
        

    foreach ($categories as $categoryData) {
        Category::create($categoryData);
    }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
