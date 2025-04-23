<?php

namespace App\Services;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;

class AdService
{
    public function index(): Collection
    {
        return Ad::query()
            ->get();
    }

    public function indexMy(): Collection
    {
        $author_id = auth('sanctum')->user()->id;

        return Ad::query()
            ->where('author_id', $author_id)
            ->get();
    }

    public function getUserId():int
    {
        return auth('sanctum')->user()->id;
    }

    public function create(array $data): ?Ad
    {
        $data['author_id'] = $this->getUserId();

        /** @var Ad $ad */
        $ad = Ad::query()->create($data);

        return $ad;
    }

    public function update(Ad $ad, array $data): bool
    {
        return $ad->update($data);
    }

    public function delete(Ad $ad): bool
    {
        return $ad->delete();
    }
}
