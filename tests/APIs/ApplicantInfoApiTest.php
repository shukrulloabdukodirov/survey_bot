<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\User\Applicant\Domain\Models\ApplicantInfo;

class ApplicantInfoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/applicant_infos', $applicantInfo
        );

        $this->assertApiResponse($applicantInfo);
    }

    /**
     * @test
     */
    public function test_read_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/applicant_infos/'.$applicantInfo->id
        );

        $this->assertApiResponse($applicantInfo->toArray());
    }

    /**
     * @test
     */
    public function test_update_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();
        $editedApplicantInfo = ApplicantInfo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/applicant_infos/'.$applicantInfo->id,
            $editedApplicantInfo
        );

        $this->assertApiResponse($editedApplicantInfo);
    }

    /**
     * @test
     */
    public function test_delete_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/applicant_infos/'.$applicantInfo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/applicant_infos/'.$applicantInfo->id
        );

        $this->response->assertStatus(404);
    }
}
