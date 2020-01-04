<?php namespace Vaslv\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTableVaslvCarouselSlides extends Migration
{
    public function up()
    {
        Schema::create('vaslv_carousel_slides', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('carousel_id')->unsigned()->nullable();
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->integer('weight')->default(0);
            $table->timestamps();

            $table->foreign('carousel_id')
                ->references('id')
                ->on('vaslv_carousel_carousels')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vaslv_carousel_slides');
    }
}