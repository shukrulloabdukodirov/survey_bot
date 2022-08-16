<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\QuestionTranslation;
use Base\Survey\Domain\Repositories\QuestionTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionTranslationRepository
     */
    protected $questionTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionTranslationRepo = \App::make(QuestionTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->make()->toArray();

        $createdQuestionTranslation = $this->questionTranslationRepo->create($questionTranslation);

        $createdQuestionTranslation = $createdQuestionTranslation->toArray();
        $this->assertArrayHasKey('id', $createdQuestionTranslation);
        $this->assertNotNull($createdQuestionTranslation['id'], 'Created QuestionTranslation must have id specified');
        $this->assertNotNull(QuestionTranslation::find($createdQuestionTranslation['id']), 'QuestionTranslation with given id must be in DB');
        $this->assertModelData($questionTranslation, $createdQuestionTranslation);
    }

    /**
     * @test read
     */
    public function test_read_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();

        $dbQuestionTranslation = $this->questionTranslationRepo->find($questionTranslation->id);

        $dbQuestionTranslation = $dbQuestionTranslation->toArray();
        $this->assertModelData($questionTranslation->toArray(), $dbQuestionTranslation);
    }

    /**
     * @test update
     */
    public function test_update_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();
        $fakeQuestionTranslation = QuestionTranslation::factory()->make()->toArray();

        $updatedQuestionTranslation = $this->questionTranslationRepo->update($fakeQuestionTranslation, $questionTranslation->id);

        $this->assertModelData($fakeQuestionTranslation, $updatedQuestionTranslation->toArray());
        $dbQuestionTranslation = $this->questionTranslationRepo->find($questionTranslation->id);
        $this->assertModelData($fakeQuestionTranslation, $dbQuestionTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();

        $resp = $this->questionTranslationRepo->delete($questionTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(QuestionTranslation::find($questionTranslation->id), 'QuestionTranslation should not exist in DB');
    }
}
