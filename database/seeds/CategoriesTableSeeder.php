<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 現在日時を変数に格納
      $now = Carbon::now();
      // カテゴリーテーブル
      DB::table('categories')->insert([
          [
              'category_name'           => 'お金',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '副業',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '恋愛',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '仕事',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '就職',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '外国語習得',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => 'ダイエット',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '筋トレ',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '人間関係',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '勉強',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => 'スポーツ',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '創作',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => 'プログラミング',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => '料理',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
          [
              'category_name'           => 'その他',
              'created_at'      => $now,
              'updated_at'          => $now,
          ],
      ]);
    }
}
