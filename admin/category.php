<?php include'includes/session.php' ?>
<?php 
include 'includes/title.php';
$now=date('Y-m-d');
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

 <?php include 'includes/header.php' ;?>

  <div class="w3-panel">
    <div class="w3-container "> <div class="w3-center " style="padding-top:1px">
      <div class="w3-large w3-border w3-blue"><b>Category</b></div>
</div> 

 <div class="w3-left" style="padding-top:1px;padding-bottom:5px"><a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>

</div>

</div>


    
    <div class="w3-row-padding" style="margin:0 -16px">
     <div  class="w3-white w3-responsive " >
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Category Name</th>
                  <th>Category Code</th>
                  <th>Category Class</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM category");
                      $stmt->execute();
                      foreach($stmt as $row){
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>".$row['code']."</td>
                            <td>".$row['class']."</td>
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
  

  <!-- End page content -->
  <?php include 'includes/category_modal.php'; ?>
  <?php include 'includes/catscripts.php';?>
</div>

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

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'category_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
      $('#edit_name').val(response.name);
      $('.catname').html(response.name);
      $('#edit_code').val(response.code);
      $('.catcode').html(response.code);
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
