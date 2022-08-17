<?php namespace Tests\Repositories;

use Base\Resource\Domain\Models\Speciality;
use Base\Resource\Domain\Repositories\SpecialityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialtyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialityRepository
     */
    protected $specialtyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialtyRepo = \App::make(SpecialityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialty()
    {
        $specialty = Speciality::factory()->make()->toArray();

        $createdSpecialty = $this->specialtyRepo->create($specialty);

        $createdSpecialty = $createdSpecialty->toArray();
        $this->assertArrayHasKey('id', $createdSpecialty);
        $this->assertNotNull($createdSpecialty['id'], 'Created Specialty must have id specified');
        $this->assertNotNull(Speciality::find($createdSpecialty['id']), 'Specialty with given id must be in DB');
        $this->assertModelData($specialty, $createdSpecialty);
    }

    /**
     * @test read
     */
    public function test_read_specialty()
    {
        $specialty = Speciality::factory()->create();

        $dbSpecialty = $this->specialtyRepo->find($specialty->id);

        $dbSpecialty = $dbSpecialty->toArray();
        $this->assertModelData($specialty->toArray(), $dbSpecialty);
    }

    /**
     * @test update
     */
    public function test_update_specialty()
    {
        $specialty = Speciality::factory()->create();
        $fakeSpecialty = Speciality::factory()->make()->toArray();

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
        $specialty = Speciality::factory()->create();

        $resp = $this->specialtyRepo->delete($specialty->id);

        $this->assertTrue($resp);
        $this->assertNull(Speciality::find($specialty->id), 'Specialty should not exist in DB');
    }
}
