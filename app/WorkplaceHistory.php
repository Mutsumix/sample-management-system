<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class WorkplaceHistory extends Model
{
    use SoftDeletes;

    public $primaryKey = 'wphistory_id';

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return object
     */
    public function wpWorkplace()
    {
        return $this->belongsTo('App\Workplace', 'workplace_id');
    }

    public function getWorkplaceHistories($workplace_id)
    {
        $wphs = WorkplaceHistory::where('workplace_id', $workplace_id)->orderBy('created_at', 'desc')->get();
        $columns = Schema::getColumnListing('workplace_histories');
        $edit_histories = array();
        $edit_history = array();
        $editor = '';
        $edit_time = '';
        $edit_item = '';
        $edit_value = '';
        $edit_lastitem = '';
        $id = '';

        foreach ($wphs as $wph) {
            if ($wph->version == 0) {
                // 初回登録時のデータは飛ばす
            } else {

                // 作成者、日時を取得
                $id = $wph->wphistory_id;
                $editor = $wph->updated_by;
                $edit_time = $wph->created_at;

                foreach ($columns as $column) {
                    // 値のある列に処理を実行 タイムスタンプ類は無視
                    if ($wph->$column &&
                        !($column == 'wphistory_id' ||
                            $column == 'workplace_id' ||
                            $column == 'version' ||
                            $column == 'created_at' ||
                            $column == 'created_by' ||
                            $column == 'updated_at' ||
                            $column == 'updated_by' ||
                            $column == 'device' ||
                            $column == 'deleted_at'
                        )) {
                        // 変更項目を取得
                        $edit_value = $wph->$column;
                        // 配列（履歴テーブル）から、変更項目の変更前の値を取得
                        // 現項目のid より小さいid のデータから変更項目がnull でないデータの最新を取得
                        $edit_lastitem = WorkplaceHistory::where('wphistory_id', '<', $id)->whereNotNull($column)->orderBy('version', 'desc')->first();

                        switch ($column) {
                            case 'workplace':$edit_item = '派遣先';
                                break;
                            case 'start_date':$edit_item = '契約開始日';
                                break;
                            case 'end_date':$edit_item = '契約終了日';
                                break;
                            case 'amount':$edit_item = '金額';
                                break;
                            case 'station':$edit_item = '最寄り駅';
                                break;
                            case 'commuting_time':$edit_item = '通勤時間';
                                break;
                            case 'contact_person':$edit_item = '担当者名';
                                break;
                            case 'contact_phone':$edit_item = '担当者電話番号';
                                break;
                            case 'contact_mail':$edit_item = '担当者メールアドレス';
                                break;
                            case 'opening_time':$edit_item = '始業時間';
                                break;
                            case 'closing_time':$edit_item = '終業時間';
                                break;
                            case 'contracttime_floor':$edit_item = '契約時間下限';
                                break;
                            case 'contracttime_roof':$edit_item = '契約時間上限';
                                break;
                            case 'reduction':$edit_item = '時間外（減額）';
                                break;
                            case 'increase':$edit_item = '時間外（増額）';
                                break;
                        }

                        // 配列を作成・追加
                        $edit_histories[] = array(
                            'editor' => $editor,
                            'edit_time' => $edit_time,
                            'edit_item' => $edit_item,
                            'edit_value' => $edit_value,
                            'edit_lastvalue' => optional($edit_lastitem)->$column);
                    }
                }
            }
        }
        return $edit_histories;
    }
}
