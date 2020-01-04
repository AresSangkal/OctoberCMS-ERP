<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1013 extends Migration
{
    public function up()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->string('nat_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->dropColumn('nat_id');
        });
    }
}