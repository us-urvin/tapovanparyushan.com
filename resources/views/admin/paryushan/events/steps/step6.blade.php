<!-- Step 6 Content -->
<div class="step-content hidden" data-step="6">
    <div class="bg-[#FCF7ED] border border-[#F3E6C7] rounded-xl p-8">
        <div class="mb-6">
            <div class="text-lg font-semibold text-[#1A2B49] mb-4">Terms & Conditions</div>
            <ol class="list-decimal list-inside text-[#1A2B49] mb-4">
                <li>पूजा-भावना जैसे जिनभक्ति के प्रसंगों में जब पुरुषों की मुख्यता हो तब बहने नृत्य, गीतगान नहीं कर सकेगी |</li>
                <li>भाईयों और बहनों साथ बैठके प्रतिक्रमण नहीं कर सकते |</li>
                <li>प्रभावना, स्वागतियात्रा में बर्द जैसी अभक्ष्य चीजों का इस्तेमाल एवं रात्री-भोजन नहीं किया जाएगा |</li>
                <li>पर्युषण पर्व की आराधना करवाने आये हुये हमारे युवाओं को आप कुछ भी रक्म-चीज भेट में नहीं दे सकते | सिर्फ श्रीफल और तिलक से बहुमान कर सकते हो | इस नियम का सख्त पालन करना रहेगा |</li>
                <li>श्रवणोपासक युवाओं को जाने-आने का खर्च बहुमान के रूप में देना रहेगा।</li>
                <li>तपोनयन पर्युषण विभाग के संचालकों को प्राप्त कुल चिंतनी पत्रों में से तपोनयन पर्युषण विभाग के संचालकों द्वारा वहाँ टीम भेजने को प्राथमिकता दी जायेगी जहाँ आराधना की दृष्टि से अधिक लाभ हो।</li>
            </ol>
            <div class="flex items-center mt-4">
                <input type="checkbox" id="terms_agree" name="terms_agree" class="rounded border-[#C9A14A] text-[#C9A14A] focus:ring-[#C9A14A] mr-2" {{ old('terms_agree', $event->terms_agree ?? '') ? 'checked' : '' }} required>
                <label for="terms_agree" class="text-[#1A2B49] text-sm">I have read all the rules & instructions, and I agree to comply with them.</label>
            </div>
        </div>
        <div class="flex justify-between mt-8">
            <button type="button" class="prev-step bg-white border border-[#C9A14A] text-[#C9A14A] px-8 py-2 rounded-lg font-semibold hover:bg-[#F3E6C7] transition cursor-pointer">Previous</button>
            <button type="submit" class="bg-[#C9A14A] text-white px-8 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition cursor-pointer" id="eventSave">@if (isset($event->id)) Update @else Submit @endif
                <svg id="eventBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
            </button>
        </div>
    </div>
</div> 