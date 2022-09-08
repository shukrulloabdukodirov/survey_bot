<?php

namespace Base\Survey\Application\Http\Controllers\Api\V1;

use Base\Survey\Application\Http\Collections\Api\V1\QuestionAnswerCollection;
use Base\Survey\Application\Http\Collections\Api\V1\QuestionCollection;
use Base\Survey\Application\Http\Requests\Api\V1\CreateQuestionAnswerAPIRequest;
use Base\Survey\Application\Http\Requests\Api\V1\UpdateQuestionAnswerAPIRequest;
use Base\Survey\Domain\Models\QuestionAnswer;
use Base\Survey\Domain\Repositories\QuestionAnswerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuestionAnswerController
 * @package Base\Survey\Application\Http\Controllers\Api\V1
 */

class QuestionAnswerAPIController extends AppBaseController
{
    /** @var  QuestionAnswerRepository */
    private $questionAnswerRepository;

    public function __construct(QuestionAnswerRepository $questionAnswerRepo)
    {
        $this->questionAnswerRepository = $questionAnswerRepo;
    }

    /**
     * Display a listing of the QuestionAnswer.
     * GET|HEAD /questionAnswers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questionAnswers = $this->questionAnswerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new QuestionAnswerCollection($questionAnswers), 'Question Answers retrieved successfully');
    }

    /**
     * Store a newly created QuestionAnswer in storage.
     * POST /questionAnswers
     *
     * @param CreateQuestionAnswerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAnswerAPIRequest $request)
    {
        $input = $request->all();

        $questionAnswer = $this->questionAnswerRepository->create($input);

        return $this->sendResponse($questionAnswer->toArray(), 'Question Answer saved successfully');
    }

    /**
     * Display the specified QuestionAnswer.
     * GET|HEAD /questionAnswers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        return $this->sendResponse($questionAnswer->toArray(), 'Question Answer retrieved successfully');
    }

    /**
     * Update the specified QuestionAnswer in storage.
     * PUT/PATCH /questionAnswers/{id}
     *
     * @param int $id
     * @param UpdateQuestionAnswerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAnswerAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        $questionAnswer = $this->questionAnswerRepository->update($input, $id);

        return $this->sendResponse($questionAnswer->toArray(), 'QuestionAnswer updated successfully');
    }

    /**
     * Remove the specified QuestionAnswer from storage.
     * DELETE /questionAnswers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        $questionAnswer->delete();

        return $this->sendSuccess('Question Answer deleted successfully');
    }
}
