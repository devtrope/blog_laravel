<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn('category');
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite')
            {
                $table->string('category');
                $table->dropForeignIdFor(\App\Models\Category::class);
            }
            
            $table->string('category')->default('');
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('categories');
    }
};
