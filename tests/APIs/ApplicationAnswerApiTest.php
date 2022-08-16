<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Application\Domain\Models\ApplicationAnswer;

class ApplicationAnswerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/application_answers', $applicationAnswer
        );

        $this->assertApiResponse($applicationAnswer);
    }

    /**
     * @test
     */
    public function test_read_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/application_answers/'.$applicationAnswer->id
        );

        $this->assertApiResponse($applicationAnswer->toArray());
    }

    /**
     * @test
     */
    public function test_update_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();
        $editedApplicationAnswer = ApplicationAnswer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/application_answers/'.$applicationAnswer->id,
            $editedApplicationAnswer
        );

        $this->assertApiResponse($editedApplicationAnswer);
    }

    /**
     * @test
     */
    public function test_delete_application_answer()
    {
        $applicationAnswer = ApplicationAnswer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/application_answers/'.$applicationAnswer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/application_answers/'.$applicationAnswer->id
        );

        $this->response->assertStatus(404);
    }
}
