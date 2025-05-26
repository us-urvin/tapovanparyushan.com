<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SanghController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sangh.index');
    }

    public function datatable(Request $request)
    {
        $query = User::whereHas('roles', function($q) {
            $q->where('name', 'Shangh');
        })->whereNull('deleted_at');

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('shangh_name', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($user) {
                return view('admin.sangh.partials.actions', compact('user'))->render();
            })
            ->addColumn('status_dropdown', function ($user) {
                return view('admin.sangh.partials.status_dropdown', compact('user'))->render();
            })
            ->rawColumns(['actions', 'status_dropdown'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
