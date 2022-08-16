<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\EducationCenterSpecialty;

class EducationCenterSpecialtyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/education_center_specialties', $educationCenterSpecialty
        );

        $this->assertApiResponse($educationCenterSpecialty);
    }

    /**
     * @test
     */
    public function test_read_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/education_center_specialties/'.$educationCenterSpecialty->id
        );

        $this->assertApiResponse($educationCenterSpecialty->toArray());
    }

    /**
     * @test
     */
    public function test_update_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();
        $editedEducationCenterSpecialty = EducationCenterSpecialty::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/education_center_specialties/'.$educationCenterSpecialty->id,
            $editedEducationCenterSpecialty
        );

        $this->assertApiResponse($editedEducationCenterSpecialty);
    }

    /**
     * @test
     */
    public function test_delete_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/education_center_specialties/'.$educationCenterSpecialty->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/education_center_specialties/'.$educationCenterSpecialty->id
        );

        $this->response->assertStatus(404);
    }
}
