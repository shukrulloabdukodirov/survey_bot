<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\Survey;

class SurveyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_survey()
    {
        $survey = Survey::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/surveys', $survey
        );

        $this->assertApiResponse($survey);
    }

    /**
     * @test
     */
    public function test_read_survey()
    {
        $survey = Survey::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/surveys/'.$survey->id
        );

        $this->assertApiResponse($survey->toArray());
    }

    /**
     * @test
     */
    public function test_update_survey()
    {
        $survey = Survey::factory()->create();
        $editedSurvey = Survey::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/surveys/'.$survey->id,
            $editedSurvey
        );

        $this->assertApiResponse($editedSurvey);
    }

    /**
     * @test
     */
    public function test_delete_survey()
    {
        $survey = Survey::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/surveys/'.$survey->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/surveys/'.$survey->id
        );

        $this->response->assertStatus(404);
    }
}
