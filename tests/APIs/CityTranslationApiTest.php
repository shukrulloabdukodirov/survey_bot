<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\CityTranslation;

class CityTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/city_translations', $cityTranslation
        );

        $this->assertApiResponse($cityTranslation);
    }

    /**
     * @test
     */
    public function test_read_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/city_translations/'.$cityTranslation->id
        );

        $this->assertApiResponse($cityTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();
        $editedCityTranslation = CityTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/city_translations/'.$cityTranslation->id,
            $editedCityTranslation
        );

        $this->assertApiResponse($editedCityTranslation);
    }

    /**
     * @test
     */
    public function test_delete_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/city_translations/'.$cityTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/city_translations/'.$cityTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
