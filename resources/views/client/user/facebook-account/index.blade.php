@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] md:ml-64">
        <x-navbar :name="auth()->user()->first_name" :profilePhoto="$profilePhoto">
            {{ $title }}
        </x-navbar>
        <div class="flex gap-2 justify-end pt-4 px-4 rounded-lg">
            {{-- <a href="/auth/facebook">Add</a> --}}
            <button type="button" id="update-cookies-button"
                class="bg-primary-base  h-[30px]  rounded-md px-4 text-sm font-semibold text-white">
                Update Cookies
            </button>
            <button type="button" id="add-facebook-button"
                class="bg-primary-base h-[30px] rounded-md px-4 text-sm font-semibold text-white">
                + Add Account
            </button>
        </div>
        <div class="p-4 justify-content-center">
            <div class="overflow-x-auto 2xl:overflow-hidden">
                <table id="table-token-facebook" class="min-w-[90%] max-w-[99%] divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Facebook Name</th>
                            <th scope="col">Facebook ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Add -->
    <div id="modal-add"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Add Facebook Account</p>
                <button id="close-modal-add" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex flex-col gap-2 px-4 pt-2 pb-4 w-[700px]">
                <form id="form-add" method="POST">
                    @csrf
                    <div class="flex flex-col w-full">
                        <div class="flex mb-1">
                            <p class="font-semibold text-sm text-primary-70">User Access Token</p>
                            <p class="font-normal text-base text-error-base">*</p>
                        </div>
                        <input id="user-access-token-add"
                            class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none"
                            type="text" id="user-access-token-add" name="user-access-token-add"
                            placeholder="your user access token" :value="old('user-access-token-add')" required autofocus>
                        <p class="error-message text-red-500 text-xs hidden" id="user-access-token-add-error"></p>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button id="submit-button-add" type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div id="modal-edit"
        class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
        <div class="bg-white rounded-lg max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center p-4 py-3 border-b">
                <p class="font-semibold text-primary-70">Edit Facebook Account</p>
                <button id="close-modal-edit" class="text-lg font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex flex-col gap-2 p-4 w-[700px]">
                <div class="w-full">
                    <label for="edit-facebook-name" class="font-semibold text-sm text-primary-70">Facebook Name</label>
                    <input type="text" name="edit-facebook-name" id="edit-facebook-name" disabled
                        class="w-full border border-primary-40 rounded-md p-3 bg-gray-200 text-neutral-70 text-md font-light focus:outline-none">
                </div>
                <div class="w-full">
                    <label for="edit-facebook-id" class="font-semibold text-sm text-primary-70">Facebook ID</label>
                    <input type="text" name="edit-facebook-id" id="edit-facebook-id" disabled
                        class="w-full border border-primary-40 rounded-md p-3 bg-gray-200 text-neutral-70 text-md font-light focus:outline-none">
                </div>
                <div class="w-full ">
                    <form id="form-edit">
                        <label for="user-access-token-edit" class="font-semibold text-sm text-primary-70">Access
                            Token</label>
                        <input type="text" name="user-access-token-edit" placeholder="your user access token"
                            id="user-access-token-edit"
                            class="w-full border border-primary-40 rounded-md p-3 text-neutral-70 text-md font-light focus:outline-none">
                        <p class="error-message text-red-500 text-xs hidden" id="user-access-token-edit-error"></p>
                    </form>
                </div>
                <div class="flex justify-end mt-4">
                    <button id="submit-button-update" type="button"
                        class="px-4 py-2 text-sm font-medium text-white bg-primary-base rounded-lg hover:bg-primary-60 focus:ring-4 focus:outline-none focus:ring-primary-30">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let selectedData = null;

            $('#table-token-facebook').DataTable({
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
                        data: 'facebook_name',
                        name: 'facebook_name'
                    },
                    {
                        data: 'facebook_id',
                        name: 'facebook_id'
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

            // Update cookie using AJAX
            $('#update-cookies-button').on('click', function(e) {
                e.preventDefault();
                var url = '{{ route('user.facebook-account.updateCookies') }}';

                // Show loading spinner with SweetAlert
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
                    url: url,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            imageUrl: "/assets/icons/alert-circle-success.png",
                            imageHeight: 70,
                            imageWidth: 70,
                            title: "Successfully Update Cookies",
                            text: "You have succesfully update cookies.",
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
                            title: "Failed Update Cookies",
                            text: "Sorry, the cookies data failed to update.",
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

            // Start Add Function
            $('#add-facebook-button').on('click', function() {
                var popup = window.open('/auth/facebook', 'popup',
                    'width=600,height=800,scrollbars=yes,resizable=yes');

                // Polling to check if the popup is closed
                var popupInterval = setInterval(function() {
                    if (popup.closed) {
                        clearInterval(popupInterval);
                        // Trigger the cookie update once the popup is closed
                        $('#table-token-facebook').DataTable().ajax.reload();
                        $('#update-cookies-button').trigger('click');
                    }
                }, 500);
            });
            // $('#add-facebook-button').on('click', function() {
            //     $('#modal-add').removeClass('hidden');
            //     $('#user-access-token-add').focus();
            //     $('#user-access-token-add').val('');

            //     var userAccessTokenValid = isValidInput($('#user-access-token-add'), $(
            //             '#user-access-token-add-error'),
            //         $('#user-access-token-add').val() == '', 'User Access Token cannot be empty');
            // });

            // $('#user-access-token-add').on('input', function() {
            //     var errorMessage = $('#user-access-token-add').next('.error-message');
            //     isValidInput($(this), errorMessage, $(this).val() == '',
            //         'User Access Token cannot be empty');
            // });

            // // Add data using AJAX
            // $('#submit-button-add').on('click', function(e) {
            //     e.preventDefault();
            //     var isValid = true;
            //     var storeData = {
            //         user_access_token: $('#user-access-token-add').val(),
            //         _token: '{{ csrf_token() }}', // Make sure you include CSRF token
            //         _method: 'POST' // Specify the method as POST
            //     };
            //     var url = '{{ route('user.facebook-account.store') }}';

            //     var userAccessTokenValid = isValidInput($('#user-access-token-add'), $(
            //             '#user-access-token-add-error'),
            //         $('#user-access-token-add').val() == '', 'User Access Token cannot be empty');
            //     isValid = isValid && userAccessTokenValid;

            //     if (isValid) {
            //         // Show loading spinner with SweetAlert
            //         Swal.fire({
            //             // title: 'Please wait...',
            //             // text: 'Updating cookies...',
            //             allowOutsideClick: false,
            //             allowEscapeKey: false,
            //             allowEnterKey: false,
            //             customClass: {
            //                 popup: "sweet_popupImportantLoading",
            //             },
            //             didOpen: () => {
            //                 Swal.showLoading();
            //             }
            //         });
            //         $.ajax({
            //             url: url,
            //             type: 'POST',
            //             data: storeData,
            //             success: function(response) {
            //                 console.log(response);
            //                 $('#modal-add').addClass('hidden');
            //                 $('#user-access-token-add').val('');
            //                 $('#table-token-facebook').DataTable().ajax.reload();
            //                 Swal.fire({
            //                     imageUrl: "/assets/icons/alert-circle-success.png",
            //                     imageHeight: 70,
            //                     imageWidth: 70,
            //                     title: "Successfully Add Facebook Data",
            //                     text: "You have succesfully add facebook data.",
            //                     confirmButtonText: "Okey",
            //                     buttonsStyling: false,
            //                     customClass: {
            //                         title: "sweet_titleImportant",
            //                         htmlContainer: "sweet_textImportant",
            //                         confirmButton: "alert-btn",
            //                     },
            //                     width: '400px',
            //                 })
            //             },
            //             complete: function() {
            //                 // Close the loading alert
            //                 Swal.hideLoading();
            //             },
            //             error: function(error) {
            //                 console.log(error);
            //                 Swal.fire({
            //                     imageUrl: "/assets/icons/alert-circle-danger.png",
            //                     imageHeight: 70,
            //                     imageWidth: 70,
            //                     title: "Failed Add Facebook Data",
            //                     text: "Sorry, the facebook data failed to add.",
            //                     confirmButtonText: "Okey",
            //                     buttonsStyling: false,
            //                     customClass: {
            //                         title: "sweet_titleImportant",
            //                         htmlContainer: "sweet_textImportant",
            //                         confirmButton: "alert-btn",
            //                     },
            //                     width: '400px',
            //                 })
            //             }
            //         });
            //     }
            // });
            // Close modal edit
            // $('#close-modal-add').on('click', function() {
            //     $('#user-access-token-add').val('');
            //     $('#modal-add').addClass('hidden');
            // });
            // End Add Function

            // Start Edit Function
            $('#table-token-facebook').on('click', '#edit-button', function() {
                selectedData = $('#table-token-facebook').DataTable().row($(this).parents('tr')).data();
                $('#modal-edit').removeClass('hidden');

                // Set value
                $('#edit-facebook-name').val(selectedData.facebook_name);
                $('#edit-facebook-id').val(selectedData.facebook_id);
                $('#user-access-token-edit').focus();

                var userAccessTokenValid = isValidInput($('#user-access-token-edit'), $(
                        '#user-access-token-edit-error'),
                    $('#user-access-token-edit').val() == '', 'User Access Token cannot be empty');
            });

            $('#user-access-token-edit').on('input', function() {
                var errorMessage = $('#user-access-token-edit').next('.error-message');
                isValidInput($(this), errorMessage, $(this).val() == '',
                    'User Access Token cannot be empty');
            });

            // Edit using ajax
            $('#submit-button-update').on('click', function(e) {
                e.preventDefault();
                var isValid = true;
                if (selectedData) {
                    var updatedData = {
                        user_access_token: $('#user-access-token-edit').val(),
                        _token: '{{ csrf_token() }}', // Make sure you include CSRF token
                        _method: 'PATCH' // Specify the method as PATCH
                    };
                    var url = '{{ route('user.facebook-account.update', 'defaultId') }}';

                    var userAccessTokenValid = isValidInput($('#user-access-token-edit'), $(
                            '#user-access-token-edit-error'),
                        $('#user-access-token-edit').val() == '', 'User Access Token cannot be empty');
                    isValid = isValid && userAccessTokenValid;

                    if (isValid) {
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
                            url: url.replace('defaultId', selectedData.id),
                            type: 'POST',
                            data: updatedData,
                            success: function(response) {
                                console.log(response);
                                $('#modal-edit').addClass('hidden');
                                $('#table-token-facebook').DataTable().ajax.reload();
                                $('#user-access-token-edit').val('');
                                Swal.fire({
                                    imageUrl: "/assets/icons/alert-circle-success.png",
                                    imageHeight: 70,
                                    imageWidth: 70,
                                    title: "Successfully Update Facebook Data",
                                    text: "You have succesfully update facebook data.",
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
                            complete: function() {
                                // Close the loading alert
                                Swal.hideLoading();
                            },
                            error: function(error) {
                                // console.log(error);
                                Swal.fire({
                                    imageUrl: "/assets/icons/alert-circle-danger.png",
                                    imageHeight: 70,
                                    imageWidth: 70,
                                    title: "Failed Update Facebook Data",
                                    text: "Sorry, the facebook data failed to update.",
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

            // Close modal edit
            $('#close-modal-edit').on('click', function() {
                $('#modal-edit').addClass('hidden');
                $('#user-access-token-edit').val('');
            });
            // End Edit Function

            // Start Delete Function
            $('#table-token-facebook').on('click', '#delete-button', function() {
                selectedData = $('#table-token-facebook').DataTable().row($(this).parents('tr')).data();
                Swal.fire({
                    imageUrl: "/assets/icons/alert-circle-warning.png",
                    imageHeight: 70,
                    imageWidth: 70,
                    title: "Facebook Data Will Be Deleted",
                    text: "Are you sure you want to delete your facebook data?",
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
                        ajaxDelete();
                    }
                });
            });
            // Delete using AJAX
            function ajaxDelete() {
                if (selectedData) {
                    var url = '{{ route('user.facebook-account.destroy', 'defaultId') }}';
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
                        url: url.replace('defaultId', selectedData.id),
                        type: 'DELETE',
                        success: function(response) {
                            console.log(response);
                            $('#table-token-facebook').DataTable().ajax.reload();
                            Swal.fire({
                                imageUrl: "/assets/icons/alert-circle-success.png",
                                imageHeight: 70,
                                imageWidth: 70,
                                title: "Successfully Deleted Facebook Data",
                                text: "You have succesfully deleted the facebook data.",
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
                                title: "Failed Deleted Facebook Data",
                                text: "Sorry, the facebook data failed to delete.",
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
            // End Delete Function
        });
    </script>
@endsection
