<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\EducationCenterSpecialty;
use Base\Resource\Domain\Repositories\EducationCenterSpecialtyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EducationCenterSpecialtyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EducationCenterSpecialtyRepository
     */
    protected $educationCenterSpecialtyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->educationCenterSpecialtyRepo = \App::make(EducationCenterSpecialtyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->make()->toArray();

        $createdEducationCenterSpecialty = $this->educationCenterSpecialtyRepo->create($educationCenterSpecialty);

        $createdEducationCenterSpecialty = $createdEducationCenterSpecialty->toArray();
        $this->assertArrayHasKey('id', $createdEducationCenterSpecialty);
        $this->assertNotNull($createdEducationCenterSpecialty['id'], 'Created EducationCenterSpecialty must have id specified');
        $this->assertNotNull(EducationCenterSpecialty::find($createdEducationCenterSpecialty['id']), 'EducationCenterSpecialty with given id must be in DB');
        $this->assertModelData($educationCenterSpecialty, $createdEducationCenterSpecialty);
    }

    /**
     * @test read
     */
    public function test_read_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();

        $dbEducationCenterSpecialty = $this->educationCenterSpecialtyRepo->find($educationCenterSpecialty->id);

        $dbEducationCenterSpecialty = $dbEducationCenterSpecialty->toArray();
        $this->assertModelData($educationCenterSpecialty->toArray(), $dbEducationCenterSpecialty);
    }

    /**
     * @test update
     */
    public function test_update_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();
        $fakeEducationCenterSpecialty = EducationCenterSpecialty::factory()->make()->toArray();

        $updatedEducationCenterSpecialty = $this->educationCenterSpecialtyRepo->update($fakeEducationCenterSpecialty, $educationCenterSpecialty->id);

        $this->assertModelData($fakeEducationCenterSpecialty, $updatedEducationCenterSpecialty->toArray());
        $dbEducationCenterSpecialty = $this->educationCenterSpecialtyRepo->find($educationCenterSpecialty->id);
        $this->assertModelData($fakeEducationCenterSpecialty, $dbEducationCenterSpecialty->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_education_center_specialty()
    {
        $educationCenterSpecialty = EducationCenterSpecialty::factory()->create();

        $resp = $this->educationCenterSpecialtyRepo->delete($educationCenterSpecialty->id);

        $this->assertTrue($resp);
        $this->assertNull(EducationCenterSpecialty::find($educationCenterSpecialty->id), 'EducationCenterSpecialty should not exist in DB');
    }
}
