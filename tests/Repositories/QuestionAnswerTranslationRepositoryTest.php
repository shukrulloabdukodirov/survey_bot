<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\QuestionAnswerTranslation;
use Base\Survey\Domain\Repositories\QuestionAnswerTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionAnswerTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionAnswerTranslationRepository
     */
    protected $questionAnswerTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionAnswerTranslationRepo = \App::make(QuestionAnswerTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->make()->toArray();

        $createdQuestionAnswerTranslation = $this->questionAnswerTranslationRepo->create($questionAnswerTranslation);

        $createdQuestionAnswerTranslation = $createdQuestionAnswerTranslation->toArray();
        $this->assertArrayHasKey('id', $createdQuestionAnswerTranslation);
        $this->assertNotNull($createdQuestionAnswerTranslation['id'], 'Created QuestionAnswerTranslation must have id specified');
        $this->assertNotNull(QuestionAnswerTranslation::find($createdQuestionAnswerTranslation['id']), 'QuestionAnswerTranslation with given id must be in DB');
        $this->assertModelData($questionAnswerTranslation, $createdQuestionAnswerTranslation);
    }

    /**
     * @test read
     */
    public function test_read_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();

        $dbQuestionAnswerTranslation = $this->questionAnswerTranslationRepo->find($questionAnswerTranslation->id);

        $dbQuestionAnswerTranslation = $dbQuestionAnswerTranslation->toArray();
        $this->assertModelData($questionAnswerTranslation->toArray(), $dbQuestionAnswerTranslation);
    }

    /**
     * @test update
     */
    public function test_update_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();
        $fakeQuestionAnswerTranslation = QuestionAnswerTranslation::factory()->make()->toArray();

        $updatedQuestionAnswerTranslation = $this->questionAnswerTranslationRepo->update($fakeQuestionAnswerTranslation, $questionAnswerTranslation->id);

        $this->assertModelData($fakeQuestionAnswerTranslation, $updatedQuestionAnswerTranslation->toArray());
        $dbQuestionAnswerTranslation = $this->questionAnswerTranslationRepo->find($questionAnswerTranslation->id);
        $this->assertModelData($fakeQuestionAnswerTranslation, $dbQuestionAnswerTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();

        $resp = $this->questionAnswerTranslationRepo->delete($questionAnswerTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(QuestionAnswerTranslation::find($questionAnswerTranslation->id), 'QuestionAnswerTranslation should not exist in DB');
    }
}
