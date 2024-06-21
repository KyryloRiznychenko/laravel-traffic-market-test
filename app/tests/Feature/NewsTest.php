<?php

namespace Tests\Feature;

use App\Enums\NewsStringEnum;
use App\Models\News;
use Database\Seeders\NewsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index_route(): void
    {
        $this->seed(NewsSeeder::class);

        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
        $response->assertJsonCount(News::query()->where('status', NewsStringEnum::STATUS__ACTIVE->value)->count());
    }

    public function test_specific_news_route(): void
    {
        $newsEntity = News::factory()->create();

        $response = $this->get(route('news.show', ['entity' => $newsEntity->id]));
        $response->assertStatus(200);
    }

    public function test_change_status_route(): void
    {
        $newsEntity = News::factory()->state(fn() => ['status' => NewsStringEnum::STATUS__HIDDEN->value])->create();

        $response = $this->patch(
            route('news.change_status', ['entity' => $newsEntity->id]),
            ['status' => NewsStringEnum::STATUS__ACTIVE->value]
        );

        $response->assertStatus(200);
        $this->assertNotEquals($newsEntity->status, NewsStringEnum::STATUS__ACTIVE);
    }
}
