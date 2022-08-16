<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\RegionTranslation;

class RegionTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/region_translations', $regionTranslation
        );

        $this->assertApiResponse($regionTranslation);
    }

    /**
     * @test
     */
    public function test_read_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/region_translations/'.$regionTranslation->id
        );

        $this->assertApiResponse($regionTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();
        $editedRegionTranslation = RegionTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/region_translations/'.$regionTranslation->id,
            $editedRegionTranslation
        );

        $this->assertApiResponse($editedRegionTranslation);
    }

    /**
     * @test
     */
    public function test_delete_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/region_translations/'.$regionTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/region_translations/'.$regionTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
