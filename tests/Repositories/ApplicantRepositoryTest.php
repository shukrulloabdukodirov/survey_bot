<?php namespace Tests\Repositories;

use Base\User\Applicant\Domain\Models\Applicant;
use Base\User\Applicant\Domain\Repositories\ApplicantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicantRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplicantRepository
     */
    protected $applicantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicantRepo = \App::make(ApplicantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_applicant()
    {
        $applicant = Applicant::factory()->make()->toArray();

        $createdApplicant = $this->applicantRepo->create($applicant);

        $createdApplicant = $createdApplicant->toArray();
        $this->assertArrayHasKey('id', $createdApplicant);
        $this->assertNotNull($createdApplicant['id'], 'Created Applicant must have id specified');
        $this->assertNotNull(Applicant::find($createdApplicant['id']), 'Applicant with given id must be in DB');
        $this->assertModelData($applicant, $createdApplicant);
    }

    /**
     * @test read
     */
    public function test_read_applicant()
    {
        $applicant = Applicant::factory()->create();

        $dbApplicant = $this->applicantRepo->find($applicant->id);

        $dbApplicant = $dbApplicant->toArray();
        $this->assertModelData($applicant->toArray(), $dbApplicant);
    }

    /**
     * @test update
     */
    public function test_update_applicant()
    {
        $applicant = Applicant::factory()->create();
        $fakeApplicant = Applicant::factory()->make()->toArray();

        $updatedApplicant = $this->applicantRepo->update($fakeApplicant, $applicant->id);

        $this->assertModelData($fakeApplicant, $updatedApplicant->toArray());
        $dbApplicant = $this->applicantRepo->find($applicant->id);
        $this->assertModelData($fakeApplicant, $dbApplicant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_applicant()
    {
        $applicant = Applicant::factory()->create();

        $resp = $this->applicantRepo->delete($applicant->id);

        $this->assertTrue($resp);
        $this->assertNull(Applicant::find($applicant->id), 'Applicant should not exist in DB');
    }
}
