<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\ClosingDate;
use App\Http\Controllers\Controller;
use App\PaymentDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::Paginate(10);
        return view('client.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * Get these objects so we can show these name
         * on each dropdown in the view.
         */
        $lastclient = Client::withTrashed()->orderBy('client_id', 'desc')->first();
        $categories = Category::orderBy('category_name', 'asc')->get();
        $closingdates = ClosingDate::orderBy('closingdate_name', 'asc')->get();
        $paymentdates = PaymentDate::orderBy('paymentdate_name', 'asc')->get();

        /**
         * return the view with an array of all these objects
         */
        return view('client.create')->with([
            'new_clientid' => optional($lastclient)->client_id + 1,
            'categories' => $categories,
            'closingdates' => $closingdates,
            'paymentdates' => $paymentdates,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['isCreation'] = true;

        /**
         * validateRequest is a method defined in this controller
         * which will validate the form. we have created it so we
         * can reuse it in the update method with different parameters.
         */
        $this->validateRequest($request, null);

        /**
         * Create new object of client
         */
        $client = new Client();

        /**
         * setClient is also a method of this controller
         * which I have created, so I can use it for update
         * method.
         */
        $this->setClient($client, $request);

        return redirect('/clients')->with('info', '取引先情報が登録されました！🎉');
    }

    public function isTimeNull($datetime, $format)
    {
        return $datetime == null ? '' : date($format, strtotime($datetime));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        // 時刻が null だった場合の対処
        $formatted_created_at = $this->isTimeNull($client->created_at, 'Y-m-d');
        $formatted_updated_at = $this->isTimeNull($client->updated_at, 'Y-m-d');

        // return view('client.detail')->with('client', $client);
        return view('client.detail')->with(
            [
                'client' => $client,
                'formatted_created_at' => $formatted_created_at,
                'formatted_updated_at' => $formatted_updated_at,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * This is the same as create but with an existing client
         */
        $categories = Category::orderBy('category_name', 'asc')->get();
        $closingdates = ClosingDate::orderBy('closingdate_name', 'asc')->get();
        $paymentdates = PaymentDate::orderBy('paymentdate_name', 'asc')->get();

        $client = Client::find($id);
        $client->postal_code = str_replace("-", "", $client->postal_code);

        /**
         * return the view with an array of all these objects
         */
        return view('client.edit')->with([
            'categories' => $categories,
            'closingdates' => $closingdates,
            'paymentdates' => $paymentdates,
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);
        $client = Client::find($id);

        // client has no picture

        /**
         * updating an existing client with setClient method
         */
        $this->setClient($client, $request);
        return redirect('/clients')->with('info', '取引先情報が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        // $client->delete();
        $client->forceDelete();
        return redirect('/clients')->with('info', '取引先情報が削除されました！');
    }

    /**
     * Search For Resource(s)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|min:1',
            'options' => 'required',
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $clients = Client::where($option, 'LIKE', '%' . $str . '%')->Paginate(10);
        return view('client.index')->with(['clients' => $clients, 'search' => true]);
    }

    /**
     * This method is used for validating the form
     *
     * @param \Illuminate\Http\Request $request
     * @return $this
     */
    private function validateRequest($request, $id)
    {
        /**
         * specifying the validation rules
         */

        /**
         * Below in Picture validation rules we are first checking
         * that if there is an image, if not then don't apply the
         * validation rules. the reason we are doing this is because
         * if we are updating an client but not updating the image.
         */
        return $this->validate($request, [
            'client_id' => 'required|numeric|between:1,9999',
            'client_name' => 'required|min:1|max:50',
            'kana_client_name' => 'required|min:1|max:50|regex:/^[ァ-ヾ]+$/u',
            'postal_code' => 'nullable|regex:/^\d{7}$/',
            'address_1' => 'max:50',
            'address_2' => 'max:50',
        ]);
    }

    /**
     * Save a new resource or update an existing resource
     * @param App\Client $client
     * @param \Illuminate\Http\Request $request
     * @param string $fileNameToStore
     * @return Boolean
     */
    private function setClient(Client $client, Request $request)
    {
        $client->client_id = $request->input('client_id');
        $client->client_name = $request->input('client_name');
        $client->kana_client_name = $request->input('kana_client_name');
        if ($request->input('postal_code')) {
            $str = $request->input('postal_code');
            $client->postal_code = substr($str, 0, 3) . "-" . substr($str, 3);
        }
        $client->address_1 = $request->input('address_1');
        $client->address_2 = $request->input('address_2');
        $client->phone = $request->input('phone');
        $client->fax = $request->input('fax');
        $client->mail_address = $request->input('mail_address');
        $client->url = $request->input('url');
        $client->category_id = $request->input('category');
        $client->office = $request->input('office');
        $client->contact_person_1 = $request->input('contact_person_1');
        $client->contact_phone_1 = $request->input('contact_phone_1');
        $client->contact_mail_1 = $request->input('contact_mail_1');
        $client->contact_person_2 = $request->input('contact_person_2');
        $client->contact_phone_2 = $request->input('contact_phone_2');
        $client->contact_mail_2 = $request->input('contact_mail_2');
        $client->contact_person_3 = $request->input('contact_person_3');
        $client->contact_phone_3 = $request->input('contact_phone_3');
        $client->contact_mail_3 = $request->input('contact_mail_3');
        $client->closingdate_id = $request->input('closing_date');
        $client->paymentdate_id = $request->input('payment_date');
        $client->remark = $request->input('remark');
        if ($request->input('isCreation')) {
            $client->created_by = Auth::user()->username;
        }
        $client->updated_by = Auth::user()->username;
        $client->delete_flag = $request->input('delete_flag');
        $client->device = gethostname();

        $client->save();
    }

}
