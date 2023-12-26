<?php

namespace App\Http\Controllers;

use App\SellerFile;
use App\SubscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pricingData = [
            (object) [
                'name' => 'free',
                'price' => 0,
                'class' => 'single-pricing',
                'features' => [
                    '✔️ Buy Properties',
                    '✔️ Browse Lot Properties',
                    '✔️ See Comments',
                    '✔️ Comment on Properties',
                    '✔️ Contact Owner/Buyers',
                    '✔️ See Lot Map Location',
                    '✔️ Gmail Notification',
                    '❌ Create Properties',
                    '❌ See Listing Visitors',
                    '❌ Auto-Feature Properties',
                ],
            ],
            (object) [
                'name' => 'standard',
                'price' => 100,
                'class' => 'single-pricing',
                'features' => [
                    '✔️ Buy Properties',
                    '✔️ Browse Lot Properties',
                    '✔️ See Comments',
                    '✔️ Comment on Properties',
                    '✔️ Contact Owner/Buyers',
                    '✔️ See Lot Map Location',
                    '✔️ Gmail Notification',
                    '✔️ Create Properties',
                    '❌ See Listing Visitors',
                    '❌ Auto-Feature Properties',
                ],
            ],
            (object) [
                'name' => 'premium',
                'price' => 200,
                'class' => 'single-pricing single-pricing-white',
                'features' => [
                    '✔️ Buy Properties',
                    '✔️ Browse Lot Properties',
                    '✔️ See Comments',
                    '✔️ Comment on Properties',
                    '✔️ Contact Owner/Buyers',
                    '✔️ See Lot Map Location',
                    '✔️ Gmail Notification',
                    '✔️ Create Properties',
                    '✔️ See Listing Visitors',
                    '✔️ Auto-Feature Properties',
                ],
            ],
        ];

        $pricingCollection = collect($pricingData);
        $pricingArray = $pricingCollection->all();

        $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();

        return view('pricing', ['plans' => $pricingCollection, 'sellerfile' => $sellerfile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gcash_reference_code' => [
                'required',
                'unique:subscription_payments',
            ],
        ]);

        $exists = SubscriptionPayment::where('user_id', auth()->user()->id)->where('status', 'pending')->first();
        if ($exists) {
            throw ValidationException::withMessages(['error' => 'Pending payment found! Please wait for admin to process previous payment.']);
        } else {
            SubscriptionPayment::create([
                'gcash_reference_code' => $request->gcash_reference_code,
                'user_id' => auth()->user()->id,
                'plan' => $request->plan,
            ]);
            return response()->json(['code' => 200, 'status' => 'success'], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
