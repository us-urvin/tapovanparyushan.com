<div class="relative inline-block w-32">
    <select class="statusDropdown w-full px-2 py-1 rounded border focus:ring-2 focus:ring-[#C9A14A] {{
        $user->status === 'accepted' ? 'bg-green-50 text-green-700 border-green-300' :
        ($user->status === 'rejected' ? 'bg-red-50 text-red-700 border-red-300' : 'bg-yellow-50 text-yellow-700 border-yellow-300')
    }}" data-user-id="{{ $user->id }}">
        <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="accepted" {{ $user->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
        <option value="rejected" {{ $user->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</div> 