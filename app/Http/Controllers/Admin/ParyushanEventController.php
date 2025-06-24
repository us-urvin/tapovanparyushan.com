<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Event;
use App\Models\Sangh;
use App\Models\EventCenterAssignment;
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
            // Store bhakti_instrument_list as array (JSON)
            if (isset($data['bhakti_instrument_list'])) {
                $data['bhakti_instrument_list'] = array_values(array_filter($data['bhakti_instrument_list']));
            }
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
        $query = Event::with(['sangh', 'centerAssignments'])
            ->select('events.*');

        if (Auth::user()->hasRole('Center')) {
            $center = Auth::user()->center;
            if ($center) {
                $query->whereHas('centerAssignments', function ($q) use ($center) {
                    $q->where('center_id', $center->id);
                });
            } else {
                // If the center user has no center, show nothing
                $query->whereRaw('1=0');
            }
        } elseif (!Auth::user()->hasRole('Admin')) {
            $query->where('sangh_id', Auth::user()->sangh->id);
        }
        
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
            ->addColumn('sub_admin_status', function ($row) {
                if (!Auth::user()->hasRole('Admin')) return '';
                // Find the current assigned center (the one with status pending or accepted, or the latest assignment)
                $currentAssignment = $row->centerAssignments->whereIn('status', ['pending', 'accepted'])->sortByDesc('assigned_at')->first();
                if (!$currentAssignment) {
                    $currentAssignment = $row->centerAssignments->sortByDesc('assigned_at')->first();
                }
                if (!$currentAssignment) {
                    return '<span class="text-gray-400">-</span>';
                }
                $status = $currentAssignment->status;
                $centerName = $currentAssignment->center ? $currentAssignment->center->center_name : '-';
                $dotColor = $status === 'accepted' ? 'bg-green-500' : ($status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500');
                $label = ucfirst($status);
                return '<span class="inline-flex items-center gap-1"><span class="w-3 h-3 rounded-full ' . $dotColor . ' inline-block"></span> <span class="font-semibold">' . $centerName . ' - ' . $label . '</span></span>';
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
                    'pending' => 'text-yellow-600 bg-yellow-50',
                    'accepted' => 'text-blue-500 bg-blue-50',
                    'rejected' => 'text-red-500 bg-red-50',
                    0 => 'text-yellow-600 bg-yellow-50',
                    1 => 'text-blue-500 bg-blue-50',
                    2 => 'text-red-500 bg-red-50',
                ];
                $user = Auth::user();
                if ($user->hasRole('Center')) {
                    $center = $user->center;
                    $assignment = $row->centerAssignments->where('center_id', $center->id)->first();
                    $assignStatus = $assignment ? $assignment->status : 'pending';
                    $statusClass = $statusClasses[$assignStatus] ?? 'text-gray-500 bg-gray-50';
                    return '<select class="assignment-status-select ' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold" data-event-id="' . $row->id . '">
                        <option value="pending" ' . ($assignStatus == 'pending' ? 'selected' : '') . '>Pending</option>
                        <option value="accepted" ' . ($assignStatus == 'accepted' ? 'selected' : '') . '>Approved</option>
                        <option value="rejected" ' . ($assignStatus == 'rejected' ? 'selected' : '') . '>Rejected</option>
                    </select>';
                }
                $statusClass = $statusClasses[$row->status] ?? 'text-gray-500 bg-gray-50';
                if ($user->hasRole('Admin')) {
                    return '<select class="status-select ' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold" data-id="' . $row->id . '">
                        <option value="0" ' . ($row->status == 0 ? 'selected' : '') . '>Pending</option>
                        <option value="1" ' . ($row->status == 1 ? 'selected' : '') . '>Approved</option>
                        <option value="2" ' . ($row->status == 2 ? 'selected' : '') . '>Rejected</option>
                    </select>';
                }
                return '<span class="' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold">' . ucfirst(\App\Constants\Constants::STATUS[$row->status]) . '</span>';
            })
            ->addColumn('assign_sub_admin', function ($row) {
                if (!Auth::user()->hasRole('Admin')) return '';
                if ($row->status != 1) {
                    return '<span class="text-gray-400">-</span>';
                }
                $centers = \App\Models\Center::where('status', 1)->pluck('id', 'center_name');
                $options = '<option value="">Assign To Sub Admin</option>';
                foreach ($centers as $center => $id) {
                    $assignment = $row->centerAssignments->where('center_id', $id)->first();
                    $selected = ($assignment && in_array($assignment->status, ['pending','accepted'])) ? 'selected' : '';
                    $options .= '<option value="' . $id . '" ' . $selected . '>' . $center . '</option>';
                }
                return '<select class="assign-to-listing bg-white border border-[#F3E6C7] px-2 py-1 rounded focus:ring-2 focus:ring-[#C9A14A] focus:outline-none transition" data-id="' . $row->id . '">' . $options . '</select>';
            })
            ->addColumn('actions', function ($row) {
                if (Auth::user()->hasRole('Center')) {
                    return '<div class="flex gap-2">
                        <button title="View" class="view-btn cursor-pointer mr-2" data-id="' . $row->id . '">
                            <i class="fa fa-eye text-[#1A2B49] hover:text-[#C9A14A]"></i>
                        </button>
                    </div>';
                }
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
            ->rawColumns(['status', 'actions', 'sub_admin_status', 'assign_sub_admin'])
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
            // If event is not approved, delete all center assignments
            if ($event->status != 1) {
                \App\Models\EventCenterAssignment::where('event_id', $event->id)->delete();
            }

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update status'], 500);
        }
    }

    public function show($id)
    {
        $event = Event::with('sangh')->findOrFail($id);
        $centers = Center::where('status', 1)->pluck('id', 'center_name');
        return view('admin.paryushan.events.show', compact('event', 'centers'));
    }

    public function downloadPdf($id)
    {
        $event = Event::with('sangh')->findOrFail($id);
        $media = $event->getFirstMedia('event_pdf_document');
        
        if (!$media) {
            return redirect()->back()->with('error', 'PDF document not found.');
        }

        return response()->download($media->getPath(), $media->file_name);
        // $logo = public_path('images/logo.png');
        // $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.paryushan.events.pdf', compact('event', 'logo'));
        // return $pdf->download('event-details-' . $event->id . '.pdf');
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
            // Store bhakti_instrument_list as array (JSON)
            if (isset($data['bhakti_instrument_list'])) {
                $data['bhakti_instrument_list'] = array_values(array_filter($data['bhakti_instrument_list']));
            }
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

    // Assign or reassign an event to a center
    public function assignToCenter(Request $request, $eventId)
    {
        $request->validate([
            'center_id' => 'required|exists:centers,id',
        ]);
        $event = Event::findOrFail($eventId);
        // Delete any existing assignments for this event with status 'pending'
        \App\Models\EventCenterAssignment::where('event_id', $event->id)
            ->where('status', 'pending')
            ->delete();
        EventCenterAssignment::create([
            'event_id' => $event->id,
            'center_id' => $request->center_id,
            'assigned_by' => auth()->id(),
            'status' => 'pending',
            'assigned_at' => now(),
        ]);
        return back()->with('success', 'Event assigned to center successfully.');
    }

    // View assignment history for an event
    public function assignmentHistory($eventId)
    {
        $event = Event::with(['centerAssignments.center.user', 'centerAssignments.assignedBy'])->findOrFail($eventId);
        return view('admin.paryushan.events.assignment-history', compact('event'));
    }

    public function updateAssignmentStatus(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'status' => 'required|in:pending,accepted,rejected',
        ]);
        $user = Auth::user();
        if (!$user->hasRole('Center')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        $center = $user->center;
        if (!$center) {
            return response()->json(['success' => false, 'message' => 'No center found for user'], 404);
        }
        $assignment = \App\Models\EventCenterAssignment::where('event_id', $request->event_id)
            ->where('center_id', $center->id)
            ->first();
        if (!$assignment) {
            return response()->json(['success' => false, 'message' => 'Assignment not found'], 404);
        }
        $assignment->status = $request->status;
        $assignment->responded_at = now();
        $assignment->save();
        return response()->json(['success' => true, 'message' => 'Assignment status updated successfully']);
    }
} 