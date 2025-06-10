<!-- Step 1 Content -->
<div class="step-content" data-step="1">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Sangh Details</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Name Of Shree Sangh <span class="text-red-500">*</span></label>
                    <input type="text" name="sangh_name" placeholder="Name Of Shree Sangh" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Event <span class="text-red-500">*</span></label>
                    <select name="event" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1">Event</option>
                        <!-- Populate with event options -->
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Other Sangh Details</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any other Jain Sangh in your city/village? <span class="text-red-500">*</span></label>
                    <select name="has_other_sangh" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">No. Of Jain Families <span class="text-red-500">*</span></label>
                    <input type="number" name="jain_family_count" placeholder="No. of jain families" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">No. Of Members <span class="text-red-500">*</span></label>
                    <input type="number" name="member_count" placeholder="No. of members" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Are they celebrate/willing to celebrate paryushan with us? <span class="text-red-500">*</span></label>
                    <select name="willing_to_celebrate" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Next</button>
        </div>
    </div>
</div> 