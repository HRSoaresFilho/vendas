<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertDefaultRecordsIntoTitulopermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('titulopermissao')->insert([
            ['id' => 1, 'nome' => 'gerente'],
            ['id' => 2, 'nome' => 'diretor'],
            ['id' => 3, 'nome' => 'vendedor'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('titulopermissao')->whereIn('id', [1, 2, 3])->delete();
    }
}
