<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1015 extends Migration
{
    public function up()
    {
        Schema::table('horizonstack_career_vacancies', function ($table) {
            $table->boolean('is_linkedin_required')->default(0);
        });
    }

    public function down()
    {
        Schema::table('horizonstack_career_vacancies', function ($table) {
            $table->dropColumn('is_linkedin_required');
        });
    }
}