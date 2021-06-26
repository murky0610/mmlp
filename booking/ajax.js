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