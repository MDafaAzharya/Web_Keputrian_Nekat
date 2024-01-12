@extends('layouts.navbar')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

h4{
    font-family:'Poppins', sans-serif;
    color:#2682A9;
}

.container{
    font-family:'Poppins', sans-serif;
}

.fc .fc-col-header-cell-cushion{
    text-decoration: none;
    color: #2682A9;
}

.fc .fc-daygrid-day-number{
    text-decoration: none;
    color: #2682A9;
}

</style>
<link rel="stylesheet" href="{{ asset('assets/css/agenda.css') }}">
<section class="section-dr-py bg-body ">
    <div class="container">
      <h3 class="text-center mb-3 mb-md-5"><span class="section-title">Program Terdaftar</h3>
      <div class="card" style="background-color:#fafafa;">
        <div class="card-body">
            <div id='calendar' class="calendar"></div>
        </div>
    </div>
    </div>
  </section>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      themeSystem: 'bootstrap5',
      events: `{{ route('agenda-show') }}`,
      })
      calendar.render();
    });
</script>
@endsection