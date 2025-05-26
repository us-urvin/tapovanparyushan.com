<div class="flex gap-3 items-center">
    <button class="editSanghBtn" data-user-id="{{ $user->id }}" title="Edit">
        <i class="fa-solid fa-pen text-[#C9A14A] hover:text-[#b38e3c] text-lg"></i>
    </button>
    <button class="viewSanghBtn" data-user-id="{{ $user->id }}" title="View">
        <i class="fa-solid fa-eye text-[#1A2B49] hover:text-[#C9A14A] text-lg"></i>
    </button>
    <button class="deleteSanghBtn" data-user-id="{{ $user->id }}" title="Delete">
        <i class="fa-solid fa-trash text-red-500 hover:text-red-700 text-lg"></i>
    </button>
</div> 