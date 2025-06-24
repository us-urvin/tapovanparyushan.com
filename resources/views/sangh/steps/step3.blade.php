<!-- Step 3 Content -->
<div class="step-content hidden" data-step="3">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="text-lg font-semibold text-[#C9A14A] mb-6">Transportation availability from Ahmedabad to Surat</div>
        <!-- Bus Transportation -->
        <div class="mb-8">
            <div class="flex items-center">
                <input type="checkbox" id="bus_transportation" name="bus_transportation" class="rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A] mr-2" 
                    {{ old('bus_transportation', $sangh->bus_transportation) == 1 ? 'checked' : '' }}>
                <label for="bus_transportation" class="text-[#1A2B49] text-sm font-medium">Bus Transportation</label>
            </div>
            <div class="overflow-x-auto mt-4">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg" id="busTransportTable">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">From <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">To <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Bus Name <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="busTransportTbody">
                        @if(isset($sangh) && $sangh->busTransportations->count() > 0)
                            @foreach($sangh->busTransportations as $index => $busTransport)
                                <tr>
                                    <td class="align-middle row-index px-2 py-1">{{ $index + 1 }}</td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="bus_transport[{{ $index }}][from]" class="bus-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('bus_transport.'.$index.'.from', $busTransport->from) }}">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="bus_transport[{{ $index }}][to]" class="bus-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('bus_transport.'.$index.'.to', $busTransport->to) }}">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="bus_transport[{{ $index }}][bus_name]" class="bus-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('bus_transport.'.$index.'.bus_name', $busTransport->bus_name) }}">
                                    </td>
                                    <td class="text-center px-2 py-1">
                                        <button type="button" class="deleteBusRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="align-middle row-index px-2 py-1">1</td>
                                <td class="px-2 py-1">
                                    <input type="text" name="bus_transport[0][from]" class="bus-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('bus_transport.0.from', '') }}">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="text" name="bus_transport[0][to]" class="bus-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('bus_transport.0.to', '') }}">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="text" name="bus_transport[0][bus_name]" class="bus-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('bus_transport.0.bus_name', '') }}">
                                </td>
                                <td class="text-center px-2 py-1">
                                    <button type="button" class="deleteBusRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <button type="button" id="addBusRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
        </div>

        <hr class="my-8 border-[#F3E6C7]">

        <!-- Train Transportation -->
        <div>
            <div class="flex items-center">
                <input type="checkbox" id="train_transportation" name="train_transportation" class="rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A] mr-2" 
                    {{ old('train_transportation', $sangh->train_transportation) == 1 ? 'checked' : '' }}>
                <label for="train_transportation" class="text-[#1A2B49] text-sm font-medium">Train Transportation</label>
            </div>
            <div class="overflow-x-auto mt-4">
                <table class="w-full text-sm bg-[#F8F5ED] rounded-lg" id="trainTransportTable">
                    <thead>
                        <tr class="border-b border-[#F3E6C7]">
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">No.</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">From <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">To <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Train Name <span class="text-red-500">*</span></th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Train Number</th>
                            <th class="py-2 text-left text-[#1A2B49] text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="trainTransportTbody">
                        @if(isset($sangh) && $sangh->trainTransportations->count() > 0)
                            @foreach($sangh->trainTransportations as $index => $trainTransport)
                                <tr>
                                    <td class="align-middle row-index px-2 py-1">{{ $index + 1 }}</td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="train_transport[{{ $index }}][from]" class="train-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('train_transport.'.$index.'.from', $trainTransport->from) }}">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="train_transport[{{ $index }}][to]" class="train-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('train_transport.'.$index.'.to', $trainTransport->to) }}">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="train_transport[{{ $index }}][train_name]" class="train-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('train_transport.'.$index.'.train_name', $trainTransport->train_name) }}">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="train_transport[{{ $index }}][train_number]" class="train-number-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                            value="{{ old('train_transport.'.$index.'.train_number', $trainTransport->train_number) }}">
                                    </td>
                                    <td class="text-center px-2 py-1">
                                        <button type="button" class="deleteTrainRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="align-middle row-index px-2 py-1">1</td>
                                <td class="px-2 py-1">
                                    <input type="text" name="train_transport[0][from]" class="train-from-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('train_transport.0.from', '') }}">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="text" name="train_transport[0][to]" class="train-to-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('train_transport.0.to', '') }}">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="text" name="train_transport[0][train_name]" class="train-name-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('train_transport.0.train_name', '') }}">
                                </td>
                                <td class="px-2 py-1">
                                    <input type="text" name="train_transport[0][train_number]" class="train-number-input w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2 text-[#1A2B49] text-sm font-medium"
                                        value="{{ old('train_transport.0.train_number', '') }}">
                                </td>
                                <td class="text-center px-2 py-1">
                                    <button type="button" class="deleteTrainRowBtn text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <button type="button" id="addTrainRowBtn" class="mt-4 bg-[#C9A14A] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2"><i class="fa fa-plus"></i> Add Row</button>
        </div>

        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition">Previous</button>
            <button type="submit" class="bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition" id="saveBtn">
                Save
                <svg id="saveBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
            </button>
        </div>
    </div>
</div> 