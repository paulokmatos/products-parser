<?php

namespace App\Jobs;

use App\DTOs\ProductDTO;
use App\Repositories\ProductEloquentORM;
use App\Services\ProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public ProductDTO $dto)
    {
        $this->service = new ProductService(app(ProductEloquentORM::class));
        $this->onQueue('create_product');
        $this->onConnection('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->service->store($this->dto);
    }
}
