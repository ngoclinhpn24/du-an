<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'product_detail' => $row[1],
            'product_price' => $row[2],
            'product_image' => $row[3],
            'product_status' => $row[4],
            'category_id' => $row[5],
            'product_quantity' => $row[6],
            
        ]);
    }
}
