<?php

use Illuminate\Database\Seeder;

use App\Models\User;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //$this->call('CiudadesTableSeeder');


        DB::table('users')->delete();
        $user = new User;
        $user->id=1;
        $user->nombres='Administrador';
        $user->username='admin';
        $user->email='hola@yopmail.com';
        $user->password=Hash::make('123');
        $user->is_superuser=true;
        $user->save();


        //$this->call('ImagesTableSeeder');
        $this->call('PaisesTableSeeder');
        $this->call('TipousuarioTableSeeder');
        //$this->call('CiudadesTableSeeder');
    }
}
