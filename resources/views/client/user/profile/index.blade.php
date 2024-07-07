@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] md:ml-64">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        {{-- <div class="p-4 rounded-lg"> --}}
        {{-- <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-4"> --}}
        <div class="relative w-full h-[280px] bg-[url('/assets/images/profile-bg.png')] bg-cover bg-center bg-no-repeat">
            {{-- <div
                class="absolute top-4 right-6 w-8 h-7 bg-primary-base rounded-lg p-2 border border-neutral-base flex items-center justify-center">
                <img src="/assets/icons/camera.png" />
            </div> --}}
            <div class="absolute top-1/3 2xl:top-1/2 h-full w-full flex justify-evenly">
                <div
                    class="h-[420px] 2xl:h-[420px] w-[20%] bg-white rounded-2xl border border-neutral-30 flex flex-col items-center shadow-lg">
                    <div
                        class="relative w-[100px] h-[100px] 2xl:w-[214px] 2xl:h-[214px] rounded-full bg-[url('/assets/icons/profile-user.png')] bg-cover mt-8">
                        <div
                            class="absolute w-9 h-9 2xl:w-[42px] 2xl:h-[42px] -right-2 bottom-1 2xl:right-2 2xl:bottom-2 rounded-full border-[3px] border-white flex justify-center items-center bg-primary-base p-2 2xl:p-3">
                            <img src="/assets/icons/camera.png" />
                        </div>
                    </div>
                    <h1 class="mt-4 text-base 2xl:text-xl font-bold text-neutral-80">
                        {{-- {user?.first_name}&nbsp;{user?.last_name} --}}
                        {{ auth()->user()->first_name }}&nbsp;{{ auth()->user()->last_name }}
                    </h1>
                    {{-- <p class="mt-2 text-xs 2xl:text-base font-normal text-neutral-60">
                        Platinum Member
                    </p> --}}
                    <p class="mt-2 text-xs 2xl:text-base font-normal text-neutral-60">
                        {{ auth()->user()->phone_number }}
                    </p>
                    <p class="mt-2 text-xs 2xl:text-base font-normal text-neutral-60">
                        {{ auth()->user()->email }}
                    </p>
                </div>
                <div
                    class="h-[420px] 2xl:h-[420px] w-[70%] bg-white rounded-2xl border border-neutral-30 pt-8 px-10 flex flex-col gap-6 shadow-lg">
                    <div class="flex flex-row gap-8">
                        <div class="flex flex-col w-full">
                            <label for="first_name" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">
                                    First Name
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="first_name"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="text" placeholder="your first name" />
                                <span id="first_name_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="last_name" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">Last Name</p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="last_name"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="text" placeholder="your last name" />
                                <span id="last_name_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-8">
                        <div class="flex flex-col w-full">
                            <label for="email" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">Email</p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="email"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="text" placeholder="your email" />
                                <span id="email_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="phone_number" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">
                                    Phone Number
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                {{-- <div class="relative"> --}}
                                {{-- <input id="phone_number_prefix"
                                    class="cursor-pointer border-l border-t border-b border-[#CFCFCF] p-3 text-neutral-70 focus:outline-none w-[11%] h-12 rounded-l-md text-sm font-light"
                                    type="text" value="+62" readOnly /> --}}
                                <input id="phone_number"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="text" placeholder="your phone number" />
                                <span id="phone_number_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-8">
                        <div class="flex flex-col w-full">
                            <label for="password" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">
                                    Password
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="password"
                                    class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="password" placeholder="your old password" />
                                <span id="password_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="new_password" class="flex mb-1">
                                <p class="font-semibold text-sm text-primary-70">
                                    New Password
                                </p>
                                {{-- <p class="font-normal text-sm text-error-base">*</p> --}}
                            </label>
                            <input id="new_password"
                                class="border border-primary-40 p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full focus:outline-none focus:ring-1 focus:ring-primary-base"
                                type="text" placeholder="your new password" />
                        </div>
                    </div>
                    <div class="flex flex-row justify-end w-full items-center gap-6 mt-9">
                        <button id="cancel_update_button"
                            class="px-4 py-2 bg-[#EDEDED] text-neutral-base font-medium text-sm rounded-md">
                            Cancel
                        </button>
                        <button id="update_button"
                            class="px-4 py-2 bg-primary-base text-white font-medium text-sm rounded-md">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Set initial values and reset borders/icons/messages
            function setValue() {
                $('#first_name').val('{{ auth()->user()->first_name }}').removeClass(['border-red-500',
                    'border-green-500'
                ]);
                $('#last_name').val('{{ auth()->user()->last_name }}').removeClass(['border-red-500',
                    'border-green-500'
                ]);
                $('#email').val('{{ auth()->user()->email }}').removeClass(['border-red-500', 'border-green-500']);
                $('#phone_number').val('{{ auth()->user()->phone_number }}').removeClass(['border-red-500',
                    'border-green-500'
                ]);
                $('#password').removeClass(['border-red-500', 'border-green-500']);

                $('#first_name_check').addClass('hidden');
                $('#last_name_check').addClass('hidden');
                $('#email_check').addClass('hidden');
                $('#phone_number_check').addClass('hidden');
                $('#password_check').addClass('hidden');

                $('.error-message').remove();
            }
            setValue();

            // Function to check if the input is valid
            function isValidInput(input, checkIcon, errorMessage, condition, message) {
                if (condition) {
                    input.addClass('border-red-500').removeClass('border-green-500');
                    checkIcon.removeClass('hidden').addClass('text-red-500').removeClass('text-green-500');
                    if (!errorMessage.length) {
                        input.after('<p class="error-message text-red-500 text-xs">' + message + '</p>');
                    }
                    return false;
                } else {
                    input.removeClass('border-red-500').addClass('border-green-500');
                    checkIcon.removeClass('hidden').addClass('text-green-500').removeClass('text-red-500');
                    errorMessage.remove();
                    return true;
                }
            }

            // Check first_name
            $('#first_name').on('input', function() {
                var checkIcon = $('#first_name_check');
                var errorMessage = $(this).next('.error-message');
                isValidInput($(this), checkIcon, errorMessage, $(this).val() == '',
                    'First name cannot be empty');
            });

            // Check last_name
            $('#last_name').on('input', function() {
                var checkIcon = $('#last_name_check');
                var errorMessage = $(this).next('.error-message');
                isValidInput($(this), checkIcon, errorMessage, $(this).val() == '',
                    'Last name cannot be empty');
            });

            // Check email
            $('#email').on('input', function() {
                var email = $(this).val();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var checkIcon = $('#email_check');
                var errorMessage = $(this).next('.error-message');
                isValidInput($(this), checkIcon, errorMessage, !emailPattern.test(email) || $(this).val() ==
                    '', 'Invalid email format');
            });

            // Check phone_number
            $('#phone_number').on('input', function() {
                var phone_number = $(this).val();
                var phonePattern = /^\d*$/;
                var checkIcon = $('#phone_number_check');
                var errorMessage = $(this).next('.error-message');
                isValidInput($(this), checkIcon, errorMessage, !phonePattern.test(phone_number) || $(this)
                    .val() == '', 'Invalid phone number format');
            });

            // Check password
            $('#password').on('input', function() {
                var checkIcon = $('#password_check');
                var errorMessage = $(this).next('.error-message');
                isValidInput($(this), checkIcon, errorMessage, $(this).val() == '',
                    'Old password cannot be empty');
            });

            // Cancel button
            $('#cancel_update_button').on('click', function() {
                setValue();
            });

            // Update button
            $('#update_button').on('click', function(e) {
                e.preventDefault();
                var isValid = true;

                // Validate first_name
                var firstNameValid = isValidInput($('#first_name'), $('#first_name_check'), $('#first_name')
                    .next('.error-message'), $('#first_name').val() == '', 'First name cannot be empty');
                isValid = isValid && firstNameValid;

                // Validate last_name
                var lastNameValid = isValidInput($('#last_name'), $('#last_name_check'), $('#last_name')
                    .next('.error-message'), $('#last_name').val() == '', 'Last name cannot be empty');
                isValid = isValid && lastNameValid;

                // Validate email
                var email = $('#email').val();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var emailValid = isValidInput($('#email'), $('#email_check'), $('#email').next(
                        '.error-message'), !emailPattern.test(email) || $('#email').val() == '',
                    'Invalid email format');
                isValid = isValid && emailValid;

                // Validate phone_number
                var phone_number = $('#phone_number').val();
                var phonePattern = /^\d*$/;
                var phoneValid = isValidInput($('#phone_number'), $('#phone_number_check'), $(
                    '#phone_number').next('.error-message'), !phonePattern.test(phone_number) || $(
                    '#phone_number').val() == '', 'Invalid phone number format');
                isValid = isValid && phoneValid;

                // Validate password
                var oldPasswordValid = isValidInput($('#password'), $('#password_check'), $(
                        '#password')
                    .next('.error-message'), $('#password').val() == '', 'Password cannot be empty'
                );
                isValid = isValid && oldPasswordValid;

                // If all inputs are valid, log 'update'
                if (isValid) {
                    var updatedData = {
                        first_name: $('#first_name').val(),
                        last_name: $('#last_name').val(),
                        email: $('#email').val(),
                        phone_number: $('#phone_number').val(),
                        password: $('#password').val(),
                        new_password: $('#new_password').val(),
                        _token: '{{ csrf_token() }}', // Make sure you include CSRF token
                        _method: 'PATCH' // Specify the method as PATCH
                    };
                    var url = '{{ route('user.profile.update', 'defaultId') }}';

                    $.ajax({
                        url: url.replace('defaultId', '{{ auth()->user()->id }}'),
                        type: 'POST',
                        data: updatedData,
                        success: function(response) {
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
                            }).then((result) => {
                                if (result.isConfirmed)
                                    location.reload();
                            })
                        },
                        error: function(error) {
                            if (error.message = "Password is incorrect") {
                                $('#password').addClass('border-red-500').removeClass(
                                    'border-green-500');
                                $('#password_check').removeClass('hidden').addClass(
                                        'text-red-500')
                                    .removeClass('text-green-500');
                                $('#password').after(
                                    '<p class="error-message text-red-500 text-xs">' +
                                    error.message + '</p>');
                            }
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
            });


        });
    </script>
@endsection
