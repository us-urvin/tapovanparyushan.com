<div class="flex gap-3 items-center">
    <a href="{{ route('admin.sangh.view', $user->id) }}" class="viewSanghBtn mr-2" title="View">
        <i class="fa-solid fa-eye text-[#1A2B49] hover:text-[#C9A14A] text-lg"></i>
    </a>
    <a href="{{ route('admin.sangh.edit', $user->id) }}" class="editSanghBtn mr-2" title="Edit">
        <i class="fa-solid fa-pen text-[#C9A14A] hover:text-[#b38e3c] text-lg"></i>
    </a>
    <button class="deleteSanghBtn" data-user-id="{{ $user->id }}" title="Delete">
        <i class="fa-solid fa-trash text-red-500 hover:text-red-700 text-lg"></i>
    </button>
</div> 