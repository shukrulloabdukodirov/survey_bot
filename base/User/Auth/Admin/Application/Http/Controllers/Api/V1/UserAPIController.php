<?php

namespace Base\User\Auth\Admin\Application\Http\Controllers\Api\V1;

use Base\User\User\Domain\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Base\User\Auth\Admin\Application\Http\Collections\Api\V1\UserCollection;
use Base\User\Auth\Admin\Application\Http\Collections\Api\V1\UserResource;
use Base\User\Auth\Admin\Application\Http\Request\Api\V1\CreateUserAPIRequest;
use Base\User\Auth\Admin\Application\Http\Request\Api\V1\UpdateUserAPIRequest;
use Base\User\Auth\Admin\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Response;

/**
 * Class ApplicantController
 * @package Base\User\User\Application\Http\Controllers\Api\V1
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /applicants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new UserCollection($users), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /applicants
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $input['password']=Hash::make($input['password']);



        $user = $this->userRepository->create($input);

        $user->assignRole($request['roles']);

        return $this->sendResponse(new UserResource($user), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse(new UserResource($user), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /applicants/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        $input['password']=Hash::make($input['password']);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse(new UserResource($user), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /user/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }
}
