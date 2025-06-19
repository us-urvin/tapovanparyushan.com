<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CenterController extends Controller
{
    public function index()
    {
        return view('admin.centers.index');
    }

    public function datatable(Request $request)
    {
        $query = Center::with('user')->whereNull('deleted_at');
        return DataTables::of($query)
            ->addColumn('name', function ($center) {
                return $center->user->name ?? '';
            })
            ->addColumn('email', function ($center) {
                return $center->user->email ?? '';
            })
            ->addColumn('mobile', function ($center) {
                return $center->user->mobile ?? '';
            })
            ->addColumn('actions', function ($center) {
                return view('admin.centers.partials.actions', compact('center'))->render();
            })
            ->addColumn('status_dropdown', function ($center) {
                $statusClasses = [
                    0 => 'text-red-500 bg-red-50',
                    1 => 'text-green-500 bg-green-50',
                ];
                $statusClass = $statusClasses[$center->status] ?? 'text-gray-500 bg-gray-50';
                return '<select class="status-select ' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold statusDropdown" data-center-id="' . $center->id . '">
                    <option value="1" ' . ($center->status == 1 ? 'selected' : '') . '>Active</option>
                    <option value="0" ' . ($center->status == 0 ? 'selected' : '') . '>Inactive</option>
                </select>';
            })
            ->rawColumns(['actions', 'status_dropdown'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:20|unique:users,mobile',
            'center_name' => 'required|string|max:255|unique:centers,center_name',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();
        try {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make('password'),
                'status' => 2,
            ]);
            $user->assignRole('Center');
            $center = Center::create([
                'user_id' => $user->id,
                'center_name' => $request->center_name,
                'status' => 1,
            ]);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create center.'], 500);
        }
    }

    public function update(Request $request, Center $center)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:users,mobile,' . $center->user_id,
            'center_name' => 'required|string|max:255|unique:centers,center_name,' . $center->id,
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        try {
            $user = $center->user;
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->save();
            $center->update([
                'center_name' => $request->center_name,
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update center.'], 500);
        }
    }

    public function changeStatus(Request $request, Center $center)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);
        $center->status = $request->status;
        $center->save();
        return response()->json(['success' => true, 'status' => $center->status]);
    }
} 