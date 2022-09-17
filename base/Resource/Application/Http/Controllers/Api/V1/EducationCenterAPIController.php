<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Collections\Api\V1\EducationCenterCollection;
use Base\Resource\Application\Http\Collections\Api\V1\EducationCenterResource;
use Base\Resource\Application\Http\Requests\Api\V1\CreateEducationCenterAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateEducationCenterAPIRequest;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Repositories\EducationCenterRepository;
use Base\Resource\Domain\Services\EducationCenterStoreService;
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
    private $educationCenterService;
    public function __construct(EducationCenterRepository $educationCenterRepo, EducationCenterStoreService $educationCenterService)
    {
        $this->middleware(['role:big_bro|admin|region_admin|education_center']);
        $this->educationCenterRepository = $educationCenterRepo;
        $this->educationCenterService = $educationCenterService;
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

        return $this->sendResponse(new EducationCenterCollection($educationCenters), 'Education Centers retrieved successfully');
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

        $educationCenter = $this->educationCenterService->storeEducationCenter($input);

        return $this->sendResponse(new EducationCenterResource($educationCenter), 'Education Center saved successfully');
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

        return $this->sendResponse(new EducationCenterResource($educationCenter), 'Education Center retrieved successfully');
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
        // $input['status']=$input['status']==='true';

        /** @var EducationCenter $educationCenter */
        $educationCenter = $this->educationCenterRepository->find($id);

        if (empty($educationCenter)) {
            return $this->sendError('Education Center not found');
        }

        $educationCenter = $this->educationCenterService->updateEducationCenter($input, $id);

        return $this->sendResponse(new EducationCenterResource($educationCenter), 'EducationCenter updated successfully');
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
