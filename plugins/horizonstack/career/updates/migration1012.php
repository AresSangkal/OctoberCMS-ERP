<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1012 extends Migration
{
    public function up()
    {
        Schema::table('horizonstack_career_vacancies', function ($table) {
            $table->string('job_app_no')->nullable();
        });
    }

    public function down()
    {
        Schema::table('horizonstack_career_vacancies', function ($table) {
            $table->dropColumn('job_app_no');
        });
    }
}