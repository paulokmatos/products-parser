<?php

namespace Tests\Unit\Service;

use App\DTOs\ProductDTO;
use App\DTOs\UpdateProductDTO;
use App\Models\Product;
use App\Repositories\ProductEloquentORM;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use DatabaseTransactions;

    private ProductService $service;

    protected function setUp(): void {
        parent::setUp();

        $this->service = new ProductService(app(ProductEloquentORM::class));
    }

    public function test_ShouldGetAll()
    {
        Product::factory($qtyProducts = 10)->create(['status' => 'draft']);

        $output = $this->service->getAll($qtyProducts, 0);

        $this->assertEquals($qtyProducts, count($output));
    }

    public function test_ShouldNotGetProduct_WhenStatusIsTrash()
    {
        $productNotFiltered = Product::factory()->create(['status' => 'trash']);

        $output = $this->service->findOne($productNotFiltered->code);

        $this->assertNull($output);
    }

    public function test_ShouldGetProduct()
    {
        $productFiltered = Product::factory()->create(['status' => 'published']);

        $output = $this->service->findOne($productFiltered->code);

        $this->assertNotNull($output);
    }

    public function test_ShouldSetStatusTrash_WhenDelete()
    {
        $productFiltered = Product::factory()->create(['status' => 'published']);

        $this->service->delete($productFiltered->code);

        $productUpdated = $productFiltered->refresh();

        $this->assertEquals('trash', $productUpdated->status);
    }

    public function test_ShouldUpdate()
    {
        $oldProduct = Product::factory()->create(['status' => 'draft']);

        $updateDTO = new UpdateProductDTO(status: $expectedStatus = 'published');

        $this->service->update($updateDTO, $oldProduct->code);

        $productUpdated = $oldProduct->refresh();

        $this->assertEquals($expectedStatus, $productUpdated->status);
    }


}
