<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\QuestionAnswer;

class QuestionAnswerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/question_answers', $questionAnswer
        );

        $this->assertApiResponse($questionAnswer);
    }

    /**
     * @test
     */
    public function test_read_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/question_answers/'.$questionAnswer->id
        );

        $this->assertApiResponse($questionAnswer->toArray());
    }

    /**
     * @test
     */
    public function test_update_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();
        $editedQuestionAnswer = QuestionAnswer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/question_answers/'.$questionAnswer->id,
            $editedQuestionAnswer
        );

        $this->assertApiResponse($editedQuestionAnswer);
    }

    /**
     * @test
     */
    public function test_delete_question_answer()
    {
        $questionAnswer = QuestionAnswer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/question_answers/'.$questionAnswer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/question_answers/'.$questionAnswer->id
        );

        $this->response->assertStatus(404);
    }
}
