<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsumerProfile;

use App\Http\Requests\ConsumerProfile\ShowAllConsumersRequest;
use App\Http\Requests\ConsumerProfile\ShowConsumerRequest;
use App\Http\Requests\ConsumerProfile\StoreConsumerRequest;
use App\Http\Requests\ConsumerProfile\UpdateConsumerRequest;
use App\Http\Requests\ConsumerProfile\DeleteConsumerRequest;


/**
 * @group Consumer Management
 *
 * APIs for managing Consumer Profile
 */
class ConsumerProfileController extends Controller
{
     /**
     * Show All Consumers
     * 
     * This endpoint allows you to show all consumers
     *
     * @authenticated
     * @param ShowAllConsumersRequest $request
     * @return JsonResponse
     */
    public function index(ShowAllConsumersRequest $request) {
        $consumers = ConsumerProfile::all();
        return response()->success($consumers);
    }

      /**
     * Show One Consumer via ID
     * 
     * This endpoint allows you to show a specific consumer by id
     *
     * @authenticated
     * @param ShowConsumerRequest $request
     * @param integer $consumerid
     * @return JsonResponse
     */
    public function show(ShowConsumerRequest $request, int $consumerid) {
        $consumers = new ConsumerProfile;
        $consumers = ConsumerProfile::where('id', $consumerid)->first();
        return response()->success($consumers);
    }

    /**
     * Store a Consumer
     * 
     * This endpoint allows you to store a consumer
     *
     * @authenticated
     * @param StoreConsumerRequest $request
     * @return JsonResponse
     */
    public function store(StoreConsumerRequest $request) {
        $consumers = new ConsumerProfile;
        $consumers->firstname = $request->firstname;
        $consumers->middlename = $request->middlename;
        $consumers->lastname = $request->lastname;
        $consumers->gender = $request->gender;
        //address
        $consumers->street= $request->street;
        $consumers->building = $request->building;
        $consumers->barangay = $request->barangay;
        $consumers->city = $request->city;
        $consumers->region = $request->region;
        $consumers->zipcode = $request->zipcode;
        
        $consumers->phonenumber = $request->phonenumber;
        $consumers->save();
        return response()->success($consumers);
    }

    /**
     * Update an Consumer
     * 
     * This endpoint allows you to update a consumer
     *
     * @authenticated
     * @param UpdateConsumerRequest $request
     * @param integer $consumerid
     * @return JsonResponse
     */
    public function update(UpdateConsumerRequest $request, int $consumerid) {
        $consumers = new ConsumerProfile;
        $consumers = ConsumerProfile::where('id', $consumerid)->first();

        $consumers->firstname = $request->firstname;
        $consumers->middlename = $request->middlename;
        $consumers->lastname = $request->lastname;
        $consumers->gender = $request->gender;
        //address
        $consumers->street= $request->street;
        $consumers->building = $request->building;
        $consumers->barangay = $request->barangay;
        $consumers->city = $request->city;
        $consumers->region = $request->region;
        $consumers->zipcode = $request->zipcode;

        $consumers->phonenumber = $request->phonenumber;
        $consumers->save();
        return response()->success($consumers);
    }

    /**
     * Delete an Consumer
     * 
     * This endpoint allows you to delete a consumer
     *
     * @authenticated
     * @param DeleteConsumerRequest $request
     * @param integer $accountid
     * @return JsonResponse
     */
    public function delete(DeleteConsumerRequest $request, int $consumerid) {
        $consumers = new ConsumerProfile;
        $consumers = ConsumerProfile::find($consumerid);
        $consumers->delete();
        return response()->success('Consumer Deleted');
    }

}
