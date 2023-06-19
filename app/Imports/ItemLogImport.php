<?php

namespace App\Imports;

use App\Models\ItemLog;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Summary of ItemLogImport
 */
class ItemLogImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        return new ItemLog([
            'data'=> $row['data'],
            'item_id' => $row['item_id'],
            'price' => $row['price'],
            'area_code' => $row['area_code']
        ]);
    }


}
