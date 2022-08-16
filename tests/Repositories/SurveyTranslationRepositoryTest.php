<?php namespace Tests\Repositories;

use Base\Survey\Domain\Models\SurveyTranslation;
use Base\Survey\Domain\Repositories\SurveyTranslationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SurveyTranslationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SurveyTranslationRepository
     */
    protected $surveyTranslationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->surveyTranslationRepo = \App::make(SurveyTranslationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->make()->toArray();

        $createdSurveyTranslation = $this->surveyTranslationRepo->create($surveyTranslation);

        $createdSurveyTranslation = $createdSurveyTranslation->toArray();
        $this->assertArrayHasKey('id', $createdSurveyTranslation);
        $this->assertNotNull($createdSurveyTranslation['id'], 'Created SurveyTranslation must have id specified');
        $this->assertNotNull(SurveyTranslation::find($createdSurveyTranslation['id']), 'SurveyTranslation with given id must be in DB');
        $this->assertModelData($surveyTranslation, $createdSurveyTranslation);
    }

    /**
     * @test read
     */
    public function test_read_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();

        $dbSurveyTranslation = $this->surveyTranslationRepo->find($surveyTranslation->id);

        $dbSurveyTranslation = $dbSurveyTranslation->toArray();
        $this->assertModelData($surveyTranslation->toArray(), $dbSurveyTranslation);
    }

    /**
     * @test update
     */
    public function test_update_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();
        $fakeSurveyTranslation = SurveyTranslation::factory()->make()->toArray();

        $updatedSurveyTranslation = $this->surveyTranslationRepo->update($fakeSurveyTranslation, $surveyTranslation->id);

        $this->assertModelData($fakeSurveyTranslation, $updatedSurveyTranslation->toArray());
        $dbSurveyTranslation = $this->surveyTranslationRepo->find($surveyTranslation->id);
        $this->assertModelData($fakeSurveyTranslation, $dbSurveyTranslation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_survey_translation()
    {
        $surveyTranslation = SurveyTranslation::factory()->create();

        $resp = $this->surveyTranslationRepo->delete($surveyTranslation->id);

        $this->assertTrue($resp);
        $this->assertNull(SurveyTranslation::find($surveyTranslation->id), 'SurveyTranslation should not exist in DB');
    }
}
