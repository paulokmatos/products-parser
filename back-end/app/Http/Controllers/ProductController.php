<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Helpers\ApiInfo;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function __construct(
        protected ProductService $service
    ) {
    }

    /**
     * List paginated products in database.
     */
    public function index()
    {
        return $this->service->getAll();
    }

    public function apiDetails()
    {
        $databaseConnection = ApiInfo::checkDatabaseConnection();
        $memoryUsage = ApiInfo::getMemoryUsage();
        $uptime = exec('uptime -p');

        $apiDetails = [
            'database_connection' => $databaseConnection,
            // 'last_cron_execution' => $lastCronExecution,
            'memory_usage' => $memoryUsage,
            'uptime' => $uptime,
        ];

        return response()->json($apiDetails, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $product = $this->service->findOne($code);
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $code)
    {
        $product = $this->service->update(
            ProductDTO::makeFromRequest($request),
            $code
        );

        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        $this->service->delete($code);

        return response('', Response::HTTP_NO_CONTENT);
    }
}
