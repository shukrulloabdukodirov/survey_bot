<?php namespace Tests\Repositories;

use Base\Application\Domain\Models\ApplicationAnswer;
use Base\Application\Domain\Repositories\ApplicationAnswerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicationAnswerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplicationAnswerRepository
     */
    protected $applicationAnswerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationAnswerRepo = \App::make(ApplicationAnswerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->make()->toArray();

        $createdApplicationAnswer = $this->applicationAnswerRepo->create($applicationAnswer);

        $createdApplicationAnswer = $createdApplicationAnswer->toArray();
        $this->assertArrayHasKey('id', $createdApplicationAnswer);
        $this->assertNotNull($createdApplicationAnswer['id'], 'Created ApplicationAnswer must have id specified');
        $this->assertNotNull(ApplicationAnswer::find($createdApplicationAnswer['id']), 'ApplicationAnswer with given id must be in DB');
        $this->assertModelData($applicationAnswer, $createdApplicationAnswer);
    }

    /**
     * @test read
     */
    public function test_read_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();

        $dbApplicationAnswer = $this->applicationAnswerRepo->find($applicationAnswer->id);

        $dbApplicationAnswer = $dbApplicationAnswer->toArray();
        $this->assertModelData($applicationAnswer->toArray(), $dbApplicationAnswer);
    }

    /**
     * @test update
     */
    public function test_update_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();
        $fakeApplicationAnswer = ApplicationAnswer::factory()->make()->toArray();

        $updatedApplicationAnswer = $this->applicationAnswerRepo->update($fakeApplicationAnswer, $applicationAnswer->id);

        $this->assertModelData($fakeApplicationAnswer, $updatedApplicationAnswer->toArray());
        $dbApplicationAnswer = $this->applicationAnswerRepo->find($applicationAnswer->id);
        $this->assertModelData($fakeApplicationAnswer, $dbApplicationAnswer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();

        $resp = $this->applicationAnswerRepo->delete($applicationAnswer->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplicationAnswer::find($applicationAnswer->id), 'ApplicationAnswer should not exist in DB');
    }
}
