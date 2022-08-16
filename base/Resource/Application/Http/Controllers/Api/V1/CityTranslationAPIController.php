<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateCityTranslationAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateCityTranslationAPIRequest;
use Base\Resource\Domain\Models\CityTranslation;
use Base\Resource\Domain\Repositories\CityTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CityTranslationController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class CityTranslationAPIController extends AppBaseController
{
    /** @var  CityTranslationRepository */
    private $cityTranslationRepository;

    public function __construct(CityTranslationRepository $cityTranslationRepo)
    {
        $this->cityTranslationRepository = $cityTranslationRepo;
    }

    /**
     * Display a listing of the CityTranslation.
     * GET|HEAD /cityTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cityTranslations = $this->cityTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cityTranslations->toArray(), 'City Translations retrieved successfully');
    }

    /**
     * Store a newly created CityTranslation in storage.
     * POST /cityTranslations
     *
     * @param CreateCityTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCityTranslationAPIRequest $request)
    {
        $input = $request->all();

        $cityTranslation = $this->cityTranslationRepository->create($input);

        return $this->sendResponse($cityTranslation->toArray(), 'City Translation saved successfully');
    }

    /**
     * Display the specified CityTranslation.
     * GET|HEAD /cityTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CityTranslation $cityTranslation */
        $cityTranslation = $this->cityTranslationRepository->find($id);

        if (empty($cityTranslation)) {
            return $this->sendError('City Translation not found');
        }

        return $this->sendResponse($cityTranslation->toArray(), 'City Translation retrieved successfully');
    }

    /**
     * Update the specified CityTranslation in storage.
     * PUT/PATCH /cityTranslations/{id}
     *
     * @param int $id
     * @param UpdateCityTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var CityTranslation $cityTranslation */
        $cityTranslation = $this->cityTranslationRepository->find($id);

        if (empty($cityTranslation)) {
            return $this->sendError('City Translation not found');
        }

        $cityTranslation = $this->cityTranslationRepository->update($input, $id);

        return $this->sendResponse($cityTranslation->toArray(), 'CityTranslation updated successfully');
    }

    /**
     * Remove the specified CityTranslation from storage.
     * DELETE /cityTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CityTranslation $cityTranslation */
        $cityTranslation = $this->cityTranslationRepository->find($id);

        if (empty($cityTranslation)) {
            return $this->sendError('City Translation not found');
        }

        $cityTranslation->delete();

        return $this->sendSuccess('City Translation deleted successfully');
    }
}
