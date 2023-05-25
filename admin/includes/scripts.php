<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<!-- Active Script -->
<!-- Active Script -->
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $(document).on('click', '.editprofile', function(e){
    e.preventDefault();
    $('#profile').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
    $("#profile").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sendMail").click(function(){
      
      var email = [];

      $(".email:checked").each(function(){
        email.push($(this).val());
      });
      if (email.length > 0) {
          $("#emailMsg").html('<div class="alert alert-primary">Please wait...!</div>');
          $.ajax({
            url : "act.php",
            type : "POST",
            cache:false,
            data : {email:email
          },
            success:function(response){
              if(response == true) {
                $("#emailMsg").html(response);
              }else{
                $("#emailMsg").html();
              }
            }
          });
      }else{
        $("#emailMsg").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> Please Select at least one checkbox </div>');
      }
    });
  });
  </script>
  <script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.email').each(function(){
                this.checked = true;
            });
        }else{
             $('.email').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.email:checked').length == $('.email').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
  