<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Base\Survey\Domain\Models\SurveyTranslation;

class SurveyTranslationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/survey_translations', $surveyTranslation
        );

        $this->assertApiResponse($surveyTranslation);
    }

    /**
     * @test
     */
    public function test_read_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/survey_translations/'.$surveyTranslation->id
        );

        $this->assertApiResponse($surveyTranslation->toArray());
    }

    /**
     * @test
     */
    public function test_update_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();
        $editedSurveyTranslation = SurveyTranslation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/survey_translations/'.$surveyTranslation->id,
            $editedSurveyTranslation
        );

        $this->assertApiResponse($editedSurveyTranslation);
    }

    /**
     * @test
     */
    public function test_delete_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/survey_translations/'.$surveyTranslation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/survey_translations/'.$surveyTranslation->id
        );

        $this->response->assertStatus(404);
    }
}
