<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PermissionIndexRequest;

/**
 * @group Permission Management
 */
class PermissionController extends Controller
{
    /**
     * Get all Permissions
     * 
     * This endpoint returns all the permissions available in the system.
     *
     * @authenticated
     * @param PermissionIndexRequest $request
     * @return void
     */
    public function index(PermissionIndexRequest $request)
    {
        $permission = config('permissions');
        return response()->success($permission);
    }
}
