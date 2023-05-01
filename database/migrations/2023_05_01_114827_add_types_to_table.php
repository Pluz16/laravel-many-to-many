<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        
        DB::table('types')->insert([
            [
                'name' => 'Backend',
                'slug' => 'backend'
            ],
            [
                'name' => 'Frontend',
                'slug' => 'frontend'
            ],
            [
                'name' => 'Fullstack',
                'slug' => 'fullstack'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('types')->whereIn('slug', ['backend', 'frontend', 'fullstack'])->delete();

        Schema::table('types', function (Blueprint $table) {
        $table->dropColumn('slug');
        });

    }
};
