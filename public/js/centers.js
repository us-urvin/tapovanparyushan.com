$(document).ready(function () {
    // CSRF setup for all AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // DataTable initialization
    var table = $('#centersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/centers/datatable',
            type: 'GET',
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'center_name', name: 'center_name' },
            { data: 'status_dropdown', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        drawCallback: function () {
            attachEditHandlers();
            attachStatusHandlers();
            attachCopyHandlers();
        }
    });

    // Modal open/close
    $('#addCenterBtn').on('click', function () {
        resetCenterForm();
        $('#centerModalTitle').text('Add Center');
        $('#centerFormBtnText').text('Save');
        $('#centerFormBtnLoader').addClass('hidden');
        $('#centerFormSubmit').prop('disabled', false);
        $('#centerModal').removeClass('hidden');
    });
    $('#closeCenterModal').on('click', function () {
        $('#centerModal').addClass('hidden');
    });
    $(document).on('click', function (e) {
        if ($(e.target).is('#centerModal')) {
            $('#centerModal').addClass('hidden');
        }
    });

    // Edit handler
    function attachEditHandlers() {
        $('.edit-center-btn').off('click').on('click', function () {
            var id = $(this).data('id');
            // Set loading state before AJAX
            $('#centerFormBtnText').text('Update').removeClass('hidden');
            $('#centerFormBtnLoader').addClass('hidden');
            $('#centerFormSubmit').prop('disabled', false);
            // Optionally, show a loading overlay or spinner in the modal here
            $.get('/admin/centers/datatable', { id: id }, function (data) {
                var center = data.data.find(c => c.id == id);
                if (center) {
                    $('#center_id').val(center.id);
                    $('#center_name_input').val(center.name);
                    $('#center_email_input').val(center.email);
                    $('#center_mobile_input').val(center.mobile);
                    $('#center_center_name_input').val(center.center_name);
                    $('#centerPasswordBlock').addClass('hidden');
                    $('#centerModalTitle').text('Edit Center');
                    $('#centerFormBtnText').text('Update').removeClass('hidden');
                    $('#centerFormBtnLoader').addClass('hidden');
                    $('#centerFormSubmit').prop('disabled', false);
                    $('#centerModal').removeClass('hidden');
                }
            });
        });
    }

    // Status dropdown handler
    function attachStatusHandlers() {
        $('.statusDropdown').off('change').on('change', function () {
            var id = $(this).data('center-id');
            var status = $(this).val();
            $.post('/admin/centers/' + id + '/status', { status: status, _token: $('meta[name="csrf-token"]').attr('content') }, function (res) {
                if (res.success) {
                    table.ajax.reload(null, false);
                }
            });
        });
    }

    // Copy password handler
    function attachCopyHandlers() {
        $('.copy-center-password').off('click').on('click', function () {
            var password = $(this).data('password');
            navigator.clipboard.writeText(password);
            iziToast.success({ message: 'Password copied!', position: 'topRight' });
        });
        $('#copyCenterPassword').off('click').on('click', function () {
            var password = $('#centerPasswordDisplay').val();
            navigator.clipboard.writeText(password);
            iziToast.success({ message: 'Password copied!', position: 'topRight' });
        });
    }

    // Form submit (add/edit)
    $('#centerForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#center_id').val();
        var url = '/admin/centers' + (id ? '/' + id : '');
        var method = id ? 'PUT' : 'POST';
        var data = {
            name: $('#center_name_input').val(),
            email: $('#center_email_input').val(),
            mobile: $('#center_mobile_input').val(),
            center_name: $('#center_center_name_input').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        if (id) data._method = 'PUT';
        clearErrors();
        // Show loader, hide text, disable button
        $('#centerFormBtnText').addClass('hidden');
        $('#centerFormBtnLoader').removeClass('hidden');
        $('#centerFormSubmit').prop('disabled', true);
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function (res) {
                // Hide loader, show text, enable button
                $('#centerFormBtnText').removeClass('hidden');
                $('#centerFormBtnLoader').addClass('hidden');
                $('#centerFormSubmit').prop('disabled', false);
                if (res.success) {
                    $('#centerModal').addClass('hidden');
                    table.ajax.reload(null, false);
                    if (res.password) {
                        $('#centerPasswordDisplay').val(res.password);
                        $('#centerPasswordBlock').removeClass('hidden');
                        iziToast.success({ message: 'Center created! Password shown below.', position: 'topRight' });
                    } else {
                        iziToast.success({ message: 'Center updated!', position: 'topRight' });
                    }
                }
            },
            error: function (xhr) {
                // Hide loader, show text, enable button
                $('#centerFormBtnText').removeClass('hidden');
                $('#centerFormBtnLoader').addClass('hidden');
                $('#centerFormSubmit').prop('disabled', false);
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.name) showError('nameError', errors.name[0]);
                    if (errors.email) showError('emailError', errors.email[0]);
                    if (errors.mobile) showError('mobileError', errors.mobile[0]);
                    if (errors.center_name) showError('centerNameError', errors.center_name[0]);
                } else {
                    iziToast.error({ message: 'Something went wrong!', position: 'topRight' });
                }
            }
        });
    });

    function resetCenterForm() {
        $('#centerForm')[0].reset();
        $('#center_id').val('');
        $('#centerPasswordBlock').addClass('hidden');
        clearErrors();
    }
    function clearErrors() {
        $('#nameError, #emailError, #mobileError, #centerNameError').addClass('hidden').text('');
    }
    function showError(id, msg) {
        $('#' + id).removeClass('hidden').text(msg);
    }
}); 