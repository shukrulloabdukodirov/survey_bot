<?php

namespace Base\User\Applicant\Application\Http\Controllers\Api\V1;

use Base\User\Applicant\Application\Http\Requests\Api\V1\CreateApplicantInfoAPIRequest;
use Base\User\Applicant\Application\Http\Requests\Api\V1\UpdateApplicantInfoAPIRequest;
use Base\User\Applicant\Domain\Models\ApplicantInfo;
use Base\User\Applicant\Domain\Repositories\ApplicantInfoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicantInfoController
 * @package Base\User\Applicant\Application\Http\Controllers\Api\V1
 */

class ApplicantInfoAPIController extends AppBaseController
{
    /** @var  ApplicantInfoRepository */
    private $applicantInfoRepository;

    public function __construct(ApplicantInfoRepository $applicantInfoRepo)
    {
        $this->applicantInfoRepository = $applicantInfoRepo;
    }

    /**
     * Display a listing of the ApplicantInfo.
     * GET|HEAD /applicantInfos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applicantInfos = $this->applicantInfoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicantInfos->toArray(), 'Applicant Infos retrieved successfully');
    }

    /**
     * Store a newly created ApplicantInfo in storage.
     * POST /applicantInfos
     *
     * @param CreateApplicantInfoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicantInfoAPIRequest $request)
    {
        $input = $request->all();

        $applicantInfo = $this->applicantInfoRepository->create($input);

        return $this->sendResponse($applicantInfo->toArray(), 'Applicant Info saved successfully');
    }

    /**
     * Display the specified ApplicantInfo.
     * GET|HEAD /applicantInfos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ApplicantInfo $applicantInfo */
        $applicantInfo = $this->applicantInfoRepository->find($id);

        if (empty($applicantInfo)) {
            return $this->sendError('Applicant Info not found');
        }

        return $this->sendResponse($applicantInfo->toArray(), 'Applicant Info retrieved successfully');
    }

    /**
     * Update the specified ApplicantInfo in storage.
     * PUT/PATCH /applicantInfos/{id}
     *
     * @param int $id
     * @param UpdateApplicantInfoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicantInfoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ApplicantInfo $applicantInfo */
        $applicantInfo = $this->applicantInfoRepository->find($id);

        if (empty($applicantInfo)) {
            return $this->sendError('Applicant Info not found');
        }

        $applicantInfo = $this->applicantInfoRepository->update($input, $id);

        return $this->sendResponse($applicantInfo->toArray(), 'ApplicantInfo updated successfully');
    }

    /**
     * Remove the specified ApplicantInfo from storage.
     * DELETE /applicantInfos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ApplicantInfo $applicantInfo */
        $applicantInfo = $this->applicantInfoRepository->find($id);

        if (empty($applicantInfo)) {
            return $this->sendError('Applicant Info not found');
        }

        $applicantInfo->delete();

        return $this->sendSuccess('Applicant Info deleted successfully');
    }
}
