<?php
namespace Base\User\Auth\Admin\Application\Http\Controllers\Api\V1;

use App\Http\Controllers\AppBaseController;
use Base\User\Auth\Admin\Application\Http\Collections\Api\V1\RolesCollection;
use Base\User\Auth\Admin\Domain\Repositories\PermissionRepository;
use Base\User\Auth\Admin\Domain\Repositories\RolesRepository;
use Base\User\Auth\Admin\Domain\Repositories\UserRepository;
use Illuminate\Http\Request;

class AccessAPIController extends AppBaseController
{
    protected $roleRepository;
    protected $permissionRepository;
    public function __construct(RolesRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->middleware(['role:big_bro|admin']);
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function index(){

    }
    public function show(){

    }
    public function store(){

    }
    public function update(){

    }
    public function delete(){

    }
    public function roles(Request $request){
        $roles = $this->roleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->whereNotIn('name',['admin','big_bro']);
        return $this->sendResponse(new RolesCollection($roles), 'Roles retrieved successfully');
    }

}
