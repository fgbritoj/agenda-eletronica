$(document).ready(function() {

  $.ajax({
    url: '/api/load/calendar',
    type: "POST",
    dataType: "json",
    success: function(data) {
    //  console.log(data);
     $(document).ready(function() {

        // console.log();

        var calendarEl = document.getElementById('calendar');
    
        var now = new Date(Date.now());

        console.log(data.data);

        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek'
    
          },
          initialDate: now,
          navLinks: true, // can click day/week names to navigate views
          nowIndicator: true,
          locale: 'pt-br',
          
          weekNumbers: true,
          weekNumberCalculation: 'ISO',
    
          more: 'Mais',
          editable: false,
          selectable: true,
          dayMaxEvents: true, // allow "more" link when too many events
          buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            day: 'Dia',
          },

          events: data.data
          
        });

        
    
        calendar.render();

        // var date = calendar.getDate().toISOString('T')[1];

        // alert(date);

      });
    },
    error: function(error) {
      console.log('Erro na requisição: ', error);
    }
  });
})

