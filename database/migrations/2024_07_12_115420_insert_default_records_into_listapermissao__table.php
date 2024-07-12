<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertDefaultRecordsIntoListapermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('listapermissao')->insert([
            ['id' => 1, 'nome' => 'cadastrar_produto', 'titulo_permissao_id' => 3],
            ['id' => 2, 'nome' => 'deletar_produto', 'titulo_permissao_id' => 3],
            ['id' => 3, 'nome' => 'deletar_produto', 'titulo_permissao_id' => 2],
            ['id' => 4, 'nome' => 'editar_produto', 'titulo_permissao_id' => 3],
            ['id' => 5, 'nome' => 'editar_produto', 'titulo_permissao_id' => 2],
            ['id' => 6, 'nome' => 'deletar_usuario', 'titulo_permissao_id' => 3],
            ['id' => 7, 'nome' => 'deletar_usuario', 'titulo_permissao_id' => 2],
            ['id' => 8, 'nome' => 'venda_produto', 'titulo_permissao_id' => 3],
            ['id' => 9, 'nome' => 'venda_produto', 'titulo_permissao_id' => 2],
            ['id' => 10, 'nome' => 'cadastrar_local', 'titulo_permissao_id' => 2],
            ['id' => 11, 'nome' => 'deletar_local', 'titulo_permissao_id' => 2],
            ['id' => 12, 'nome' => 'editar_local', 'titulo_permissao_id' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('listapermissao')->whereIn('id', [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ])->delete();
    }
}
