<!-- Step 2 Content -->
<div class="step-content hidden" data-step="2">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <!-- Jain Family Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Jain Family Information In Shree Sangh</div>
            <input type="number" name="jain_family_count" placeholder="No. Of Jain Families In Shree Sangh" class="w-full bg-white border {{ $errors->has('jain_family_count') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] text-[#1A2B49] text-sm font-medium" required
                value="{{ old('jain_family_count', $sangh->jain_family_count ?? '') }}">
        </div>

        <hr class="my-8 border-[#F3E6C7]">
        <!-- Age-wise Distribution Of Members -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Age-wise Distribution Of Members</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg" id="ageDistributionTable">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Age Group</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No. Of Members <span class="text-red-500">*</span></th>
                            <th class="py-2 text-center text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle px-2 py-1">1</td>
                            <td class="px-2 py-1">0-20 YEARS</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[0_20]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                value="{{ old('age_group.0_20', $sangh->age_group['0_20'] ?? '') }}">
                            </td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">2</td>
                            <td class="px-2 py-1">21-40 YEARS</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[21_40]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                value="{{ old('age_group.21_40', $sangh->age_group['21_40'] ?? '') }}">
                            </td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">3</td>
                            <td class="px-2 py-1">41-60 YEARS</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[41_60]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                value="{{ old('age_group.41_60', $sangh->age_group['41_60'] ?? '') }}">
                            </td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">4</td>
                            <td class="px-2 py-1">60 YEARS +</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[60_plus]" class="w-full bg-white border {{ $errors->has('age_group.60_plus') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                value="{{ old('age_group.60_plus', $sangh->age_group['60_plus'] ?? '') }}">
                            </td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1"></td>
                            <td class="px-2 py-1">Total</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[total]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                value="{{ old('age_group.total', $sangh->age_group['total'] ?? '') }}" readonly>
                            </td>
                            <td class="text-center px-2 py-1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="my-8 border-[#F3E6C7]">
        <!-- Pathshala Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Pathshala Information</div>
            <div class="mb-4">
                <label class="block text-[#1A2B49] text-sm font-medium mb-1">Does shree sangh have pathshala?</label>
                <select name="has_pathshala" class="pathshala-select w-full bg-white border {{ $errors->has('has_pathshala') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    <option value=1 {{ old('has_pathshala', $sangh->has_pathshala) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value=0 {{ old('has_pathshala', $sangh->has_pathshala) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <!-- Teacher's Details will be toggled by JS -->
            <div id="teachersDetailsSection" style="display:none">
                <div class="mb-2 text-[#1A2B49] text-sm font-semibold">Teacher's Details</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="pathshala_first_name" placeholder="First name" class="w-full bg-white border {{ $errors->has('pathshala_first_name') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                            value="{{ old('pathshala_first_name', $sangh->pathshala_first_name ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="pathshala_last_name" placeholder="Last name" class="w-full bg-white border {{ $errors->has('pathshala_last_name') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                            value="{{ old('pathshala_last_name', $sangh->pathshala_last_name ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="pathshala_email" placeholder="Email Address" class="w-full bg-white border {{ $errors->has('pathshala_email') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                            value="{{ old('pathshala_email', $sangh->pathshala_email ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" name="pathshala_phone" placeholder="Phone Number" class="w-full bg-white border {{ $errors->has('pathshala_phone') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                            value="{{ old('pathshala_phone', $sangh->pathshala_phone ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-8 border-[#F3E6C7]">
        <!-- Other Sangh Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Other Sangh Information</div>
            <div class="mb-4">
                <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any other jain sangh in your city / village? <span class="text-red-500">*</span></label>
                <select name="has_other_sangh" class="other-sangh-exists-select w-full bg-white border {{ $errors->has('has_other_sangh') ? 'border-red-500' : 'border-[#F3E6C7]' }} rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    <option value=1 {{ old('has_other_sangh', $sangh->has_other_sangh) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value=0 {{ old('has_other_sangh', $sangh->has_other_sangh) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div id="otherSanghTableSection">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm bg-[#F8F5ED] rounded-lg" id="otherSanghTable">
                        <thead>
                            <tr class="border-b border-[#F3E6C7]">
                                <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                                <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Select any Particulars</th>
                                <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No. Of Jain Families</th>
                                <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No. Of Members</th>
                                <th class="py-2 text-center text-[#1A2B49] text-sm font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="otherSanghTbody">
                            @if(isset($sangh->has_other_sangh) && count($sangh->otherSanghs) > 0)
                                @foreach($sangh->otherSanghs as $index => $otherSangh)
                                    <tr>
                                        <td class="text-center align-middle px-2 py-1">{{ $index + 1 }}</td>
                                                <td class="px-2 py-1">
                                            <select name="other_sanghs[{{$index }}][particulars]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                                                @foreach(App\Constants\Constants::PARTICULARS as $key => $particular)
                                                    <option value="{{ $key }}" {{ old('other_sanghs.'.$index.'.particulars', $otherSangh->particulars) == $key ? 'selected' : '' }}>{{ $particular }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-2 py-1">
                                            <input type="number" name="other_sanghs[{{$index }}][family_count]" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                                value="{{ old('other_sanghs.'.$index.'.family_count', $otherSangh->no_of_jain_families) }}">
                                        </td>
                                        <td class="px-2 py-1">
                                            <input type="number" name="other_sanghs[{{$index }}][member_count]" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                                value="{{ old('other_sanghs.'.$index.'.member_count', $otherSangh->no_of_members) }}">
                                        </td>
                                        <td class="text-center px-2 py-1">
                                            <button type="button" class="deleteOtherSanghRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center align-middle px-2 py-1">1</td>
                                    <td class="px-2 py-1">
                                    <select name="other_sanghs[0][particulars]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                                        @foreach(App\Constants\Constants::PARTICULARS as $key => $particular)
                                            <option value="{{ $key }}">{{ $particular }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-2 py-1">
                                    <input type="number" name="other_sanghs[0][family_count]" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="number" name="other_sanghs[0][member_count]" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="">
                                </td>
                                <td class="text-center px-2 py-1">
                                    <button type="button" class="deleteOtherSanghRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Add Row button for JS -->
                <button type="button" id="addOtherSanghRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
            </div>
        </div>

        <hr class="my-8 border-[#F3E6C7]">

        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Next</button>
        </div>
    </div>
</div>