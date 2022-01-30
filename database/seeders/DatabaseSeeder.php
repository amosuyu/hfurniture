<?php

namespace Database\Seeders;

use DB;
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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'idgroup' => 1,
            'username' => 'admin',
            'address' => 'TPHCM',
        ]);
        DB::table('colors')->insert([
            [
                'name' => 'Màu tự nhiên',
                'code' => '#d2af84',
            ],
            [
                'name' => 'Màu nâu',
                'code' => '#644335',
            ],
        ]);
        DB::table('spaces')->insert([
            [
                'name_vi' => 'Phòng khách',
                'name_en' => 'Living room',
                'slug' => 'phong-khach',
            ],
            [
                'name_vi' => 'Phòng ăn',
                'name_en' => 'Dining room',
                'slug' => 'phong-an',
            ],
            [
                'name_vi' => 'Phòng ngủ',
                'name_en' => 'Bedroom',
                'slug' => 'phong-ngu',
            ],
        ]);
        DB::table('collections')->insert([
            [
                'name_vi' => 'Bộ sưu tập VIENNA',
                'name_en' => 'VIENNA Collection',
                'slug' => 'vienna-collection',
            ],
            [
                'name_vi' => 'Bộ sưu tập VLINE',
                'name_en' => 'VLINE Collection',
                'slug' => 'vline-collection',
            ],
            [
                'name_vi' => 'Bộ sưu tập MILAN',
                'name_en' => 'MILAN Collection',
                'slug' => 'milan-collection',
            ],
            [
                'name_vi' => 'Bộ sưu tập OLSO',
                'name_en' => 'OLSO Collection',
                'slug' => 'olso-collection',
            ],
            [
                'name_vi' => 'Bộ sưu tập VERONA',
                'name_en' => 'VERONA Collection',
                'slug' => 'verona-collection',
            ],
        ]);
        DB::table('categories')->insert([
            [
                'name_vi' => 'Ghế sofa',
                'name_en' => 'Sofa',
                'space_id'=> 1,
                'slug' => 'ghe-sofa',
            ],
            [
                'name_vi' => 'Bàn Sofa – Bàn Cafe – Bàn Trà',
                'name_en' => 'Sofa Table',
                'space_id'=> 1,
                'slug' => 'ban-sofa-ban-cafe-ban-tra',
            ],
            [
                'name_vi' => 'Tủ kệ Tivi',
                'name_en' => 'TV Stand',
                'space_id'=> 1,
                'slug' => 'tu-ke-tivi',
            ],
            [
                'name_vi' => 'Tủ & kệ',
                'name_en' => 'Cabinet & Shelf',
                'space_id'=> 1,
                'slug' => 'tu-ke',
            ],
            [
                'name_vi' => 'Tủ giày - Tủ trang trí',
                'name_en' => 'Shoes cabinet',
                'space_id'=> 1,
                'slug' => 'tu-giay-tu-trang-tri',
            ],
            [
                'name_vi' => 'Bàn làm việc',
                'name_en' => 'table',
                'space_id'=> 1,
                'slug' => 'ban-lam-viec',
            ],
            [
                'name_vi' => 'Bàn ăn',
                'name_en' => 'Dining table',
                'space_id'=> 2,
                'slug' => 'ban-an',
            ],
            [
                'name_vi' => 'Ghế ăn',
                'name_en' => 'Dining chair',
                'space_id'=> 2,
                'slug' => 'ghe-an',
            ],
            [
                'name_vi' => 'Bộ bàn ăn',
                'name_en' => 'Dining set',
                'space_id'=> 2,
                'slug' => 'bo-ban-an',
            ],
            [
                'name_vi' => 'Giường ngủ',
                'name_en' => 'Bed',
                'space_id'=> 3,
                'slug' => 'giuong-ngu',
            ],
            [
                'name_vi' => 'Tủ đầu giường',
                'name_en' => 'Bedside',
                'space_id'=> 3,
                'slug' => 'tu-dau-giuong',
            ],
            [
                'name_vi' => 'Tủ quần áo',
                'name_en' => 'Wardrobe',
                'space_id'=> 3,
                'slug' => 'tu-quan-ao',
            ],
        ]);
    }
}
