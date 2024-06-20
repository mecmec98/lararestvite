<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bills;

use App\Http\Requests\Bills\ShowAllBillsRequest;
use App\Http\Requests\Bills\ShowBillsbyAccountRequest;
use App\Http\Requests\Bills\ShowBillRequest;
use App\Http\Requests\Bills\StoreBillRequest;
use App\Http\Requests\Bills\UpdateBillRequest;
use App\Http\Requests\Bills\DeleteBillRequest;


/**
 * @group Bills Management
 *
 * APIs for managing Bills
 */
class BillsController extends Controller
{
    /**
     * Show All Bills
     * 
     * This endpoint allows you to show all bills
     *
     * @authenticated
     * @param ShowAllBillsRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllBillsRequest $request) {
        $bills = Bills::all();
        return response()->success($bills);
    }

    /**
     * Show One Bill via ID
     * 
     * This endpoint allows you to show a specific bill by bills id
     *
     * @authenticated
     * @param ShowBillRequest $request
     * @param integer $billid
     * @return JsonResponse
     */
    public function show(ShowBillRequest $request, int $billid) {
        $bills = new Bills;
        $bills = Bills::where('id', $billid)->first();
        return response()->success($bills);
    }

    /**
     * Show All Bills via Accounts ID
     * 
     * This endpoint allows you to show a specific bills by bills id
     *
     * @authenticated
     * @param ShowBillsbyAccountRequest $request
     * @param integer $accountid
     * @return JsonResponse
     */

     public function showviaAcc(ShowBillsbyAccountRequest $request, int $accountid) {
        $bills = new Bills;
        $bills = Bills::where('account_id', $accountid)->get();
        return response()->success($bills);
    }

    /**
     * Store a Bill
     * 
     * This endpoint allows you to store a bill
     *
     * @authenticated
     * @param StoreBillRequest $request
     * @return JsonResponse
     */
    public function store(StoreBillRequest $request) {
        $bills = new Bills;
        $bills->account_id = $request->accountid;
        $bills->current_reading = $request->currentreading;
        $bills->past_reading = $request->pastreading;
        $bills->save();
        return response()->success($bills);
    }

    /**
     * Update a Bill
     * 
     * This endpoint allows you to update a bill
     *
     * @authenticated
     * @param UpdateBillRequest $request
     * @param integer $billid
     * @return JsonResponse
     */
    public function update(UpdateBillRequest $request, int $billid) {
        $bills = new Bills;
        $bills = Bills::where('id', $billid)->first();
        
        $bills->account_id = $request->accountid;
        $bills->current_reading = $request->currentreading;
        $bills->past_reading = $request->pastreading;
        $bills->save();
        return response()->success($bills);
    }

    /**
     * Delete a Bill
     * 
     * This endpoint allows you to delete a bill
     *
     * @authenticated
     * @param DeleteBillRequest $request
     * @param integer $billid
     * @return JsonResponse
     */
    public function destroy(DeleteBillRequest $request, int $billid) {
        $bills = new Bills;
        $bills = Bills::find($billid);
        $bills->delete();
        return response()->success('Bill Deleted');
    }

}
