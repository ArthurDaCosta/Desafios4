<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('título');
            $table->string('autor');
            $table->date('data_publicação');
            $table->string('gênero');
            $table->integer('páginas');
            $table->timestamps();
        });

        DB::table('livros')->insert(
            array( [
                'título' => 'Teste1',
                'autor' => 'Teste1',
                'data_publicação' => '2024-02-12',
                'gênero' => 'Romance', 
                'páginas' => 60,
                'created_at' => 'now',
                'updated_at' => 'now'
            ],
            [
                'título' => 'Teste2',
                'autor' => 'Teste2',
                'data_publicação' => '2023-02-12',
                'gênero' => 'Clássico', 
                'páginas' => 68,
                'created_at' => 'now',
                'updated_at' => 'now'
            ],
            [
                'título' => 'Teste3',
                'autor' => 'Teste3',
                'data_publicação' => '2022-02-12',
                'gênero' => 'Ficção', 
                'páginas' => 8,
                'created_at' => 'now',
                'updated_at' => 'now'
            ],
            [
                'título' => 'Teste4',
                'autor' => 'Teste4',
                'data_publicação' => '2021-02-12',
                'gênero' => 'Mistério', 
                'páginas' => 900,
                'created_at' => 'now',
                'updated_at' => 'now'
            ],
            [
                'título' => 'Teste5',
                'autor' => 'Teste5',
                'data_publicação' => '2020-02-12',
                'gênero' => 'Drama', 
                'páginas' => 254,
                'created_at' => 'now',
                'updated_at' => 'now'
            ])
            );
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
