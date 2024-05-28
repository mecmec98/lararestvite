<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiscFee;

use App\Http\Requests\MiscFee\ShowAllMiscFeesRequest;
use App\Http\Requests\MiscFee\ShowMiscFeeRequest;
use App\Http\Requests\MiscFee\StoreMiscFeeRequest;
use App\Http\Requests\MiscFee\UpdateMiscFeeRequest;
use App\Http\Requests\MiscFee\DeleteMiscFeeRequest;
use App\Http\Requests\MiscFee\ToggleMiscFeeRequest;
use App\Http\Requests\MiscFee\ShowActivatedMiscFeeRequest;


/**
 * @group Misc Fees Management
 *
 * APIs for managing Misc Fees
 */
class MiscFeeController extends Controller
{
    /**
     * Show All Misc Fees
     * 
     * This endpoint allows you to show all misc fees
     *
     * @authenticated
     * @param ShowAllMiscFeesRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllMiscFeesRequest $request) {
        $miscfees = MiscFee::all();
        return response()->success($miscfees);
    }

    /**
     * Show One Misc Fee via ID
     * 
     * This endpoint allows you to show a specific misc fee by miscfeeid
     *
     * @authenticated
     * @param ShowMiscFeeRequest $request
     * @param integer $miscfeeid
     * @return JsonResponse
     */
    public function show(ShowMiscFeeRequest $request, int $miscfeeid) {
        $miscfees = new MiscFee;
        $miscfees = MiscFee::where('id', $miscfeeid)->first();
        return response()->success($miscfees);
    }

    /**
     * Store a Misc Fee
     * 
     * This endpoint allows you to store a misc fee
     *
     * @authenticated
     * @param StoreMiscFeeRequest $request
     * @return JsonResponse
     */
    public function store(StoreMiscFeeRequest $request) {
        $miscfees = new MiscFee;
        $miscfees->misc_name = $request->miscname;
        $miscfees->fee_value = $request->miscvalue;
        $miscfees->description = $request->description;
        $miscfees->activate = false;
        $miscfees->save();
        return response()->success($miscfees);
    }

    /**
     * Update a Misc Fee
     * 
     * This endpoint allows you to update a misc fee
     *
     * @authenticated
     * @param UpdateMiscFeeRequest $request
     * @param integer $miscfeeid
     * @return JsonResponse
     */
    public function update(UpdateMiscFeeRequest $request, int $miscfeeid) {
        $miscfees = new MiscFee;
        $miscfees = MiscFee::where('id', $miscfeeid)->first();

        $miscfees->misc_name = $request->miscname;
        $miscfees->fee_value = $request->miscvalue;
        $miscfees->description = $request->description;
       
        $miscfees->save();
        return response()->success($miscfees);
    }

    /**
     * Show All activated Misc Fee
     * 
     * This endpoint allows you to show all activated misc fee
     *
     * @authenticated
     * @param ActivatedMiscFeeRequest $request
     * @return JsonResponse
     */
    public function showActivated(ShowActivatedMiscFeeRequest $request) {
        $miscfees = new MiscFee;
        $activation = true;
        $miscfees = MiscFee::where('activate', $activation)->get();
        
        return response()->success($miscfees);
    }

    /**
     * Toggle a Misc Fee acticvation
     * 
     * This endpoint allows you to activate or diactivate a misc fee
     *
     * @authenticated
     * @param ToggleMiscFeeRequest $request
     * @param integer $miscfeeid;
     * @return JsonResponse
     */
    public function activetoggle(ToggleMiscFeeRequest $request, int $miscfeeid) {
        $miscfees = new MiscFee;
        $miscfees = MiscFee::where('id',$miscfeeid)->first();

        $miscfees->activate = !$miscfees->activate;
        $miscfees->save();
        return response()->success($miscfees);
    }

    /**
     * Delete a Misc Fees
     * 
     * This endpoint allows you to delete a misc fee
     *
     * @authenticated
     * @param DeleteMiscFeeRequest $request
     * @param integer $miscfeeid
     * @return JsonResponse
     */
    public function destroy(DeleteMiscFeeRequest $request, int $miscfeedid) {
        $miscfees = new MiscFee;
        $miscfees = MiscFees::find($miscfeeid);
        $miscfees->delete();
        return response()->success('Misc Fee Deleted');
    }

}
