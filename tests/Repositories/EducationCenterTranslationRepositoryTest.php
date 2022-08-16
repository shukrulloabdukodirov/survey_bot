<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\EducationCenterTranslation;
use Base\Resource\Domain\Repositories\EducationCenterTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EducationCenterTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EducationCenterTranslationRepository
     */
    protected $educationCenterTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->educationCenterTranslationRepo = \App::make(EducationCenterTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->make()->toArray();

        $createdEducationCenterTranslation = $this->educationCenterTranslationRepo->create($educationCenterTranslation);

        $createdEducationCenterTranslation = $createdEducationCenterTranslation->toArray();
        $this->assertArrayHasKey('id', $createdEducationCenterTranslation);
        $this->assertNotNull($createdEducationCenterTranslation['id'], 'Created EducationCenterTranslation must have id specified');
        $this->assertNotNull(EducationCenterTranslation::find($createdEducationCenterTranslation['id']), 'EducationCenterTranslation with given id must be in DB');
        $this->assertModelData($educationCenterTranslation, $createdEducationCenterTranslation);
    }

    /**
     * @test read
     */
    public function test_read_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();

        $dbEducationCenterTranslation = $this->educationCenterTranslationRepo->find($educationCenterTranslation->id);

        $dbEducationCenterTranslation = $dbEducationCenterTranslation->toArray();
        $this->assertModelData($educationCenterTranslation->toArray(), $dbEducationCenterTranslation);
    }

    /**
     * @test update
     */
    public function test_update_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();
        $fakeEducationCenterTranslation = EducationCenterTranslation::factory()->make()->toArray();

        $updatedEducationCenterTranslation = $this->educationCenterTranslationRepo->update($fakeEducationCenterTranslation, $educationCenterTranslation->id);

        $this->assertModelData($fakeEducationCenterTranslation, $updatedEducationCenterTranslation->toArray());
        $dbEducationCenterTranslation = $this->educationCenterTranslationRepo->find($educationCenterTranslation->id);
        $this->assertModelData($fakeEducationCenterTranslation, $dbEducationCenterTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_education_center_translation()
    {
        $educationCenterTranslation = EducationCenterTranslation::factory()->create();

        $resp = $this->educationCenterTranslationRepo->delete($educationCenterTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(EducationCenterTranslation::find($educationCenterTranslation->id), 'EducationCenterTranslation should not exist in DB');
    }
}
