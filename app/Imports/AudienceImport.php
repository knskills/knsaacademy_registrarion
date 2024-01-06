<?php

namespace App\Imports;

use App\Models\audience;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class AudienceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::info($row);
        return new audience([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'   => $row['phone'],
        ]);
    }
}
