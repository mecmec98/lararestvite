<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DapitanAddress;

use App\Http\Requests\DapitanAddress\ShowAllDapitanAddressRequest;
use App\Http\Requests\DapitanAddress\ShowAllBarangayRequest;

/**
 * @group Dapitan Address Management
 *
 * APIs for managing Dapitan Addresses
 */
class DapitanAddressController extends Controller
{
    /**
     * Show All Dapitan Addresses
     * 
     * This endpoint allows you to show all dapitan addresses
     *
     * @authenticated
     * @param ShowAllDapitanAddressRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllDapitanAddressRequest $request) {
        $daddress = DapitanAddress::all();
        return response()->success($daddress);
    }


}
