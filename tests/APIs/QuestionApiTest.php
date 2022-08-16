<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\Question;

class QuestionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question()
    {
        $question = Question::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/questions', $question
        );

        $this->assertApiResponse($question);
    }

    /**
     * @test
     */
    public function test_read_question()
    {
        $question = Question::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/questions/'.$question->id
        );

        $this->assertApiResponse($question->toArray());
    }

    /**
     * @test
     */
    public function test_update_question()
    {
        $question = Question::factory()->create();
        $editedQuestion = Question::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/questions/'.$question->id,
            $editedQuestion
        );

        $this->assertApiResponse($editedQuestion);
    }

    /**
     * @test
     */
    public function test_delete_question()
    {
        $question = Question::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/questions/'.$question->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/questions/'.$question->id
        );

        $this->response->assertStatus(404);
    }
}
