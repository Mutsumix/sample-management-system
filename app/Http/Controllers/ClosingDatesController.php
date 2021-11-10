<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClosingDate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClosingDatesController extends Controller
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
        $closingdates = ClosingDate::Paginate(5);
        return view('sys_mg.closingdates.index')->with('closingdates', $closingdates);
    }

    /**
     * Show the form for creating a new source.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.closingdates.create');
    }

    /**
     * Store a newly created resource in storage
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'closingdate_name' => 'required:1|unique:closingdates',
        ]);

        $closingdate = new ClosingDate;
        $closingdate->closingdate_name = $request->input('closingdate_name');
        $closingdate->save();

        return redirect('/closingdates')->with('info', '締め日が作成されました！');
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
        $closingdate = ClosingDate::find($id);
        return view('sys_mg.closingdates.edit')->with('closingdate', $closingdate);
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
            'closingdate_name' => 'required|unique:closingdates|min:1',
        ]);
        $closingdate = ClosingDate::Find($id);
        $closingdate->closingdate_name = $request->input('closingdate_name');
        $closingdate->save();
        return redirect('/closingdates')->with('info', '締め日が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::where('closingdate_id', $id)->first();
        if ($client) {
            return redirect('/closingdates')->with('info', 'この締め日で登録している取引先があります！');
        }

        $closingdate = ClosingDate::find($id);

        $closingdate->delete();
        return redirect('/closingdates')->with('info', '締め日が削除されました！');
    }
}
