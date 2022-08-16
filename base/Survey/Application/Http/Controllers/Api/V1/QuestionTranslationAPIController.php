<?php

namespace Base\Survey\Application\Http\Controllers\Api\V1;

use Base\Survey\Application\Http\Requests\Api\V1\CreateQuestionTranslationAPIRequest;
use Base\Survey\Application\Http\Requests\Api\V1\UpdateQuestionTranslationAPIRequest;
use Base\Survey\Domain\Models\QuestionTranslation;
use Base\Survey\Domain\Repositories\QuestionTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuestionTranslationController
 * @package Base\Survey\Application\Http\Controllers\Api\V1
 */

class QuestionTranslationAPIController extends AppBaseController
{
    /** @var  QuestionTranslationRepository */
    private $questionTranslationRepository;

    public function __construct(QuestionTranslationRepository $questionTranslationRepo)
    {
        $this->questionTranslationRepository = $questionTranslationRepo;
    }

    /**
     * Display a listing of the QuestionTranslation.
     * GET|HEAD /questionTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questionTranslations = $this->questionTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($questionTranslations->toArray(), 'Question Translations retrieved successfully');
    }

    /**
     * Store a newly created QuestionTranslation in storage.
     * POST /questionTranslations
     *
     * @param CreateQuestionTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionTranslationAPIRequest $request)
    {
        $input = $request->all();

        $questionTranslation = $this->questionTranslationRepository->create($input);

        return $this->sendResponse($questionTranslation->toArray(), 'Question Translation saved successfully');
    }

    /**
     * Display the specified QuestionTranslation.
     * GET|HEAD /questionTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var QuestionTranslation $questionTranslation */
        $questionTranslation = $this->questionTranslationRepository->find($id);

        if (empty($questionTranslation)) {
            return $this->sendError('Question Translation not found');
        }

        return $this->sendResponse($questionTranslation->toArray(), 'Question Translation retrieved successfully');
    }

    /**
     * Update the specified QuestionTranslation in storage.
     * PUT/PATCH /questionTranslations/{id}
     *
     * @param int $id
     * @param UpdateQuestionTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionTranslation $questionTranslation */
        $questionTranslation = $this->questionTranslationRepository->find($id);

        if (empty($questionTranslation)) {
            return $this->sendError('Question Translation not found');
        }

        $questionTranslation = $this->questionTranslationRepository->update($input, $id);

        return $this->sendResponse($questionTranslation->toArray(), 'QuestionTranslation updated successfully');
    }

    /**
     * Remove the specified QuestionTranslation from storage.
     * DELETE /questionTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionTranslation $questionTranslation */
        $questionTranslation = $this->questionTranslationRepository->find($id);

        if (empty($questionTranslation)) {
            return $this->sendError('Question Translation not found');
        }

        $questionTranslation->delete();

        return $this->sendSuccess('Question Translation deleted successfully');
    }
}
