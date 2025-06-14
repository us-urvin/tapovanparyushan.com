<!-- Step 1: Sangh Details & Other Sangh Details -->
<div class="step-content" data-step="1">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Sangh Details</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(Auth::user()->hasRole('Admin'))
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Select Sangh <span class="text-red-500">*</span></label>
                        <select name="sangh_id" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                            <option value="">Select Sangh</option>
                            @foreach($sanghs as $id => $name)
                                <option value="{{ $id }}" {{ (old('sangh_id', $event->sangh_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div>
                        <label class="block text-[#1A2B49] text-sm font-medium mb-1">Name Of Shree Sangh <span class="text-red-500">*</span></label>
                        <input type="text" name="sangh_name" value="{{ Auth::user()->sangh->sangh_name }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" readonly>
                    </div>
                @endif
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Event <span class="text-red-500">*</span></label>
                    <select name="event_year" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="">Select Year</option>
                        @foreach(App\Constants\Constants::EVENT_YEAR as $year => $label)
                            <option value="{{ $year }}" {{ old('event_year', $event->event_year ?? '') == $year ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
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
                        <option value="1" {{ old('has_other_sangh', $event->has_other_sangh ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_other_sangh', $event->has_other_sangh ?? '') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">No. Of Jain Families <span class="text-red-500">*</span></label>
                    <input type="number" name="jain_family_count" value="{{ old('jain_family_count', $event->jain_family_count ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">No. Of Members <span class="text-red-500">*</span></label>
                    <input type="number" name="member_count" value="{{ old('member_count', $event->member_count ?? '') }}" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Are they celebrate/willing to celebrate paryushan with us? <span class="text-red-500">*</span></label>
                    <select name="willing_to_celebrate" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1" {{ old('willing_to_celebrate', $event->willing_to_celebrate ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('willing_to_celebrate', $event->willing_to_celebrate ?? '') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition cursor-pointer">Next</button>
        </div>
    </div>
</div> 