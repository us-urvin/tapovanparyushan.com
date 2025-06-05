<!-- Step 3 Content -->
<div class="step-content hidden">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="text-lg font-semibold text-[#C9A14A] mb-6">Transportation availability from Ahmedabad to Surat</div>
        <!-- Bus Transportation -->
        <div class="mb-8">
            <div class="flex items-center mb-2">
                <input type="checkbox" id="bus_transportation" name="bus_transportation" class="mr-2 rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A]">
                <label for="bus_transportation" class="text-[#1A2B49] text-base font-semibold">Bus Transportation</label>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">From</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Station to Disembark the Bus</th>
                            <th class="py-2 text-center text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="busTransportTbody">
                        <tr>
                            <td class="align-middle row-index px-2 py-1">1</td>
                            <td class="px-2 py-1"><input type="text" name="bus_from[]" class="bus-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="px-2 py-1"><input type="text" name="bus_to[]" class="bus-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteBusRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addBusRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
        </div>

        <hr class="my-8 border-[#F3E6C7]">

        <!-- Train Transportation -->
        <div>
            <div class="flex items-center mb-2">
                <input type="checkbox" id="train_transportation" name="train_transportation" class="mr-2 rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A]">
                <label for="train_transportation" class="text-[#1A2B49] text-base font-semibold">Train Transportation</label>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">From</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Train Name</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Station to Disembark</th>
                            <th class="py-2 text-center text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="trainTransportTbody">
                        <tr>
                            <td class="align-middle row-index px-2 py-1">1</td>
                            <td class="px-2 py-1"><input type="text" name="train_from[]" class="train-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="px-2 py-1"><input type="text" name="train_name[]" class="train-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="px-2 py-1"><input type="text" name="train_to[]" class="train-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"></td>
                            <td class="text-center px-2 py-1">
                                <button type="button" class="deleteTrainRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addTrainRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
        </div>

        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition">Previous</button>
            <button type="submit" class="bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">Save</button>
        </div>
    </div>
</div> 