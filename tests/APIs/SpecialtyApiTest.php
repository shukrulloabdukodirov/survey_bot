<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Resource\Domain\Models\Speciality;

class SpecialtyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_specialty()
    {
        $specialty = Speciality::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/specialties', $specialty
        );

        $this->assertApiResponse($specialty);
    }

    /**
     * @test
     */
    public function test_read_specialty()
    {
        $specialty = Speciality::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/specialties/'.$specialty->id
        );

        $this->assertApiResponse($specialty->toArray());
    }

    /**
     * @test
     */
    public function test_update_specialty()
    {
        $specialty = Speciality::factory()->create();
        $editedSpecialty = Speciality::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/specialties/'.$specialty->id,
            $editedSpecialty
        );

        $this->assertApiResponse($editedSpecialty);
    }

    /**
     * @test
     */
    public function test_delete_specialty()
    {
        $specialty = Speciality::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/specialties/'.$specialty->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/specialties/'.$specialty->id
        );

        $this->response->assertStatus(404);
    }
}
