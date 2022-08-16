<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\QuestionAnswerTranslation;

class QuestionAnswerTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/question_answer_translations', $questionAnswerTranslation
        );

        $this->assertApiResponse($questionAnswerTranslation);
    }

    /**
     * @test
     */
    public function test_read_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/question_answer_translations/'.$questionAnswerTranslation->id
        );

        $this->assertApiResponse($questionAnswerTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();
        $editedQuestionAnswerTranslation = QuestionAnswerTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/question_answer_translations/'.$questionAnswerTranslation->id,
            $editedQuestionAnswerTranslation
        );

        $this->assertApiResponse($editedQuestionAnswerTranslation);
    }

    /**
     * @test
     */
    public function test_delete_question_answer_translation()
    {
        $questionAnswerTranslation = QuestionAnswerTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/question_answer_translations/'.$questionAnswerTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/question_answer_translations/'.$questionAnswerTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
