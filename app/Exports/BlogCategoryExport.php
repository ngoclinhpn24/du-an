<?php

namespace App\Exports;

use App\Models\BlogCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class BlogCategoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BlogCategory::all();
    }
}
