<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1014 extends Migration
{
    public function up()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->integer('vacancy_id')->nullable();
            $table->text('linkedin_link')->nullable();
        });
    }

    public function down()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->dropColumn('vacancy_id');
            $table->dropColumn('linkedin_link');
        });
    }
}