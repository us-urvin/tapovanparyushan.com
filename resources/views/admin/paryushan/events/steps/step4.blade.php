<!-- Step 4 Content -->
<div class="step-content hidden" data-step="4">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#C9A14A] mb-4">Anticipated attendance for carious activities which are going to be organized by our veer - sainik during paryushan</div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm bg-[#F8F5ED] rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Particulars</th>
                            <th class="px-4 py-3 text-left font-semibold">Morning</th>
                            <th class="px-4 py-3 text-left font-semibold">Afternoon</th>
                            <th class="px-4 py-3 text-left font-semibold">Evening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">Pratikraman</td>
                            <td class="px-4 py-2"><input type="number" name="attendance[pratikraman][morning]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.pratikraman.morning', $event->attendance['pratikraman']['morning'] ?? '') }}"></td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2"><input type="number" name="attendance[pratikraman][evening]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.pratikraman.evening', $event->attendance['pratikraman']['evening'] ?? '') }}"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Pravachan</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2"><input type="number" name="attendance[pravachan][afternoon]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.pravachan.afternoon', $event->attendance['pravachan']['afternoon'] ?? '') }}"></td>
                            <td class="px-4 py-2">-</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Bhakti-Bhavana</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2"><input type="number" name="attendance[bhakti][evening]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.bhakti.evening', $event->attendance['bhakti']['evening'] ?? '') }}"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Other Activities</td>
                            <td class="px-4 py-2">-</td>
                            <td class="px-4 py-2"><input type="number" name="attendance[other][afternoon]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.other.afternoon', $event->attendance['other']['afternoon'] ?? '') }}"></td>
                            <td class="px-4 py-2"><input type="number" name="attendance[other][evening]" class="w-full bg-white border border-[#F3E6C7] rounded-lg px-4 py-2"
                            value="{{ old('attendance.other.evening', $event->attendance['other']['evening'] ?? '') }}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition cursor-pointer">Previous</button>
            <button type="button" class="next-step bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition cursor-pointer">Next</button>
        </div>
    </div>
</div> 