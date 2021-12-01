<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('rating');
            $table->integer('votes_amount');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE authors ADD FULLTEXT search_authors (name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authors', function($table) {

            $table->dropIndex('search_authors');

        });

        Schema::dropIfExists('authors');
    }
}
