<?php

namespace Base\Survey\Application\Http\Controllers\Api\V1;

use Base\Survey\Application\Http\Requests\Api\V1\CreateSurveyTranslationAPIRequest;
use Base\Survey\Application\Http\Requests\Api\V1\UpdateSurveyTranslationAPIRequest;
use Base\Survey\Domain\Models\SurveyTranslation;
use Base\Survey\Domain\Repositories\SurveyTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SurveyTranslationController
 * @package Base\Survey\Application\Http\Controllers\Api\V1
 */

class SurveyTranslationAPIController extends AppBaseController
{
    /** @var  SurveyTranslationRepository */
    private $surveyTranslationRepository;

    public function __construct(SurveyTranslationRepository $surveyTranslationRepo)
    {
        $this->surveyTranslationRepository = $surveyTranslationRepo;
    }

    /**
     * Display a listing of the SurveyTranslation.
     * GET|HEAD /surveyTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $surveyTranslations = $this->surveyTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($surveyTranslations->toArray(), 'Survey Translations retrieved successfully');
    }

    /**
     * Store a newly created SurveyTranslation in storage.
     * POST /surveyTranslations
     *
     * @param CreateSurveyTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSurveyTranslationAPIRequest $request)
    {
        $input = $request->all();

        $surveyTranslation = $this->surveyTranslationRepository->create($input);

        return $this->sendResponse($surveyTranslation->toArray(), 'Survey Translation saved successfully');
    }

    /**
     * Display the specified SurveyTranslation.
     * GET|HEAD /surveyTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SurveyTranslation $surveyTranslation */
        $surveyTranslation = $this->surveyTranslationRepository->find($id);

        if (empty($surveyTranslation)) {
            return $this->sendError('Survey Translation not found');
        }

        return $this->sendResponse($surveyTranslation->toArray(), 'Survey Translation retrieved successfully');
    }

    /**
     * Update the specified SurveyTranslation in storage.
     * PUT/PATCH /surveyTranslations/{id}
     *
     * @param int $id
     * @param UpdateSurveyTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSurveyTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var SurveyTranslation $surveyTranslation */
        $surveyTranslation = $this->surveyTranslationRepository->find($id);

        if (empty($surveyTranslation)) {
            return $this->sendError('Survey Translation not found');
        }

        $surveyTranslation = $this->surveyTranslationRepository->update($input, $id);

        return $this->sendResponse($surveyTranslation->toArray(), 'SurveyTranslation updated successfully');
    }

    /**
     * Remove the specified SurveyTranslation from storage.
     * DELETE /surveyTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SurveyTranslation $surveyTranslation */
        $surveyTranslation = $this->surveyTranslationRepository->find($id);

        if (empty($surveyTranslation)) {
            return $this->sendError('Survey Translation not found');
        }

        $surveyTranslation->delete();

        return $this->sendSuccess('Survey Translation deleted successfully');
    }
}
