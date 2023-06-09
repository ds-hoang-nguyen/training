@extends('master')
@section('content')

    <div class=" align-content-center col-md-12">
        <div class="card card-primary">
            <div class="card-body p-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                var date = new Date()
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear()

                const Calendar = FullCalendar.Calendar;

                const calendarEl = document.getElementById("calendar");

                let resources = {!! json_encode($timeSheets) !!};

                let data = resources.map(item => {
                    return {
                        id: item?.id,
                        title: item?.difficult + "\n" + item?.user.name,
                        start: setTimeToDate(item?.work_day),
                        end: setTimeToDate(item?.created_at),
                        backgroundColor: getRandomColor(),
                        borderColor: getRandomColor()
                    }
                });

                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

                function setTimeToDate(dateString) {
                    return new Date(dateString);
                }

                let calendar = new Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek'
                    },
                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: true,
                    },
                    displayEventEnd: true,
                    themeSystem: 'bootstrap',

                    events: data
                });
                calendar.render();
            })
        </script>
    @endpush
@endsection
