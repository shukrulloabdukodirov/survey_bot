<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateSpecialtyTranslationAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateSpecialtyTranslationAPIRequest;
use Base\Resource\Domain\Models\SpecialtyTranslation;
use Base\Resource\Domain\Repositories\SpecialtyTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialtyTranslationController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class SpecialtyTranslationAPIController extends AppBaseController
{
    /** @var  SpecialtyTranslationRepository */
    private $specialtyTranslationRepository;

    public function __construct(SpecialtyTranslationRepository $specialtyTranslationRepo)
    {
        $this->specialtyTranslationRepository = $specialtyTranslationRepo;
    }

    /**
     * Display a listing of the SpecialtyTranslation.
     * GET|HEAD /specialtyTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $specialtyTranslations = $this->specialtyTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialtyTranslations->toArray(), 'Specialty Translations retrieved successfully');
    }

    /**
     * Store a newly created SpecialtyTranslation in storage.
     * POST /specialtyTranslations
     *
     * @param CreateSpecialtyTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecialtyTranslationAPIRequest $request)
    {
        $input = $request->all();

        $specialtyTranslation = $this->specialtyTranslationRepository->create($input);

        return $this->sendResponse($specialtyTranslation->toArray(), 'Specialty Translation saved successfully');
    }

    /**
     * Display the specified SpecialtyTranslation.
     * GET|HEAD /specialtyTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SpecialtyTranslation $specialtyTranslation */
        $specialtyTranslation = $this->specialtyTranslationRepository->find($id);

        if (empty($specialtyTranslation)) {
            return $this->sendError('Specialty Translation not found');
        }

        return $this->sendResponse($specialtyTranslation->toArray(), 'Specialty Translation retrieved successfully');
    }

    /**
     * Update the specified SpecialtyTranslation in storage.
     * PUT/PATCH /specialtyTranslations/{id}
     *
     * @param int $id
     * @param UpdateSpecialtyTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecialtyTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialtyTranslation $specialtyTranslation */
        $specialtyTranslation = $this->specialtyTranslationRepository->find($id);

        if (empty($specialtyTranslation)) {
            return $this->sendError('Specialty Translation not found');
        }

        $specialtyTranslation = $this->specialtyTranslationRepository->update($input, $id);

        return $this->sendResponse($specialtyTranslation->toArray(), 'SpecialtyTranslation updated successfully');
    }

    /**
     * Remove the specified SpecialtyTranslation from storage.
     * DELETE /specialtyTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SpecialtyTranslation $specialtyTranslation */
        $specialtyTranslation = $this->specialtyTranslationRepository->find($id);

        if (empty($specialtyTranslation)) {
            return $this->sendError('Specialty Translation not found');
        }

        $specialtyTranslation->delete();

        return $this->sendSuccess('Specialty Translation deleted successfully');
    }
}
