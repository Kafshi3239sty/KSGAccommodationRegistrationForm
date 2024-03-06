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
        if (isset($row['hostels'])) {
            // Access the 'HOSTELS' element here
            $hostel = $row['hostels'];
        } else {
            // Handle the case where the 'HOSTELS' key does not exist in the array
            echo "The 'HOSTELS' key does not exist in the array.";
        }
    
        return new Rooms([
            'Hostels' => $hostel,
            'Room_No' => $row['room_no'],
        ]);
    }
}
