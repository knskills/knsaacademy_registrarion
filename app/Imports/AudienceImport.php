<?php

namespace App\Imports;

use App\Models\audience;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class AudienceImport implements ToModel, WithHeadingRow
{
    private $event_id;
    private $event_name;


    // /**
    //  * @param array $row
    //  *
    //  * @return array
    //  */
    // public function rules(): array
    // {
    //     return [
    //         'full_name' => 'required',
    //         'phone_number' => 'required|unique:audiences,phone',
    //         'created_time' => 'required',
    //     ];
    // }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {

            // Convert Excel serial date to Unix timestamp
            $unixTimestamp = ($row['created_time'] - 25569) * 86400; // Convert to seconds since Unix epoch

            // Create a Carbon instance from the Unix timestamp
            $date = Carbon::createFromTimestamp($unixTimestamp);

            // Format the date as per your requirement (e.g., 'Y-m-d H:i:s')
            $registration_date = $date->format('Y-m-d H:i:s');

            return new audience([
                // 'event_id' => $row['event_id']  ,
                'name'     => $row['full_name'] ? $row['full_name'] : null,
                // 'email'    => $row['email'] ? $row['email'] : null,
                'phone'    => $row['phone_number'] ? $row['phone_number'] : null,
                // 'event_name' => $row['event_name'],
                'registration_date' => $registration_date,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
