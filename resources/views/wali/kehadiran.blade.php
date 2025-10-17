<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<style>
    #calendar {
        max-width: 900px;
        margin: 30px auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    #detail {
        max-width: 900px;
        margin: 20px auto;
        background: #f9fafb;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
    }
</style>
<div id="calendar"></div>
<div id="detail">
    <h3>📅 Detail Kehadiran</h3>
    <ul id="detailList"></ul>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events),
            eventClick: function(info) {
                const tanggal = info.event.startStr;
                const status = info.event.title;
                const keterangan = info.event.extendedProps.keterangan || '-';
                document.getElementById('detailList').innerHTML = `
          <li>Tanggal : ${tanggal}</li>
          <li>Status : ${status}</li>
          <li>Keterangan : ${keterangan}</li>
        `;
            }
        });
        calendar.render();
    });
</script>
