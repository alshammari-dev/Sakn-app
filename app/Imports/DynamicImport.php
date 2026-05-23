<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DynamicImport implements ToModel, WithHeadingRow
{
    protected $modelClass;
    protected $fieldMapping;

    public function __construct($modelClass, array $fieldMapping)
    {
        $this->modelClass = $modelClass;
        $this->fieldMapping = $fieldMapping;
    }

    public function model(array $row)
    {
        $data = [];

        foreach ($this->fieldMapping as $dbColumn => $excelColumn) {
            $data[$dbColumn] = $row[$excelColumn] ?? null;
        }

        return new $this->modelClass($data);
    }
}