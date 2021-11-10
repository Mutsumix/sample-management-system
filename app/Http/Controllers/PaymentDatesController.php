<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use App\PaymentDate;
use Illuminate\Http\Request;

class PaymentDatesController extends Controller
{
    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentdates = PaymentDate::Paginate(5);
        return view('sys_mg.paymentdates.index')->with('paymentdates', $paymentdates);
    }

    /**
     * Show the form for creating a new source.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.paymentdates.create');
    }

    /**
     * Store a newly created resource in storage
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'paymentdate_name' => 'required:1|unique:paymentdates',
        ]);

        $paymentdate = new PaymentDate;
        $paymentdate->paymentdate_name = $request->input('paymentdate_name');
        $paymentdate->save();

        return redirect('/paymentdates')->with('info', '支払日が作成されました！');
    }

    /**
     * Display the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentdate = PaymentDate::find($id);
        return view('sys_mg.paymentdates.edit')->with('paymentdate', $paymentdate);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'paymentdate_name' => 'required|unique:paymentdates|min:1',
        ]);
        $paymentdate = PaymentDate::Find($id);
        $paymentdate->paymentdate_name = $request->input('paymentdate_name');
        $paymentdate->save();
        return redirect('/paymentdates')->with('info', '支払日が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::where('paymentdate_id', $id)->first();
        if ($client) {
            return redirect('/paymentdates')->with('info', 'この支払日で登録している取引先があります！');
        }

        $paymentdate = PaymentDate::find($id);
        $paymentdate->delete();
        return redirect('/paymentdates')->with('info', '支払日が削除されました！');
    }
}
