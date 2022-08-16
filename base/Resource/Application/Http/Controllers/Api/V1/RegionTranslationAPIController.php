<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateRegionTranslationAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateRegionTranslationAPIRequest;
use Base\Resource\Domain\Models\RegionTranslation;
use Base\Resource\Domain\Repositories\RegionTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RegionTranslationController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class RegionTranslationAPIController extends AppBaseController
{
    /** @var  RegionTranslationRepository */
    private $regionTranslationRepository;

    public function __construct(RegionTranslationRepository $regionTranslationRepo)
    {
        $this->regionTranslationRepository = $regionTranslationRepo;
    }

    /**
     * Display a listing of the RegionTranslation.
     * GET|HEAD /regionTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $regionTranslations = $this->regionTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($regionTranslations->toArray(), 'Region Translations retrieved successfully');
    }

    /**
     * Store a newly created RegionTranslation in storage.
     * POST /regionTranslations
     *
     * @param CreateRegionTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRegionTranslationAPIRequest $request)
    {
        $input = $request->all();

        $regionTranslation = $this->regionTranslationRepository->create($input);

        return $this->sendResponse($regionTranslation->toArray(), 'Region Translation saved successfully');
    }

    /**
     * Display the specified RegionTranslation.
     * GET|HEAD /regionTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RegionTranslation $regionTranslation */
        $regionTranslation = $this->regionTranslationRepository->find($id);

        if (empty($regionTranslation)) {
            return $this->sendError('Region Translation not found');
        }

        return $this->sendResponse($regionTranslation->toArray(), 'Region Translation retrieved successfully');
    }

    /**
     * Update the specified RegionTranslation in storage.
     * PUT/PATCH /regionTranslations/{id}
     *
     * @param int $id
     * @param UpdateRegionTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegionTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var RegionTranslation $regionTranslation */
        $regionTranslation = $this->regionTranslationRepository->find($id);

        if (empty($regionTranslation)) {
            return $this->sendError('Region Translation not found');
        }

        $regionTranslation = $this->regionTranslationRepository->update($input, $id);

        return $this->sendResponse($regionTranslation->toArray(), 'RegionTranslation updated successfully');
    }

    /**
     * Remove the specified RegionTranslation from storage.
     * DELETE /regionTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RegionTranslation $regionTranslation */
        $regionTranslation = $this->regionTranslationRepository->find($id);

        if (empty($regionTranslation)) {
            return $this->sendError('Region Translation not found');
        }

        $regionTranslation->delete();

        return $this->sendSuccess('Region Translation deleted successfully');
    }
}
