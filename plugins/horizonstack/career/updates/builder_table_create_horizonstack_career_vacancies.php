<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateHorizonstackCareerVacancies extends Migration
{
    public function up()
    {
        Schema::create('horizonstack_career_vacancies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('slug')->nullable();
            $table->integer('category_id')->nullable();
            $table->dateTime('date_posted')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('horizonstack_career_vacancies');
    }
}