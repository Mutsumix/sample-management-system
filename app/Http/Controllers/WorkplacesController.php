<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\Http\Controllers\Controller;
use App\SalesHistory;
use App\Workplace;
use App\WorkplaceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkplacesController extends Controller
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
        $workplaces = Workplace::orderBy('end_date', 'asc')->Paginate(10);
        return view('workplace.index')->with('workplaces', $workplaces);
    }

    public function create()
    {
        $lastworkplace = Workplace::withTrashed()->orderBy('workplace_id', 'desc')->first();
        $clients = Client::orderBy('client_id', 'asc')->get();
        $employees = Employee::orderBy('employee_id', 'asc')->get();
        $workplace = new Workplace();

        return view('workplace.create')->with([
            'new_workplaceid' => optional($lastworkplace)->workplace_id + 1,
            'clients' => $clients,
            'employees' => $employees,
            'workplace' => $workplace,
        ]);
    }

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
        $workplace = new Workplace();

        /**
         * setClient is also a method of this controller
         * which I have created, so I can use it for update
         * method.
         */
        $this->setWorkplace($workplace, $request);

        return redirect('/workplaces')->with('info', '派遣先情報が登録されました！🎉');
    }

    // 時刻が null だった場合の対処
    public function isTimeNull($datetime, $format)
    {
        $rtn = '';
        if ($datetime == '00:00') {
            $rtn = null;
        } elseif ($datetime == null) {
            $rtn = null;
        } else {
            $rtn = date($format, strtotime($datetime));
        }
        return $rtn;
    }

    // 小数点1桁まで
    public function floor_plus($value, $precision = 1)
    {
        if ($value > 0.5) {
            return round($value - 0.5 * pow(0.1, $precision), $precision, PHP_ROUND_HALF_UP);
        } else {
            return round($value * pow(0.1, $precision), $precision, PHP_ROUND_HALF_UP);
        }
    }

    public function show($id)
    {
        $workplace = Workplace::with('sHistories', 'wpHistories')->find($id);

        // 営業メモを作成日でソートしたい
        // $workplace = Workplace::select('workplaces.*')
        //     ->where('workplaces.workplace_id', $id)
        //     ->join('sales_histories', 'workplaces.workplace_id', '=', 'sales_histories.workplace_id')
        //     ->orderBy('sales_histories.shistory_date', 'ASC')
        //     ->first();

        // 契約継続期間 〇年〇月形式で表示したい
        // $now = date('Ymd');
        // $startday = str_replace('-', '', $workplace->start_date);
        // $contract_duration = '';
        // if ($startday) {
        //     $contract_duration = $this->floor_plus((($now - $startday) / 10000), 1) . '年';
        // }

        $workplace->commuting_time = $this->isTimeNull($workplace->commuting_time, 'G時間i分');
        $workplace->opening_time = $this->isTimeNull($workplace->opening_time, 'G:i');
        $workplace->closing_time = $this->isTimeNull($workplace->closing_time, 'G:i');
        $formatted_created_at = $this->isTimeNull($workplace->created_at, 'Y-m-d');
        $formatted_updated_at = $this->isTimeNull($workplace->updated_at, 'Y-m-d');

        // 派遣先情報変更履歴取得
        $wph = new WorkplaceHistory();
        $wphistories = $wph->getWorkplaceHistories($workplace->workplace_id);

        return view('workplace.detail')->with(
            [
                'workplace' => $workplace,
                'formatted_created_at' => $formatted_created_at,
                'formatted_updated_at' => $formatted_updated_at,
                // 'contract_duration' => $contract_duration,
                'wphistories' => $wphistories,
            ]
        );
    }

    public function copy($id)
    {
        $clients = Client::orderBy('client_id', 'asc')->get();
        $employees = Employee::orderBy('employee_id', 'asc')->get();

        $workplace = Workplace::find($id);
        $lastworkplace = Workplace::withTrashed()->orderBy('workplace_id', 'desc')->first();
        $workplace->workplace_id = $lastworkplace->workplace_id + 1;

        return view('workplace.create')->with([
            'clients' => $clients,
            'employees' => $employees,
            'workplace' => $workplace,
            'new_workplaceid' => optional($lastworkplace)->workplace_id + 1,
        ]);
    }

    public function edit($id)
    {
        /**
         * This is the same as create but with an existing client
         */
        $clients = Client::orderBy('client_id', 'asc')->get();
        $employees = Employee::orderBy('employee_id', 'asc')->get();
        $workplace = Workplace::find($id);

        /**
         * return the view with an array of all these objects
         */
        return view('workplace.edit')->with([
            'clients' => $clients,
            'employees' => $employees,
            // 'paymentdates' => $paymentdates,
            'workplace' => $workplace,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);
        $workplace = Workplace::find($id);

        /**
         * updating an existing client with setClient method
         */
        if ($this->setWorkplace($workplace, $request)) {
            return redirect('/workplaces')->with('info', '派遣先情報が更新されました！');
        } else {
            $clients = Client::orderBy('client_id', 'asc')->get();
            $employees = Employee::orderBy('employee_id', 'asc')->get();
            $workplace = Workplace::find($id);

            session()->flash('info', '更新する派遣先情報がありません！');

            return view('workplace.edit')->with([
                'clients' => $clients,
                'employees' => $employees,
                'workplace' => $workplace,
            ]);
        }
    }

    public function destroy($id)
    {
        $shistories = SalesHistory::where('workplace_id', $id)->get();
        $wphistories = WorkplaceHistory::where('workplace_id', $id)->get();

        foreach ($shistories as $shistory) {
            $shistory->forcedelete();
        }
        foreach ($wphistories as $wphistory) {
            $wphistory->forcedelete();
        }

        $workplace = Workplace::find($id);
        $workplace->forceDelete();
        return redirect('/workplaces')->with('info', '派遣先情報が削除されました！');

    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|min:1',
            'options' => 'required',
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $workplaces = Workplace::where($option, 'LIKE', '%' . $str . '%')->Paginate(10);
        return view('workplace.index')->with(['workplaces' => $workplaces, 'search' => true]);
    }

    private function validateRequest($request, $id)
    {
        return $this->validate($request, [
            'workplace' => 'nullable|min:1|max:50',
            'contact_phone' => 'max:13',
            'contact_mail' => 'max:250',
        ]);
    }

    private function setWorkplace(Workplace $workplace, Request $request)
    {
        $workplace->workplace_id = $request->input('workplace_id');
        $workplace->client_id = $request->input('client_id');
        $workplace->employee_id = $request->input('employee_id');
        $workplace->workplace = $request->input('workplace');
        $workplace->start_date = $request->input('start_date');
        $workplace->end_date = $request->input('end_date');
        $workplace->amount = $request->input('amount');
        $workplace->station = $request->input('station');
        $workplace->commuting_time = $request->input('commuting_time');
        $workplace->contact_person = $request->input('contact_person');
        $workplace->contact_phone = $request->input('contact_phone');
        $workplace->contact_mail = $request->input('contact_mail');
        $workplace->opening_time = $request->input('opening_time');
        $workplace->closing_time = $request->input('closing_time');
        $workplace->contracttime_floor = $request->input('contracttime_floor');
        $workplace->contracttime_roof = $request->input('contracttime_roof');
        $workplace->reduction = $request->input('reduction');
        $workplace->increase = $request->input('increase');

        if ($request->input('isCreation')) {
            $workplace->created_by = Auth::user()->username;
        }
        $workplace->updated_by = Auth::user()->username;
        $workplace->device = gethostname();

        $wphc = app()->make('App\Http\Controllers\WorkplaceHistoriesController');
        if (isset($_POST['update_log'])) {
            $diff_exists = $wphc->setWPHistory($workplace);
            if ($diff_exists) {
                // 差分あり（何もしない）
            } else {
                // 差分なし（処理終了）
                return false;
            }
        }

        $workplace->save();

        // 初回であれば全て、以降は修正項目を修正履歴に保存する
        if ($request->input('isCreation')) {
            $wphc->setFirstWPHistory($workplace);
        }

        return true;
    }
}
