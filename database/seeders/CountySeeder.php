<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder {

    /**
     * Run the database seeds. To run: php artisan db:seed --class=CountySeeder
     * 
     * @return void
     */
    public function run() {
        $data = $this->getData();
        DB::table('county')->insert($data);
    }

    private function getData(): array {
        return [
            ["name" => "Bács-Kiskun vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Baranya vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Békés vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Borsod-Abaúj-Zemplén vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Csongrád-Csanád vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Fejér vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Győr-Moson-Sopron vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Hajdú-Bihar vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Heves vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Jász-Nagykun-Szolnok vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Komárom-Esztergom vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Nógrád vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Pest vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Somogy vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Szabolcs-Szatmár-Bereg vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Tolna vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Vas vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Veszprém vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
            ["name" => "Zala vármegye", "created_at"=>date("Y-m-d H:i:s"), "updated_at"=>date("Y-m-d H:i:s")],
        ];
    }
}
