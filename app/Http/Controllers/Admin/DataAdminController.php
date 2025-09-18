<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('user')->get();
        $data = [
            'content' => 'admin.dataAdmin.index',
            'title' => 'Data Admin',
            'admins' => $admins
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'content' => 'admin.dataAdmin.create',
            'title' => 'Tambah Admin'
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // Custom rule: username dan email tidak boleh sama
        $validator->after(function ($validator) use ($request) {
            if ($request->username === $request->email) {
                $validator->errors()->add('email', 'Email tidak boleh sama dengan Username.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        // Create admin
        Admin::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.dataAdmin.index')->with('success', 'Admin berhasil ditambahkan!');
    }


    public function show($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        $data = [
            'content' => 'admin.dataAdmin.show',
            'title' => 'Detail Admin',
            'admin' => $admin
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function edit($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        $data = [
            'content' => 'admin.dataAdmin.edit',
            'title' => 'Edit Admin',
            'admin' => $admin
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::with('user')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users,username,' . $admin->user->id,
            'email' => 'required|string|email|max:100|unique:users,email,' . $admin->user->id,
            'password' => 'nullable|string|min:8',
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user
        $admin->user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->user->password,
        ]);

        // Update admin
        $admin->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.dataAdmin.index')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete(); // This will also delete the user due to ON DELETE CASCADE
        return redirect()->route('admin.dataAdmin.index')->with('success', 'Admin berhasil dihapus!');
    }
}
