<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sangh;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Check if sangh exists for current user
            $sangh = Sangh::where('user_id', Auth::id())->first();

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
                    'pathshala_first_name' => $request->pathshala_first_name,
                    'pathshala_last_name' => $request->pathshala_last_name,
                    'pathshala_email' => $request->pathshala_email,
                    'pathshala_phone' => $request->pathshala_phone,
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
                // Create new sangh
                $sangh = Sangh::create([
                    'user_id' => Auth::id(),
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
                    'pathshala_first_name' => $request->pathshala_first_name,
                    'pathshala_last_name' => $request->pathshala_last_name,
                    'pathshala_email' => $request->pathshala_email,
                    'pathshala_phone' => $request->pathshala_phone,
                    'has_other_sangh' => $request->has_other_sangh,
                    'bus_transportation' => $request->bus_transportation == 'on' ? 1 : 0,
                    'train_transportation' => $request->train_transportation == 'on' ? 1 : 0,
                    'sangh_address' => $request->sangh_address ?? '',
                    'reason_note' => $request->reason_note ?? '',
                    'status' => 'pending',
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
                    $authUser = User::find(Auth::id());  
                    $authUser->mobile = $trustee['phone'];
                    $authUser->email = $trustee['email'];
                    $authUser->name = $trustee['first_name'] . ' ' . $trustee['surname'];
                    $authUser->save();
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

            // Create bus transportations if any
            if ($request->bus_transportation && $request->bus_transport) {
                foreach ($request->bus_transport as $busTransportation) {
                    $sangh->busTransportations()->create([
                        'from' => $busTransportation['from'],
                        'to' => $busTransportation['to'],
                    ]);
                }
            }

            // Create train transportations if any
            if ($request->train_transportation && $request->train_transport) {
                foreach ($request->train_transport as $trainTransportation) {
                    $sangh->trainTransportations()->create([
                        'from' => $trainTransportation['from'],
                        'train_name' => $trainTransportation['train_name'],
                        'to' => $trainTransportation['to'],
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

        return response()->json(['success' => true, 'status' => $user->status]);
    }
}
