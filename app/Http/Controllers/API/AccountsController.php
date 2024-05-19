<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts;

use App\Http\Request\Accounts\ShowAllAccountsRequest;
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
     * @return void
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
     * @return void
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
     * @return void
     */
    public function store(StoreAccountRequest $request) {
        $accounts = new Accounts;
        $accounts->consumer_id = $request->consumerid;
        $accounts->meter_id = $request->meterid;
        $accounts->balance = $request->balance;
        $accounts->save();
        return response()->success($accounts);

    }


}
