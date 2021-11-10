<?php

namespace App\Http\Controllers;

// use App\Client;
use App\Employee;
use App\Http\Controllers\Controller;
// use App\Workplace;
use Illuminate\Support\Facades\Auth;
// Spreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataIOController extends Controller
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
        return view('dataio.index');
    }

    public function outputClient()
    {
        $spreadsheet = new Spreadsheet();

        // シート作成
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("社員一覧");

        //社員一覧取得
        $employees = Employee::orderBy('employee_id', 'asc')->get();

        //タイトル設定
        $sheet->setCellValueByColumnAndRow(1, 1, '社員ID');
        $sheet->setCellValueByColumnAndRow(2, 1, '社員名');
        $sheet->setCellValueByColumnAndRow(3, 1, '姓');
        $sheet->setCellValueByColumnAndRow(4, 1, '名');
        $sheet->setCellValueByColumnAndRow(5, 1, '生年月日');
        $sheet->setCellValueByColumnAndRow(6, 1, '年齢');
        $sheet->setCellValueByColumnAndRow(7, 1, '個人携帯');
        $sheet->setCellValueByColumnAndRow(8, 1, '郵便番号');
        $sheet->setCellValueByColumnAndRow(9, 1, '住所');
        //列幅設定
        $sheet->getColumnDimension('A')->setWidth(8.0);
        $sheet->getColumnDimension('B')->setWidth(14.0);
        $sheet->getColumnDimension('C')->setWidth(12.0);
        $sheet->getColumnDimension('D')->setWidth(12.0);
        $sheet->getColumnDimension('E')->setWidth(12.0);
        $sheet->getColumnDimension('F')->setWidth(6.0);
        $sheet->getColumnDimension('G')->setWidth(15.0);
        $sheet->getColumnDimension('H')->setWidth(10.0);
        $sheet->getColumnDimension('I')->setWidth(62.0);

        foreach ($employees as $index => $employee) {
            $sheet->setCellValueByColumnAndRow(1, $index + 2, $employee->employee_id);
            $sheet->setCellValueByColumnAndRow(2, $index + 2, $employee->last_name . $employee->first_name);
            $sheet->setCellValueByColumnAndRow(3, $index + 2, $employee->kana_last_name);
            $sheet->setCellValueByColumnAndRow(4, $index + 2, $employee->kana_first_name);
            $sheet->setCellValueByColumnAndRow(5, $index + 2, $employee->birth_date);
            //Age calculation
            $now = date('Ymd');
            $birthday = str_replace('-', '', $employee->birth_date);
            $age = '';
            if ($birthday) {
                $age = floor(($now - $birthday) / 10000) . '歳';
            }
            $sheet->setCellValueByColumnAndRow(6, $index + 2, $age);
            $sheet->setCellValueByColumnAndRow(7, $index + 2, $employee->phone_1);
            $sheet->setCellValueByColumnAndRow(8, $index + 2, $employee->postal_code);
            $sheet->setCellValueByColumnAndRow(9, $index + 2, $employee->address_1 . "" . $employee->address_2);
        }

        $filename = '社員一覧_' . date("Y/m/d") . '.xlsx';
        $this->setHeader($filename);

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // return redirect('/dataio')->with('info', '出力されました！📄');

    }

    public function setHeader($filename)
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
    }

}
