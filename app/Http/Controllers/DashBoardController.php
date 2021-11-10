<?php

namespace App\Http\Controllers;

// use Illuminate\Heep\Request;
// use Carcon\Carbon;
// use DB;
use App\Admin;
use App\Client;
use App\Employee;
use App\Workplace;

class DashboardController extends Controller
{
    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Dashboard View
     *
     * @return View
     */
    public function index()
    {
        //get current date and time
        // $date_current = Carcon::now()->toDateTimeString();

        $t_admins = Admin::all()->count();
        $t_employees = Employee::all()->count();
        $t_clients = Client::all()->count();
        $t_workplaces = Workplace::all()->count();

        return view('dashboard.index')
            ->with([
                't_admins' => $t_admins,
                't_employees' => $t_employees,
                't_clients' => $t_clients,
                't_workplaces' => $t_workplaces,
            ]);
    }
}
