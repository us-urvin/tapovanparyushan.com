<!-- Step 2 Content -->
<div class="step-content hidden">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <!-- Jain Family Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Jain Family Information In Shree Sangh</div>
            <input type="number" name="jain_family_count" placeholder="No. Of Jain Families In Shree Sangh" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] text-[#1A2B49] text-sm font-medium" required>
        </div>

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
                            <td class="px-2 py-1"><input type="number" name="age_group[0_20]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">2</td>
                            <td class="px-2 py-1">21-40 YEARS</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[21_40]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">3</td>
                            <td class="px-2 py-1">41-60 YEARS</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[41_60]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1">4</td>
                            <td class="px-2 py-1">60 YEARS +</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[60_plus]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteAgeRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle px-2 py-1"></td>
                            <td class="px-2 py-1">Total</td>
                            <td class="px-2 py-1"><input type="number" name="age_group[total]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium" readonly></td>
                            <td class="text-center px-2 py-1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pathshala Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Pathshala Information</div>
            <div class="mb-4">
                <label class="block text-[#1A2B49] text-sm font-medium mb-1">Does shree sangh have pathshala?</label>
                <select name="has_pathshala" class="pathshala-select w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    <option value="Yes">Yes</option>
                    <option value="No" selected>No</option>
                </select>
            </div>
            <!-- Teacher's Details will be toggled by JS -->
            <div id="teachersDetailsSection" style="display:none">
                <div class="mb-2 text-[#1A2B49] text-sm font-semibold">Teacher's Details</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="teacher_first_name" placeholder="First name" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="teacher_last_name" placeholder="Last name" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="teacher_email" placeholder="Email Address" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" name="teacher_phone" placeholder="Phone Number" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Sangh Information -->
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Other Sangh Information</div>
            <div class="mb-4">
                <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any other jain sangh in your city / village? <span class="text-red-500">*</span></label>
                <select name="other_sangh_exists" class="other-sangh-exists-select w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                    <option value="Yes">Yes</option>
                    <option value="No" selected>No</option>
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
                            <tr>
                                <td class="text-center align-middle px-2 py-1">1</td>
                                <td class="px-2 py-1">
                                    <select name="other_sangh_particulars[]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                                        <option value="Shanahavaksi">Shanahavaksi</option>
                                    </select>
                                </td>
                                <td class="px-2 py-1">
                                    <input type="number" name="other_sangh_family_count[]" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="number" name="other_sangh_member_count[]" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium">
                                </td>
                                <td class="text-center px-2 py-1">
                                    <button type="button" class="deleteOtherSanghRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Add Row button for JS -->
                <button type="button" id="addOtherSanghRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
            </div>
        </div>

        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Next</button>
        </div>
    </div>
</div> 