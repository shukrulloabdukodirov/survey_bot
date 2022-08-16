<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\QuestionAnswer;
use Base\Survey\Domain\Repositories\QuestionAnswerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionAnswerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionAnswerRepository
     */
    protected $questionAnswerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionAnswerRepo = \App::make(QuestionAnswerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->make()->toArray();

        $createdQuestionAnswer = $this->questionAnswerRepo->create($questionAnswer);

        $createdQuestionAnswer = $createdQuestionAnswer->toArray();
        $this->assertArrayHasKey('id', $createdQuestionAnswer);
        $this->assertNotNull($createdQuestionAnswer['id'], 'Created QuestionAnswer must have id specified');
        $this->assertNotNull(QuestionAnswer::find($createdQuestionAnswer['id']), 'QuestionAnswer with given id must be in DB');
        $this->assertModelData($questionAnswer, $createdQuestionAnswer);
    }

    /**
     * @test read
     */
    public function test_read_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();

        $dbQuestionAnswer = $this->questionAnswerRepo->find($questionAnswer->id);

        $dbQuestionAnswer = $dbQuestionAnswer->toArray();
        $this->assertModelData($questionAnswer->toArray(), $dbQuestionAnswer);
    }

    /**
     * @test update
     */
    public function test_update_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();
        $fakeQuestionAnswer = QuestionAnswer::factory()->make()->toArray();

        $updatedQuestionAnswer = $this->questionAnswerRepo->update($fakeQuestionAnswer, $questionAnswer->id);

        $this->assertModelData($fakeQuestionAnswer, $updatedQuestionAnswer->toArray());
        $dbQuestionAnswer = $this->questionAnswerRepo->find($questionAnswer->id);
        $this->assertModelData($fakeQuestionAnswer, $dbQuestionAnswer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();

        $resp = $this->questionAnswerRepo->delete($questionAnswer->id);

        $this->assertTrue($resp);
        $this->assertNull(QuestionAnswer::find($questionAnswer->id), 'QuestionAnswer should not exist in DB');
    }
}
