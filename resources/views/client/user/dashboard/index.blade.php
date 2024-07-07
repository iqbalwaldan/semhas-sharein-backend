@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] sm:ml-64 bg-gray-100">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        {{-- <div class="p-4 mx-4 border-2 border-gray-200 border-dashed rounded-xl dark:border-gray-700"> --}}
        <div class="grid grid-cols-4 gap-4 p-4" style="grid-template-rows: auto auto auto 1fr;">
            <div class="flex flex-col gap-1 p-4 h-36 rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Jumlah Schedule
                </p>
                <p class="text-2xl font-bold">
                    {{ $totalSchedule }} Schedule
                </p>
            </div>
            <div class="flex flex-col gap-1 p-4 h-36 rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Jumlah Reminder
                </p>
                <p class="text-2xl font-bold">
                    {{ $totalReminder }} Reminder
                </p>
            </div>
            <div class="flex flex-col gap-1 p-4 h-36 rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Jumlah Akun
                </p>
                <p class="text-2xl font-bold">
                    {{ $totalAccount }} Akun
                </p>
            </div>
            <div class="flex flex-col gap-1 p-4 h-36 rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Jumlah Page
                </p>
                <p class="text-2xl font-bold">
                    {{ $totalPage }} Page
                </p>
            </div>
            <div class="col-span-3 flex flex-col gap-1 p-4 h-full rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Kalender
                </p>
                <div id="calendar"></div>
            </div>
            <div class="flex flex-col gap-2 p-4 h-[680px] rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70 mb-2">
                    List Facebook Page
                </p>
                <div class="flex flex-col gap-2 overflow-y-auto">
                    @foreach ($pageList as $item)
                        <div class="flex flex-row gap-2 border border-2 border-primary-30 p-2 rounded-lg ">
                            <img src="assets\icons\facebook.png" class="w-10 h-10 rounded-full">
                            <div class="flex flex-col">
                                <p class="font-semibold">{{ $item['name'] }} Page</p>
                                <p class="text-xs text-primary-60">{{ $item['facebook_name'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-2 p-4 w-full rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Schedule Teratas
                </p>
                <table id="table-schedule" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Page Name</th>
                            <th scope="col">Post Capton</th>
                            <th scope="col">Post Time</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-span-2 p-4 w-full rounded-xl bg-white shadow-lg">
                <p class="text-lg font-semibold text-primary-70">
                    Reminder Teratas
                </p>
                <table id="table-reminder" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Reminder Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Reminder Time</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <style>
        .fc .fc-button-primary {
            background-color: #2652FF !important;
            color: white !important;
            border-color: #2652FF !important;
        }

        .fc:hover .fc-button-primary:hover {
            background-color: #1a3fbc !important;
            border-color: #1a3fbc !important;
        }

        .fc-next-button,
        .fc-prev-button {
            background-color: #2652FF !important;
            color: white !important;
            border-color: #2652FF !important;
        }

        .fc-next-button:hover,
        .fc-prev-button:hover {
            background-color: #1a3fbc !important;
            border-color: #1a3fbc !important;
        }
    </style>
@endsection

@section('scripts')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}
    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendarEvents = @json($calendarEvents);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2024-06-12',
                eventColor: '#2652FF',
                height: 610,
                events: calendarEvents,
                // eventDidMount: function(info) {
                //     new bootstrap.Tooltip(info.el, {
                //         title: info.event.extendedProps.description,
                //         placement: 'top',
                //         trigger: 'hover',
                //         container: 'body'
                //     });
                // }
                // eventTextColor: '#FFC300',
                // eventBackgroundColor: '#52CE29',
                // eventBorderColor: '#DB2D24',
                // headerToolbar: {
                //     left: 'prev,next today',
                //     center: 'title',
                //     right: 'dayGridMonth,timeGridWeek,timeGridDay'
                // },
            });
            calendar.render();

            let selectedData = null;

            $('#table-schedule').DataTable({
                paging: false, // Disable pagination
                searching: false, // Enable searching
                info: false, // Disable info
                lengthChange: false, // Disable length change
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}/schedules',
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
                        data: 'page_name',
                        name: 'page_name'
                    },
                    {
                        data: 'caption',
                        name: 'caption',
                        render: function(data, type, row) {
                            return '<div class="max-width">' + data + '</div>';
                        }
                    },
                    {
                        data: 'post_time',
                        name: 'post_time'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action'
                    // },
                ]
            });
            $('#table-reminder').DataTable({
                paging: false, // Disable pagination
                searching: false, // Enable searching
                info: false, // Disable info
                lengthChange: false, // Disable length change
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}/reminders',
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
                        name: 'email',
                        render: function(data, type, row) {
                            return '<div class="max-width">' + data + '</div>';
                        }
                    },
                    {
                        data: 'reminder_time',
                        name: 'reminder_time'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action'
                    // },
                ]
            });
        });
    </script>
@endsection
