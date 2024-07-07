@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] md:ml-64 h-screen bg-gray-100">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        <div class="h-[90%] p-4 rounded-lg">
            <div class="h-full grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-4">
                <div class="h-full flex flex-col justify-between p-4 rounded-lg bg-white shadow-xl  order-2 lg:order-1">
                    <form id="form" action="{{ route('user.auto-post.store') }}" method="POST"
                        enctype="multipart/form-data" class="w-full">
                        @csrf
                        <div class="w-full">
                            <!-- Dropdown Select Page -->
                            <div class="mb-4 w-full">
                                <label for="facebook_page" class="flex mb-1">
                                    <p class="font-semibold text-sm text-primary-70">
                                        Select Facebook Page
                                    </p>
                                    <p class="font-normal text-sm text-error-base">*</p>
                                </label>
                                <select id="facebook_page" name="facebook_page[]" multiple="multiple"
                                    class="w-full custom-tom-select" required>
                                </select>
                                <p class="error-message text-red-500 text-xs hidden" id="facebook_page_error"></p>
                            </div>
                            <!-- Upload Image -->
                            <div class="mb-4 w-full">
                                <label class="font-semibold text-sm text-primary-70" for="file_input">Upload
                                    file</label>
                                <input type="file" id="file_input" name="file_input" aria-describedby="file_input_help"
                                    class="block mt-2 w-full text-sm text-slate-500 border border-l-0 border-primary-40 rounded-lg file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-white hover:file:bg-primary-base">
                                <p class="mt-1 text-sm text-gray-500 " id="file_input_help">PNG, JPG, JEPG</p>
                                <!-- Button Remove Image -->
                                <div class="flex justify-end w-full">
                                    <button id="remove_image_button" type="button"
                                        class="mt-1 text-sm text-red-500 underline" style="display: none;">Remove
                                        Image</button>
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
                                <p class="error-message text-red-500 text-xs hidden" id="caption_error"></p>
                            </div>
                            {{-- <div class="mb-2 flex justify-end">
                                <button id="preview_button" type="button"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-primary-base rounded-lg hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300">Preview</button>
                            </div> --}}
                            <!-- Schedule -->
                            <!-- Toggle -->
                            <div class="flex flex-row items-center justify-between mb-3 w-full">
                                <label for="toggle_datetime" class="font-semibold text-sm text-primary-70">Schedule
                                    Post</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input id="toggle_datetime" type="checkbox" value="" class="sr-only peer">
                                    <div
                                        class="relative w-11 h-6 bg-primary-30 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-30 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                            <!-- Datetime -->
                            <div id="datetime" class="hidden mb-3">
                                <p class="text-sm mb-3">
                                    Schedule your post for the times when your audience is most active, or manually select a
                                    date and time in the future to publish your post.
                                </p>
                                <label for="input_datetime" class="block font-semibold text-sm text-primary-70 mb-1">
                                    Select Datetime
                                </label>
                                <input type="datetime-local" name="input_datetime" id="input_datetime"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-primary-base w-full flex-grow h-15 rounded-md text-sm text-base font-normal">
                            </div>
                            <!-- Submit -->
                        </div>
                    </form>
                    <button id="posting_button"
                        class="w-full h-10 2xl:h-10 mt-1 rounded-md py-2 px-4 text-base 2xl:text-l font-semibold text-white bg-primary-base hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        type="button">
                        Posting
                    </button>
                </div>
                <!-- Preview -->
                <div class="flex items-center justify-center rounded-lg  xl:col-span-2 order-1 lg:order-2">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <div class="flex flex-row p-2">
                            <img class="rounded-full w-11 h-11" src="/assets/icons/profile-user.png" alt="" />
                            <div class="flex flex-col">
                                <p class="text-md font-semibold ml-2">{{ auth()->user()->first_name }}</p>
                                <p class="text-sm font-light text-gray-900 ml-2">Just now</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 min-w-96">
                            <p id="previewCaption" class="text-sm font-normal text-gray-900"></p>
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
        </div>
    </div>
    <!-- Modal Show -->
    <div id="modal_detail_post"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Detail Post</p>
                <button id="close_modal_detail_post" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex flex-col xl:flex-row gap-2 px-4 pt-4">
                <div class="flex flex-col order-1 xl:order-3 flex rounded-lg">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <div class="flex flex-row p-2">
                            <img class="rounded-full w-11 h-11" src="/assets/icons/profile-user.png" alt="" />
                            <div class="flex flex-col">
                                <p class="text-md font-semibold ml-2">{{ auth()->user()->first_name }}</p>
                                <p class="text-sm font-light text-gray-900 ml-2">Just now</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 min-w-96">
                            <p id="showCaption" class="text-sm font-normal text-gray-900"></p>
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
                    <div class="w-96">
                        <h3 class="text-md font-semibold text-primary-70 mb-2 mt-2">Facebook Page :</h3>
                        <div id="detail_facebook_page" class="flex flex-row flex-wrap gap-2">
                            {{-- <div class="px-2 bg-gray-300 rounded-md">Info</div>
                            <div class="px-2 bg-gray-300 rounded-md">Post</div> --}}
                        </div>
                        <h3 id="title_detail_datetime" class="text-md font-semibold text-primary-70 mt-2">Datetime Page :
                        </h3>
                        <p id="detail_datetime">dfdfd</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2 p-4">
                <p class="text-sm text-red-500">Please check post detail before posting! </p>
                <button id="confirm_posting_button" type="button"
                    class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">Confirm
                    Posting</button>
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

        /* focus:outline-none focus:border-primary-base focus:ring-1 focus:ring-primary-base */
        /* .focus .ts-control {
                                                        border-color: var(--primary-base) !important;
                                                        outline: none !important;
                                                        box-shadow: 0 0 0 1px var(--primary-base) !important;
                                                    } */

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
            // Select Facebook Page
            var facebookPageSelect = new TomSelect('#facebook_page', {
                plugins: ['remove_button'],
                create: false,
                maxOptions: 100,
                onDropdownOpen: () => {
                    document.querySelector('.ts-dropdown').classList.add('max-h-56', 'overflow-auto')
                }
            });

            // Fetch data and populate Tom Select
            fetch("{{ route('user.dashboard.getFacebookData') }}")
                .then(response => response.json())
                .then(jsonData => {
                    // Add each item to the Tom Select
                    jsonData.forEach(item => {
                        facebookPageSelect.addOption({
                            value: JSON.stringify({
                                id: item.id,
                                name: item.name,
                                page_access_token: item.page_access_token
                            }),
                            text: item.name
                        });
                    });

                    // Refresh options
                    facebookPageSelect.refreshOptions();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
            // Onchage file input
            $('#file_input').change(function() {
                preview();
                if ($('#file_input').val() != '') {
                    $('#remove_image_button').show();
                }
            });
            // Preview button
            $('#preview_button').click(function() {
                preview();
            });

            $('#caption, #file_input').change(function() {
                // Panggil fungsi previewEdit()
                preview();
            });
            // Function preview
            function preview() {
                var fileInput = document.getElementById('file_input');
                var imagePreview = document.getElementById('imagePreview');
                var previewCaption = document.getElementById('showCaption');
                var imagePreviewDetail = document.getElementById('showImage');
                var previewCaptionDetail = document.getElementById('previewCaption');
                var captionText = document.getElementById('caption').value;
                var reader = new FileReader();

                if (fileInput.files && fileInput.files[0]) {

                    reader.onload = function(e) {
                        imagePreview.innerHTML = '<img src="' + e.target.result +
                            '" class="h-full w-full object-cover" />';
                        imagePreviewDetail.innerHTML = '<img src="' + e.target.result +
                            '" class="h-full w-full object-cover" />';
                        // Update preview caption
                        previewCaption.innerText = captionText;
                        previewCaptionDetail.innerText = captionText;
                    }

                    reader.readAsDataURL(fileInput.files[0]);
                } else if (captionText != '') {
                    imagePreview.innerHTML = '';
                    imagePreviewDetail.innerHTML = '';
                    previewCaption.innerHTML = '<p id="previewCaption" class="text-xl font-normal text-gray-900">' +
                        captionText + '</p>';
                    previewCaptionDetail.innerHTML =
                        '<p id="showCaption" class="text-xl font-normal text-gray-900">' +
                        captionText + '</p>';
                } else {
                    imagePreview.innerHTML =
                        '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>';
                    imagePreviewDetail.innerHTML =
                        '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>';
                    previewCaption.innerText = '';
                    previewCaptionDetail.innerText = '';
                }
            }
            // Show button remove image
            $('#remove_image_button').click(function() {
                removeImage();
                preview();
            });

            // Function remove image
            function removeImage() {
                var fileInput = document.getElementById('file_input');
                fileInput.value = ''; // Menghapus nilai file input
                var imagePreview = document.getElementById('imagePreview');
                var captionText = document.getElementById('caption').value;
                if (captionText == '') {
                    imagePreview.innerHTML =
                        '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>'; // Mereset pratinjau gambar
                } else {
                    imagePreview.innerHTML = ''; // Menghapus pratinjau gambar
                }

                document.getElementById('remove_image_button').style.display =
                    'none'; // Sembunyikan tombol "Hapus Gambar"
            }

            // Show input datetime
            $('#toggle_datetime').change(function() {
                if (this.checked) {
                    $('#datetime').removeClass('hidden');
                    $('#input_date_time').prop('disabled', false);
                } else {
                    $('#datetime').addClass('hidden');
                    $('#input_date_time').prop('disabled', true);
                }
            });

            // Set min datetime
            $('#input_datetime').attr('min', getNow());
            // Set value datetime
            if ($('#input_datetime').val() < getNow()) {
                $('#input_datetime').val(getNow());
            } else {
                $('#input_datetime').val($('#input_datetime').val());
            }
            // Check if the selected date is less than the minimum date
            $('#input_datetime').change(function() {
                if ($('#input_datetime').val() < getNow()) {
                    $('#input_datetime').val(getNow());
                }
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

            $('#facebook_page').on('input', function() {
                var errorMessage = $('#facebook_page_error');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Facebook Page cannot be empty');
            });

            $('#caption').on('input', function() {
                var errorMessage = $('#caption').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'Caption cannot be empty');
            });

            // Posting button
            $('#posting_button').click(function(e) {
                e.preventDefault();
                var isValid = true;
                console.log('Posting...');

                // check input form
                var captionValid = isValidInput($('#caption'), $('#caption_error'),
                    $('#caption').val() == '', 'Caption cannot be empty');
                isValid = isValid && captionValid;

                var facebookPageValid = isValidInput($('#facebook_page'), $('#facebook_page_error'),
                    $('#facebook_page').val() == '', 'Facebook Page cannot be empty');
                isValid = isValid && facebookPageValid;

                // if ($('#facebook_page').val() == '') {
                //     alert('Please input caption');
                //     return;
                // }
                // if ($('#caption').val() == '') {
                //     alert('Please input caption');
                //     return;
                // }
                // if ($('#toggle_datetime').is(':checked') && $('#input_datetime').val() == '') {
                //     alert('Please input datetime');
                //     return;
                // }
                if ($('#toggle_datetime').is(':checked')) {
                    $('#detail_datetime').text($('#input_datetime').val());
                    $('#title_detail_datetime').removeClass('hidden');
                } else {
                    $('#title_detail_datetime').addClass('hidden');
                    $('#detail_datetime').text('');
                }

                if (isValid) {
                    $('#modal_detail_post').removeClass('hidden');
                    preview();
                    $('#facebook_page').val().forEach(element => {
                        $('#detail_facebook_page').append(
                            '<div class="px-2 py-1 bg-primary-50 text-white rounded-md">' +
                            JSON.parse(element).name + '</div>');
                    });
                }

            });
            $('#confirm_posting_button').click(function() {
                console.log('Confirm Posting...');
                $('#modal_detail_post').addClass('hidden');

                // Create a new FormData object
                var formData = new FormData();

                // Append each item in the facebookPages array as a separate field
                var facebookPageString = $('#facebook_page').val();
                formData.append('facebook_page', JSON.stringify(facebookPageString));

                formData.append('caption', $('#caption').val());

                // Append the file only if it exists
                var fileInput = document.getElementById('file_input');
                formData.append(
                    'file_input', fileInput.files[0]);

                // Append datetime if the toggle is checked
                if ($('#toggle_datetime').is(':checked')) {
                    formData.append('datetime', $('#input_datetime').val());
                }
                // Loading
                Swal.fire({
                    // title: 'Please wait...',
                    // text: 'Updating cookies...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    customClass: {
                        popup: "sweet_popupImportantLoading",
                    },
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.auto-post.store') }}",
                    data: formData,
                    contentType: false, // Important: Don't set contentType
                    processData: false, // Important: Don't process the data
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            imageUrl: "/assets/icons/alert-circle-success.png",
                            imageHeight: 70,
                            imageWidth: 70,
                            title: "Successfully Posting",
                            text: "You have succesfully posting.",
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
                                location.reload();
                            }
                        });
                    },
                    complete: function() {
                        // Close the loading alert
                        Swal.hideLoading();
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            imageUrl: "/assets/icons/alert-circle-danger.png",
                            imageHeight: 70,
                            imageWidth: 70,
                            title: "Failed Posting",
                            text: "Sorry, the post post failed to posting.",
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
            });
            $('#close_modal_detail_post').on('click', function() {
                $('#modal_detail_post').addClass('hidden');
                $('#detail_facebook_page').text('');
            });

        });

        // function getNow() {
        //     // Min date time > now + 5 minutes
        //     let tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
        //     let minDatetime = (new Date(Date.now() - tzoffset + 5 * 60 * 1000)).toISOString().slice(0, -
        //         8);
        //     return minDatetime;
        // }
    </script>
@endsection
