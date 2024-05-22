<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rates;

use App\Http\Requests\Rates\ShowAllRatesRequest;
use App\Http\Requests\Rates\ShowRateRequest;
use App\Http\Requests\Rates\StoreRateRequest;
use App\Http\Requests\Rates\UpdateRateRequest;
use App\Http\Requests\Rates\DeleteRateRequest;

/**
 * @group Rates Management
 *
 * APIs for managing Rate
 */
class RatesController extends Controller
{
    /**
     * Show All Rates
     * 
     * This endpoint allows you to show all rate
     *
     * @authenticated
     * @param ShowAllRatesRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllRatesRequest $request) {
        $rates = Rates::all();
        return response()->success($rates);
    }

     /**
     * Show One Rate via ID
     * 
     * This endpoint allows you to show a specific rate b id
     *
     * @authenticated
     * @param ShowRateRequest $request
     * @param integer $rateid
     * @return JsonResponse
     */
    public function show(ShowRateRequest $request, int $rateid) {
        $rates = new Rates;
        $rates = Rates::where('id', $rateid)->first();
        return response()->success($rates);
    }

    /**
     * Store a Rate
     * 
     * This endpoint allows you to store a raate
     *
     * @authenticated
     * @param StoreRateRequest $request
     * @return JsonResponse
     */
    public function store(StoreRateRequest $request) {
        $rates = new Rates;
        $rates->rate_name = $request->ratename;
        $rates->rate_value = $request->ratevalue;
        $rates->rate_minimum = $request->rateminimum;
        $rates->save();
        return response()->success($rates);
    }

    /**
     * Update a Rate
     * 
     * This endpoint allows you to update a rate
     *
     * @authenticated
     * @param UpdateRateRequest $request
     * @param integer $rateid
     * @return JsonResponse
     */
    public function update(UpdateRateRequest $request, int $rateid) {
        $rates = new Rates;
        $rates = Rates::where('id', $rateid)->first();

        $rates->rate_name = $request->ratename;
        $rates->rate_value = $request->ratevalue;
        $rates->rate_minimum = $request->rateminimum;
        $rates->save();
        return response()->success($rates);
    }

     /**
     * Delete a Rate
     * 
     * This endpoint allows you to delete a rate
     *
     * @authenticated
     * @param DeleteRateRequest $request
     * @param integer $rateid
     * @return JsonResponse
     */
    public function destroy(DeleteRateRequest $request, int $rateid) {
        $rates = new Rates;
        $rates = Rates::find($rateid);
        $rates->delete();
        return response()->success('Rate Deleted');
    }

}
