<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\SpecialtyTranslation;

class SpecialtyTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/specialty_translations', $specialtyTranslation
        );

        $this->assertApiResponse($specialtyTranslation);
    }

    /**
     * @test
     */
    public function test_read_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/specialty_translations/'.$specialtyTranslation->id
        );

        $this->assertApiResponse($specialtyTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();
        $editedSpecialtyTranslation = SpecialtyTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/specialty_translations/'.$specialtyTranslation->id,
            $editedSpecialtyTranslation
        );

        $this->assertApiResponse($editedSpecialtyTranslation);
    }

    /**
     * @test
     */
    public function test_delete_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/specialty_translations/'.$specialtyTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/specialty_translations/'.$specialtyTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
