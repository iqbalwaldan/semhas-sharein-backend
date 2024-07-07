@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] md:ml-64">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        <div class="p-4 justify-content-center">
            <div class="overflow-x-auto 3xl:overflow-hidden">
                <table id="table-schedule" class="min-w-[90%] max-w-[99%] divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Account Facebook</th>
                            <th scope="col">Page Name</th>
                            <th scope="col">Post Capton</th>
                            <th scope="col">Reminder Name</th>
                            <th scope="col">Post Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Show -->
    <div id="modal-show"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Show Post</p>
                <button id="close-modal-show" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex flex-col xl:flex-row gap-2 p-4">
                <div class="order-1 xl:order-3 flex items-center justify-center rounded-lg">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <div class="flex flex-row p-2">
                            <img class="rounded-full w-11 h-11" src="/assets/icons/profile-user.png" alt="" />
                            <div class="flex flex-col">
                                <p class="text-sm font-medium text-gray-900 ml-2">{{ auth()->user()->first_name }}</p>
                                <p class="text-sm font-light text-gray-900 ml-2">Just now</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 min-w-96">
                            <p id="showCaption" class="text-sm font-normal text-gray-900 break-words"></p>
                        </div>
                        <div id="showImage">
                            <img src="/assets/images/home-bg.png" alt="">
                        </div>
                        <div class="flex flex-row justify-between px-10 py-2">
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-thumbs-up text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Like</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-comment text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Comment</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-paper-plane text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Share </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Reschedule -->
    <div id="modal-reschedule"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-1/3">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Reschedule Post</p>
                <button id="close-modal-reschedule" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="p-4">
                <form id="reschedule-form">
                    @csrf
                    @method('PATCH')
                    <div class="flex flex-col gap-4">
                        {{-- <div>
                            <label for="post_time" class="block text-sm font-medium text-gray-700">
                                Post Time
                            </label>
                            <input type="datetime-local" name="post_time" id="post_time"
                                class="border border-[#CFCFCF] p-3   text-neutral-70 focus:outline-primary-base w-full flex-grow h-15 rounded-md text-sm text-base font-normal">
                        </div> --}}
                        <div>
                            <label for="post-time" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">
                                    Reminder Time
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <input type="datetime-local" name="post-time" id="post-time"
                                class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                            <p class="error-message text-red-500 text-xs hidden" id="post-time-error"></p>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="submit-button-reschedule" type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div id="modal-edit"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-3xl">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Edit Post</p>
                <button id="close-modal-edit" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex flex-col xl:flex-row gap-5 p-4 pb-2">
                <div class="order-3 xl:order-1">
                    <form enctype="multipart/form-data" id="form-data" class="w-full">
                        @csrf
                        <div class="w-full">
                            <!-- Dropdown Select Page -->
                            <div class="mb-4 w-full">
                                <label for="facebook-page" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Select Facebook Page
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <select id="facebook-page" name="facebook-page" class="w-full custom-tom-select" required>
                                </select>
                                <p class="error-message text-red-500 text-xs hidden" id="facebook-page-error"></p>
                            </div>
                            <!-- Upload Image -->
                            <div class="mb-4 w-full">
                                <label class="font-semibold text-sm text-primary-70" for="file-input">Upload
                                    file</label>
                                <input type="file" id="file-input" name="file-input" aria-describedby="file-input_help"
                                    class="mt-2 w-full text-sm text-slate-500 border border-l-0 border-primary-40 rounded-lg file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-white hover:file:bg-primary-base"
                                    onchange="showButtonRemoveImage()">
                                <p class="mt-1 text-sm text-gray-500 " id="file-input-help">PNG, JPG, JEPG</p>
                                <!-- Button Remove Image -->
                                <div class="flex justify-end w-full">
                                    <button id="removeImageButton" type="button"
                                        class="mt-1 text-sm text-red-500 underline" style="display: none;"
                                        onclick="removeImage()">Remove Image</button>
                                </div>
                            </div>
                            <!-- Caption -->
                            <div class="w-full">
                                <label for="caption" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Your Caption
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <textarea id="caption" name="caption" rows="4"
                                    class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none"
                                    placeholder="Write your caption here..." required></textarea>
                                <p class="error-message text-red-500 text-xs hidden" id="caption-error"></p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="order-2 border border-gray-500"></div>

                <div class="order-1 xl:order-3 flex items-center justify-center rounded-lg">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <div class="flex flex-row p-2">
                            <img class="rounded-full w-11 h-11" src="/assets/icons/profile-user.png" alt="" />
                            <div class="flex flex-col">
                                <p class="text-sm font-medium text-gray-900 ml-2">{{ auth()->user()->first_name }}</p>
                                <p class="text-sm font-light text-gray-900 ml-2">Just now</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 min-w-96">
                            <p id="previewCaption" class="text-sm font-normal text-gray-900 break-words"></p>
                        </div>
                        <div id="imagePreview">
                            <img src="/assets/images/home-bg.png" alt="">
                        </div>
                        <div class="flex flex-row justify-between px-10 py-2">
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-thumbs-up text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Like</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-comment text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Comment</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <i class="fa-regular fa-paper-plane text-primary-base"></i>
                                <p class="text-sm font-light text-gray-900 ml-1">Share </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <div class="p-4 pt-0">
                <button id="submit-button-edit"
                    class="w-full h-10 mt-1 rounded-md py-2 px-4 text-base 2xl:text-l font-semibold text-white bg-primary-base hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    type="button">
                    Save
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <style>
        .custom-tom-select .ts-control {
            background-color: #f8f9fa;
            border-color: var(--primary-40);
            padding: 12px;
            border-radius: 8px;
        }

        .ts-wrapper.multi .ts-control>div {
            cursor: pointer;
            margin: 0 6px 6px 0 !important;
            padding: 4px 2px 4px 8px !important;
            background: var(--primary-50) !important;
            border-radius: 4px !important;
            color: #ffffff !important;
        }

        .ts-wrapper .ts-control>div {
            padding: 4px 2px 4px 8px !important;
            background: var(--primary-50) !important;
            border-radius: 4px !important;
            color: #ffffff !important;
        }

        .custom-tom-select .ts-dropdown {
            background-color: #ffffff;
            border-color: #ced4da;
        }
    </style>
    <!-- Include Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <!-- Include Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedData = null;

            $('#table-schedule').DataTable({
                paging: true, // Disable pagination
                searching: true, // Enable searching
                info: true, // Disable info
                lengthChange: true, // Disable length change
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
                        data: 'post.facebook_name',
                        name: 'post.facebook_name'
                    },
                    {
                        data: 'post.page_name',
                        name: 'post.page_name'
                    },
                    {
                        data: 'post.caption',
                        name: 'post.caption',
                        render: function(data, type, row) {
                            return '<div class="max-width">' + data + '</div>';
                        }
                    },
                    {
                        data: 'reminder.name',
                        name: 'reminder.name'
                    },
                    {
                        data: 'post_time',
                        name: 'post_time'
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
            }

            // Start Show Post Function
            $('#table-schedule').on('click', '#show-button', function() {
                selectedData = $('#table-schedule').DataTable().row($(this).parents('tr')).data();
                $('#modal-show').removeClass('hidden');

                // Set value
                if (selectedData.post.media.length > 0) {
                    $('#showImage').removeClass('hidden');
                    document.getElementById('showCaption').innerText = selectedData.post.caption;
                    document.getElementById('showImage').innerHTML = '<img src="' + selectedData.post.media[
                            0]
                        .original_url + '" class="h-full w-full object-cover" />';
                } else {
                    document.getElementById('showCaption').innerHTML =
                        '<p id="previewCaption" class="text-xl font-normal text-gray-900 break-words">' +
                        selectedData.post.caption +
                        '</p>';
                    $('#showImage').addClass('hidden');
                }
            });
            // Close modal show
            $('#close-modal-show').on('click', function() {
                $('#modal-show').addClass('hidden');
            });
            // End Show Post Function

            // Start Reschedule Post Function
            $('#table-schedule').on('click', '#reschedule-button', function() {
                selectedData = $('#table-schedule').DataTable().row($(this).parents('tr')).data();
                $('#modal-reschedule').removeClass('hidden');

                $('#post-time').attr('min', getNow());

                // Set value
                if (selectedData.post_time < getNow()) {
                    $('#post-time').val(getNow());
                } else {
                    $('#post-time').val(selectedData.post_time);
                }

                // Check if the selected date is less than the minimum date
                $('#post-time').change(function() {
                    if ($('#post-time').val() < getNow()) {
                        $('#post-time').val(getNow());
                    }
                });
            });


            // Reschedule Post using AJAX
            $('#submit-button-reschedule').on('click', function(e) {
                e.preventDefault();
                if (selectedData) {
                    var updatedData = {
                        post_time: $('#post-time').val(),
                        _token: '{{ csrf_token() }}', // Make sure you include CSRF token
                        _method: 'PATCH' // Specify the method as PATCH
                    };
                    var url = '{{ route('user.manage-schedule.update', 'defaultId') }}';

                    $.ajax({
                        url: url.replace('defaultId', selectedData.id),
                        type: 'POST',
                        data: updatedData,
                        success: function(response) {
                            $('#modal-reschedule').addClass('hidden');
                            $('#table-schedule').DataTable().ajax.reload();
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-success.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Successfully Reschedule Post",
                                text: "You have succesfully reschedule post.",
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
                                title: "Failed Reschedule Post",
                                text: "Sorry, the post failed to reschedule.",
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
            // Close modal reschedule
            $('#close-modal-reschedule').on('click', function() {
                $('#modal-reschedule').addClass('hidden');
            });
            // End Reschedule Post Function

            // Start Edit Post Function
            $('#table-schedule').on('click', '#edit-button', function() {
                selectedData = $('#table-schedule').DataTable().row($(this).parents('tr')).data();
                $('#modal-edit').removeClass('hidden');

                // Set value
                $('#caption').val(selectedData.post.caption);
                previewEdit();
                $('#caption, #file-input').change(function() {
                    // Panggil fungsi previewEdit()
                    previewEdit();
                });

                // Validate input
                var facebookPageValid = isValidInput($('#facebook-page'), $('#facebook-page-error'),
                    $('#facebook-page').val() == '', 'Facebook Page cannot be empty');

                var captionValid = isValidInput($('#caption'), $('#caption-error'),
                    $('#caption').val() == '', 'Caption cannot be empty');

                // Populate Facebook Page Select
                populateFacebookPageSelect(selectedData.post.page_id);
            });

            function previewEdit() {
                // var img = selectedData.post.media[0].original_url;
                var fileInput = document.getElementById('file-input');
                var imagePreview = document.getElementById('imagePreview');
                var previewCaption = document.getElementById('previewCaption');
                var captionText = document.getElementById('caption').value;
                var reader = new FileReader();
                if ((fileInput.files && fileInput.files[0])) {
                    reader.onload = function(e) {
                        imagePreview.innerHTML = '<img src="' + e.target.result +
                            '" class="h-full w-full object-cover" />';
                        // Update preview caption
                        previewCaption.innerText = captionText;
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                } else if (selectedData.post.media.length > 0) {
                    var img = selectedData.post.media[0].original_url;
                    imagePreview.innerHTML = '<img src="' + img +
                        '" class="h-full w-full object-cover" />';
                    // Update preview caption
                    previewCaption.innerText = captionText;

                } else if (captionText != '') {
                    imagePreview.innerHTML = '';
                    previewCaption.innerHTML =
                        '<p id="previewCaption" class="text-xl font-normal text-gray-900 break-words">' +
                        captionText + '</p>';
                } else {
                    imagePreview.innerHTML =
                        '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>';
                    previewCaption.innerText = '';
                }
            }

            // Initialize TomSelect
            var facebookPageSelect = new TomSelect('#facebook-page', {
                plugins: ['remove_button'],
                create: false,
                maxOptions: 100,
                onDropdownOpen: () => {
                    document.querySelector('.ts-dropdown').classList.add('max-h-56', 'overflow-auto');
                }
            });

            // Function to fetch data and populate Tom Select
            function populateFacebookPageSelect(selectedPageIds) {
                fetch("{{ route('user.dashboard.getFacebookData') }}")
                    .then(response => response.json())
                    .then(jsonData => {
                        // Add each item to the Tom Select
                        jsonData.forEach(item => {
                            facebookPageSelect.addOption({
                                value: item.id,
                                text: item.name
                            });
                        });

                        // Refresh options
                        facebookPageSelect.refreshOptions();
                        // Set selected options based on selectedData
                        facebookPageSelect.setValue(selectedPageIds);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            // Populate Facebook Page Select on document ready
            populateFacebookPageSelect();

            $('#facebook-page').on('input', function() {
                var errorMessage = $('#facebook-page-error');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Facebook Page cannot be empty');
            });

            $('#caption').on('input', function() {
                var errorMessage = $('#caption').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Caption cannot be empty');
            });

            // Update Post using AJAX
            $('#submit-button-edit').on('click', function(e) {
                e.preventDefault();
                var isValid = true;
                if (selectedData) {
                    var formData = new FormData();

                    formData.append('page_id', $('#facebook-page').val());
                    formData.append('caption', $('#caption').val());
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'PATCH');

                    // Append media files
                    var fileInput = $('#file-input')[0];
                    if (fileInput.files.length > 0) {
                        formData.append('media', fileInput.files[0]);
                    }

                    var url = '{{ route('user.manage-schedule.update', 'defaultId') }}';

                    var facebookPageValid = isValidInput($('#facebook-page'), $('#facebook-page-error'),
                        $('#facebook-page').val() == '', 'Facebook Page cannot be empty');
                    isValid = isValid && facebookPageValid;

                    var captionValid = isValidInput($('#caption'), $('#caption-error'),
                        $('#caption').val() == '', 'Caption cannot be empty');
                    isValid = isValid && captionValid;

                    if (isValid) {
                        $.ajax({
                            url: url.replace('defaultId', selectedData.id),
                            type: 'POST',
                            data: formData,
                            contentType: false, // Prevent jQuery from overriding the content type
                            processData: false, // Prevent jQuery from processing the data
                            success: function(response) {
                                $('#modal-edit').addClass('hidden');
                                $('#table-schedule').DataTable().ajax.reload();
                                removeImage();
                                Swal.fire({
                                    imageUrl: "/assets/icons/alert-circle-success.png",
                                    imageHeight: 70,
                                    imageWidth: 70,
                                    title: "Successfully Update Schedule Post",
                                    text: "You have succesfully update schedule post.",
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
                                    title: "Failed Update Schedule Post",
                                    text: "Sorry, the schedule post failed to update.",
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
                    };
                };
            });
            // Close modal edit
            $('#close-modal-edit').on('click', function() {
                $('#modal-edit').addClass('hidden');
                console.log("test")
                // reset form   
                document.getElementById('form-data').reset();
                removeImage();
            });
            // End Edit Post Function

            // Start Delete Post Function
            $('#table-schedule').on('click', '#delete-button', function(e) {
                e.preventDefault();
                selectedData = $('#table-schedule').DataTable().row($(this).parents('tr')).data();
                Swal.fire({
                    imageUrl: "/assets/icons/alert-circle-warning.png",
                    imageHeight: 70,
                    imageWidth: 70,
                    title: "Schedule Post Will Be Deleted",
                    text: "Are you sure you want to delete your schedule post?",
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
                        scheduleDelete();
                    }
                });
            });

            // Delete Schedule using AJAX
            function scheduleDelete() {
                // e.preventDefault();
                if (selectedData) {
                    var url = '{{ route('user.manage-schedule.destroy', 'defaultId') }}';
                    $.ajax({
                        url: url.replace('defaultId', selectedData.id),
                        type: 'DELETE',
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-success.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Successfully Deleted Schedule Post",
                                text: "You have succesfully deleted the posting schedule.",
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
                                    $('#table-schedule').DataTable().ajax.reload();
                                }
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-danger.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Failed Deleted Schedule Post",
                                text: "Sorry, the schedule failed to delete.",
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
            };
        });

        // Get realtime date time
        // function getNow() {
        //     // Min date time > now + 5 minutes
        //     let tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
        //     let minDatetime = (new Date(Date.now() - tzoffset + 5 * 60 * 1000)).toISOString().slice(0, -
        //         8);
        //     return minDatetime;
        // }

        function showButtonRemoveImage() {
            // Menampilaan tombol "Hapus Gambar"
            document.getElementById('removeImageButton').style.display = 'inline-block';
        }

        function removeImage() {
            var fileInput = document.getElementById('file-input');
            fileInput.value = ''; // Menghapus nilai file input
            var imagePreview = document.getElementById('imagePreview');
            var captionText = document.getElementById('caption').value;
            if (captionText == '') {
                imagePreview.innerHTML =
                    '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>'; // Mereset pratinjau gambar
            } else {
                imagePreview.innerHTML = ''; // Menghapus pratinjau gambar
            }
            document.getElementById('removeImageButton').style.display =
                'none'; // Sembunyikan tombol "Hapus Gambar"
        }
    </script>
    <!-- <script>
        $(document).ready(function() {
            // Assuming you have selectedData variable available in the scope where you want to set the value
            var selectedData = {
                post: {
                    page_id: ["1", "2", "3"], // Example data, replace with actual data
                    caption: "Example caption" // Example caption, replace with actual data
                }
            };

            // Initialize TomSelect
            var facebookPageSelect = new TomSelect('#facebook-page', {
                plugins: ['remove_button'],
                create: false,
                maxOptions: 100,
                onDropdownOpen: () => {
                    document.querySelector('.ts-dropdown').classList.add('max-h-56', 'overflow-auto');
                }
            });

            // Function to fetch data and populate Tom Select
            function populateFacebookPageSelect() {
                fetch("{{ route('get.facebook.data') }}")
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            facebookPageSelect.addOption({
                                value: item.id,
                                text: item.name
                            });
                        });
                        facebookPageSelect.refreshOptions();
                        // Set selected options based on selectedData
                        facebookPageSelect.setValue(selectedData.post.page_id);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            // Populate Facebook Page Select on document ready
            populateFacebookPageSelect();
        });
    </script> -->
@endsection
