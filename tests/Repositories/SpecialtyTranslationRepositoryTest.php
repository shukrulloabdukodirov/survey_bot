<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\SpecialtyTranslation;
use Base\Resource\Domain\Repositories\SpecialtyTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialtyTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialtyTranslationRepository
     */
    protected $specialtyTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialtyTranslationRepo = \App::make(SpecialtyTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->make()->toArray();

        $createdSpecialtyTranslation = $this->specialtyTranslationRepo->create($specialtyTranslation);

        $createdSpecialtyTranslation = $createdSpecialtyTranslation->toArray();
        $this->assertArrayHasKey('id', $createdSpecialtyTranslation);
        $this->assertNotNull($createdSpecialtyTranslation['id'], 'Created SpecialtyTranslation must have id specified');
        $this->assertNotNull(SpecialtyTranslation::find($createdSpecialtyTranslation['id']), 'SpecialtyTranslation with given id must be in DB');
        $this->assertModelData($specialtyTranslation, $createdSpecialtyTranslation);
    }

    /**
     * @test read
     */
    public function test_read_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();

        $dbSpecialtyTranslation = $this->specialtyTranslationRepo->find($specialtyTranslation->id);

        $dbSpecialtyTranslation = $dbSpecialtyTranslation->toArray();
        $this->assertModelData($specialtyTranslation->toArray(), $dbSpecialtyTranslation);
    }

    /**
     * @test update
     */
    public function test_update_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();
        $fakeSpecialtyTranslation = SpecialtyTranslation::factory()->make()->toArray();

        $updatedSpecialtyTranslation = $this->specialtyTranslationRepo->update($fakeSpecialtyTranslation, $specialtyTranslation->id);

        $this->assertModelData($fakeSpecialtyTranslation, $updatedSpecialtyTranslation->toArray());
        $dbSpecialtyTranslation = $this->specialtyTranslationRepo->find($specialtyTranslation->id);
        $this->assertModelData($fakeSpecialtyTranslation, $dbSpecialtyTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_specialty_translation()
    {
        $specialtyTranslation = SpecialtyTranslation::factory()->create();

        $resp = $this->specialtyTranslationRepo->delete($specialtyTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialtyTranslation::find($specialtyTranslation->id), 'SpecialtyTranslation should not exist in DB');
    }
}
