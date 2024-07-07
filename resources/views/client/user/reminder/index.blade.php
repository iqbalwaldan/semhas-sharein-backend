@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] md:ml-64">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        <div class="p-4 grid">
            <div class="mb-3 justify-self-end">
                <button id="add-button" type="button"
                    class="bg-primary-base  h-[30px]  rounded-md px-4 text-sm font-semibold text-white">
                    + Add Reminder
                </button>
            </div>
            <div class="overflow-x-auto 3xl:overflow-hidden">
                <table id="table-reminder" class="min-w-[90%] max-w-[99%] divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Description</th>
                            <th scope="col">Reminder Time</th>
                            <th scope="col">Is Reminder</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Modal Add -->
        <div id="modal-add"
            class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
            <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-3xl">
                <div class="flex justify-between items-center p-4 py-3 border-b">
                    <p class="font-semibold text-primary-70">Add Reminder</p>
                    <button id="close-modal-add" class="text-lg font-semibold focus:outline-none">&times;</button>
                </div>
                <div class="flex flex-col 3xl:flex-row gap-2 p-4">
                    <form id="add-form">
                        @csrf
                        @method('POST')
                        <div class="flex flex-col gap-4">
                            <div>
                                <label for="name-add" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Name
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="text" name="name-add" id="name-add"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="name-add-error"></p>
                            </div>
                            <div>
                                <label for="name-add" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Email
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="email" name="email-add" id="email-add"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="email-add-error"></p>
                            </div>
                            <div>
                                <label for="description-add" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Description
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <textarea name="description-add" id="description-add" rows="4"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none"></textarea>
                                <p class="error-message text-red-500 text-xs hidden" id="description-add-error"></p>
                            </div>
                            <div>
                                <label for="reminder-time-add" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Time
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="datetime-local" name="reminder-time-add" id="reminder-time-add"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="reminder-time-add-error"></p>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="submit-button-add" type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="modal-edit"
            class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg w-1/3">
                <div class="flex justify-between items-center p-4 py-3 border-b">
                    <p class="font-semibold text-primary-70">Edit Reminder</p>
                    <button id="close-modal-edit" class="text-lg font-semibold focus:outline-none">&times;</button>
                </div>
                <div class="p-4">
                    <form id="edit-form">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col gap-4">
                            <div>
                                <label for="name-edit" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Name
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="text" name="name-edit" id="name-edit"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="name-add-error"></p>
                            </div>
                            <div>
                                <label for="name-edit" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Email
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="email" name="email-edit" id="email-edit"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="email-add-error"></p>
                            </div>
                            <div>
                                <label for="description-edit" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Description
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <textarea name="description-edit" id="description-edit" rows="4"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none"></textarea>
                                <p class="error-message text-red-500 text-xs hidden" id="description-add-error"></p>
                            </div>
                            <div>
                                <label for="reminder-time-edit" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Reminder Time
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <input type="datetime-local" name="reminder-time-edit" id="reminder-time-edit"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                                <p class="error-message text-red-500 text-xs hidden" id="reminder-time-add-error"></p>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="submit-button-edit" type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let selectedData = null;

            $('#table-reminder').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: null,
                        searchable: false,
                        orderable: false,
                        width: 60,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'reminder_time',
                        name: 'reminder_time'
                    },
                    {
                        data: 'is_reminder',
                        name: 'is_reminder',
                        render: function(data) {
                            return data == 1 ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            // Function to check if the input is valid
            function isValidInput(input, errorMessage, condition, message) {
                if (condition) {
                    input.addClass('border-red-500');
                    errorMessage.removeClass('hidden');
                    errorMessage.text(message);
                    return false;
                } else {
                    input.removeClass('border-red-500');
                    errorMessage.addClass('hidden');
                    return true;
                }
            };

            // Start Edit Function
            $('#table-reminder').on('click', '#edit-button', function() {
                selectedData = $('#table-reminder').DataTable().row($(this).parents('tr')).data();
                $('#modal-edit').removeClass('hidden');
                // fill data to modal-edit
                $('#name-edit').val(selectedData.name);
                $('#email-edit').val(selectedData.email);
                $('#description-edit').val(selectedData.description);
                // $('#reminder_time').val(selectedData.reminder_time);

                $('#reminder-time-edit').attr('min', getNow());

                // Set value
                $('#reminder-time-edit').val(getNow());

                // Check if the selected date is less than the minimum date
                $('#reminder-time-edit').change(function() {
                    if ($('#reminder-time-edit').val() < getNow()) {
                        $('#reminder-time-edit').val(getNow());
                    }
                });
            });

            // Validasi input edit
            $('#name-edit').on('input', function() {
                var errorMessage = $('#name-edit').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Name Reminder cannot be empty');
            });
            $('#email-edit').on('input', function() {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var errorMessage = $('#email-edit').next('.error-message');
                isValidInput($(this), errorMessage, !emailPattern.test($(this).val()),
                    'Email Reminder format is incorrect');
            });
            $('#description-edit').on('input', function() {
                var errorMessage = $('#description-edit').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Description Reminder cannot be empty');
            });
            // Update data using AJAX
            $('#submit-button-edit').on('click', function(e) {
                e.preventDefault();
                var isValid = true;
                if (selectedData) {
                    var updatedData = {
                        name: $('#name-edit').val(),
                        email: $('#email-edit').val(),
                        description: $('#description-edit').val(),
                        reminder_time: $('#reminder-time-edit').val(),
                        _token: '{{ csrf_token() }}', // Make sure you include CSRF token
                        _method: 'PATCH' // Specify the method as PATCH
                    };
                    var url = '{{ route('user.reminder.update', 'defaultId') }}';

                    var nameValid = isValidInput($('#name-edit'), $('#name-edit-error'),
                        $('#name-edit').val() == '', 'Name Reminder cannot be empty');
                    isValid = isValid && nameValid;

                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    var emailValid = isValidInput($('#email-edit'), $('#email-edit-error'),
                        !emailPattern.test($('#email-edit').val()), 'Email Reminder format is incorrect'
                    );
                    isValid = isValid && emailValid;

                    var descriptionValid = isValidInput($('#description-edit'), $(
                            '#description-edit-error'),
                        $('#description-edit').val() == '', 'Description Reminder cannot be empty');
                    isValid = isValid && descriptionValid;

                    if (isValid) {
                        $.ajax({
                            url: url.replace('defaultId', selectedData.id),
                            type: 'POST',
                            data: updatedData,
                            success: function(response) {
                                $('#modal-edit').addClass('hidden');
                                $('#table-reminder').DataTable().ajax.reload();
                                Swal.fire({
                                    imageUrl: "/assets/icons/alert-circle-success.png",
                                    imageHeight: 70,
                                    imageWidth: 70,
                                    title: "Successfully Update Reminder",
                                    text: "You have succesfully update reminder.",
                                    confirmButtonText: "Okey",
                                    buttonsStyling: false,
                                    customClass: {
                                        title: "sweet_titleImportant",
                                        htmlContainer: "sweet_textImportant",
                                        confirmButton: "alert-btn",
                                    },
                                    width: '400px',
                                })
                            },
                            error: function(error) {
                                Swal.fire({
                                    imageUrl: "/assets/icons/alert-circle-danger.png",
                                    imageHeight: 70,
                                    imageWidth: 70,
                                    title: "Failed Update Reminder",
                                    text: "Sorry, the reminder failed to update.",
                                    confirmButtonText: "Okey",
                                    buttonsStyling: false,
                                    customClass: {
                                        title: "sweet_titleImportant",
                                        htmlContainer: "sweet_textImportant",
                                        confirmButton: "alert-btn",
                                    },
                                    width: '400px',
                                })
                            }
                        });
                    }
                }
            });
            // Close modal-edit
            $('#close-modal-edit').on('click', function() {
                $('#modal-edit').addClass('hidden');
            });
            // End Edit Function

            // Start Add Function
            $('#add-button').on('click', function() {
                $('#modal-add').removeClass('hidden');
                $('#reminder-time-add').attr('min', getNow());

                // Set value
                $('#reminder-time-add').val(getNow());

                // Check if the selected date is less than the minimum date
                $('#reminder-time-add').change(function() {
                    if ($('#reminder-time-add').val() < getNow()) {
                        $('#reminder-time-add').val(getNow());
                    }
                });
            });

            // Validasi input add
            $('#name-add').on('input', function() {
                var errorMessage = $('#name-add').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Name Reminder cannot be empty');
            });
            $('#email-add').on('input', function() {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var errorMessage = $('#email-add').next('.error-message');
                isValidInput($(this), errorMessage, !emailPattern.test($(this).val()),
                    'Email Reminder format is incorrect');
            });
            $('#description-add').on('input', function() {
                var errorMessage = $('#description-add').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Description Reminder cannot be empty');
            });

            // Add data using AJAX
            $('#submit-button-add').on('click', function(e) {
                e.preventDefault();
                var isValid = true;

                var storeData = {
                    name: $('#name-add').val(),
                    email: $('#email-add').val(),
                    description: $('#description-add').val(),
                    reminder_time: $('#reminder-time-add').val(),
                    _token: '{{ csrf_token() }}', // Make sure you include CSRF token
                    _method: 'POST' // Specify the method as POST
                };
                var url = '{{ route('user.reminder.store') }}';

                var nameValid = isValidInput($('#name-add'), $('#name-add-error'),
                    $('#name-add').val() == '', 'Name Reminder cannot be empty');
                isValid = isValid && nameValid;

                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var emailValid = isValidInput($('#email-add'), $('#email-add-error'),
                    !emailPattern.test($('#email-add').val()), 'Email Reminder format is incorrect');
                isValid = isValid && emailValid;

                var descriptionValid = isValidInput($('#description-add'), $('#description-add-error'),
                    $('#description-add').val() == '', 'Description Reminder cannot be empty');
                isValid = isValid && descriptionValid;

                if (isValid) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: storeData,
                        success: function(response) {
                            $('#modal-add').addClass('hidden');
                            // clear form
                            document.getElementById('add-form').reset();
                            $('#table-reminder').DataTable().ajax.reload();
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-success.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Successfully Add Reminder",
                                text: "You have succesfully add the reminder.",
                                confirmButtonText: "Okey",
                                buttonsStyling: false,
                                customClass: {
                                    title: "sweet_titleImportant",
                                    htmlContainer: "sweet_textImportant",
                                    confirmButton: "alert-btn",
                                },
                                width: '400px',
                            })
                        },
                        error: function(xhr) {
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-danger.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Failed Add Reminder",
                                text: "Sorry, the reminder failed to add.",
                                confirmButtonText: "Okey",
                                buttonsStyling: false,
                                customClass: {
                                    title: "sweet_titleImportant",
                                    htmlContainer: "sweet_textImportant",
                                    confirmButton: "alert-btn",
                                },
                                width: '400px',
                            })
                        }
                    });
                }
            });
            // Close modal-add
            $('#close-modal-add').on('click', function() {
                document.getElementById('add-form').reset();
                $('#modal-add').addClass('hidden');
            });
            // End Add Function

            // Start Delete Post Function
            $('#table-reminder').on('click', '#delete-button', function(e) {
                e.preventDefault();
                selectedData = $('#table-reminder').DataTable().row($(this).parents('tr')).data();
                Swal.fire({
                    imageUrl: "/assets/icons/alert-circle-warning.png",
                    imageHeight: 70,
                    imageWidth: 70,
                    title: "Reminder Will Be Deleted",
                    text: "Are you sure you want to delete your reminder?",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Delete",
                    buttonsStyling: false,
                    reverseButtons: true,
                    customClass: {
                        title: "sweet_titleImportant",
                        htmlContainer: "sweet_textImportant",
                        confirmButton: "alert-btn-dialog",
                        cancelButton: "alert-btn-cancel",
                    },
                    width: '400px',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan sesuatu jika tombol "Ya, hapus saja!" diklik
                        if (selectedData) {
                            var url = '{{ route('user.reminder.destroy', 'defaultId') }}';
                            $.ajax({
                                url: url.replace('defaultId', selectedData.id),
                                type: 'DELETE',
                                success: function(response) {
                                    Swal.fire({
                                        imageUrl: "/assets/icons/alert-circle-success.png",
                                        imageHeight: 70,
                                        imageWidth: 70,
                                        title: "Successfully Deleted Reminder",
                                        text: response.message,
                                        confirmButtonText: "Okey",
                                        buttonsStyling: false,
                                        customClass: {
                                            title: "sweet_titleImportant",
                                            htmlContainer: "sweet_textImportant",
                                            confirmButton: "alert-btn",
                                        },
                                        width: '400px',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#table-reminder').DataTable()
                                                .ajax.reload();
                                        }
                                    });
                                },
                                error: function(error) {
                                    Swal.fire({
                                        imageUrl: "/assets/icons/alert-circle-danger.png",
                                        imageHeight: 70,
                                        imageWidth: 70,
                                        title: "Failed Deleted Reminder",
                                        text: error.responseJSON.message,
                                        confirmButtonText: "Okey",
                                        buttonsStyling: false,
                                        customClass: {
                                            title: "sweet_titleImportant",
                                            htmlContainer: "sweet_textImportant",
                                            confirmButton: "alert-btn",
                                        },
                                        width: '400px',
                                    })
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
