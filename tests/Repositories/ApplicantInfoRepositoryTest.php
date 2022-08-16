<?php namespace Tests\Repositories;

use Base\User\Applicant\Domain\Models\ApplicantInfo;
use Base\User\Applicant\Domain\Repositories\ApplicantInfoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicantInfoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplicantInfoRepository
     */
    protected $applicantInfoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicantInfoRepo = \App::make(ApplicantInfoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->make()->toArray();

        $createdApplicantInfo = $this->applicantInfoRepo->create($applicantInfo);

        $createdApplicantInfo = $createdApplicantInfo->toArray();
        $this->assertArrayHasKey('id', $createdApplicantInfo);
        $this->assertNotNull($createdApplicantInfo['id'], 'Created ApplicantInfo must have id specified');
        $this->assertNotNull(ApplicantInfo::find($createdApplicantInfo['id']), 'ApplicantInfo with given id must be in DB');
        $this->assertModelData($applicantInfo, $createdApplicantInfo);
    }

    /**
     * @test read
     */
    public function test_read_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();

        $dbApplicantInfo = $this->applicantInfoRepo->find($applicantInfo->id);

        $dbApplicantInfo = $dbApplicantInfo->toArray();
        $this->assertModelData($applicantInfo->toArray(), $dbApplicantInfo);
    }

    /**
     * @test update
     */
    public function test_update_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();
        $fakeApplicantInfo = ApplicantInfo::factory()->make()->toArray();

        $updatedApplicantInfo = $this->applicantInfoRepo->update($fakeApplicantInfo, $applicantInfo->id);

        $this->assertModelData($fakeApplicantInfo, $updatedApplicantInfo->toArray());
        $dbApplicantInfo = $this->applicantInfoRepo->find($applicantInfo->id);
        $this->assertModelData($fakeApplicantInfo, $dbApplicantInfo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_applicant_info()
    {
        $applicantInfo = ApplicantInfo::factory()->create();

        $resp = $this->applicantInfoRepo->delete($applicantInfo->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplicantInfo::find($applicantInfo->id), 'ApplicantInfo should not exist in DB');
    }
}
