<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection, WithChunkReading, ShouldQueue {
    public function collection(Collection $rows) {
        foreach ($rows as $row) {
            ProcessProductRow::dispatch($row);
        }
    }
    public function chunkSize(): int { return 1000; }
}

