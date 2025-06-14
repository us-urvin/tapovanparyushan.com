<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sangh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ParyushanEventController extends Controller
{
    public function index()
    {
        return view('admin.paryushan.events.index');
    }

    public function create()
    {
        $sanghs = [];
        if (Auth::user()->hasRole('Admin')) {
            $sanghs = Sangh::where('status', 'accepted')->pluck('sangh_name', 'id')?->toArray();
        }
        return view('admin.paryushan.events.create', compact('sanghs'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['sangh_id'] = $request['sangh_id'] ?? Auth::user()->sangh->id;
            $data['terms_agree'] = $data['terms_agree'] == 'on' ? 1 : 0;
            unset($data['sangh_name']);
            $event = Event::create($data);

            if (isset($request->pdf_document) && !blank($request->pdf_document)) {
                $event->addMediaFromRequest('pdf_document')->toMediaCollection('event_pdf_document');
            }

            DB::commit();
            
            return redirect()->route('sangh.paryushan.events.index')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Event creation failed: ' . $e->getMessage());
            return redirect()->route('sangh.paryushan.events.index')->with('error', 'Event creation failed! Please try again.');
        }
    }

    public function datatable(Request $request)
    {
        $query = Event::with('sangh')
            ->select('events.*');
        
        if (isset($request->event_id) && !blank($request->event_id)) {
            $query->where('event_year', $request->event_id);
        }

        if (isset($request->search) && !blank($request->search)) {
            $query->where('event_year', $request->search);
        }

        return DataTables::of($query)
            ->addColumn('sangh_name', function ($row) {
                if (Auth::user()->hasRole('Admin')) {
                    return $row->sangh->sangh_name ?? 'N/A';
                }
                return 'N/A';
            })
            ->addColumn('event', function ($row) {
                return $row->event_year;
            })
            ->addColumn('email', function ($row) {
                return $row->contact_person['email'] ?? 'N/A';
            })
            ->addColumn('mobile', function ($row) {
                return $row->contact_person['phone'];
            })
            ->addColumn('country', function ($row) {
                return $row->sangh->country ?? 'N/A';
            })
            ->addColumn('status', function ($row) {
                $statusClasses = [
                    0 => 'text-yellow-600 bg-yellow-50',
                    1 => 'text-blue-500 bg-blue-50',
                    2 => 'text-red-500 bg-red-50',
                ];
                $statusClass = $statusClasses[$row->status] ?? 'text-gray-500 bg-gray-50';
                
                if (Auth::user()->hasRole('Admin')) {
                    return '<select class="status-select ' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold" data-id="' . $row->id . '">
                        <option value="0" ' . ($row->status == 0 ? 'selected' : '') . '>Pending</option>
                        <option value="1" ' . ($row->status == 1 ? 'selected' : '') . '>Approved</option>
                        <option value="2" ' . ($row->status == 2 ? 'selected' : '') . '>Rejected</option>
                    </select>';
                }
                
                return '<span class="' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold">' . ucfirst(Constants::EVENT_STATUS[$row->status]) . '</span>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="flex gap-2">
                    <button title="View" class="view-btn cursor-pointer mr-2" data-id="' . $row->id . '">
                        <i class="fa fa-eye text-[#1A2B49] hover:text-[#C9A14A]"></i>
                    </button>
                    <a href="' . route('sangh.paryushan.events.edit', $row->id) . '" title="Edit" class="edit-btn cursor-pointer mr-2">
                        <i class="fa fa-pen text-[#C9A14A] hover:text-[#b38e3c]"></i>
                    </a>
                    <a title="Delete" class="delete-btn cursor-pointer" data-id="' . $row->id . '">
                        <i class="fa fa-trash text-red-500 hover:text-red-700"></i>
                    </a>
                </div>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function updateStatus(Request $request)
    {
        if (!Auth::user()->hasRole('Admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $event = Event::findOrFail($request->id);
            $event->status = $request->status;
            $event->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update status'], 500);
        }
    }

    public function show($id)
    {
        $event = Event::with('sangh')->findOrFail($id);
        return view('admin.paryushan.events.show', compact('event'));
    }

    public function downloadPdf($id)
    {
        $event = Event::with('sangh')->findOrFail($id);
        $logo = public_path('images/logo.png');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.paryushan.events.pdf', compact('event', 'logo'));
        return $pdf->download('event-details-' . $event->id . '.pdf');
    }

    public function edit($id)
    {
        $event = Event::with('sangh')->findOrFail($id);
        $sanghs = [];
        if (Auth::user()->hasRole('Admin')) {
            $sanghs = Sangh::where('status', 'accepted')->pluck('sangh_name', 'id')?->toArray();
        }
        return view('admin.paryushan.events.create', compact('event', 'sanghs'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $event = Event::findOrFail($id);
            $data = $request->except('_token', '_method');
            $data['terms_agree'] = $data['terms_agree'] == 'on' ? 1 : 0;
            unset($data['sangh_name']);
            $event->update($data);
            DB::commit();

            
            if (isset($request->pdf_document)) {
                $event->clearMediaCollection('event_pdf_document');
                $event->addMediaFromRequest('pdf_document')->toMediaCollection('event_pdf_document');
            }

            return redirect()->route('sangh.paryushan.events.index')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Event update failed: ' . $e->getMessage());
            return redirect()->route('sangh.paryushan.events.index')->with('error', 'Event update failed! Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return response()->json(['success' => true, 'message' => 'Event deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Event delete failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete event.'], 500);
        }
    }
} 