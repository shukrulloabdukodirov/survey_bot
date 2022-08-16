<?php

namespace Base\Survey\Application\Http\Controllers\Api\V1;

use Base\Survey\Application\Http\Requests\Api\V1\CreateQuestionAnswerTranslationAPIRequest;
use Base\Survey\Application\Http\Requests\Api\V1\UpdateQuestionAnswerTranslationAPIRequest;
use Base\Survey\Domain\Models\QuestionAnswerTranslation;
use Base\Survey\Domain\Repositories\QuestionAnswerTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuestionAnswerTranslationController
 * @package Base\Survey\Application\Http\Controllers\Api\V1
 */

class QuestionAnswerTranslationAPIController extends AppBaseController
{
    /** @var  QuestionAnswerTranslationRepository */
    private $questionAnswerTranslationRepository;

    public function __construct(QuestionAnswerTranslationRepository $questionAnswerTranslationRepo)
    {
        $this->questionAnswerTranslationRepository = $questionAnswerTranslationRepo;
    }

    /**
     * Display a listing of the QuestionAnswerTranslation.
     * GET|HEAD /questionAnswerTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questionAnswerTranslations = $this->questionAnswerTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($questionAnswerTranslations->toArray(), 'Question Answer Translations retrieved successfully');
    }

    /**
     * Store a newly created QuestionAnswerTranslation in storage.
     * POST /questionAnswerTranslations
     *
     * @param CreateQuestionAnswerTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAnswerTranslationAPIRequest $request)
    {
        $input = $request->all();

        $questionAnswerTranslation = $this->questionAnswerTranslationRepository->create($input);

        return $this->sendResponse($questionAnswerTranslation->toArray(), 'Question Answer Translation saved successfully');
    }

    /**
     * Display the specified QuestionAnswerTranslation.
     * GET|HEAD /questionAnswerTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var QuestionAnswerTranslation $questionAnswerTranslation */
        $questionAnswerTranslation = $this->questionAnswerTranslationRepository->find($id);

        if (empty($questionAnswerTranslation)) {
            return $this->sendError('Question Answer Translation not found');
        }

        return $this->sendResponse($questionAnswerTranslation->toArray(), 'Question Answer Translation retrieved successfully');
    }

    /**
     * Update the specified QuestionAnswerTranslation in storage.
     * PUT/PATCH /questionAnswerTranslations/{id}
     *
     * @param int $id
     * @param UpdateQuestionAnswerTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAnswerTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionAnswerTranslation $questionAnswerTranslation */
        $questionAnswerTranslation = $this->questionAnswerTranslationRepository->find($id);

        if (empty($questionAnswerTranslation)) {
            return $this->sendError('Question Answer Translation not found');
        }

        $questionAnswerTranslation = $this->questionAnswerTranslationRepository->update($input, $id);

        return $this->sendResponse($questionAnswerTranslation->toArray(), 'QuestionAnswerTranslation updated successfully');
    }

    /**
     * Remove the specified QuestionAnswerTranslation from storage.
     * DELETE /questionAnswerTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionAnswerTranslation $questionAnswerTranslation */
        $questionAnswerTranslation = $this->questionAnswerTranslationRepository->find($id);

        if (empty($questionAnswerTranslation)) {
            return $this->sendError('Question Answer Translation not found');
        }

        $questionAnswerTranslation->delete();

        return $this->sendSuccess('Question Answer Translation deleted successfully');
    }
}
