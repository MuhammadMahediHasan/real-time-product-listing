<?php

namespace App\Console\Commands;

use App\Action\FetchProductAndStoreAction;
use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use App\Events\ProductAdded;

class FetchProducts extends Command
{
    protected $signature = 'fetch:products';
    protected $description = 'Fetch products from Fake Store API';

    public function handle(): void
    {
        FetchProductAndStoreAction::execute();

        $this->info('Products fetched and stored.');
    }
}
