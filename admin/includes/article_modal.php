<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style=
 ' text-decoration:none;overflow: hidden;
    overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;'><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body" style=
 ' text-decoration:none;overflow: hidden;
    overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 5; /* number of lines to show */
   -webkit-box-orient: vertical;'>
                <p id="desc" ></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Article</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="article_add.php" enctype="multipart/form-data">
                 <input type="hidden"  name="date_posted" value="<?php echo date("Y-m-d H:i:s "); ?>">
                 <input type="hidden"  name="writers_name" value="<?php echo $user['firstname']; ?>">
                 <input type="hidden"   name="user_id" value="<?php echo $user['id']; ?>">
                <div class="form-group">
                  <label for="name" class="col-sm-1 control-label">Name</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>

                  <label for="category" class="col-sm-1 control-label">Category</label>

                  <div class="col-sm-5">
                    <select class="form-control" id="category" name="category" required>
                      <option value="" selected>- Select -</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="photo" class="col-sm-1 control-label">Photo</label>

                  <div class="col-sm-5">
                    <input type="file" id="photo" name="photo">
                  </div>
                  <label for="name" class="col-sm-1 control-label">Image Info</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control"  name="image_description" required>
                  </div>
                </div>

                <p><b>Description</b></p>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea id="editor1" name="description" rows="10" cols="80" required></textarea>
                  </div>
                  
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style=
 ' text-decoration:none;overflow: hidden;
    overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;'><b><span class="name"></span></b></h4>
            </div>

            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="article_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>