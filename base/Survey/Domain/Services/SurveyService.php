<?php

namespace Base\Survey\Domain\Services;

use Base\Survey\Domain\Repositories\QuestionRepository;
use Base\Survey\Domain\Repositories\SurveyRepository;

class SurveyService
{
    public $surveyRepo;
    public $questionRepo;
    public function __construct(SurveyRepository $surveyRepo, QuestionRepository $questionRepo){
        $this->questionRepo = $questionRepo;
        $this->surveyRepo = $surveyRepo;
    }

    public function getQuestion(){

    }
}
