<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Http\Requests\ProductStoreRequest;
use App\Services\ProductService;

class ProductController extends Controller
{

    public function __construct(
        protected ProductService $service
    ) {}

    /**
     * List paginated products in database.
     */
    public function index()
    {
        return $this->service->getAll();
    }

    /**
     * Display API Info
     */
    public function apiDetails()
    {
        echo "Info";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $this->service->store(
            ProductDTO::makeFromRequest($request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        return $this->service->findOne($code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, string $code)
    {
        $this->service->update(
            ProductDTO::makeFromRequest($request)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        $this->service->delete($code);
    }
}
