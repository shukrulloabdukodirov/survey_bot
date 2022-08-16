<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\User\Applicant\Domain\Models\Applicant;

class ApplicantApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_applicant()
    {
        $applicant = Applicant::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/applicants', $applicant
        );

        $this->assertApiResponse($applicant);
    }

    /**
     * @test
     */
    public function test_read_applicant()
    {
        $applicant = Applicant::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/applicants/'.$applicant->id
        );

        $this->assertApiResponse($applicant->toArray());
    }

    /**
     * @test
     */
    public function test_update_applicant()
    {
        $applicant = Applicant::factory()->create();
        $editedApplicant = Applicant::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/applicants/'.$applicant->id,
            $editedApplicant
        );

        $this->assertApiResponse($editedApplicant);
    }

    /**
     * @test
     */
    public function test_delete_applicant()
    {
        $applicant = Applicant::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/applicants/'.$applicant->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/applicants/'.$applicant->id
        );

        $this->response->assertStatus(404);
    }
}
