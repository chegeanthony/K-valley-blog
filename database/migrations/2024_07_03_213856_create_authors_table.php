<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_authors_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->text('bio')->nullable();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable();
            $table->string('profession')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
