<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Property([
            'title'          => $row['title'],
            'ai_description' => $row['ai_description'] ?? null,
            'price'          => $row['price'] ?? 0,
            'city'           => $row['city'],
            'district'       => $row['district'],
            'lat'            => $row['lat'] ?? 0,
            'lng'            => $row['lng'] ?? 0,
            'status'         => Property::STATUS_AVAILABLE,
            'is_archived'    => 0,
            'added_by'       => auth()->id(),
        ]);
    }
}
