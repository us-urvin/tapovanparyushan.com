<!-- Step 3 Content -->
<div class="step-content hidden" data-step="3">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Regarding Pravachan</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">What is the prefered language for pravachan?</label>
                    <input type="text" name="pravachan_language" placeholder="Gujarati" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]"
                    value="{{ old('pravachan_language', $event->pravachan_language ?? '') }}">
                </div>
            </div>
        </div>
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Regarding Pratikraman</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there a sangh member proficient in performing the 5 pratikraman with kriya? <span class="text-red-500">*</span></label>
                    <select name="pratikraman_proficient" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1" {{ old('pratikraman_proficient', $event->pratikraman_proficient ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('pratikraman_proficient', $event->pratikraman_proficient ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Will they remain present during the paryushan?</label>
                    <select name="pratikraman_present" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]">
                        <option value="1" {{ old('pratikraman_present', $event->pratikraman_present ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('pratikraman_present', $event->pratikraman_present ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">How Many? <span class="text-red-500">*</span></label>
                    <input type="number" name="pratikraman_how_many" placeholder="" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required
                    value="{{ old('pratikraman_how_many', $event->pratikraman_how_many ?? '') }}">
                </div>
            </div>
        </div>
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Regarding Bhakti/Bhavana</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Does shree sangh arrange for professional musicians during paryushan? <span class="text-red-500">*</span></label>
                    <select name="bhakti_musicians" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1" {{ old('bhakti_musicians', $event->bhakti_musicians ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('bhakti_musicians', $event->bhakti_musicians ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Does shree sangh have any bhakti group of youngsters which perform bhakti/bhavana occasionally? <span class="text-red-500">*</span></label>
                    <select name="bhakti_group" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1" {{ old('bhakti_group', $event->bhakti_group ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('bhakti_group', $event->bhakti_group ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Does shree sangh have any musical instruments? <span class="text-red-500">*</span></label>
                    <select name="bhakti_instruments" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="1" {{ old('bhakti_instruments', $event->bhakti_instruments ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('bhakti_instruments', $event->bhakti_instruments ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Select the instrument that shree sangh have <span class="text-red-500">*</span></label>
                    <input type="text" name="bhakti_instrument_list" placeholder="" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required
                    value="{{ old('bhakti_instrument_list', $event->bhakti_instrument_list ?? '') }}">
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition cursor-pointer">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition cursor-pointer">Next</button>
        </div>
    </div>
</div> 