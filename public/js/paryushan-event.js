class ParyushanStepper {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 6;
        this.init();
    }

    init() {
        this.updateStepperUI();
        this.setupNavigationButtons();
        this.setupStepClickHandlers();
        this.setupFormValidation();
        this.setupFileUpload();
    }

    setupFormValidation() {
        document.querySelectorAll('#paryushanEventForm input:not([type="checkbox"]), #paryushanEventForm select').forEach(input => {
            input.addEventListener('input', () => {
                this.clearError(input);
            });
        });
    }

    validateField(input) {
        const value = input.value.trim();
        let isValid = true;
        let errorMessage = '';
        if (input.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required';
        }
        if (isValid && value) {
            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
            } else if (input.name === 'contact_person[phone]') {
                const phoneRegex = /^\d{10}$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Phone number must be exactly 10 digits';
                }
            } else if (input.type === 'file' || input.id === 'pdf_upload') {
                const file = input.files[0];
                if (file) {
                    if (file.type !== 'application/pdf') {
                        isValid = false;
                        errorMessage = 'Only PDF files are allowed';
                    } else if (file.size > 10 * 1024 * 1024) { // 10MB in bytes
                        isValid = false;
                        errorMessage = 'File size must not exceed 10MB';
                    }
                }
            } else if (input.type === 'number') {
                if (isNaN(value) || parseInt(value) < 0) {
                    isValid = false;
                    errorMessage = 'Please enter a valid number';
                }
            }
        }
        return { isValid, errorMessage };
    }

    showError(input, message) {
        input.classList.add('border-red-500');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-xs mt-1';
        errorDiv.textContent = message;
        const existingError = input.parentElement.querySelector('.text-red-500');
        if (existingError) {
            existingError.remove();
        }
        input.parentElement.appendChild(errorDiv);
    }

    clearError(input) {
        input.classList.remove('border-red-500');
        const errorDiv = input.parentElement.querySelector('.text-red-500');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    validateStep(stepNumber) {
        const stepContent = document.querySelector(`.step-content[data-step="${stepNumber}"]`);
        if (!stepContent) return true;
        let isValid = true;
        const inputs = stepContent.querySelectorAll('input:not([type="checkbox"]):not([type="hidden"]), select, textarea');
        inputs.forEach(input => {
            this.clearError(input);
            const { isValid: fieldValid, errorMessage } = this.validateField(input);
            if (!fieldValid) {
                this.showError(input, errorMessage);
                isValid = false;
            }
        });
        // For step 6, ensure the terms checkbox is checked
        if (stepNumber === 6) {
            const terms = stepContent.querySelector('input[type="checkbox"][name="terms_agree"]');
            if (terms && !terms.checked) {
                const termsError = document.createElement('div');
                termsError.className = 'text-red-500 text-sm ml-2';
                termsError.textContent = 'You must agree to the terms and conditions';
                const existingError = terms.parentElement.querySelector('.text-red-500');
                if (existingError) {
                    existingError.remove();
                }
                terms.parentElement.appendChild(termsError);
                isValid = false;
            }
        }
        return isValid;
    }

    setupNavigationButtons() {
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (this.validateStep(this.currentStep)) {
                    this.goToStep(this.currentStep + 1);
                }
            });
        });
        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                this.goToStep(this.currentStep - 1);
            });
        });
        // On submit, validate last step
        const form = document.getElementById('paryushanEventForm');
        if (form) {
            const eventSave = document.getElementById('eventSave');
            const eventBtnLoader = document.getElementById('eventBtnLoader');

            form.addEventListener('submit', (e) => {
                if (!this.validateStep(this.totalSteps)) {
                    e.preventDefault();
                    if (eventSave && eventBtnLoader) {
                        eventBtnLoader.classList.remove('hidden');
                        eventSave.textContent = 'Sending...';
                    }
                } else {
                    if (eventSave && eventBtnLoader) {
                        eventBtnLoader.classList.remove('hidden');
                        eventSave.textContent = 'Sending...';
                    }
                }

                
            });
        }
    }

    setupStepClickHandlers() {
        document.querySelectorAll('.stepper-step').forEach(step => {
            step.addEventListener('click', () => {
                const stepNum = parseInt(step.getAttribute('data-step'));
                if (stepNum <= this.currentStep) {
                    this.goToStep(stepNum);
                }
            });
        });
    }

    updateStepperUI() {
        const steps = document.querySelectorAll('.stepper-step');
        steps.forEach((step, idx) => {
            const circle = step.querySelector('.step-circle');
            const dot = circle.querySelector('div');
            const text = step.querySelector('.step-text');
            // Line before this step
            const line = idx > 0 ? steps[idx - 1].nextElementSibling : null;
            if (idx + 1 < this.currentStep) {
                // Completed step
                circle.classList.add('border-[#C9A14A]', 'bg-[#C9A14A]');
                circle.classList.remove('border-[#E5E5E5]', 'bg-[#FFFCF5]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-white';
                text.classList.add('text-[#C9A14A]');
                text.classList.remove('text-black');
                if (line) line.classList.add('bg-[#C9A14A]');
                if (line) line.classList.remove('bg-[#E5E5E5]');
            } else if (idx + 1 === this.currentStep) {
                // Current step
                circle.classList.add('border-[#C9A14A]', 'bg-[#FFFCF5]');
                circle.classList.remove('border-[#E5E5E5]', 'bg-[#C9A14A]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-[#C9A14A]';
                text.classList.add('text-[#C9A14A]');
                text.classList.remove('text-black');
                if (line) line.classList.add('bg-[#C9A14A]');
                if (line) line.classList.remove('bg-[#E5E5E5]');
            } else {
                // Upcoming step
                circle.classList.remove('border-[#C9A14A]', 'bg-[#C9A14A]');
                circle.classList.add('border-[#E5E5E5]', 'bg-[#FFFCF5]');
                if (dot) dot.className = 'w-3 h-3 rounded-full bg-black';
                text.classList.remove('text-[#C9A14A]');
                text.classList.add('text-black');
                if (line) line.classList.remove('bg-[#C9A14A]');
                if (line) line.classList.add('bg-[#E5E5E5]');
            }
        });
        this.showStepContent(this.currentStep);
    }

    goToStep(stepNumber) {
        if (stepNumber < 1 || stepNumber > this.totalSteps) return;
        this.currentStep = stepNumber;
        this.updateStepperUI();
    }

    showStepContent(stepNumber) {
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.add('hidden');
        });
        const active = document.querySelector(`.step-content[data-step="${stepNumber}"]`);
        if (active) active.classList.remove('hidden');
    }

    setupFileUpload() {
        const fileInput = document.getElementById('pdf_upload');
        if (fileInput) {
            fileInput.addEventListener('change', () => {
                this.validatePdfUpload(fileInput);
            });
        }
    }

    validatePdfUpload(input) {
        const file = input.files[0];
        const errorElement = document.getElementById('pdf_error');
        const fileNameElement = document.getElementById('uploaded_file_name');
        const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    
        if (file) {
            if (file.type !== 'application/pdf') {
                errorElement.textContent = 'Only PDF files are allowed';
                errorElement.classList.remove('hidden');
                fileNameElement.textContent = '';
                input.value = ''; // Clear the file input
                return false;
            }
            
            if (file.size > maxSize) {
                errorElement.textContent = 'File size must not exceed 10MB';
                errorElement.classList.remove('hidden');
                fileNameElement.textContent = '';
                input.value = ''; // Clear the file input
                return false;
            }
    
            // If validation passes
            errorElement.classList.add('hidden');
            fileNameElement.textContent = `Uploaded: ${file.name}`;
            return true;
        }
        return false;
    } 
}

class ParyushanEvents {
    constructor() {
        this.table = null;
        this.init();
    }

    init() {
        this.initializeDataTable();
        this.setupEventListeners();
        this.populateEventDropdown();
    }

    initializeDataTable() {
        this.table = $('#eventTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/sangh/paryushan/events/datatable',
                data: (d) => {
                    d.search = $('#searchInput').val();
                    d.event_id = $('#eventFilter').val();
                }
            },
            columns: this.getTableColumns(),
            drawCallback: (settings) => {
                $('#eventCount').text(settings._iRecordsTotal + ' Events');
            },
            dom: 'rtip'
        });
        // Assign to global variable for reload after assignment change
        window.paryushanEventsTable = this.table;
    }

    getTableColumns() {
        const columns = [];
        
        // Add Sangh Name column if user is admin
        if (window.isAdmin) {
            columns.push({ data: 'sangh_name', name: 'sangh_name' });
        }

        // Add other columns
        columns.push(
            { data: 'event', name: 'event', searchable: true, sortable: true },
            { data: 'email', name: 'email', searchable: true, sortable: true },
            { data: 'mobile', name: 'mobile', searchable: false, sortable: true },
            { data: 'country', name: 'country', searchable: false, sortable: true },
            { data: 'status', name: 'status', searchable: false, sortable: false }
        );

        if (window.isAdmin) {
            columns.push({ data: 'sub_admin_status', name: 'sub_admin_status', orderable: false, searchable: false });
            columns.push({ data: 'assign_sub_admin', name: 'assign_sub_admin', orderable: false, searchable: false });
        }

        columns.push(
            { data: 'actions', name: 'actions', searchable: false, sortable: false }
        );

        return columns;
    }

    populateEventDropdown() {
        const eventFilter = $('#eventFilter');
        eventFilter.empty();
        eventFilter.append('<option value="">All Events</option>');
        // Add events from EVENT_YEAR constant
        Object.entries(window.eventYears).forEach(([year, label]) => {
            eventFilter.append(`<option value="${year}">${label}</option>`);
        });
        // Set default to current year if present
        const currentYear = new Date().getFullYear();
        if (window.eventYears[currentYear]) {
            eventFilter.val(currentYear);
            // If DataTable is initialized, reload with filter
            if (this.table) {
                this.table.ajax.reload();
            }
        }
    }

    setupEventListeners() {
        // Search input handler
        $('#searchInput').on('keyup', (e) => {
            this.table.search(e.target.value).draw();
        });

        // Filter button toggle
        $('#filterBtn').on('click', () => {
            $('#filterSection').slideToggle(200);
        });

        // Apply filter button
        $('#applyFilter').on('click', () => {
            this.table.ajax.reload();
        });

        // Reset filter button
        $('#resetFilter').on('click', () => {
            $('#eventFilter').val('');
            this.table.ajax.reload();
        });

        // Status update handler for event status (admin)
        $(document).on('change', '.status-select', (e) => {
            this.handleStatusUpdate(e);
            // Refresh DataTable after status change to update columns (e.g., Assign Sub Admin)
            if (this.table) {
                this.table.ajax.reload(null, false);
            }
        });

        // Assignment status update handler for center users
        $(document).on('change', '.assignment-status-select', (e) => {
            const select = $(e.currentTarget);
            const eventId = select.data('event-id');
            const status = select.val();
            
            $.ajax({
                url: '/sangh/paryushan/events/update-assignment-status',
                method: 'POST',
                data: {
                    _token: window.csrfToken,
                    event_id: eventId,
                    status: status
                },
                success: (response) => {
                    if (response.success) {
                        this.showNotification('success', 'Success', response.message);
                        // Update dropdown style
                        const statusClasses = {
                            'pending': 'text-yellow-600 bg-yellow-50',
                            'accepted': 'text-blue-500 bg-blue-50',
                            'rejected': 'text-red-500 bg-red-50'
                        };
                        select.removeClass().addClass('assignment-status-select ' + statusClasses[status] + ' px-3 py-1 rounded-full text-xs font-semibold');
                    }
                },
                error: (xhr) => {
                    this.showNotification('error', 'Error', xhr.responseJSON?.message || 'Failed to update assignment status');
                    this.table.ajax.reload();
                }
            });
        });

        // View button handler
        $(document).on('click', '.view-btn', (e) => {
            const id = $(e.currentTarget).data('id');
            this.handleView(id);
        });

        // Edit button handler
        $(document).on('click', '.edit-btn', (e) => {
            const id = $(e.currentTarget).data('id');
            this.handleEdit(id);
        });

        // Delete button handler
        $(document).on('click', '.delete-btn', (e) => {
            const id = $(e.currentTarget).data('id');
            this.handleDelete(id);
        });

        // Assign to sub admin from listing
        $(document).on('change', '.assign-to-listing', function() {
            const select = $(this);
            const eventId = select.data('id');
            const centerId = select.val();
            if (!centerId) return;
            $.ajax({
                url: `/sangh/paryushan/events/${eventId}/assign-center`,
                method: 'POST',
                data: {
                    _token: window.csrfToken,
                    center_id: centerId
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Assigned center successfully.',
                        background: '#f8f5ed',
                        confirmButtonColor: '#C9A14A'
                    });
                    // Refresh DataTable after assignment change
                    if (window.paryushanEventsTable) {
                        window.paryushanEventsTable.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to assign event',
                        background: '#f8f5ed',
                        confirmButtonColor: '#C9A14A'
                    });
                }
            });
        });
    }

    loadEvents() {
        $.ajax({
            url: '/sangh/paryushan/events/get-events',
            method: 'GET',
            success: (response) => {
                const eventFilter = $('#eventFilter');
                eventFilter.empty();
                eventFilter.append('<option value="">All Events</option>');
                
                response.forEach((event) => {
                    eventFilter.append(`<option value="${event.id}">${event.name}</option>`);
                });
            },
            error: (xhr) => {
                this.showNotification('error', 'Error', 'Failed to load events');
            }
        });
    }

    handleStatusUpdate(event) {
        const select = $(event.currentTarget);
        const id = select.data('id');
        const status = select.val();

        $.ajax({
            url: '/sangh/paryushan/events/update-status',
            method: 'POST',
            data: {
                _token: window.csrfToken,
                id: id,
                status: status
            },
            success: (response) => {
                if (response.success) {
                    this.showNotification('success', 'Success', response.message);
                    this.updateStatusStyles(select, status);
                    // Refresh DataTable after status change to update Sub Admin Status and assignment columns
                    if (window.paryushanEventsTable) {
                        window.paryushanEventsTable.ajax.reload(null, false);
                    }
                }
            },
            error: (xhr) => {
                this.showNotification('error', 'Error', xhr.responseJSON?.message || 'Failed to update status');
                this.table.ajax.reload();
            }
        });
    }

    updateStatusStyles(select, status) {
        const statusClasses = {
            0: 'text-yellow-600 bg-yellow-50',
            1: 'text-blue-500 bg-blue-50',
            2: 'text-red-500 bg-red-50'
        };
        select.removeClass().addClass('status-select ' + statusClasses[status] + ' px-3 py-1 rounded-full text-xs font-semibold');
    }

    showNotification(type, title, message) {
        Swal.fire({
            icon: type,
            title: title,
            text: message,
            background: '#f8f5ed',
            confirmButtonColor: '#C9A14A'
        });
    }

    handleView(id) {
        window.location.href = `/sangh/paryushan/events/${id}/view`;
    }

    handleEdit(id) {
        // Implement edit functionality
        console.log('Edit event:', id);
    }

    handleDelete(id) {
        const self = this;
        Swal.fire({
            title: 'Delete Confirmation',
            text: 'Are you sure you want to delete this event?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C9A14A',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/sangh/paryushan/events/${id}`,
                    type: 'DELETE',
                    data: { _token: window.csrfToken },
                    success: function(res) {
                        if (res.success) {
                            self.showNotification('success', 'Deleted', res.message);
                            self.table.ajax.reload(null, false);
                        } else {
                            self.showNotification('error', 'Error', res.message || 'Failed to delete event.');
                        }
                    },
                    error: function(xhr) {
                        self.showNotification('error', 'Error', xhr.responseJSON?.message || 'Failed to delete event.');
                    }
                });
            }
        });
    }
}

// Initialize when document is ready
$(document).ready(() => {
    // Initialize stepper if the form exists
    if (document.getElementById('paryushanEventForm')) {
        new ParyushanStepper();
    }
    
    // Initialize events table if it exists
    if (document.getElementById('eventTable')) {
        new ParyushanEvents();
    }

    // Initialize select2 for bhakti_instrument_list
    if ($('#bhakti_instrument_list').length) {
        $('#bhakti_instrument_list').select2({
            placeholder: 'Select instruments',
            allowClear: true,
            width: '100%'
        });
    }
});