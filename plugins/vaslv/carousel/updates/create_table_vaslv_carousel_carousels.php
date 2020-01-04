<?php namespace Vaslv\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTableVaslvCarouselCarousels extends Migration
{
    public function up()
    {
        Schema::create('vaslv_carousel_carousels', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->boolean('do_resize')->default(1);
            $table->integer('image_width')->unsigned()->default(1110);
            $table->integer('image_height')->unsigned()->default(400);
            $table->integer('interval')->unsigned()->default(5000);
            $table->boolean('with_controls')->default(0);
            $table->boolean('with_indicators')->default(0);
            $table->boolean('has_keyboard_react')->default(1);
            $table->boolean('has_hover_pause')->default(1);
            $table->boolean('has_autoplays')->default(1);
            $table->boolean('has_continuously_cycle')->default(1);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vaslv_carousel_carousels');
    }
}