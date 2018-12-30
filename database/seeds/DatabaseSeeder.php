<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UnidadesTableSeeder::class);
        $this->call(TipoPessoasTableSeeder::class);
        $this->call(UfsTableSeeder::class);
        //$this->call(LaratrustSeeder::class); /* somente em instalações novas ou no demo */
        $this->call(TipoMovimentacaoProdutoSeeder::class);
        $this->call(TipoMovCombSeeder::class); 
        $this->call(NovasPermissoesSeeder::class);
    }
}
