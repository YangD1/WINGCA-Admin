<?php

use Illuminate\Database\Seeder;

class defaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 用户表数据
        DB::table('users')->insert([
            'name' => "admin",
            'email' => 'admin@wingca.com',
            'password' => bcrypt('admin')
        ]);

        // 菜单表数据
        DB::table('menus')->insert([
            'name' => "测试栏目",
            'icon' => 'link',
            'url' => '#',
            'parent_id' => '0',
            'menu_order' => '0',
            'name_index' => 'test'
        ]);

        // 权限表数据
        DB::table('roles')->insert([
            'name' => "超级管理员",
            'access_menus_id' => '1'
        ]); 

        // 关联数据表
        DB::table('user_roles')->insert([
            'user_id' => "1",
            'role_id' => '1'
        ]);

    }
}
