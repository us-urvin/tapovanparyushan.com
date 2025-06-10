<!-- Step 2 Content -->
<div class="step-content hidden" data-step="2">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Accommodation - Contact Person</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="accommodation_first_name" placeholder="first name" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Middle Name</label>
                    <input type="text" name="accommodation_middle_name" placeholder="middle name" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]">
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Surname</label>
                    <input type="text" name="accommodation_surname" placeholder="surname" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Email Address</label>
                    <input type="email" name="accommodation_email" placeholder="Email Address" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]">
                </div>
                <div>
                    <label class="block text-[#1A2B49] text-sm font-medium mb-1">Enter Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="accommodation_phone" placeholder="Phone Number" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" required>
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="accommodation_whatsapp" name="accommodation_whatsapp" class="rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A] mr-2">
                        <label for="accommodation_whatsapp" class="text-[#1A2B49] text-xs">Same for Whatsapp Number</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Next</button>
        </div>
    </div>
</div> 