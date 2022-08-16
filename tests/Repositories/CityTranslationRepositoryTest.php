<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\CityTranslation;
use Base\Resource\Domain\Repositories\CityTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CityTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CityTranslationRepository
     */
    protected $cityTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cityTranslationRepo = \App::make(CityTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->make()->toArray();

        $createdCityTranslation = $this->cityTranslationRepo->create($cityTranslation);

        $createdCityTranslation = $createdCityTranslation->toArray();
        $this->assertArrayHasKey('id', $createdCityTranslation);
        $this->assertNotNull($createdCityTranslation['id'], 'Created CityTranslation must have id specified');
        $this->assertNotNull(CityTranslation::find($createdCityTranslation['id']), 'CityTranslation with given id must be in DB');
        $this->assertModelData($cityTranslation, $createdCityTranslation);
    }

    /**
     * @test read
     */
    public function test_read_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();

        $dbCityTranslation = $this->cityTranslationRepo->find($cityTranslation->id);

        $dbCityTranslation = $dbCityTranslation->toArray();
        $this->assertModelData($cityTranslation->toArray(), $dbCityTranslation);
    }

    /**
     * @test update
     */
    public function test_update_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();
        $fakeCityTranslation = CityTranslation::factory()->make()->toArray();

        $updatedCityTranslation = $this->cityTranslationRepo->update($fakeCityTranslation, $cityTranslation->id);

        $this->assertModelData($fakeCityTranslation, $updatedCityTranslation->toArray());
        $dbCityTranslation = $this->cityTranslationRepo->find($cityTranslation->id);
        $this->assertModelData($fakeCityTranslation, $dbCityTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_city_translation()
    {
        $cityTranslation = CityTranslation::factory()->create();

        $resp = $this->cityTranslationRepo->delete($cityTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(CityTranslation::find($cityTranslation->id), 'CityTranslation should not exist in DB');
    }
}
