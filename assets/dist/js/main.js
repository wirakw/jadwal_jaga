

$(function(){

    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event

    $('#color').colorpicker(); // Colopicker

    var base_url='http://jj.opsigo.xyz/'; // Here i define the base_url

    // Fullcalendar
    $('#calendar').fullCalendar({
		googleCalendarApiKey: 'AIzaSyDjOv4MMdIMqAcdWlVCG1gsIm4wMLyqbF0',
        header: {
            left: 'prev, next, today',
            center: 'title',
             right: 'month, basicWeek, basicDay'
        },
        // Get all events stored in database
        eventLimit: true, // allow "more" link when too many events
		events: base_url+'calendar/getEvents',
        selectable: true, //untuk dev ini di buat false
        selectHelper: true, //untuk dev ini di buat false
        editable: false, // Make the event resizable true
        displayEventTime: false,
        eventOrder: "status",
        dayNamesShort: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],//nama default dari hari
            select: function(start, end) {

                $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                 // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-success', // Buttons class
                        label: 'Save' // Buttons label
                    }
                },
                title: 'Input Jadwal Manual' // Modal title
            });
            },

         eventDrop: function(event, delta, revertFunc,start,end) {

            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }

               $.post(base_url+'calendar/dragUpdateEvent',{
                id:event.id,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('updated successfuly');
                hide_notify();
            });
          },

        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view){

            var tooltip = '<div class="event-tooltip">' + calEvent.status + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) { //untuk dev ini di buat comend
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;
            // Open modal to edit or delete event
            modal_update({
                // Available buttons when editing
                buttons: {
                    update: {
                        id: 'update-event',
                        css: 'btn-success',
                        label: 'Update'
                      },
                    delete: {
                        id: 'delete-event',
                        css: 'btn-danger',
                        label: 'Delete'
                    }
                },
                title: 'Edit Dev "' + calEvent.title + '"',
                event: calEvent
            });
        } //sampai sini

    });

    // Prepares the modal window according to data passed
    function modal(data) {
        // Set modal title
        $('.modal-title').html(data.title);
        // Clear buttons except Cancel
        $('.modal-footer button:not(".btn-default")').remove();
        // Set input values
        $('#title').val('');
        $('#title2').val('');
        // Create Butttons
        $.each(data.buttons, function(index, button){
            $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
        })
        //Show Modal
        $('#modal').modal('show');
    }
    function modal_update(data){
      // Set modal title
      $('.modal-title').html(data.title);
      // Clear buttons except Cancel
      $('.modal-footer button:not(".btn-default")').remove();
      // Set input values
      $('#title_update').val(data.event ? data.event.title : '');
      $('#dev_sebelumnya').val(data.event ? data.event.dev_sebelumnya : '');
      $('#description').val(data.event ? data.event.description : '');
      // Create Butttons
      $.each(data.buttons, function(index, button){
          $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
      })
      //Show Modal
      $('#modal1').modal('show');
    }

    // Handle Click on Add Button
    $('#modal').on('click', '#add-event',  function(e){
        if(validator(['title','title2']) && checksame('title','title2')){
            $.post(base_url+'calendar/addEvent', {
                title: $('#title').val(),
                status: $('#status').val(),
                color: $('#color').val(),
                start: $('#start').val(),
                end: $('#end').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('add successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
            $.post(base_url+'calendar/addEvent', {
                title: $('#title2').val(),
                status: $('#status2').val(),
                color: $('#color2').val(),
                start: $('#start').val(),
                end: $('#end').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('add successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
        }
    });

    $('#input_libur').on('click', '#insert_libur',  function(e){
        if(validator(['Ket_libur'])) {
          $.post(base_url+'calendar/addLibur', {
              title: $('#Ket_libur').val(),
              status: $('#status_libur').val(),
              color: $('#color_libur').val(),
              start: $('#start_libur').val(),
              end: $('#end_libur').val()
          }, function(result){
              $('.alert').addClass('alert-success').text('add successfuly');
              $('#input_libur').removeClass("in");
              $(".modal-backdrop").remove();
              $("#input_libur").hide();
              $('#calendar').fullCalendar("refetchEvents");
              hide_notify();
          });
          }
    });

    // Handle click on Update Button
    $('#modal1').on('click', '#update-event',  function(e){
        if(validator(['dev_sebelumnya'])) {
            $.post(base_url+'calendar/updateEvent', {
                id: currentEvent._id,
                title: $('#dev_sebelumnya').val(),
                dev_sebelumnya : $('#title_update').val(),
                description: $('#description').val(),
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
          }
    });

    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
        $.get(base_url+'calendar/deleteEvent?id=' + currentEvent._id, function(result){
            $('.alert').addClass('alert-success').text('delete successfully !');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();
        });
    });

    function hide_notify()
    {
        setTimeout(function() {
                    $('.alert').removeClass('alert-success').text('');
                }, 2000);
    }


    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Developer Belum Terisi');
            return false;
        }
        return true;
    }

	    function checksame(elements, elements2) {
        var errors = 0;
            if($.trim($('#' + elements).val()) == $.trim($('#' + elements2).val())) errors++;

        if(errors) {
            $('.error').html('Developer tidak boleh sama');
            return false;
        }
        return true;
    }




});
