<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\Survey;
use Base\Survey\Domain\Repositories\SurveyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SurveyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SurveyRepository
     */
    protected $surveyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->surveyRepo = \App::make(SurveyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_survey()
    {
        $survey = Survey::factory()->make()->toArray();

        $createdSurvey = $this->surveyRepo->create($survey);

        $createdSurvey = $createdSurvey->toArray();
        $this->assertArrayHasKey('id', $createdSurvey);
        $this->assertNotNull($createdSurvey['id'], 'Created Survey must have id specified');
        $this->assertNotNull(Survey::find($createdSurvey['id']), 'Survey with given id must be in DB');
        $this->assertModelData($survey, $createdSurvey);
    }

    /**
     * @test read
     */
    public function test_read_survey()
    {
        $survey = Survey::factory()->create();

        $dbSurvey = $this->surveyRepo->find($survey->id);

        $dbSurvey = $dbSurvey->toArray();
        $this->assertModelData($survey->toArray(), $dbSurvey);
    }

    /**
     * @test update
     */
    public function test_update_survey()
    {
        $survey = Survey::factory()->create();
        $fakeSurvey = Survey::factory()->make()->toArray();

        $updatedSurvey = $this->surveyRepo->update($fakeSurvey, $survey->id);

        $this->assertModelData($fakeSurvey, $updatedSurvey->toArray());
        $dbSurvey = $this->surveyRepo->find($survey->id);
        $this->assertModelData($fakeSurvey, $dbSurvey->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_survey()
    {
        $survey = Survey::factory()->create();

        $resp = $this->surveyRepo->delete($survey->id);

        $this->assertTrue($resp);
        $this->assertNull(Survey::find($survey->id), 'Survey should not exist in DB');
    }
}
