
<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
  <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="bootstrap.bundle.min.js"></script>
  <style>

#cat1{
    background-color: aquamarine;
}
#cat2{
    background-color: rgb(246, 255, 127);
}
#cat3{
    background-color: rgb(129, 127, 255);
}
#cat4{
    background-color: rgb(255, 127, 187);
}
#cat5{
    background-color: rgb(161, 127, 255);
}
#cat6{
    background-color: rgb(255, 204, 127);
}

.fc-time-grid .fc-slats td {
    height: 3.2em;
}
    </style>
  <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    buttonText: {
                today: 'aurd',
                month: 'Mois',
                week: 'Week',
                day: 'Day'                
              },
      monthNames:['Janvier', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      monthNamesShort:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      dayNames:['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      dayNamesShort:['Dim', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay,listMonth'
    },
    minTime: '08:00:00', /* calendar start Timing */
    maxTime: '19:00:00',
    slotDuration: '00:15:00',
    //snapDuration: '01:00:00',
   // handleWindowResize: true,   
    height: $(window).height() ,
   // timeFormat: 'HH:mm',
   // height: 'parent',
    events: 'load.php', 
    selectable:true,
    selectHelper:true,
    select: function(start, end)
    {
      $("#satrtevent").val($.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss"));
      $("#endevent").val($.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss"));
      $("#exampleModal").modal('show');
      
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },
    dayClick:function(start,end){
     // alert(start +"\n" + end +"\n");

    },
    eventDestroy:function(event){
    //  if(confirm("Are you sure you want to remove it?"))
    //  {
    //   var id = event.id;
    //   $.ajax({
    //    url:"delete.php",
    //    type:"POST",
    //    data:{id:id},
    //    success:function()
    //    {
    //     calendar.fullCalendar('refetchEvents');
    //     alert("Event Removed");
    //    }
    //   })
    //  }
    },
    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },
    eventMouseover: function(event, jsEvent, view) {
            // if (view.name !== 'agendaDay') {
            //     $(jsEvent.target).attr('title', event.nomcomplet);
            // }
        },
  
    eventClick:function(event, jsEvent, view)
    {

      $("#exampleModal").modal("show");
      $("#nomcomplet").val(event.nomcomplet).prop('readonly', true);
      console.log(event.categorie);
      $("input[name=categories][value='" + event.categorie + "']").prop('checked', true).prop('readonly', true);
      $("#telephone").val(event.telephone).prop('readonly', true);
      $("#description").val(event.description).prop('readonly', true);
      $("#satrtevent").val(event.start).prop('readonly', true);
      $("#endevent").val(event.end).prop('readonly', true);
    //  if(confirm("Are you sure you want to remove it?"))
    //  {
    //   var id = event.id;
    //   $.ajax({
    //    url:"delete.php",
    //    type:"POST",
    //    data:{id:id},
    //    success:function()
    //    {
    //     calendar.fullCalendar('refetchEvents');
    //     alert("Event Removed");
    //    }
    //   })
    //  }
         //  $('#modalTitle').html(event.title);
           // $('#modalBody').html(event.description);
           // $('#eventUrl').attr('href',event.url);
          //  $('#calendarModal').modal();
         //  



    },
  
    eventRender: function (event, element) {
       // return '<div class="md-full-event"></div>';
      
    },
   
   });
 
  $("#btnev").click(function(){
       var nomcomplet = $("#nomcomplet").val();
       var categorie =$("input[name = 'categories']:checked").val();
       var telephone =$("#telephone").val();
       var description =$("#description").val();
       var start =  $("#satrtevent").val();
       var end = $("#endevent").val();
       var backgroundColor = $("input[name = 'categories']:checked").parent().css("background-color");
                $.ajax({
                url:"insert.php",
                type:"POST",
                data:{nomcomplet:nomcomplet, categorie:categorie, telephone:telephone, start:start, end:end, description:description,backgroundColor:backgroundColor },
                success: function()
                {
                  
                    calendar.fullCalendar('refetchEvents');
                    $("#nomcomplet").val('');
                    $("input[name=categories]").prop('checked', false);
                    $("#telephone").val('');
                    $("#description").val('');
                    $("#satrtevent").val('');
                    $("#endevent").val('');
                    $("#exampleModal").modal('hide');
                    alert("Added Successfully");
                }
                });  
    });
  });

    //     $("#btnev").click(function(start, end, allDay){
    //       var nomcomplet = $("#nomcomplet").val();
    //    var categorie =$("#input[name = 'categories']").val();
    //    var telephone =$("#telephone").val();
    //     var description =$("#description").val();
    //    console.log(nomcomplet);
    //             var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //             var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    //             $.ajax({
    //             url:"insert.php",
    //             type:"POST",
    //             data:{nomcomplet:nomcomplet, categorie:categorie, telephone:telephone, start:start, end:end, description:description },
    //             success: function()
    //             {
    //                // calendar.fullCalendar('refetchEvents');
    //                 alert("Added Successfully");
    //             }
    //             });  
    // });

  </script>
 
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2>
  <br />
  <div class="container">
  <button type="button" hidden id="btnmodal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button>
    
  <!-- start modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <!-- <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">date start</label>
                    <input type="datetime" name="datestart" id="datestart" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">date end</label>
                    <input type="datetime" name="dateend" id="dateend" class="form-control">
                </div> -->
                <div class="">
                    <label for="recipient-name" class="col-form-label">start event</label>
                    <input type="text" name="satrtevent" id="satrtevent" class="form-control" readonly>
                </div>
                <div class="">
                    <label for="recipient-name" class="col-form-label">end event</label>
                    <input type="textdatetime-local" name="endevent" id="endevent" class="form-control" readonly>
                </div>
                <div class="">
                    <label for="recipient-name" class="col-form-label">Nom complet</label>
                    <input type="text" name="nomcomplet" id="nomcomplet" class="form-control">
                </div>
                <div class="">
                    <label for="recipient-name" class="col-form-label">telephone :</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" id="recipient-name">
                </div>
                <div class="">
                    <label for="message-text" class="col-form-label">description:</label>
                    <input type="text" class="form-control" id="description" name="description"></input>
                </div>
               <span id="cat1"> <input type="radio" name="categories"  value="val1">val1 </span><br>
               <span id="cat2">  <input type="radio" name="categories" value="val2">val2</span> <br>
               <span id="cat3">  <input type="radio" name="categories" value="val3">val3 </span><br>
               <span id="cat4">  <input type="radio" name="categories"  value="val4">val4 </span><br>
               <span id="cat5">  <input type="radio" name="categories"  value="val5">val5</span> <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnev" class="btn btn-primary">Enregistrer</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->
   <div id="calendar" ></div>
  </div>


 </body>
 <script >


 </script>
</html>