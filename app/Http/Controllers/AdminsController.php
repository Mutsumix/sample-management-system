<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * It works the same as EmployeesController
         */

        $admins = Admin::Paginate(10);
        return view('admin.index')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new Admin();
        $this->validateRequest($request, null);
        $fileNameToStore = $this->handleImageUpload($request);
        $this->setAdmin($request, $admin, $fileNameToStore);
        return redirect('\admins')->with('info', '管理者が登録されました！🧑‍🔧');
    }

    /**
     * Show the form for editin the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit')->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        $admin = Admin::find($id);

        if ($request->hasFile('picture')) {
            $fileNameToStore = $this->handleImageUpload($request);
            Storage::disk('public_images')->delete('images/admin_images/' . $admin->picture);
        } else {
            $fileNameToStore = '';
        }

        $this->setAdmin($request, $admin, $fileNameToStore);
        return redirect('/admins')->with('info', '管理者情報が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Check if the admin is the
         * current authenticated user
         */
        if ($id == Auth::user()->admin_id) {
            //redirect to admins route
            return redirect('/admins')->with('info', '認証中の管理者は削除できません！');
        }

        $admin = Admin::find($id);
        //delete the admin picture
        Storage::disk('public_images')->delete('public/admins/' . $admin->picture);
        $admin->delete();
        return redirect('/admins')->with('info', '管理者情報が削除されました！');
    }

    private function validateRequest(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:admins,username,' . ($id ?: '') . ',admin_id|min:3',
            'mail_address' => 'required|email|unique:admins,mail_address,' . ($id ?: '') . ',admin_id|min:7',
            'password' => 'required|alpha_dash|min:7',
            'picture' => '' . ($request->hasFile('picture') ? 'image|max:1999' : ''),
        ]);
    }

    private function setAdmin(Request $request, Admin $admin, $fileNameToStore)
    {
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->username = $request->input('username');
        $admin->mail_address = $request->input('mail_address');
        $admin->password = bcrypt($request->input('password'));
        if ($request->hasFile('picture')) {
            $admin->picture = $fileNameToStore;
        }
        $admin->save();
    }

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
            $path = $request->file('picture')->storeAs('images/admin_images', $fileNameToStore, 'public_images');
        }
        /**
         * return the file name so we can add it to database.
         */
        return $fileNameToStore;
    }
}
