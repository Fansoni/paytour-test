<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscolaridadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('escolaridades')->insert([
            'nome'     => 'Ensino Médio',
            'created_at'    =>  new \DateTime(),
            'updated_at'    =>  new \DateTime()
        ]);
        DB::table('escolaridades')->insert([
            'nome'     => 'Bacharel',
            'created_at'    =>  new \DateTime(),
            'updated_at'    =>  new \DateTime()
        ]);
        DB::table('escolaridades')->insert([
            'nome'     => 'Licenciatura',
            'created_at'    =>  new \DateTime(),
            'updated_at'    =>  new \DateTime()
        ]);
        DB::table('escolaridades')->insert([
            'nome'     => 'Mestrado',
            'created_at'    =>  new \DateTime(),
            'updated_at'    =>  new \DateTime()
        ]);
        DB::table('escolaridades')->insert([
            'nome'     => 'Doutoramento',
            'created_at'    =>  new \DateTime(),
            'updated_at'    =>  new \DateTime()
        ]);
    }
}
