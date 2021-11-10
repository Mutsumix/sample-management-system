<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Workplace;
use App\WorkplaceHistory;
use Illuminate\Support\Facades\Auth;

class WorkplaceHistoriesController extends Controller
{
    public $wphkeys = array(
        'workplace',
        'start_date',
        'end_date',
        'amount',
        'station',
        'commuting_time',
        'contact_person',
        'contact_phone',
        'contact_mail',
        'opening_time',
        'closing_time',
        'contracttime_floor',
        'contracttime_roof',
        'reduction',
        'increase');

    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setFirstWPHistory(Workplace $workplace)
    {
        // wph オブジェクト生成
        $wph = new WorkplaceHistory();

        // 最初の更新だったら、version 0 として全部登録する
        $wph->version = 0;
        $wph->workplace_id = $workplace->workplace_id;
        $wph->created_by = $workplace->created_by;
        $wph->updated_by = $workplace->updated_by;
        $wph->device = $workplace->device;

        foreach ($this->wphkeys as $key) {
            $wph->$key = $workplace->$key;
        }

        $wph->save();
    }

    public function setWPHistory(Workplace $workplace)
    {
        // 変更前のworkplaceオブジェクトを取得
        $lastWorkplace = Workplace::find($workplace->workplace_id);

        // wph オブジェクト生成
        $wph = new WorkplaceHistory();

        // 変更点（派遣先～時間外（増額））をwphに入れる
        $diff = array_diff_assoc($workplace->toarray(), $lastWorkplace->toArray());

        // 差分がなければ終了
        if ($diff) {

        } else {
            return false;
        }

        // wph に 代入する項目の配列
        foreach ($this->wphkeys as $key) {
            if (array_key_exists($key, $diff)) {
                $wph->$key = $diff[$key] ?: '';
            }
        }

        // workpkace_id, created_by, updated_by, device はそのままwph に入れる
        $wph->workplace_id = $workplace->workplace_id;
        $wph->created_by = $workplace->created_by;
        $wph->updated_by = $workplace->updated_by;
        $wph->device = $workplace->device;

        // wph.version を＋1
        $lastwph = WorkplaceHistory::withTrashed()->where('workplace_id', $workplace->workplace_id)->orderBy('version', 'desc')->first();
        $wph->version = is_null($lastwph) ? 1 : $lastwph->version + 1;

        $wph->save();

        return true;
    }
}
