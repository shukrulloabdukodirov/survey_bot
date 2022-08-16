<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\Question;
use Base\Survey\Domain\Repositories\QuestionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionRepository
     */
    protected $questionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionRepo = \App::make(QuestionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question()
    {
        $question = Question::factory()->make()->toArray();

        $createdQuestion = $this->questionRepo->create($question);

        $createdQuestion = $createdQuestion->toArray();
        $this->assertArrayHasKey('id', $createdQuestion);
        $this->assertNotNull($createdQuestion['id'], 'Created Question must have id specified');
        $this->assertNotNull(Question::find($createdQuestion['id']), 'Question with given id must be in DB');
        $this->assertModelData($question, $createdQuestion);
    }

    /**
     * @test read
     */
    public function test_read_question()
    {
        $question = Question::factory()->create();

        $dbQuestion = $this->questionRepo->find($question->id);

        $dbQuestion = $dbQuestion->toArray();
        $this->assertModelData($question->toArray(), $dbQuestion);
    }

    /**
     * @test update
     */
    public function test_update_question()
    {
        $question = Question::factory()->create();
        $fakeQuestion = Question::factory()->make()->toArray();

        $updatedQuestion = $this->questionRepo->update($fakeQuestion, $question->id);

        $this->assertModelData($fakeQuestion, $updatedQuestion->toArray());
        $dbQuestion = $this->questionRepo->find($question->id);
        $this->assertModelData($fakeQuestion, $dbQuestion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question()
    {
        $question = Question::factory()->create();

        $resp = $this->questionRepo->delete($question->id);

        $this->assertTrue($resp);
        $this->assertNull(Question::find($question->id), 'Question should not exist in DB');
    }
}
