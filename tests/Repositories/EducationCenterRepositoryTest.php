<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Repositories\EducationCenterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EducationCenterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EducationCenterRepository
     */
    protected $educationCenterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->educationCenterRepo = \App::make(EducationCenterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_education_center()
    {
        $educationCenter = EducationCenter::factory()->make()->toArray();

        $createdEducationCenter = $this->educationCenterRepo->create($educationCenter);

        $createdEducationCenter = $createdEducationCenter->toArray();
        $this->assertArrayHasKey('id', $createdEducationCenter);
        $this->assertNotNull($createdEducationCenter['id'], 'Created EducationCenter must have id specified');
        $this->assertNotNull(EducationCenter::find($createdEducationCenter['id']), 'EducationCenter with given id must be in DB');
        $this->assertModelData($educationCenter, $createdEducationCenter);
    }

    /**
     * @test read
     */
    public function test_read_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();

        $dbEducationCenter = $this->educationCenterRepo->find($educationCenter->id);

        $dbEducationCenter = $dbEducationCenter->toArray();
        $this->assertModelData($educationCenter->toArray(), $dbEducationCenter);
    }

    /**
     * @test update
     */
    public function test_update_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();
        $fakeEducationCenter = EducationCenter::factory()->make()->toArray();

        $updatedEducationCenter = $this->educationCenterRepo->update($fakeEducationCenter, $educationCenter->id);

        $this->assertModelData($fakeEducationCenter, $updatedEducationCenter->toArray());
        $dbEducationCenter = $this->educationCenterRepo->find($educationCenter->id);
        $this->assertModelData($fakeEducationCenter, $dbEducationCenter->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_education_center()
    {
        $educationCenter = EducationCenter::factory()->create();

        $resp = $this->educationCenterRepo->delete($educationCenter->id);

        $this->assertTrue($resp);
        $this->assertNull(EducationCenter::find($educationCenter->id), 'EducationCenter should not exist in DB');
    }
}
