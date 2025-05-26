@extends('layouts.admin')

@section('title', 'Profile')
@section('page-title', 'Profile')

@section('content')
<div class="max-w-xl mx-auto bg-[#F8F5ED] rounded-lg shadow p-8">
    <h2 class="text-xl font-bold text-[#1A2B49] mb-6">Edit Profile</h2>
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" id="profileForm">
        @csrf
        <div class="mb-4 flex flex-col items-center">
            <img id="profileImagePreview" src="{{ $user->profile_image_url }}" alt="Profile Image" class="w-24 h-24 rounded-full border-2 border-[#C9A14A] mb-2 object-cover">
            <label class="block text-gray-700 mb-1">Profile Image</label>
            <label class="inline-block cursor-pointer bg-[#C9A14A] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition mb-1">
                Choose Image
                <input type="file" name="profile_image" id="profileImageInput" class="hidden" accept="image/*">
            </label>
            @error('profile_image')
                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Enter Name">
            @error('name')
                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email" value="{{ $user->email }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed" readonly>
        </div>
        <button id="profileSubmitBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition flex items-center justify-center gap-2">
            <span id="profileBtnText">Update Profile</span>
            <svg id="profileBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
        </button>
    </form>
</div>
<script>
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const [file] = e.target.files;
        if (file) {
            document.getElementById('profileImagePreview').src = URL.createObjectURL(file);
        }
    });
    document.getElementById('profileForm').addEventListener('submit', function() {
        const btn = document.getElementById('profileSubmitBtn');
        const loader = document.getElementById('profileBtnLoader');
        const text = document.getElementById('profileBtnText');
        btn.disabled = true;
        loader.classList.remove('hidden');
        text.textContent = 'Updating...';
    });
</script>
@endsection 