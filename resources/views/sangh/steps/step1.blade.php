<!-- Step 1 Content -->
<div class="step-content">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <!-- Basic Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Basic Information</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Name Of Shree Sangh <span class="text-red-500">*</span></label>
                    <input type="text" name="sangh_name" placeholder="Name Of Shree Sangh" value="{{ old('sangh_name', $sangh->sangh_name) }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Shree Sangh Type <span class="text-red-500">*</span></label>
                    <select name="sangh_type" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] text-[#1A2B49]" required>
                        <option value="">Select Type</option>
                        <option value="Type 1" {{ (old('sangh_type', $sangh->sangh_type ?? '') == 'Type 1') ? 'selected' : '' }}>Type 1</option>
                        <option value="Type 2" {{ (old('sangh_type', $sangh->sangh_type ?? '') == 'Type 2') ? 'selected' : '' }}>Type 2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email', $user->email) }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="mobile" placeholder="Phone Number" value="{{ old('mobile', $user->mobile) }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="same_whatsapp" name="same_whatsapp" class="rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A] mr-2">
                        <label for="same_whatsapp" class="text-[#1A2B49] text-xs">Same for Whatsapp Number</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Address -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Current Address</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Building / Flat / Apartment / Plot No. <span class="text-red-500">*</span></label>
                    <input type="text" name="building_no" placeholder="Building / Flat / Apartment / Plot No." value="{{ old('building_no', $sangh->building_no ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Building / Flat / Apartment Name <span class="text-red-500">*</span></label>
                    <input type="text" name="building_name" placeholder="Building / Flat / Apartment Name" value="{{ old('building_name', $sangh->building_name ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Locality Area <span class="text-red-500">*</span></label>
                    <input type="text" name="locality" placeholder="Locality Area" value="{{ old('locality', $sangh->locality ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Nearby Landmark <span class="text-red-500">*</span></label>
                    <input type="text" name="landmark" placeholder="Nearby Landmark" value="{{ old('landmark', $sangh->landmark ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Pincode <span class="text-red-500">*</span></label>
                    <input type="text" name="pincode" placeholder="Pincode" value="{{ old('pincode', $user->pincode) }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">District <span class="text-red-500">*</span></label>
                    <input type="text" name="district" placeholder="District" value="{{ old('district', $sangh->district ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">State <span class="text-red-500">*</span></label>
                    <input type="text" name="state" placeholder="State" value="{{ old('state', $sangh->state ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Country <span class="text-red-500">*</span></label>
                    <input type="text" name="country" placeholder="Country" value="{{ old('country', $sangh->country ?? 'India') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] " required>
                </div>
            </div>
        </div>

        <!-- Trustees Details -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Trustee's Details</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg" id="trusteesTable">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">First Name <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Surname <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Phone No. <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Position Held <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Email <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="trusteesTbody">
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td>
                                <input type="text" name="trustees[0][first_name]" placeholder="First Name"
                                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            </td>
                            <td>
                                <input type="text" name="trustees[0][surname]" placeholder="Surname"
                                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            </td>
                            <td>
                                <input type="text" name="trustees[0][phone]" placeholder="Phone No."
                                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            </td>
                            <td>
                                <input type="text" name="trustees[0][position]" placeholder="Position Held"
                                    class="w-60 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            </td>
                            <td>
                                <input type="email" name="trustees[0][email]" placeholder="Email"
                                    class="w-48 bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 my-1 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            </td>
                            <td>
                                <div class="flex gap-2 justify-center items-center min-h-[40px]">
                                    <button type="button" class="deleteTrusteeBtn text-red-500 hover:text-red-700 flex items-center" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addTrusteeBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
        </div>

        <div class="flex justify-end mt-8">
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Next</button>
        </div>
    </div>
</div> 