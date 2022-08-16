<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\EducationCenter;

class EducationCenterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_education_center()
    {
        $educationCenter = EducationCenter::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/education_centers', $educationCenter
        );

        $this->assertApiResponse($educationCenter);
    }

    /**
     * @test
     */
    public function test_read_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/education_centers/'.$educationCenter->id
        );

        $this->assertApiResponse($educationCenter->toArray());
    }

    /**
     * @test
     */
    public function test_update_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();
        $editedEducationCenter = EducationCenter::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/education_centers/'.$educationCenter->id,
            $editedEducationCenter
        );

        $this->assertApiResponse($editedEducationCenter);
    }

    /**
     * @test
     */
    public function test_delete_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/education_centers/'.$educationCenter->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/education_centers/'.$educationCenter->id
        );

        $this->response->assertStatus(404);
    }
}
