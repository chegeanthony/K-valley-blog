<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdColumnTypeInAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Drop foreign key constraint in blogs table if exists
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        // Modify id column in authors table
        Schema::table('authors', function (Blueprint $table) {
            $table->string('id')->change();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop author_id column in blogs table if exists
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('author_id');
        });

        // Revert id column in authors table
        Schema::table('authors', function (Blueprint $table) {
            $table->bigInteger('id')->change();
        });

        // Recreate foreign key constraint in blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
        });
    }
}
