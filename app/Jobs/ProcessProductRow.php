<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductRow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $row;

    // Row is passed from import
    public function __construct(array $row)
    {
        $this->row = $row;
    }

    public function handle()
    {
        Product::create([
            'name'     => $this->row['name'],
            'price'    => $this->row['price'],
            'category' => $this->row['category'],
            'stock'    => $this->row['stock'],
            'image'    => $this->row['image'] ?? 'products/default.png',
        ]);
    }
}

