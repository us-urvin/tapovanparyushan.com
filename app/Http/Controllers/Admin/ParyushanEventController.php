<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParyushanEventController extends Controller
{
    public function index()
    {
        // For now, just return the view. Data will be added after model is ready.
        return view('admin.paryushan.events.index');
    }

    public function datatable(Request $request)
    {
        // Placeholder data
        $data = collect([
            [
                'sangh_name' => 'Theresa Webb',
                'event' => 'Digambara',
                'email' => 'daniel.miller@info.net',
                'mobile' => '9874563215',
                'country' => 'India',
                'status' => 'accepted',
            ],
            [
                'sangh_name' => 'Annette Black',
                'event' => 'Digambara',
                'email' => 'emily.jones@service.net',
                'mobile' => '8653258963',
                'country' => 'India',
                'status' => 'rejected',
            ],
            [
                'sangh_name' => 'Cameron Williamson',
                'event' => 'Shvetambara',
                'email' => 'chloe.taylor@world.org',
                'mobile' => '9874563215',
                'country' => 'Tokyo',
                'status' => 'accepted',
            ],
            // ... add more rows as needed ...
        ]);

        return DataTables::of($data)
            ->addColumn('status', function ($row) {
                if ($row['status'] === 'accepted') {
                    return '<span class="text-blue-500 bg-blue-50 px-3 py-1 rounded-full text-xs font-semibold">Accepted</span>';
                } elseif ($row['status'] === 'rejected') {
                    return '<span class="text-red-500 bg-red-50 px-3 py-1 rounded-full text-xs font-semibold">Rejected</span>';
                } else {
                    return '<span class="text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>';
                }
            })
            ->addColumn('actions', function ($row) {
                return '<button title="View"><i class="fa fa-eye text-[#1A2B49] hover:text-[#C9A14A]"></i></button>
                        <button title="Edit"><i class="fa fa-pen text-[#C9A14A] hover:text-[#b38e3c]"></i></button>
                        <button title="Delete"><i class="fa fa-trash text-red-500 hover:text-red-700"></i></button>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.paryushan.events.create');
    }
} 