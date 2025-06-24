<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Sangh;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

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
        })
        ->whereNull('deleted_at')
        ->with('sangh');

        if ($search = $request->input('search')) {
            $query->whereHas('sangh', function($q) use ($search) {
                $q->where('sangh_name', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('sangh_name', function ($user) {
                return $user->sangh ? $user->sangh->sangh_name : '';
            })
            ->addColumn('actions', function ($user) {
                return view('admin.sangh.partials.actions', compact('user'))->render();
            })
            ->addColumn('status_dropdown', function ($user) {
                $statusClasses = [
                    'pending' => 'text-yellow-600 bg-yellow-50',
                    'accepted' => 'text-blue-500 bg-blue-50',
                    'rejected' => 'text-red-500 bg-red-50',
                ];
                $statusClass = $statusClasses[$user->status] ?? 'text-gray-500 bg-gray-50';
                
                if (Auth::user()->hasRole('Admin')) {
                    return '<select class="status-select ' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold statusDropdown" data-user-id="' . $user->id . '">
                        <option value="pending" ' . ($user->status === 'pending'  ? 'selected' : '') . '>Pending</option>
                        <option value="accepted" ' . ($user->status === 'accepted' ? 'selected' : '') . '>Approved</option>
                        <option value="rejected" ' . ($user->status === 'rejected' ? 'selected' : '') . '>Rejected</option>
                    </select>';
                }
                
                return '<span class="' . $statusClass . ' px-3 py-1 rounded-full text-xs font-semibold">' . ucfirst(Constants::STATUS[$user->status]) . '</span>';
            })
            ->rawColumns(['actions', 'status_dropdown'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new \App\Models\User();
        $sangh = new \App\Models\Sangh();
        return view('sangh.edit', compact('user', 'sangh'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Check if sangh exists for current user
            $sangh = Sangh::where('id', $request->sangh_id)->first();

            if ($sangh) {
                // Update existing sangh
                $sangh->update([
                    'sangh_name' => $request->sangh_name,
                    'sangh_type' => $request->sangh_type,
                    'sangh_email' => $request->sangh_email,
                    'sangh_mobile' => $request->sangh_mobile,
                    'whatsapp' => $request->whatsapp == 'on' ? 1 : 0,
                    'building_no' => $request->building_no,
                    'building_name' => $request->building_name,
                    'locality' => $request->locality,
                    'landmark' => $request->landmark,
                    'pincode' => $request->pincode,
                    'district' => $request->district,
                    'state' => $request->state,
                    'country' => $request->country,
                    'jain_family_count' => $request->jain_family_count,
                    'age_group' => $request->age_group,
                    'has_pathshala' => $request->has_pathshala,
                    'has_other_sangh' => $request->has_other_sangh,
                    'bus_transportation' => $request->bus_transportation == 'on' ? 1 : 0,
                    'train_transportation' => $request->train_transportation == 'on' ? 1 : 0,
                    'sangh_address' => $request->sangh_address ?? '',
                    'reason_note' => $request->reason_note ?? '',
                ]);

                // Delete existing related records
                $sangh->trustees()->delete();
                $sangh->otherSanghs()->delete();
                $sangh->busTransportations()->delete();
                $sangh->trainTransportations()->delete();
            } else {
                $user = User::create([
                    'name' => $request->trustees[0]['first_name'] . ' ' . $request->trustees[0]['surname'],
                    'email' => $request->trustees[0]['email'],
                    'mobile' => $request->trustees[0]['phone'],
                    'pincode' => $request->pincode,
                    'password' => Hash::make('password'),
                    'status' => 'pending',
                ]);

                $user->assignRole('Shangh');
                
                // Create new sangh
                $sangh = Sangh::create([
                    'user_id' => $user->id,
                    'sangh_name' => $request->sangh_name,
                    'sangh_type' => $request->sangh_type,
                    'sangh_email' => $request->sangh_email,
                    'sangh_mobile' => $request->sangh_mobile,
                    'whatsapp' => $request->whatsapp == 'on' ? 1 : 0,
                    'building_no' => $request->building_no,
                    'building_name' => $request->building_name,
                    'locality' => $request->locality,
                    'landmark' => $request->landmark,
                    'pincode' => $request->pincode,
                    'district' => $request->district,
                    'state' => $request->state,
                    'country' => $request->country,
                    'jain_family_count' => $request->jain_family_count,
                    'age_group' => $request->age_group,
                    'has_pathshala' => $request->has_pathshala,
                    'has_other_sangh' => $request->has_other_sangh,
                    'bus_transportation' => $request->bus_transportation == 'on' ? 1 : 0,
                    'train_transportation' => $request->train_transportation == 'on' ? 1 : 0,
                    'sangh_address' => $request->sangh_address ?? '',
                    'reason_note' => $request->reason_note ?? '',
                ]);
            }

            // Create trustees
            foreach ($request->trustees as $key => $trustee) {
                $sangh->trustees()->create([
                    'first_name' => $trustee['first_name'],
                    'last_name' => $trustee['surname'],
                    'designation' => $trustee['position'],
                    'phone' => $trustee['phone'],
                    'email' => $trustee['email'],
                ]);

                if ($key == 0) {
                    $sangh->user->update([  
                        'mobile' => $trustee['phone'],
                        'email' => $trustee['email'],
                        'name' => $trustee['first_name'] . ' ' . $trustee['surname'],
                        'pincode' => $request->pincode,
                    ]);
                }
            }

            // Create other sanghs if any
            if ($request->has_other_sangh && $request->other_sanghs) {
                foreach ($request->other_sanghs as $otherSangh) {
                    $sangh->otherSanghs()->create([
                        'particulars' => $otherSangh['particulars'],
                        'no_of_members' => $otherSangh['family_count'],
                        'no_of_jain_families' => $otherSangh['member_count'],
                    ]);
                }
            }

            if ($request->bus_transportation && $request->bus_transport) {
                foreach ($request->bus_transport as $busTransportation) {
                    $sangh->busTransportations()->create([
                        'from' => $busTransportation['from'],
                        'to' => $busTransportation['to'],
                        'bus_name' => $busTransportation['bus_name'],
                    ]);
                }
            }

            if ($request->train_transportation && $request->train_transport) {
                foreach ($request->train_transport as $trainTransportation) {
                    $sangh->trainTransportations()->create([
                        'from' => $trainTransportation['from'],
                        'train_name' => $trainTransportation['train_name'],
                        'train_number' => $trainTransportation['train_number'] ?? null,
                        'to' => $trainTransportation['to'],
                    ]);
                }
            }

            // Remove old teachers and add new ones if has_pathshala
            $sangh->pathshalaTeachers()->delete();
            if ($request->has_pathshala && $request->teachers) {
                foreach ($request->teachers as $teacher) {
                    $sangh->pathshalaTeachers()->create([
                        'first_name' => $teacher['first_name'],
                        'last_name' => $teacher['last_name'],
                        'email' => $teacher['email'],
                        'phone' => $teacher['phone'],
                    ]);
                }
            }

            DB::commit();
 
            return redirect()->route('sangh.profile')
                ->with('success', 'Sangh profile updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving sangh profile: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while saving the sangh profile. Please try again.');
        }
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
     * Remove the specified resource from storage (soft delete user and sangh).
     */
    public function destroy(User $user)
    {
        if ($user->sangh) {
            $user->sangh->delete();
        }
        $user->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Change the status of the sangh profile.
     */
    public function changeStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $user->status = $request->status;
        $user->save();

        Sangh::where('user_id', $user->id)->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $user->status]);
    }

    /**
     * Admin view of a sangh profile.
     */
    public function adminView(User $user)
    {
        $sangh = $user->sangh;
        // You can eager load more relations if needed
        return view('admin.sangh.view', compact('user', 'sangh'));
    }

    /**
     * Admin edit of a sangh profile.
     */
    public function adminEdit(User $user)
    {
        $sangh = $user->sangh;
        // Load any relations as needed
        return view('sangh.edit', compact('user', 'sangh'));
    }

    /**
     * Download Sangh details as PDF.
     */
    public function downloadPdf(User $user)
    {
        $sangh = $user->sangh;
        $media = $sangh->getFirstMedia('sangh_pdf_document');
        
        if (!$media) {
            return redirect()->back()->with('error', 'PDF document not found.');
        }

        return response()->download($media->getPath(), $media->file_name);
        // $pdf = Pdf::loadView('admin.sangh.pdf', compact('user', 'sangh'));
        // return $pdf->download('sangh-profile-' . $user->id . '.pdf');
    }
}
