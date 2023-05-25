<?php include'includes/session.php' ?>
<?php 
$where = '';
if (isset($_GET['category'])) {
$catid =$_GET['category'];
$where = 'WHERE category_id='.$catid;
}
$now=date('Y-m-d');
$d=date('d');
?>
<?php 
include 'includes/title.php';
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

 <?php include 'includes/header.php' ; 

 ?>
    <div class="w3-panel">
      <div class="w3-container w3-margin" >

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
     
      
                <div class="w3-white w3-responsive " >
        <table id="example1" class="table table-bordered">
          <thead>
            <th>Name</th>
            <th> Photo</th>
            <th>Description</th>
            <th> Preview</th>
            <th>Status</th>
            <th>Tools</th>
          </thead>
          <tbody>
              <?php
                    $conn = $pdo->open();
$now = date('Y-m-d');
                    try{
                     $stmt = $conn->prepare("


                      SELECT *, published.id AS updateid,published.status AS stat FROM published LEFT JOIN views ON published.id=views.article_id  $where AND  DAY(date_view)=:d ");
                      $stmt->execute(['d'=>$d]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        $status=($row['stat'])?'<span class="w3-tag w3-red">Activated</span>':'<span class="w3-tag w3-blue">De-Activated</span>';
                        $active=(!$row['stat'])?'<span class="w3-tag w3-blue"><a href="#publish" class="publish" data-toggle="modal" data-id="'.$row['updateid'].'"> <i class="fa fa-check-square-o"></i></a></a></span>':'<span class="w3-tag w3-red"><a href="#unpublish" class="publish" data-toggle="modal" data-id="'.$row['updateid'].'"> <i class="fa fa-check-square-o"></i></a></a></span>';
                        echo "
                          <tr>
                            <td><a href='#name_1' data-toggle='modal' class='btn  btn-sm btn-flat nam' data-id='".$row['updateid']."'><i class='fa fa-search'></i> Name</a></td>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                                                        </td>
                            <td><a href='#description' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='".$row['updateid']."'><i class='fa fa-search'></i> View</a></td>
                            <td><a href='preview.php?prev=".$row['updateid']."'  class='btn btn-info btn-sm btn-flat'> View</a></td>
                            <td>
                              ".$status."
                              ".$active."
                            </td>
                            <td>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['updateid']."'><i class='fa fa-trash'></i> Delete</button>
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
  <?php include 'includes/publish_modal.php'; ?>
  <?php include 'includes/publish_modal2.php'; ?>
<?php include 'includes/profile_modal.php';?>
  </div>



 
   
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    
    <p>Powered by <a href="#" target="_blank">Me and myself</a></p>
  </footer>

  <!-- End page content -->
</div>
 
 <?php include 'includes/scripts.php'; ?><script>

$(function(){
  
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
  $(document).on('click', '.nam', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

 $(document).on('click', '.publish', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });
  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'publish.php';
    }
    else{
      window.location = 'publish.php?category='+val;
    }
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'publish_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.description);
      $('#name').html(response.prodname);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
     
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
