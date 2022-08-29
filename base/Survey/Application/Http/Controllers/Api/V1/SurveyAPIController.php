<?php

namespace Base\Survey\Application\Http\Controllers\Api\V1;

use Base\Survey\Application\Http\Collections\Api\V1\SurveyCollection;
use Base\Survey\Application\Http\Collections\Api\V1\SurveyResource;
use Base\Survey\Application\Http\Requests\Api\V1\CreateSurveyAPIRequest;
use Base\Survey\Application\Http\Requests\Api\V1\UpdateSurveyAPIRequest;
use Base\Survey\Domain\Models\Survey;
use Base\Survey\Domain\Repositories\SurveyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SurveyController
 * @package Base\Survey\Application\Http\Controllers\Api\V1
 */

class SurveyAPIController extends AppBaseController
{
    /** @var  SurveyRepository */
    private $surveyRepository;

    public function __construct(SurveyRepository $surveyRepo)
    {
        $this->surveyRepository = $surveyRepo;
    }

    /**
     * Display a listing of the Survey.
     * GET|HEAD /surveys
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $surveys = $this->surveyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new SurveyCollection($surveys), 'Surveys retrieved successfully');
    }

    /**
     * Store a newly created Survey in storage.
     * POST /surveys
     *
     * @param CreateSurveyAPIRequest $request
     *
     * @return Response
     */
//    public function store(CreateSurveyAPIRequest $request)
//    {
//        $input = $request->all();
//
//        $survey = $this->surveyRepository->create($input);
//
//        return $this->sendResponse(new SurveyResource($survey), 'Survey saved successfully');
//    }

    /**
     * Display the specified Survey.
     * GET|HEAD /surveys/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Survey $survey */
        $survey = $this->surveyRepository->find($id);

        if (empty($survey)) {
            return $this->sendError('Survey not found');
        }

        return $this->sendResponse(new SurveyResource($survey), 'Survey retrieved successfully');
    }

    /**
     * Update the specified Survey in storage.
     * PUT/PATCH /surveys/{id}
     *
     * @param int $id
     * @param UpdateSurveyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSurveyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Survey $survey */
        $survey = $this->surveyRepository->find($id);

        if (empty($survey)) {
            return $this->sendError('Survey not found');
        }

        $survey = $this->surveyRepository->update($input, $id);

        return $this->sendResponse(new SurveyResource($survey), 'Survey updated successfully');
    }

    /**
     * Remove the specified Survey from storage.
     * DELETE /surveys/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Survey $survey */
        $survey = $this->surveyRepository->find($id);

        if (empty($survey)) {
            return $this->sendError('Survey not found');
        }

        $survey->delete();

        return $this->sendSuccess('Survey deleted successfully');
    }
}
