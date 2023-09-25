<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    // Menampilkan halaman pengguna
    public function index()
    {
        $setting = Setting::first();

        return view('admin.pengguna.index', compact('setting'));
    }

    // Proses menampilkan data pengguna dengan datatables
    public function listData()
    {
        $data = User::where('role', 'pengguna');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.pengguna.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menghapus pengguna
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.pengguna')->with('berhasil', 'Berhasil menghapus pengguna.');
    }
}
