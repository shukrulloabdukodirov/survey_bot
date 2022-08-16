<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\QuestionTranslation;

class QuestionTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/question_translations', $questionTranslation
        );

        $this->assertApiResponse($questionTranslation);
    }

    /**
     * @test
     */
    public function test_read_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/question_translations/'.$questionTranslation->id
        );

        $this->assertApiResponse($questionTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();
        $editedQuestionTranslation = QuestionTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/question_translations/'.$questionTranslation->id,
            $editedQuestionTranslation
        );

        $this->assertApiResponse($editedQuestionTranslation);
    }

    /**
     * @test
     */
    public function test_delete_question_translation()
    {
        $questionTranslation = QuestionTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/question_translations/'.$questionTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/question_translations/'.$questionTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
