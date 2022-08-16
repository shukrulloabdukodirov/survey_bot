<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateEducationCenterAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateEducationCenterAPIRequest;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Repositories\EducationCenterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EducationCenterController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class EducationCenterAPIController extends AppBaseController
{
    /** @var  EducationCenterRepository */
    private $educationCenterRepository;

    public function __construct(EducationCenterRepository $educationCenterRepo)
    {
        $this->educationCenterRepository = $educationCenterRepo;
    }

    /**
     * Display a listing of the EducationCenter.
     * GET|HEAD /educationCenters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $educationCenters = $this->educationCenterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($educationCenters->toArray(), 'Education Centers retrieved successfully');
    }

    /**
     * Store a newly created EducationCenter in storage.
     * POST /educationCenters
     *
     * @param CreateEducationCenterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEducationCenterAPIRequest $request)
    {
        $input = $request->all();

        $educationCenter = $this->educationCenterRepository->create($input);

        return $this->sendResponse($educationCenter->toArray(), 'Education Center saved successfully');
    }

    /**
     * Display the specified EducationCenter.
     * GET|HEAD /educationCenters/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EducationCenter $educationCenter */
        $educationCenter = $this->educationCenterRepository->find($id);

        if (empty($educationCenter)) {
            return $this->sendError('Education Center not found');
        }

        return $this->sendResponse($educationCenter->toArray(), 'Education Center retrieved successfully');
    }

    /**
     * Update the specified EducationCenter in storage.
     * PUT/PATCH /educationCenters/{id}
     *
     * @param int $id
     * @param UpdateEducationCenterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEducationCenterAPIRequest $request)
    {
        $input = $request->all();

        /** @var EducationCenter $educationCenter */
        $educationCenter = $this->educationCenterRepository->find($id);

        if (empty($educationCenter)) {
            return $this->sendError('Education Center not found');
        }

        $educationCenter = $this->educationCenterRepository->update($input, $id);

        return $this->sendResponse($educationCenter->toArray(), 'EducationCenter updated successfully');
    }

    /**
     * Remove the specified EducationCenter from storage.
     * DELETE /educationCenters/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EducationCenter $educationCenter */
        $educationCenter = $this->educationCenterRepository->find($id);

        if (empty($educationCenter)) {
            return $this->sendError('Education Center not found');
        }

        $educationCenter->delete();

        return $this->sendSuccess('Education Center deleted successfully');
    }
}
