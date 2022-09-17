<?php

namespace Base\Application\Application\Http\Controllers\Api\V1;

use Base\Application\Application\Http\Collections\Api\V1\ApplicationCollection;
use Base\Application\Application\Http\Collections\Api\V1\ApplicationResource;
use Base\Application\Application\Http\Requests\Api\V1\CreateApplicationAPIRequest;
use Base\Application\Application\Http\Requests\Api\V1\UpdateApplicationAPIRequest;
use Base\Application\Domain\Models\Application;
use Base\Application\Domain\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicationController
 * @package Base\Application\Application\Http\Controllers\Api\V1
 */

class ApplicationAPIController extends AppBaseController
{
    /** @var  ApplicationRepository */
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->middleware(['role:big_bro|admin|region_admin|education_center']);
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * Display a listing of the Application.
     * GET|HEAD /applications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applications = $this->applicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new ApplicationCollection($applications), 'Applications retrieved successfully');
    }

    /**
     * Store a newly created Application in storage.
     * POST /applications
     *
     * @param CreateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationAPIRequest $request)
    {
        $input = $request->all();

        $application = $this->applicationRepository->create($input);

        return $this->sendResponse($application->toArray(), 'Application saved successfully');
    }

    /**
     * Display the specified Application.
     * GET|HEAD /applications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        return $this->sendResponse(new ApplicationResource($application), 'Application retrieved successfully');
    }

    /**
     * Update the specified Application in storage.
     * PUT/PATCH /applications/{id}
     *
     * @param int $id
     * @param UpdateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application = $this->applicationRepository->update($input, $id);

        return $this->sendResponse(new ApplicationResource($application), 'Application updated successfully');
    }

    /**
     * Remove the specified Application from storage.
     * DELETE /applications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application->delete();

        return $this->sendSuccess('Application deleted successfully');
    }
}
