<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\RegionTranslation;
use Base\Resource\Domain\Repositories\RegionTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RegionTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RegionTranslationRepository
     */
    protected $regionTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->regionTranslationRepo = \App::make(RegionTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->make()->toArray();

        $createdRegionTranslation = $this->regionTranslationRepo->create($regionTranslation);

        $createdRegionTranslation = $createdRegionTranslation->toArray();
        $this->assertArrayHasKey('id', $createdRegionTranslation);
        $this->assertNotNull($createdRegionTranslation['id'], 'Created RegionTranslation must have id specified');
        $this->assertNotNull(RegionTranslation::find($createdRegionTranslation['id']), 'RegionTranslation with given id must be in DB');
        $this->assertModelData($regionTranslation, $createdRegionTranslation);
    }

    /**
     * @test read
     */
    public function test_read_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();

        $dbRegionTranslation = $this->regionTranslationRepo->find($regionTranslation->id);

        $dbRegionTranslation = $dbRegionTranslation->toArray();
        $this->assertModelData($regionTranslation->toArray(), $dbRegionTranslation);
    }

    /**
     * @test update
     */
    public function test_update_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();
        $fakeRegionTranslation = RegionTranslation::factory()->make()->toArray();

        $updatedRegionTranslation = $this->regionTranslationRepo->update($fakeRegionTranslation, $regionTranslation->id);

        $this->assertModelData($fakeRegionTranslation, $updatedRegionTranslation->toArray());
        $dbRegionTranslation = $this->regionTranslationRepo->find($regionTranslation->id);
        $this->assertModelData($fakeRegionTranslation, $dbRegionTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_region_translation()
    {
        $regionTranslation = RegionTranslation::factory()->create();

        $resp = $this->regionTranslationRepo->delete($regionTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(RegionTranslation::find($regionTranslation->id), 'RegionTranslation should not exist in DB');
    }
}
