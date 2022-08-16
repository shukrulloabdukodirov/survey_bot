<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\EducationCenterTranslation;

class EducationCenterTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/education_center_translations', $educationCenterTranslation
        );

        $this->assertApiResponse($educationCenterTranslation);
    }

    /**
     * @test
     */
    public function test_read_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/education_center_translations/'.$educationCenterTranslation->id
        );

        $this->assertApiResponse($educationCenterTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();
        $editedEducationCenterTranslation = EducationCenterTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/education_center_translations/'.$educationCenterTranslation->id,
            $editedEducationCenterTranslation
        );

        $this->assertApiResponse($editedEducationCenterTranslation);
    }

    /**
     * @test
     */
    public function test_delete_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/education_center_translations/'.$educationCenterTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/education_center_translations/'.$educationCenterTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
