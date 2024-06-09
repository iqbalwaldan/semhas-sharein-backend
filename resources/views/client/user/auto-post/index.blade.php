@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="px-4 ml-[60px] md:ml-64">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        {{-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700"> --}}
        <div class="p-4 rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-4">
                <div class="flex p-2 rounded bg-gray-200 order-2 lg:order-1">
                    <form action="{{ route('user.auto-post.post') }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf
                        <div class="w-full">
                            <!-- Dropdown Select Page -->
                            <div class="mb-4 w-full">
                                <label for="facebook_page" class="text-sm font-medium text-gray-900">Select Facebook
                                    Page</label>
                                <select id="facebook_page" name="facebook_page[]" multiple="multiple"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                                    required>
                                </select>
                            </div>

                            {{-- Upload Image --}}
                            <div class="mb-4 w-full">
                                <label class="text-sm font-medium text-gray-900" for="file_input">Upload
                                    file</label>
                                <input type="file" id="file_input" name="file_input" aria-describedby="file_input_help"
                                    class=" mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                                    onchange="showButtonRemoveImage()">
                                <p class="mt-1 text-sm text-gray-500 " id="file_input_help">PNG, JPG, JEPG</p>
                                {{-- Button Remove Image --}}
                                <button id="removeImageButton" type="button" class="mt-1 text-sm text-red-500"
                                    style="display: none;" onclick="removeImage()">Remove Image</button>
                            </div>
                            {{-- Caption --}}
                            <div class="mb-1 w-full">
                                <div class="flex flex-row">
                                    <label for="caption" class="mb-2 text-sm font-medium text-gray-900">
                                        Your Caption
                                    </label>
                                    <label for="caption" class="mb-2 text-sm font-medium text-red-500">
                                        *
                                    </label>
                                </div>
                                <textarea id="caption" name="caption" rows="4"
                                    class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write your caption here..." required></textarea>
                            </div>
                            <div class="mb-2 flex justify-end">
                                <button id="previewButton" type="button"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-primary-base rounded-lg hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                    onclick="preview()">Preview</button>
                            </div>
                            {{-- Schedule --}}
                            {{-- Toggle --}}
                            <div class="flex flex-row items-center justify-between mb-1 w-full">
                                <label for="toggleDatetime" class="mb-2 text-sm font-medium text-gray-900">Schedule
                                    Post</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input id="toggleDatetime" type="checkbox" value=""
                                        class="sr-only peer"onchange="toggleDateTime()">
                                    <div
                                        class="relative w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                            {{-- Date --}}
                            <div id="dateHidden" class="mb-4 w-full hidden">
                                <label for="date" class="mb-2 text-sm font-medium text-gray-900">Select Date:
                                </label>
                                <div class="relative max-w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="date" name="date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full ps-10 p-2.5"
                                        min="{{ date('Y-m-d') }}" placeholder="Select date" disabled required>
                                    </input>
                                </div>
                            </div>
                            {{-- Time --}}
                            <div id="timeHidden" class="mb-4 hidden">
                                <label for="time" class="mb-2 text-sm font-medium text-gray-900">Select
                                    time:
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="time" name="time" aria-describedby="time_help"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                                        disabled required>
                                    </input>
                                </div>
                            </div>
                            {{-- Submit --}}
                            <button
                                class="w-full h-10 2xl:h-10 mt-1 rounded-md py-2 px-4 text-base 2xl:text-l font-semibold text-white bg-primary-base hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                type="submit">
                                Posting
                            </button>
                        </div>
                    </form>
                </div>
                {{-- Preview --}}
                <div class="flex items-center justify-center rounded bg-gray-200 xl:col-span-2 order-1 lg:order-2">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <div class="flex flex-row p-2">
                            <img class="rounded-full w-10" src="/assets/images/fb_pp4.png" alt="" />
                            <div class="flex flex-col">
                                <p class="text-sm font-medium text-gray-900 ml-2">{{ auth()->user()->first_name }}</p>
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
                                <img class="w-6" src="/assets/icons/copy.png" alt="" />
                                <p class="text-sm font-light text-gray-900 ml-1">Like</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <img class="w-6" src="/assets/icons/copy.png" alt="" />
                                <p class="text-sm font-light text-gray-900 ml-1">Comment</p>
                            </div>
                            <div class="flex flex-row items-center">
                                <img class="w-6" src="/assets/icons/copy.png" alt="" />
                                <p class="text-sm font-light text-gray-900 ml-1">Share </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Scrip Set Time --}}
    <script>
        function toggleDateTime() {
            var dateTimeToggle = document.getElementById('toggleDatetime');

            var dateInput = document.getElementById('date');
            var timeInput = document.getElementById('time');
            var dateHidden = document.getElementById('dateHidden');
            var timeHidden = document.getElementById('timeHidden');

            if (dateTimeToggle.checked) {
                // Mendapatkan waktu sekarang
                var now = new Date();
                // Menambahkan 30 menit ke waktu sekarang
                now.setMinutes(now.getMinutes() + 2);
                // Mengonversi waktu menjadi format HH:mm
                var minTime = now.toTimeString().substring(0, 5);
                // Mengatur nilai minimum untuk input time
                document.getElementById('time').setAttribute('min', minTime);
                document.getElementById('time').setAttribute('value', minTime);
                dateInput.disabled = false;
                timeInput.disabled = false;
                dateHidden.classList.remove('hidden');
                timeHidden.classList.remove('hidden');
            } else {
                dateInput.disabled = true;
                timeInput.disabled = true;
                dateHidden.classList.add('hidden');
                timeHidden.classList.add('hidden');
            }
        }

        function preview() {
            var fileInput = document.getElementById('file_input');
            var imagePreview = document.getElementById('imagePreview');
            var previewCaption = document.getElementById('previewCaption');
            var captionText = document.getElementById('caption').value;
            var reader = new FileReader();

            if (fileInput.files && fileInput.files[0]) {

                reader.onload = function(e) {
                    imagePreview.innerHTML = '<img src="' + e.target.result +
                        '" class="h-full w-full object-cover" />';
                    // Update preview caption
                    previewCaption.innerText = captionText;
                }

                reader.readAsDataURL(fileInput.files[0]);
            } else if (captionText != '') {
                imagePreview.innerHTML = '';
                previewCaption.innerHTML = '<p id="previewCaption" class="text-xl font-normal text-gray-900">' +
                    captionText + '</p>';
            } else {
                imagePreview.innerHTML = '<img src="/assets/images/home-bg.png" class="h-full w-full object-cover"/>';
                previewCaption.innerText = '';
            }
        }

        function showButtonRemoveImage() {
            // Menampilaan tombol "Hapus Gambar"
            document.getElementById('removeImageButton').style.display = 'inline-block';
        }

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
            document.getElementById('removeImageButton').style.display =
                'none'; // Sembunyikan tombol "Hapus Gambar"
        }
    </script>

    <!-- Include Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <!-- Include Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var facebookPageSelect = new TomSelect('#facebook_page', {
                plugins: ['remove_button'],
                create: false,
                maxOptions: 100,
                onDropdownOpen: () => {
                    document.querySelector('.ts-dropdown').classList.add('max-h-56', 'overflow-auto')
                }
            });

            // Fetch data and populate Tom Select
            fetch("{{ route('get.facebook.data') }}")
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        facebookPageSelect.addOption({
                            value: JSON.stringify({
                                id: item.id,
                                name: item.name,
                                access_token: item.access_token
                            }),
                            text: item.name
                        });
                    });
                    facebookPageSelect.refreshOptions();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    </script>
@endsection
