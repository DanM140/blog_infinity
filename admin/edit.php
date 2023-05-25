<?php include'includes/session.php' ?>
<?php
  if(!isset($_GET['id'])){
    header('location: updates.php');
    exit();
  }
  else{
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT *,updates.name AS update_name,updates.id AS updateid, category.name AS catname,category.id AS catid FROM updates LEFT JOIN category ON category.id=updates.category_id   WHERE updates.id=:id");
    $stmt->execute(['id'=>$_GET['id']]);
    $id = $stmt->fetch();
$catid=$id['catid'];
    $pdo->close();
  }
  $now=date('Y-m-d');

?>
<?php 
include 'includes/title.php';
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
    <div class="w3-panel">
    
    <div class="w3-row-padding" style="margin:0 -16px">
     
      
                <div class="box-body" style="margin-top:20px;">
       <form class="form-horizontal" method="POST" action="update_edit.php">
                <input type="hidden" class="prodid" name="id" value="<?php echo $id['updateid']; ?>">
                <div class="form-group">
                  <label for="edit_name" class="col-sm-1 control-label">Name</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="edit_name" value='<?php echo $id['name']; ?>' name="name">
                  </div>

                  <label for="edit_category" class="col-sm-1 control-label">Category</label>

                  <div class="col-sm-5">
                    
                    <select class="w3-select w3-border"  name="category" id="select_category"required>
                      <option value="0">Categories</option>
                        <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>

                                         </select>
                  </div>
                  

                  
                </div>
                <p><b>Img Description</b></p>
                <div class="form-group">
                  <div class="col-sm-12">
                
                    <input type="text" class="form-control" id="image_description" value="<?php echo $id['image_description']; ?>" name="image_description" required>
                                  </div>
              </div>
                <p><b>Description</b></p>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea id="editor1" name="description" style=
 ' text-decoration:none;overflow: hidden;
    overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 10; /* number of lines to show */
   -webkit-box-orient: vertical;'>
     <?php echo $id['description'] ?>

   </textarea>

                  </div>
                  
                </div>
            </div>
                        <div class="modal-footer">
              
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
      </div>
    </div>
      
  </div>
   <?php include 'includes/article_modal.php'; ?>
  <?php include 'includes/article_modal2.php'; ?>
<?php include 'includes/profile_modal.php';?>
  </div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
 
    <p>Powered by <a href="#" target="_blank">Me and myself</a></p>
  </footer>

  <!-- End page content -->
</div>
 
 <?php include 'includes/scripts.php'; ?>
 <script>

$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'update_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.description);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
      $('#edit_name').val(response.prodname);
       $('#image_description').val(response.image);
      $('#catselected').val(response.category_id).html(response.catname);
            CKEDITOR.instances["editor2"].setData(response.description);
      getCategory();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>


</body>
</html>
