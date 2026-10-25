<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ログイン確認用のテストユーザー（パスワードはすべて password）
        User::factory()->create([
            'name' => 'test1',
            'email' => 'test1@example.com',
        ]);
        User::factory()->create([
            'name' => 'test2',
            'email' => 'test2@example.com',
        ]);
        User::factory()->create([
            'name' => 'test3',
            'email' => 'test3@example.com',
        ]);
        User::factory()->create([
            'name' => 'test4',
            'email' => 'test4@example.com',
        ]);

        // ダミーユーザーを10人作る
        User::factory(10)->create();
    }
}
