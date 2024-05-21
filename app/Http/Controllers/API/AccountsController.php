<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts;

use App\Http\Requests\Accounts\ShowAllAccountsRequest;
use App\Http\Requests\Accounts\ShowAccountRequest;
use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Http\Requests\Accounts\UpdateAccountRequest;
use App\Http\Requests\Accounts\DeleteAccountRequest;



/**
 * @group Accounts Management
 *
 * APIs for managing Accounts
 */
class AccountsController extends Controller
{
    /**
     * Show All Accounts
     * 
     * This endpoint allows you to show all accounts
     *
     * @authenticated
     * @param ShowAllAccountsRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllAccountsRequest $request) {
        $accounts = Accounts::all();
        return response()->success($accounts);
    }

    /**
     * Show One Account via ID
     * 
     * This endpoint allows you to show a specific account by id
     *
     * @authenticated
     * @param ShowAccountRequest $request
     * @param integer $accountid
     * @return JsonResponse
     */

    public function show(ShowAccountRequest $request, int $accountid) {
        $accounts = new Accounts;
        $accounts = Accounts::where('id', $accountid)->first();
        return response()->success($accounts);
    }

    /**
     * Store an Account
     * 
     * This endpoint allows you to store an account
     *
     * @authenticated
     * @param StoreAccountRequest $request
     * @return JsonResponse
     */
    public function store(StoreAccountRequest $request) {
        $accounts = new Accounts;
        $accounts->consumer_id = $request->consumerid;
        $accounts->meter_id = $request->meterid;
        $accounts->discount_id = $request->discountid;
        $accounts->rate_id = $request->rateid;
        $accounts->save();
        return response()->success($accounts);

    }

    /**
     * Update an Account
     * 
     * This endpoint allows you to update an account
     *
     * @authenticated
     * @param UpdateAccountRequest $request
     * @param integer $accountid
     * @return JsonResponse
     */
    public function update(UpdateAccountRequest $request, int $accountid) {
        $accounts = new Accounts;
        $accounts = Accounts::where('id', $accountid)->first();

        $accounts->consumer_id = $request->consumerid;
        $accounts->meter_id = $request->meterid;
        $accounts->discount_id = $request->discountid;
        $accounts->rate_id = $request->rateid;
        $accounts->save();
        return response()->success($accounts);
    }

    /**
     * Delete an Account
     * 
     * This endpoint allows you to delete an account
     *
     * @authenticated
     * @param DeleteAccountRequest $request
     * @param integer $accountid
     * @return JsonResponse
     */
    public function destroy(DeleteAccountRequest $request, int $accountid) {
        $accounts = new Accounts;
        $accounts = Accounts::find($accountid);
        $accounts->delete();
        return response()->success('Account Deleted');
    }

}
