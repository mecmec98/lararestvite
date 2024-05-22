<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discounts;

use App\Http\Requests\Discounts\ShowAllDiscountsRequest;
use App\Http\Requests\Discounts\ShowDiscountRequest;
use App\Http\Requests\Discounts\StoreDiscountRequest;
use App\Http\Requests\Discounts\DeleteDiscountRequest;
use App\Http\Requests\Discounts\UpdateDiscountRequest;


/**
 * @group Discounts Management
 *
 * APIs for managing Discounts
 */
class DiscountsController extends Controller
{
   /**
     * Show All Discounts
     * 
     * This endpoint allows you to show all discounts
     *
     * @authenticated
     * @param ShowAllDiscountsRequest $request
     * @return JsonResponse
     */ 
    public function index(ShowAllDiscountsRequest $request) {
        $discounts = Discounts::all();
        return response()->success($discounts);
    }

    /**
     * Show One Discount via ID
     * 
     * This endpoint allows you to show a specific account by Discount id
     *
     * @authenticated
     * @param ShowDiscountRequest $request
     * @param integer $discountid
     * @return JsonResponse
     */
    public function show(ShowDiscountRequest $request, int $discountid) {
        $discounts = new Discounts;
        $discounts = Discounts::where('id', $discountid)->first();
        return response()->success($discounts);
    }

    /**
     * Store a Discount
     * 
     * This endpoint allows you to store a discount
     *
     * @authenticated
     * @param StoreDiscountRequest $request
     * @return JsonResponse
     */
    public function store(StoreDiscountRequest $request) {
        $discounts = new Discounts;
        $discounts->discount_name = $request->discountname;
        $discounts->discount_value = $request->discountvalue;
        $discounts->save();
        return response()->success($discounts);
    }

    /**
     * Update a Discount
     * 
     * This endpoint allows you to update a discount
     *
     * @authenticated
     * @param UpdateDiscountRequest $request
     * @param integer $billid
     * @return JsonResponse
     */
    public function update(UpdateDiscountRequest $request, int $discountid) {
        $discounts = new Discounts;
        $discounts = Discounts::where('id', $discountid)->first();

        $discounts->discount_name = $request->discountname;
        $discounts->discount_value = $request->discountvalue;
        $discounts->save();
        return response()->success($discounts);
    }

    /**
     * Delete a Discount
     * 
     * This endpoint allows you to delete a discount
     *
     * @authenticated
     * @param DeleteDiscountRequest $request
     * @param integer $discountid
     * @return JsonResponse
     */
    public function destroy(DeleteDiscountRequest $request, int $discountid) {
        $discounts = new Discounts;
        $discounts = Discounts::find($discountid);
        $discounts->delete();
        return response()->success('Discount Deleted');
    }
}
