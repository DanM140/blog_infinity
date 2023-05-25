<?php include'includes/session.php' ?>
<?php 
include 'includes/title.php';
$now=date('Y-m-d');
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

 <?php include 'includes/header.php' ; 

 ?>
    <div class="w3-panel">
      <div class="w3-container w3-margin" >

      <div class="w3-left" style="padding-bottom:15px;">
        <a href="#addnew" data-toggle="modal"   class="btn btn-primary btn-sm btn-flat"  id="addproduct"><i class="fa fa-plus"></i> New User</a>

</div>
    </div>
    
    <div class="w3-row-padding" style="margin:0 -16px">
     
      
                <div class="w3-white w3-responsive">
        <table id="example1" class="table table-bordered">
          <thead>
            <th>Photo</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date Added</th>
                  <th>Tools</th>
          </thead>
          <tbody>
              <?php
                    $conn = $pdo->open();

                    try{
               $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type");
                      $stmt->execute(['type'=>2]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        $status=($row['status'])?'<span class="w3-tag w3-red">Activated</span>':'<span class="w3-tag w3-blue">De-Activated</span>';
                        $active=(!$row['status'])?'<span class="w3-tag w3-blue"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"> <i class="fa fa-check-square-o"></i></a></a></span>':'<span class="w3-tag w3-red"><a href="#deactivate" class="status" data-toggle="modal" data-id="'.$row['id'].'"> <i class="fa fa-check-square-o"></i></a></a></span>';
                        echo "
                        <tr>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>".$row['email']."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>
                              ".$status."
                              ".$active."
                            </td>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td>
                              <a href='article.php?user=".$row['id']."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> Articles</a>
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
  <?php include 'includes/users_modal.php'; ?>
 

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

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
       $('#catselected').html(response.type);
      $('.fullname').html(response.firstname+' '+response.lastname);
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
