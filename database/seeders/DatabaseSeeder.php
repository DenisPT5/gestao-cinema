<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genero')->insert([
            ['nome' => 'Drama'],
            ['nome' => 'Comedia'],
            ['nome' => 'Ficcao Cientifica'],
            ['nome' => 'Documentario'],
            ['nome' => 'Thriller'],
        ]);

        DB::table('filme')->insert([
            ['titulo' => 'O Circo', 'duracao_minutos' => 150, 'ano_lancamento' => 2024, 'realizador' => 'Ana Silva'],
            ['titulo' => 'A Ultima Gargalhada', 'duracao_minutos' => 95, 'ano_lancamento' => 2023, 'realizador' => 'Bruno Costa'],
            ['titulo' => 'Vozes do Interior', 'duracao_minutos' => 120, 'ano_lancamento' => 2024, 'realizador' => 'Carla Mendes'],
            ['titulo' => 'A Danca dos Planetas', 'duracao_minutos' => 130, 'ano_lancamento' => 2025, 'realizador' => 'David Pinto'],
        ]);

        DB::table('filme_genero')->insert([
            ['id_filme' => 1, 'id_genero' => 1],
            ['id_filme' => 1, 'id_genero' => 5],
            ['id_filme' => 2, 'id_genero' => 2],
            ['id_filme' => 3, 'id_genero' => 1],
            ['id_filme' => 3, 'id_genero' => 4],
            ['id_filme' => 4, 'id_genero' => 3],
        ]);

        DB::table('sala')->insert([
            ['nome' => 'Grande Auditorio', 'capacidade' => 300],
            ['nome' => 'Sala Multimedia', 'capacidade' => 150],
            ['nome' => 'Pequeno Estudio', 'capacidade' => 50],
        ]);

        DB::table('funcionario')->insert([
            ['nome' => 'Manuel Santos', 'funcao' => 'Coordenador'],
            ['nome' => 'Sofia Pereira', 'funcao' => 'Bilheteira'],
        ]);

        DB::table('espectador')->insert([
            ['nome' => 'Pedro Afonso', 'email' => 'pedro.afonso@email.com', 'contacto' => '910000001'],
            ['nome' => 'Mariana Gomes', 'email' => 'mariana.gomes@email.com', 'contacto' => '920000002'],
        ]);

        DB::table('sessao')->insert([
            ['data_hora' => '2026-12-15 18:00:00', 'preco_base' => 7.50, 'id_filme' => 1, 'id_sala' => 1, 'id_funcionario' => 1],
            ['data_hora' => '2026-12-15 21:30:00', 'preco_base' => 8.00, 'id_filme' => 2, 'id_sala' => 2, 'id_funcionario' => 1],
            ['data_hora' => '2026-12-16 19:00:00', 'preco_base' => 7.50, 'id_filme' => 3, 'id_sala' => 1, 'id_funcionario' => 2],
        ]);
    }
}