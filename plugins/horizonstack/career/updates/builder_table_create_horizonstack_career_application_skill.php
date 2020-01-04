<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateHorizonstackCareerApplicationSkill extends Migration
{
    public function up()
    {
        Schema::create('horizonstack_career_application_skill', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('application_id');
            $table->integer('skill_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('horizonstack_career_application_skill');
    }
}
