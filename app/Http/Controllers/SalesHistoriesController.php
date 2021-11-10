<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SalesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesHistoriesController extends Controller
{
    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // ページリロード時の二重送信対策
        $request->session()->regenerateToken();

        $lastSHistory = SalesHistory::withTrashed()->orderBy('shistory_id', 'desc')->first();

        $request['shistory_id'] = optional($lastSHistory)->shistory_id + 1;

        $request['isCreation'] = true;

        $shistory = new SalesHistory();

        $this->setSHistory($shistory, $request);

        $view = $this->showWorkplace($shistory);
        session()->flash('info', '営業メモを作成しました！');
        return $view;
    }

    public function destroy($id)
    {
        $shistory = SalesHistory::find($id);
        $shistory->forceDelete();

        $view = $this->showWorkplace($shistory);
        return $view;
    }

    public function update(Request $request, $id)
    {
        // $this->validateRequest($request, $id);
        $shistory = SalesHistory::find($id);

        $request['shistory_id'] = $id;
        $request['shistory_date'] = $request->input('shistory_date' . $id);
        $request['contact_person'] = $request->input('contact_person' . $id);
        $request['contact_person_smc'] = $request->input('contact_person_smc' . $id);
        $request['shistory_memo'] = $request->input('shistory_memo' . $id);
        $request['remind_year'] = $request->input('remind_year' . $id);
        $request['remind_month'] = $request->input('remind_month' . $id);
        $request['remind_day'] = $request->input('remind_day' . $id);
        $request['remind_memo'] = $request->input('remind_memo' . $id);
        $request['done_flag'] = $request->input('done_flag' . $id);

        /**
         * updating an existing SHistory with setSHistory method
         */
        $this->setSHistory($shistory, $request);

        $view = $this->showWorkplace($shistory);
        session()->flash('info', '営業メモを更新しました！');
        return $view;
    }

    public function showWorkplace($shistory)
    {
        $wpc = app()->make('App\Http\Controllers\WorkplacesController');
        return $wpc->show($shistory->workplace_id);
    }

    /**
     * Save a new resource or update an existing resource
     * @param App\SalesHistory $client
     * @param \Illuminate\Http\Request $request
     * @param string $fileNameToStore
     * @return Boolean
     */
    private function setSHistory(SalesHistory $shistory, Request $request)
    {
        $shistory->shistory_id = $request->input('shistory_id');
        if ($request->input('isCreation')) {
            $shistory->workplace_id = $request->input('workplace_id');
        }
        $shistory->shistory_date = $request->input('shistory_date');
        $shistory->contact_person = $request->input('contact_person');
        // $shistory->contact_person_smc = $request->input('contact_person_smc');
        $shistory->shistory_memo = $request->input('shistory_memo');
        $shistory->remind_year = $request->input('remind_year');
        $shistory->remind_month = $request->input('remind_month');
        $shistory->remind_day = $request->input('remind_day');
        $shistory->remind_memo = $request->input('remind_memo');
        if ($request->input('done_flag') == 'on') {
            $shistory->done_flag = 1;
        } else {
            $shistory->done_flag = null;
        }

        if ($request->input('isCreation')) {
            $shistory->created_by = Auth::user()->username;
        }
        $shistory->updated_by = Auth::user()->username;
        $shistory->device = gethostname();

        $shistory->save();
    }
}
