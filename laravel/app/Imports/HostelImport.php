<?php

namespace App\Imports;

use App\Models\Rooms;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HostelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rooms([
            'Hostels' => $row['hostels'],
            'Room_No' => $row['room_no'],
        ]);
    }
}
