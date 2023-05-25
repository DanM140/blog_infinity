<?php include'includes/session.php' ?>
<?php 
$and = '';
if (isset($_GET['category'])) {
$catid =$_GET['category'];
$and = 'AND category_id='.$catid;
}
?>
<?php 
include 'includes/title.php';
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

 <?php
$now =date('Y-m-d');
  include 'includes/header.php' ; 

 ?>
    <div class="w3-panel">
      <div class="w3-container w3-margin" >

      <div class="w3-left" style="padding-bottom:15px;">
        <a href="#addnew" data-toggle="modal"   class="btn btn-primary btn-sm btn-flat"  id="addproduct"><i class="fa fa-plus"></i> New Blog</a>

</div>

<div class=" w3-right" >
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

                                         </select></div>

        


    </div>
    
    <div class="w3-row-padding" style="margin:0 -16px">
     
      
                <div class="box-body">
        <table id="example1" class="table table-bordered">
          <thead>
            <th> Photo</th>
            <th>Description</th>
            <th>Status</th>
            <th>Preview</th>
            <th>Tools</th>
          </thead>
          <tbody>
              <?php
                    $conn = $pdo->open();

                    try{
                  $stmt = $conn->prepare("SELECT * FROM published where published.user_id=:id $and");
                      $stmt->execute(['id'=>$admin['id']]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        $status=($row['status'])?'<span class="w3-tag w3-red">Published</span>':'<span class="w3-tag w3-blue">Unpublished</span>';
                        
                        echo "
                          <tr>
                                                         <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='".$row['id']."'><i class='fa fa-search'></i> View</a></td>
                            <td>".$status."</td>
                            <td><a href='preview.php?prev=".$row['id']."'  class='btn btn-info btn-sm btn-flat'> View</a></td>
                            
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>

          </tbody>
        </table>
      </div>
    </div>
      
  </div>
  <?php include 'includes/update_modal.php'; ?>
  <?php include 'includes/update_modal2.php'; ?>

  </div>



 
   
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <?php echo basename($_SERVER['PHP_SELF']); ?>
    <p>Powered by <a href="#" target="_blank">Me and myself</a></p>
  </footer>
 
  <?php include 'includes/profile_modal.php'; ?>
  <!-- End page content -->
</div>
 
 <?php include 'includes/scripts.php'; ?><script>

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
$(document).on('click', '.nam', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'updates.php';
    }
    else{
      window.location = 'updates.php?category='+val;
    }
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
