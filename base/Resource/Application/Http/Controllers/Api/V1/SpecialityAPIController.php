<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateSpecialtyAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateSpecialtyAPIRequest;
use Base\Resource\Domain\Models\Speciality;
use Base\Resource\Domain\Repositories\SpecialityRepository;
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
    private $specialtyRepository;

    public function __construct(SpecialityRepository $specialtyRepo)
    {
        $this->specialtyRepository = $specialtyRepo;
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
        $specialties = $this->specialtyRepository->all(
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

        $specialty = $this->specialtyRepository->create($input);

        return $this->sendResponse($specialty->toArray(), 'Specialty saved successfully');
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
        /** @var Speciality $specialty */
        $specialty = $this->specialtyRepository->find($id);

        if (empty($specialty)) {
            return $this->sendError('Specialty not found');
        }

        return $this->sendResponse($specialty->toArray(), 'Specialty retrieved successfully');
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

        /** @var Speciality $specialty */
        $specialty = $this->specialtyRepository->find($id);

        if (empty($specialty)) {
            return $this->sendError('Specialty not found');
        }

        $specialty = $this->specialtyRepository->update($input, $id);

        return $this->sendResponse($specialty->toArray(), 'Specialty updated successfully');
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
    public function destroy($id)
    {
        /** @var Speciality $specialty */
        $specialty = $this->specialtyRepository->find($id);

        if (empty($specialty)) {
            return $this->sendError('Specialty not found');
        }

        $specialty->delete();

        return $this->sendSuccess('Specialty deleted successfully');
    }
}
