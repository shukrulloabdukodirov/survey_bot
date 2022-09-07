<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Collections\Api\V1\RegionCollection;
use Base\Resource\Application\Http\Collections\Api\V1\RegionResource;
use Base\Resource\Application\Http\Collections\Api\V1\RegionShowCollection;
use Base\Resource\Application\Http\Collections\Api\V1\RegionShowResource;
use Base\Resource\Application\Http\Requests\Api\V1\CreateRegionAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateRegionAPIRequest;
use Base\Resource\Domain\Models\Region;
use Base\Resource\Domain\Repositories\RegionRepository;
use Base\Resource\Domain\Services\RegionStoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RegionController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class RegionAPIController extends AppBaseController
{
    /** @var  RegionRepository */
    private $storeService;
    private $regionRepository;
    public function __construct(RegionStoreService $storeService,RegionRepository $regionRepository)
    {
        $this->storeService = $storeService;
        $this->regionRepository = $regionRepository;
    }

    /**
     * Display a listing of the Region.
     * GET|HEAD /regions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $regions = $this->regionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new RegionCollection($regions), 'Regions retrieved successfully');
    }

    /**
     * Store a newly created Region in storage.
     * POST /regions
     *
     * @param CreateRegionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRegionAPIRequest $request)
    {
        $input = $request->all();

        $region = $this->storeService->storeRegion($input);

        return $this->sendResponse(new RegionResource($region), 'Region saved successfully');
    }

    /**
     * Display the specified Region.
     * GET|HEAD /regions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        return $this->sendResponse(new RegionShowResource($region), 'Region retrieved successfully');
    }

    /**
     * Update the specified Region in storage.
     * PUT/PATCH /regions/{id}
     *
     * @param int $id
     * @param UpdateRegionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        $region = $this->storeService->updateRegion($input, $id);

        return $this->sendResponse(new RegionShowResource($region), 'Region updated successfully');
    }

    /**
     * Remove the specified Region from storage.
     * DELETE /regions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        $region->delete();

        return $this->sendSuccess('Region deleted successfully');
    }
}
