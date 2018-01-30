<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menus')->insert([
            'name' => "测试栏目",
            'icon' => 'link',
            'url' => '#',
            'parent_id' => '0',
            'menu_order' => '0',
            'name_index' => 'test'
        ]);
    }
}
