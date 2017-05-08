<?php

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'm_members';

        \DB::table($tableName)->insert($this->getContentsArray());
    }

    private function getContentsArray()
    {
        return [
            ['member_id' => 1, 'first_name' => 'test', 'last_name' => 'man', 'birth_date' => '1991-02-16', 'home_id' => '0', 'post_code' => '0', 'email' => 'test@gmail.com', 'password' => '$2y$10$CcsJSn/kUztzled1uf8CK..9AZ/lNiNlSa3b1Y/labfTou7Xz4DeO', 'address' => ''],
        ];
    }
}
