<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('admin.user.index', [
            'users' => \DB::table('users')->get()
        ]);
    }

    public function edit($id) {
        return response()->json(\DB::table('users')->where('id', $id)->first());
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed',
        ]);

        $dataUser = $request->except('password', 'password_confirmation', '_token', '_method');

        if ($request->password != null) {
            $dataUser['password'] = Hash::make($request->password);
        }

        \DB::table('users')->where('id', $id)->update($dataUser);

        toast('Data user berhasil diubah', 'success');
        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diubah');
    }

    public function destroy($id) {
        \DB::table('users')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
