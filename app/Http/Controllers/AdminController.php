<?php

namespace App\Http\Controllers;

use App\Http\Middleware\admin;
use App\Http\Requests\CreateAdminRequest;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function editAdmins()
    {
        $authUserEmail = Auth::user()->email;
        $admins = ModelsAdmin::where('email', '!=', $authUserEmail)->get();
        return view('admins.edit-admins', ['admins'=> $admins]);
    }
    public function deleteAdmins($id)
    {
        ModelsAdmin::destroy($id);
        return redirect()->back();
    }
    public function addAdmins(Request $request)
    {
        $admin = new ModelsAdmin();
        $request->validate([
            'is_super_admin' => ['required', 'numeric', 'min:0', 'max:1'],
            'email' => ['required', 'email'],
        ]);
        $admin->is_super_admin = $request->is_super_admin;
        $admin->email = $request->email;
        $admin->save();
        return redirect()->back();
        /* return redirect()->route('view.admins.edit'); */
    }
}
