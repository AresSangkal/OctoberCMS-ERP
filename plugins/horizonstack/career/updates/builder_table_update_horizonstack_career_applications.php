<?php namespace Horizonstack\Career\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateHorizonstackCareerApplications extends Migration
{
    public function up()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->integer('admin_approval')->nullable()->default(1);
        });
    }

    public function down()
    {
        Schema::table('horizonstack_career_applications', function ($table) {
            $table->dropColumn('admin_approval');
        });
    }
}
