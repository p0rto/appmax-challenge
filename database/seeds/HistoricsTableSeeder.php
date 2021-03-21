<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Historic;
use Carbon\Carbon;

class HistoricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historics')->insert([
            [
                'stock_id' => 1,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => 1000,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'stock_id' => 2,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => 90,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'stock_id' => 3,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => 150,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'stock_id' => 4,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => 50,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'stock_id' => 5,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => 200,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
