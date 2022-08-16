<?php

namespace Base\Application\Application\Http\Controllers\Api\V1;

use Base\Application\Application\Http\Requests\Api\V1\CreateApplicationAnswerAPIRequest;
use Base\Application\Application\Http\Requests\Api\V1\UpdateApplicationAnswerAPIRequest;
use Base\Application\Domain\Models\ApplicationAnswer;
use Base\Application\Domain\Repositories\ApplicationAnswerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicationAnswerController
 * @package Base\Application\Application\Http\Controllers\Api\V1
 */

class ApplicationAnswerAPIController extends AppBaseController
{
    /** @var  ApplicationAnswerRepository */
    private $applicationAnswerRepository;

    public function __construct(ApplicationAnswerRepository $applicationAnswerRepo)
    {
        $this->applicationAnswerRepository = $applicationAnswerRepo;
    }

    /**
     * Display a listing of the ApplicationAnswer.
     * GET|HEAD /applicationAnswers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applicationAnswers = $this->applicationAnswerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicationAnswers->toArray(), 'Application Answers retrieved successfully');
    }

    /**
     * Store a newly created ApplicationAnswer in storage.
     * POST /applicationAnswers
     *
     * @param CreateApplicationAnswerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationAnswerAPIRequest $request)
    {
        $input = $request->all();

        $applicationAnswer = $this->applicationAnswerRepository->create($input);

        return $this->sendResponse($applicationAnswer->toArray(), 'Application Answer saved successfully');
    }

    /**
     * Display the specified ApplicationAnswer.
     * GET|HEAD /applicationAnswers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ApplicationAnswer $applicationAnswer */
        $applicationAnswer = $this->applicationAnswerRepository->find($id);

        if (empty($applicationAnswer)) {
            return $this->sendError('Application Answer not found');
        }

        return $this->sendResponse($applicationAnswer->toArray(), 'Application Answer retrieved successfully');
    }

    /**
     * Update the specified ApplicationAnswer in storage.
     * PUT/PATCH /applicationAnswers/{id}
     *
     * @param int $id
     * @param UpdateApplicationAnswerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationAnswerAPIRequest $request)
    {
        $input = $request->all();

        /** @var ApplicationAnswer $applicationAnswer */
        $applicationAnswer = $this->applicationAnswerRepository->find($id);

        if (empty($applicationAnswer)) {
            return $this->sendError('Application Answer not found');
        }

        $applicationAnswer = $this->applicationAnswerRepository->update($input, $id);

        return $this->sendResponse($applicationAnswer->toArray(), 'ApplicationAnswer updated successfully');
    }

    /**
     * Remove the specified ApplicationAnswer from storage.
     * DELETE /applicationAnswers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ApplicationAnswer $applicationAnswer */
        $applicationAnswer = $this->applicationAnswerRepository->find($id);

        if (empty($applicationAnswer)) {
            return $this->sendError('Application Answer not found');
        }

        $applicationAnswer->delete();

        return $this->sendSuccess('Application Answer deleted successfully');
    }
}
