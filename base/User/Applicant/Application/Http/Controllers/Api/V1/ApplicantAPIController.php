<?php

namespace Base\User\Applicant\Application\Http\Controllers\Api\V1;

use Base\User\Applicant\Application\Http\Requests\Api\V1\CreateApplicantAPIRequest;
use Base\User\Applicant\Application\Http\Requests\Api\V1\UpdateApplicantAPIRequest;
use Base\User\Applicant\Domain\Models\Applicant;
use Base\User\Applicant\Domain\Repositories\ApplicantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicantController
 * @package Base\User\Applicant\Application\Http\Controllers\Api\V1
 */

class ApplicantAPIController extends AppBaseController
{
    /** @var  ApplicantRepository */
    private $applicantRepository;

    public function __construct(ApplicantRepository $applicantRepo)
    {
        $this->applicantRepository = $applicantRepo;
    }

    /**
     * Display a listing of the Applicant.
     * GET|HEAD /applicants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applicants = $this->applicantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicants->toArray(), 'Applicants retrieved successfully');
    }

    /**
     * Store a newly created Applicant in storage.
     * POST /applicants
     *
     * @param CreateApplicantAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicantAPIRequest $request)
    {
        $input = $request->all();

        $applicant = $this->applicantRepository->create($input);

        return $this->sendResponse($applicant->toArray(), 'Applicant saved successfully');
    }

    /**
     * Display the specified Applicant.
     * GET|HEAD /applicants/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        return $this->sendResponse($applicant->toArray(), 'Applicant retrieved successfully');
    }

    /**
     * Update the specified Applicant in storage.
     * PUT/PATCH /applicants/{id}
     *
     * @param int $id
     * @param UpdateApplicantAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        $applicant = $this->applicantRepository->update($input, $id);

        return $this->sendResponse($applicant->toArray(), 'Applicant updated successfully');
    }

    /**
     * Remove the specified Applicant from storage.
     * DELETE /applicants/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        $applicant->delete();

        return $this->sendSuccess('Applicant deleted successfully');
    }
}
