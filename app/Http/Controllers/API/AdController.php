<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\AdCreateRequest;
use App\Http\Requests\Ad\AdUpdateRequest;
use App\Http\Resources\AdResource;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Ad;
use App\Services\AdService;
use Illuminate\Http\JsonResponse;

class AdController extends Controller
{
    private AdService $service;

    public function __construct()
    {
        $this->service = new AdService();
    }

    public function index(): JsonResponse
    {
        $ads = $this->service->index();

        return new SuccessResponse(
            data: ['data' => AdResource::collection($ads)],
        );
    }

    public function indexMy(): JsonResponse
    {
        $ads = $this->service->indexMy();

        return new SuccessResponse(
            data: ['data' => AdResource::collection($ads)],
        );
    }

    public function store(AdCreateRequest $request): JsonResponse
    {
        $ad = $this->service->create($request->validated());

        return $ad
            ? new SuccessResponse(message: 'ad created')
            : new FailResponse(message: 'ad creation failed');
    }

    public function show(Ad $ad): JsonResponse
    {
        return new SuccessResponse(
            data: ['data' => AdResource::make($ad)]
        );
    }

    public function update(Ad $ad, AdUpdateRequest $request): JsonResponse
    {
        return $this->service->update(
            ad: $ad,
            data: $request->validated()
        )
            ? new SuccessResponse(message: 'ad updated')
            : new FailResponse(message: 'ad update failed');
    }

    public function delete(Ad $ad): JsonResponse
    {
        $isDeleted = $this->service->delete($ad);

        return $isDeleted
            ? new SuccessResponse(message: 'client deleted')
            : new FailResponse(message: 'client delete failed');
    }
}
