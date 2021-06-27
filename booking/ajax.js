$(document).ready(function() {
  $("#seat_group").change(function() {
    var seat_groups = $(this).val();
    if(seat_groups != "") {
      $.ajax({
        url:"get-date.php",
        data:{theater_id: seat_groups},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#showdate").html(resp);
        }
      });
    } else {
      $("#showdate").html("<option value=''>------- Select --------</option>");
    }
  });
});


$(document).ready(function() {
  $("#showdate").change(function() {
    var date_id = $(this).val();
    if(date_id != "") {
      $.ajax({
        url:"get-time.php",
        data:{d_id: date_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#time").html(resp);
        }
      });
    } else {
      $("#time").html("<option value=''>------- Select --------</option>");
    }
  });
});






