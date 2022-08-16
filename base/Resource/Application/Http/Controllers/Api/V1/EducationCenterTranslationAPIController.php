<?php

namespace Base\Resource\Application\Http\Controllers\Api\V1;

use Base\Resource\Application\Http\Requests\Api\V1\CreateEducationCenterTranslationAPIRequest;
use Base\Resource\Application\Http\Requests\Api\V1\UpdateEducationCenterTranslationAPIRequest;
use Base\Resource\Domain\Models\EducationCenterTranslation;
use Base\Resource\Domain\Repositories\EducationCenterTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EducationCenterTranslationController
 * @package Base\Resource\Application\Http\Controllers\Api\V1
 */

class EducationCenterTranslationAPIController extends AppBaseController
{
    /** @var  EducationCenterTranslationRepository */
    private $educationCenterTranslationRepository;

    public function __construct(EducationCenterTranslationRepository $educationCenterTranslationRepo)
    {
        $this->educationCenterTranslationRepository = $educationCenterTranslationRepo;
    }

    /**
     * Display a listing of the EducationCenterTranslation.
     * GET|HEAD /educationCenterTranslations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $educationCenterTranslations = $this->educationCenterTranslationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($educationCenterTranslations->toArray(), 'Education Center Translations retrieved successfully');
    }

    /**
     * Store a newly created EducationCenterTranslation in storage.
     * POST /educationCenterTranslations
     *
     * @param CreateEducationCenterTranslationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEducationCenterTranslationAPIRequest $request)
    {
        $input = $request->all();

        $educationCenterTranslation = $this->educationCenterTranslationRepository->create($input);

        return $this->sendResponse($educationCenterTranslation->toArray(), 'Education Center Translation saved successfully');
    }

    /**
     * Display the specified EducationCenterTranslation.
     * GET|HEAD /educationCenterTranslations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EducationCenterTranslation $educationCenterTranslation */
        $educationCenterTranslation = $this->educationCenterTranslationRepository->find($id);

        if (empty($educationCenterTranslation)) {
            return $this->sendError('Education Center Translation not found');
        }

        return $this->sendResponse($educationCenterTranslation->toArray(), 'Education Center Translation retrieved successfully');
    }

    /**
     * Update the specified EducationCenterTranslation in storage.
     * PUT/PATCH /educationCenterTranslations/{id}
     *
     * @param int $id
     * @param UpdateEducationCenterTranslationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEducationCenterTranslationAPIRequest $request)
    {
        $input = $request->all();

        /** @var EducationCenterTranslation $educationCenterTranslation */
        $educationCenterTranslation = $this->educationCenterTranslationRepository->find($id);

        if (empty($educationCenterTranslation)) {
            return $this->sendError('Education Center Translation not found');
        }

        $educationCenterTranslation = $this->educationCenterTranslationRepository->update($input, $id);

        return $this->sendResponse($educationCenterTranslation->toArray(), 'EducationCenterTranslation updated successfully');
    }

    /**
     * Remove the specified EducationCenterTranslation from storage.
     * DELETE /educationCenterTranslations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EducationCenterTranslation $educationCenterTranslation */
        $educationCenterTranslation = $this->educationCenterTranslationRepository->find($id);

        if (empty($educationCenterTranslation)) {
            return $this->sendError('Education Center Translation not found');
        }

        $educationCenterTranslation->delete();

        return $this->sendSuccess('Education Center Translation deleted successfully');
    }
}
