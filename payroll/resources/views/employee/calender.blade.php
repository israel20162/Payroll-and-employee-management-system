<x-employee-layout>
    <x-slot name='slot'>
        <div class="container overflow-y-scroll !max-h-screen"style='max-height:calc(100vh - 64px);'>
            <div id="calendar"></div>
        </div>


    </x-slot>
     @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        slotMinTime: '8:00:00',
                        slotMaxTime: '19:00:00',
                        events: @json($events),
                    });
                    calendar.render();
                });
            </script>
        @endpush
</x-employee-layout>
