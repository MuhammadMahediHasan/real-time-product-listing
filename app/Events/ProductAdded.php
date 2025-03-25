<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class ProductAdded implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('products');
    }

    public function broadcastAs(): string
    {
        return 'product.added';
    }
}
