document.addEventListener('DOMContentLoaded', function () {
    // Handler for Edit Sangh Profile button
    const editBtn = document.querySelector('.edit-sangh-profile-btn');
    if (editBtn) {
        editBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openSanghEditModal();
        });
    }
});

function openSanghEditModal() {
    // Remove any existing modal
    const existingModal = document.getElementById('sanghEditModal');
    if (existingModal) existingModal.remove();

    // Create modal overlay
    const modal = document.createElement('div');
    modal.id = 'sanghEditModal';
    modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-8 relative animate-fade-in">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl close-modal-btn">&times;</button>
            <div id="sanghEditModalContent" class="w-full">
                <div class="text-center text-lg text-gray-500 py-8">Loading...</div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Close modal on click of close button
    modal.querySelector('.close-modal-btn').addEventListener('click', function () {
        modal.remove();
    });

    // Fetch the form partial for step 1
    fetch('/sangh/profile/edit/step1')
        .then(response => response.text())
        .then(html => {
            document.getElementById('sanghEditModalContent').innerHTML = html;
        });
}

// Optionally, add ESC key to close modal
window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('sanghEditModal');
        if (modal) modal.remove();
    }
}); 