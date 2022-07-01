<?php

namespace App\Imports;

use App\Models\BlogCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class BlogCategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BlogCategory([
            'blogcategory_name' => $row[0],
            'blogcategory_status' => $row[1],
        ]);
    }
}
