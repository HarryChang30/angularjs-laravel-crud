<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('supplier')->delete();

        Supplier::create(array(
            'supplierName' => 'Harry Wijaya Chang',
            'supplierEmail' => 'harry.chang@binus.edu',
            'supplierContact' => '087783009152',
            'supplierPosition' => 'CEO'
        ));

        Supplier::create(array(
            'supplierName' => 'Aloy',
            'supplierEmail' => 'alloy@binus.edu',
            'supplierContact' => '081317013685',
            'supplierPosition' => 'Product Manager'
        ));
    }
}
