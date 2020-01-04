<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateHorizonstackCareerApplicationCertifications extends Migration
{
    public function up()
    {
        Schema::create('horizonstack_career_application_certifications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('certified_from')->nullable();
            $table->string('year')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('horizonstack_career_application_certifications');
    }
}
