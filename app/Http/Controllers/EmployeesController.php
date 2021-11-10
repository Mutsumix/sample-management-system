<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Gender;
use App\Http\Controllers\Controller;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use DB;

class EmployeesController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::Paginate(10);
        return view('employee.index')->with('employees', $employees);
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
        $lastemployee = Employee::withTrashed()->orderBy('employee_id', 'desc')->first();
        $genders = Gender::orderBy('gender_name', 'asc')->get();
        $status = Status::orderBy('status_name', 'asc')->get();

        /**
         * return the view with an array of all these objects
         */
        return view('employee.create')->with([
            'new_employeeid' => optional($lastemployee)->employee_id + 1,
            'genders' => $genders,
            'status' => $status,
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
         * Note!
         * before using storage we need to link it to
         * the public folder by typing the command,
         * php artisan storage:link
         */

        /**
         * Handle the image file upload which will be stored
         * in storage/app/public/employee_images
         */
        $fileNameToStore = $this->handleImageUpload($request);

        /**
         * Create new object of employee
         */
        $employee = new Employee();

        /**
         * setEmployee is also a method of this controller
         * which I have created, so I can use it for update
         * method.
         */
        $this->setEmployee($employee, $request, $fileNameToStore);

        return redirect('/employees')->with('info', '社員情報が登録されました！🎉');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        /**
         * Age Calculation
         */
        $now = date('Ymd');
        $birthday = str_replace('-', '', $employee->birth_date);
        $age = '';
        if ($birthday) {
            $age = floor(($now - $birthday) / 10000) . '歳';
        }

        // マイナンバー
        $str = $employee->my_number;
        $str_ary = str_split($str, 4);
        $employee->my_number = implode('-', $str_ary);

        $str = $employee->spouses_my_number;
        $str_ary = str_split($str, 4);
        $employee->spouses_my_number = implode('-', $str_ary);

        $str = $employee->dep1_my_number;
        $str_ary = str_split($str, 4);
        $employee->dep1_my_number = implode('-', $str_ary);

        $str = $employee->dep2_my_number;
        $str_ary = str_split($str, 4);
        $employee->dep2_my_number = implode('-', $str_ary);

        $str = $employee->dep3_my_number;
        $str_ary = str_split($str, 4);
        $employee->dep3_my_number = implode('-', $str_ary);

        $str = $employee->dep4_my_number;
        $str_ary = str_split($str, 4);
        $employee->dep4_my_number = implode('-', $str_ary);

        // 基礎年金番号
        if ($employee->basic_pension_number) {
            $str = $employee->basic_pension_number;
            $employee->basic_pension_number = substr($str, 0, 4) . "-" . substr($str, 4);
        }

        // 雇用保険 被保険者整理番号
        if ($employee->ei_number) {
            $str = $employee->ei_number;
            $employee->ei_number = substr($str, 0, 4) . "-" . substr($str, 4, 6) . "-" . substr($str, 10);
        }

        // 被扶養者の有無
        if ($employee->existence_of_dependents == '0') {
            $employee->existence_of_dependents = '無';
        } elseif ($employee->existence_of_dependents == '1') {
            $employee->existence_of_dependents = '有';
        }

        if ($employee->password) {
            $employee->password = 'パスワード設定済';
        } else {
            $employee->password = 'パスワード未設定';
        }

        return view('employee.detail')->with(
            [
                'employee' => $employee,
                'age' => $age,
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
         * This is the same as create but with an existing employee
         */
        $genders = Gender::orderBy('gender_name', 'asc')->get();
        $status = Status::orderBy('status_name', 'asc')->get();

        $employee = Employee::find($id);
        $employee->postal_code = str_replace("-", "", $employee->postal_code);

        /**
         * return the view with an array of all these objects
         */
        return view('employee.edit')->with([
            'genders' => $genders,
            'status' => $status,
            'employee' => $employee,
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
        $employee = Employee::find($id);
        $old_picture = $employee->picture;
        if ($request->hasFile('picture')) {
            //Upload the image
            $fileNameToStore = $this->handleImageUpload($request);
            //Delete the previous image
            Storage::disk('public_images')->delete('images/employee_images/' . $employee->picture);
        } else {
            $fileNameToStore = '';
        }

        // password can be updated when password area is input and current password matches password that user input
        if ($request->input('password') || $request->input('password_confirmation')) {
            if (password_verify($request->input('password_confirmation'), $employee->password)) {
                //success
            } elseif($request->input('password') && is_null($employee->password)) {
                //success
            } else {
                return back()->withInput()->withErrors(array('password_confirmation' => 'パスワードが正しくありません'));
            }
        }
        /**
         * updating an existing employee with setEmployee method
         */
        $this->setEmployee($employee, $request, $fileNameToStore);
        return redirect('/employees')->with('info', '社員情報が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        Storage::disk('public_images')->delete('images/employee_images/' . $employee->picture);
        return redirect('/employees')->with('info', '社員情報が削除されました！');
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
        $employees = Employee::where($option, 'LIKE', '%' . $str . '%')->Paginate(10);
        return view('employee.index')->with(['employees' => $employees, 'search' => true]);
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
         * if we are updating an employee but not updating the image.
         */
        return $this->validate($request, [
            'employee_id' => 'required|numeric|between:1001,9999',
            'last_name' => 'required|min:1|max:50',
            'kana_last_name' => 'required|min:1|max:50|regex:/^[ァ-ヾ]+$/u',
            'first_name' => 'required|min:1|max:50',
            'kana_first_name' => 'required|min:1|max:50|regex:/^[ァ-ヾ]+$/u',
            'postal_code' => 'nullable|regex:/^\d{7}$/',
            'address_1' => 'max:50',
            'address_2' => 'max:50',
            'phone' => 'max:13',
            'mail_address' => 'max:250',
            'picture' => ($request->hasFile('picture') ? 'required|image|max:1999' : ''),
            'password' => 'nullable|min:8',
        ]);
    }

    /**
     * Save a new resource or update an existing resource
     * @param App\Employee $employee
     * @param \Illuminate\Http\Request $request
     * @param string $fileNameToStore
     * @return Boolean
     */
    private function setEmployee(Employee $employee, Request $request, $fileNameToStore)
    {
        $employee->employee_id = $request->input('employee_id');
        $employee->last_name = $request->input('last_name');
        $employee->first_name = $request->input('first_name');
        $employee->kana_last_name = $request->input('kana_last_name');
        $employee->kana_first_name = $request->input('kana_first_name');
        $employee->office = $request->input('office');
        $employee->status_id = $request->input('status');
        if ($request->input('postal_code')) {
            $str = $request->input('postal_code');
            $employee->postal_code = substr($str, 0, 3) . "-" . substr($str, 3);
        }
        $employee->address_1 = $request->input('address_1');
        $employee->address_2 = $request->input('address_2');
        $employee->birth_date = $request->input('birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('birth_date')))) : null;
        $employee->gender_id = $request->input('gender_id');
        $employee->blood_type = $request->input('blood_type');
        $employee->my_number = $request->input('my_number');
        $employee->phone_1 = $request->input('phone_1');
        $employee->phone_2 = $request->input('phone_2');
        $employee->mail_address = $request->input('mail_address');
        $employee->station = $request->input('station');
        $employee->commuting_route = $request->input('commuting_route');
        $employee->fare = $request->input('fare');
        $employee->join_date = $request->input('join_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('join_date')))) : null;
        $employee->leave_date = $request->input('leave_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('leave_date')))) : null;
        $employee->insurance_number = $request->input('insurance_number');
        $employee->reference_pension_number = $request->input('reference_pension_number');
        $employee->basic_pension_number = $request->input('basic_pension_number');
        $employee->hi_acquisition_date = $request->input('hi_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('hi_acquisition_date')))) : null;
        $employee->hi_loss_date = $request->input('hi_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('hi_loss_date')))) : null;
        $employee->existence_of_dependents = $request->input('existence_of_dependents');
        $employee->spouses_name = $request->input('spouses_name');
        $employee->spouses_birth_date = $request->input('spouses_birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('spouses_birth_date')))) : null;
        $employee->spouses_my_number = $request->input('spouses_my_number');
        $employee->dep1_name = $request->input('dep1_name');
        $employee->dep1_birth_date = $request->input('dep1_birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep1_birth_date')))) : null;
        $employee->dep1_my_number = $request->input('dep1_my_number');
        $employee->dep1_gender_id = $request->input('dep1_gender_id');
        $employee->dep1_relationship = $request->input('dep1_relationship');
        $employee->dep1_acquisition_date = $request->input('dep1_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep1_acquisition_date')))) : null;
        $employee->dep1_loss_date = $request->input('dep1_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep1_loss_date')))) : null;
        $employee->dep2_name = $request->input('dep2_name');
        $employee->dep2_birth_date = $request->input('dep2_birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep2_birth_date')))) : null;
        $employee->dep2_my_number = $request->input('dep2_my_number');
        $employee->dep2_gender_id = $request->input('dep2_gender_id');
        $employee->dep2_relationship = $request->input('dep2_relationship');
        $employee->dep2_acquisition_date = $request->input('dep2_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep2_acquisition_date')))) : null;
        $employee->dep2_loss_date = $request->input('dep2_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep2_loss_date')))) : null;
        $employee->dep3_name = $request->input('dep3_name');
        $employee->dep3_birth_date = $request->input('dep3_birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep3_birth_date')))) : null;
        $employee->dep3_my_number = $request->input('dep3_my_number');
        $employee->dep3_gender_id = $request->input('dep3_gender_id');
        $employee->dep3_relationship = $request->input('dep3_relationship');
        $employee->dep3_acquisition_date = $request->input('dep3_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep3_acquisition_date')))) : null;
        $employee->dep3_loss_date = $request->input('dep3_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep3_loss_date')))) : null;
        $employee->dep4_name = $request->input('dep4_name');
        $employee->dep4_birth_date = $request->input('dep4_birth_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep4_birth_date')))) : null;
        $employee->dep4_my_number = $request->input('dep4_my_number');
        $employee->dep4_gender_id = $request->input('dep4_gender_id');
        $employee->dep4_relationship = $request->input('dep4_relationship');
        $employee->dep4_acquisition_date = $request->input('dep4_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep4_acquisition_date')))) : null;
        $employee->dep4_loss_date = $request->input('dep4_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dep4_loss_date')))) : null;
        $employee->ei_number = $request->input('ei_number');
        $employee->ei_acquisition_date = $request->input('ei_acquisition_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('ei_acquisition_date')))) : null;
        $employee->ei_loss_date = $request->input('ei_loss_date') ? date('Y-m-d', strtotime(str_replace('-', '/', $request->input('ei_loss_date')))) : null;
        $employee->ec_name = $request->input('ec_name');
        $employee->ec_kana_name = $request->input('ec_kana_name');
        $employee->ec_relationship = $request->input('ec_relationship');
        $employee->ec_address = $request->input('ec_address');
        $employee->ec_phone = $request->input('ec_phone');
        $employee->fg1_name = $request->input('fg1_name');
        $employee->fg1_kana_name = $request->input('fg1_kana_name');
        $employee->fg1_relationship = $request->input('fg1_relationship');
        $employee->fg1_address = $request->input('fg1_address');
        $employee->fg1_phone = $request->input('fg1_phone');
        $employee->fg2_name = $request->input('fg2_name');
        $employee->fg2_kana_name = $request->input('fg2_kana_name');
        $employee->fg2_relationship = $request->input('fg2_relationship');
        $employee->fg2_address = $request->input('fg2_address');
        $employee->fg2_phone = $request->input('fg2_phone');
        $employee->remark = $request->input('remark');
        if ($request->input('isCreation')) {
            $employee->created_by = Auth::user()->username;
        }
        $employee->updated_by = Auth::user()->username;
        $employee->device = gethostname();

        if ($request->hasFile('picture')) {
            $employee->picture = $fileNameToStore;
        }
        if($request->input('password')){
            $employee->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        }

        $employee->save();

    }

    /**
     * Handle image upload when creating a new resource
     * or updating an existing resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function handleImageUpload(Request $request)
    {
        $fileNameToStore = "";

        if ($request->hasFile('picture')) {

            //get filename with extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();

            //get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('picture')->getClientOriginalExtension();

            /**
             * filename to store
             *
             * we are appending timestamp to the file name
             * and prepending it to the file extension just to
             * make the file name unique.
             */
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //upload the image
            $path = $request->file('picture')->storeAs('images/employee_images', $fileNameToStore, 'public_images');
        }
        /**
         * return the file name so we can add it to database.
         */
        return $fileNameToStore;

    }

}
