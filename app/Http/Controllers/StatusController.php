<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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
        /**
         * We are using Eloquent ORM for database handling.
         * DB library can alse be used, check the docs for more
         * information.
         */

        /**
         * It's retrieving all rows from status table.
         * we can also use 'All' instead of paginate which will return
         * all rows from status table
         */
        $status = Status::orderBy('status_name', 'asc')->Paginate(4);

        /**
         * We can alse do orderBy('status_name', 'desc') which means it'll return
         * rows in descending order.
         */
        return view('sys_mg.status.index')->with('status', $status);
    }

    /**
     * Show the form for creating a new source.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * This will simply return the create view which is
         * just a form for creating a new status.
         */
        return view('sys_mg.status.create');
    }

    /**
     * Store a newly created resource in storage
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Using laravel's pre-build validation class.
         * it's first argument will be Request which is $request
         * and second argument will be an array which whill specify
         * the validation rules.
         * format is,
         * 'form field name' => 'rule'
         * unique:status means it should be unique to status_name
         * in status table (note that input name and column name
         * should be the same)
         */
        $this->validate($request, [
            'status_name' => 'required|min:1|unique:status',
        ]);

        /**
         * create new Status.
         * add value(s) to it's fields.
         * and save (store it to the database).
         */
        $status = new Status;
        $status->status_name = $request->input('status_name');
        $status->save();

        /**
         * redirect us to the /status route with a message.
         * this message will make a toast that we have created in
         * inc/message view which is included in layoutes/app view.
         * see the inc/message view
         */
        return redirect('/status')->with('info', '社員区分が作成されました！');
    }

    /**
     * Display the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * You can use this method if you wanna display a
         * single status(recource) in a differenct view.
         */
    }

    /**
     * Show the form for editing the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * find a status(resource) by its id which
         * is coming from our route.
         */
        $status = Status::find($id);
        return view('sys_mg.status.edit')->with('status', $status);
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
            'status_name' => 'required|unique:status|min:1',
        ]);

        /**
         * it's the same as creating a new resource,
         * but we are modifying an existing resource
         * so first we'll find it by its id then, save it.
         */
        $status = Status::Find($id);
        $status->status_name = $request->input('status_name');
        $status->save();

        /**
         * redirecting with a message.
         */
        return redirect('/status')->with('info', '社員区分が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('status_id', $id)->first();
        if ($employee) {
            return redirect('/status')->with('info', 'この社員区分で登録している社員がいます！');
        }
        /**
         * find the specified resource and delete it.
         * then redirect us with a message.
         */
        $status = Status::find($id);
        $status->delete();
        return redirect('/status')->with('info', '社員区分が削除されました！');
    }

}
