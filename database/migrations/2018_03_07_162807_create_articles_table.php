<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255); //заголовок статьи
            $table->text('text'); //текст статьи
            $table->text('desc'); //карткое описание
            $table->string('alias',155)->unique(); //псевдоним статьи
            $table->string('img'); //картинка к статье
            $table->string('keywords'); //метаинформация (ключевые слова) на стр. детального просмотра
            $table->string('meta_desc'); //метаинформация (краткое описание) на стр. детального просмотра
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
