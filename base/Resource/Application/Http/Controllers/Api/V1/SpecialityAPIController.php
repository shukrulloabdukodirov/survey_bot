<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Collections\Api\V1\SpecialityResource;
use Base\Resource\Application\Http\Requests\Api\V1\CreateSpecialtyAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateSpecialtyAPIRequest;
use Base\Resource\Domain\Models\Speciality;
use Base\Resource\Domain\Repositories\SpecialityRepository;
use Base\Resource\Domain\Services\SpecialityStoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialtyController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class SpecialityAPIController extends AppBaseController
{
    /** @var  SpecialityRepository */
    private $specialityRepository;
    private $specialityService;
    public function __construct(SpecialityRepository $specialityRepository, SpecialityStoreService $specialityService)
    {
        $this->middleware(['role:big_bro|admin|region_admin|education_center']);
        $this->specialityRepository = $specialityRepository;
        $this->specialityService = $specialityService;
    }

    /**
     * Display a listing of the Specialty.
     * GET|HEAD /specialties
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $specialties = $this->specialityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialties->toArray(), 'Specialties retrieved successfully');
    }

    /**
     * Store a newly created Specialty in storage.
     * POST /specialties
     *
     * @param CreateSpecialtyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecialtyAPIRequest $request)
    {
        $input = $request->all();

        $speciality = $this->specialityService->storeSpeciality($input);

        return $this->sendResponse(new SpecialityResource($speciality), 'Specialty saved successfully');
    }

    /**
     * Display the specified Specialty.
     * GET|HEAD /specialties/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Speciality $speciality */
        $speciality = $this->specialityRepository->find($id);

        if (empty($speciality)) {
            return $this->sendError('Specialty not found');
        }

        return $this->sendResponse(new SpecialityResource($speciality), 'Specialty retrieved successfully');
    }

    /**
     * Update the specified Specialty in storage.
     * PUT/PATCH /specialties/{id}
     *
     * @param int $id
     * @param UpdateSpecialtyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecialtyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Speciality $speciality */
        $speciality = $this->specialityRepository->find($id);

        if (empty($speciality)) {
            return $this->sendError('Specialty not found');
        }

        $speciality = $this->specialityService->updateSpeciality($input, $id);

        return $this->sendResponse(new SpecialityResource($speciality), 'Specialty updated successfully');
    }

    /**
     * Remove the specified Specialty from storage.
     * DELETE /specialties/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Request $request, $speciality)
    {
        /** @var Speciality $speciality */
        $speciality = $this->specialityService->deleteSpeciality($request,$speciality);

        if (empty($speciality)) {
            return $this->sendError('Specialty not found');
        }

        return $this->sendSuccess('Specialty deleted successfully');
    }
}
