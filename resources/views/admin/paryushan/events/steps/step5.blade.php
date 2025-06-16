<!-- Step 5 Content -->
<div class="step-content hidden" data-step="5">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#1A2B49] mb-4">Regarding Mahatma</div>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any sadhu - bhagavant located within a 5-10 km radius from our shree sangh? <span class="text-red-500">*</span></label>
                    <select name="mahatma_sadhu" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="0" {{ old('mahatma_sadhu', $event->mahatma_sadhu ?? '') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('mahatma_sadhu', $event->mahatma_sadhu ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any sadhviji - bhagavant located within a 5-10 km radius from our shree sangh? <span class="text-red-500">*</span></label>
                    <select name="mahatma_sadhviji" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="0" {{ old('mahatma_sadhviji', $event->mahatma_sadhviji ?? '') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('mahatma_sadhviji', $event->mahatma_sadhviji ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Is there any sadhviji-bhagavant present at our shree sangh for chaturmas? <span class="text-red-500">*</span></label>
                    <select name="mahatma_chaturmas" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                        <option value="0" {{ old('mahatma_chaturmas', $event->mahatma_chaturmas ?? '') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('mahatma_chaturmas', $event->mahatma_chaturmas ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col gap-4 mt-8">
                <div class="flex items-center gap-4">
                    <input type="file" id="pdf_upload" name="pdf_document" accept=".pdf" class="hidden">
                    <button type="button" onclick="document.getElementById('pdf_upload').click()" class="bg-[#C9A14A] text-white px-8 py-2 rounded-full font-semibold flex items-center gap-2 transition hover:bg-[#b38e3c] focus:outline-none">
                        Upload PDF
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                        </svg>
                    </button>

                    @if (isset($event) && $event->hasPdfDocument())
                        <a href="{{ $event->getPdfDocumentUrl() }}"
                           download
                           class="flex items-center gap-2 bg-[#1A2B49] text-white px-8 py-2 rounded-full font-semibold transition hover:bg-[#22376b] focus:outline-none">
                            Download PDF
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                            </svg>
                        </a>
                    @endif
                </div>
                <span id="uploaded_file_name" class="text-sm text-[#1A2B49]">Accepted File Types: PDF and max size 10MB</span>
                @if (isset($event) && $event->hasPdfDocument())
                    <span class="text-sm text-gray-600">Current File: {{ $event->getFirstMedia('event_pdf_document')->file_name }}</span>
                @endif
                <p id="pdf_error" class="text-red-500 text-sm hidden"></p>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition cursor-pointer">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition cursor-pointer">Next</button>
        </div>
    </div>
</div> 