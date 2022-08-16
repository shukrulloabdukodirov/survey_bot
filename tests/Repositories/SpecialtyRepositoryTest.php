<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\Specialty;
use Base\Resource\Domain\Repositories\SpecialtyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialtyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialtyRepository
     */
    protected $specialtyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialtyRepo = \App::make(SpecialtyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialty()
    {
        $specialty = Specialty::factory()->make()->toArray();

        $createdSpecialty = $this->specialtyRepo->create($specialty);

        $createdSpecialty = $createdSpecialty->toArray();
        $this->assertArrayHasKey('id', $createdSpecialty);
        $this->assertNotNull($createdSpecialty['id'], 'Created Specialty must have id specified');
        $this->assertNotNull(Specialty::find($createdSpecialty['id']), 'Specialty with given id must be in DB');
        $this->assertModelData($specialty, $createdSpecialty);
    }

    /**
     * @test read
     */
    public function test_read_specialty()
    {
        $specialty = Specialty::factory()->create();

        $dbSpecialty = $this->specialtyRepo->find($specialty->id);

        $dbSpecialty = $dbSpecialty->toArray();
        $this->assertModelData($specialty->toArray(), $dbSpecialty);
    }

    /**
     * @test update
     */
    public function test_update_specialty()
    {
        $specialty = Specialty::factory()->create();
        $fakeSpecialty = Specialty::factory()->make()->toArray();

        $updatedSpecialty = $this->specialtyRepo->update($fakeSpecialty, $specialty->id);

        $this->assertModelData($fakeSpecialty, $updatedSpecialty->toArray());
        $dbSpecialty = $this->specialtyRepo->find($specialty->id);
        $this->assertModelData($fakeSpecialty, $dbSpecialty->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_specialty()
    {
        $specialty = Specialty::factory()->create();

        $resp = $this->specialtyRepo->delete($specialty->id);

        $this->assertTrue($resp);
        $this->assertNull(Specialty::find($specialty->id), 'Specialty should not exist in DB');
    }
}
