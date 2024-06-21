<?php

namespace App\Http\Controllers\Api;

use App\Enums\NewsStringEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\News\ChangeStatusRequest;
use App\Http\Resources\Api\News\IndexResource;
use App\Http\Resources\Api\News\ShowResource;
use App\Models\News;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    // Usually I keep all logic into services & repositories and trigger them from controllers,
    // but due to small size of the task I think it's unnecessary.
    //
    // I could also use the Request class for pagination functional,
    // but the pagination wasn't described in the task's goals.
    public function index(): AnonymousResourceCollection
    {
        return IndexResource::collection(News::query()->where('status', NewsStringEnum::STATUS__ACTIVE->value)->get());
    }

    // We can use soft binding instead of manual getting for a model entity.
    public function show(string $entity): ShowResource
    {
        return new ShowResource(News::where('id', $entity)->orWhere('slug', $entity)->first());
    }

    public function changeStatus(string $entity, ChangeStatusRequest $request): ShowResource
    {
        $newsEntity = News::query()->where('id', $entity)->orWhere('slug', $entity)->first();
        $newsEntity->update(['status', $request->validated('status')]);

        return new ShowResource($newsEntity);
    }
}
