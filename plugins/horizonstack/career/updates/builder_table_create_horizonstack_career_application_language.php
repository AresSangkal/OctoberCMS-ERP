<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateHorizonstackCareerApplicationLanguage extends Migration
{
    public function up()
    {
        Schema::create('horizonstack_career_application_language', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('application_id');
            $table->integer('language_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('horizonstack_career_application_language');
    }
}