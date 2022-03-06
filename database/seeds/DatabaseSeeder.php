<?php

use App\Curso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        /*         $curso= new Curso();
        $curso->nombre="Laravel";
        $curso->descripcion="Este framework es el mejor del mundo";
        $curso->categoria="Desarrollo web";

        $curso->save(); */

        factory(Curso::class, 50)->create();
    }
}
