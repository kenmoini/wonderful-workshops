<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('small_logo')->nullable();
            $table->text('large_logo')->nullable();
            $table->text('font_awesome_icon')->nullable();
            $table->tinyInteger('status')->default('0'); //0=draft, 1=active, 2=hidden, 3=disabled
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog');
    }
}
