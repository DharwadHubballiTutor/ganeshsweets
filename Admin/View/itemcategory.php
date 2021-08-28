<?php
include('category.php');
require_once("../DB Operations/item_categoryOps.php");
require_once("../Model/item_categorymodel.php");
?>
<h1 class="h3 mb-4 text-gray-800">Inventory Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Item Category</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#itemcatModal>
                    <button type="button" + class="btn btn-success btn-circle btn-sm"><i
                            class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="itemcat_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Item Category</th>
                        <th>Item Category Description.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $itemcatlist = DBitemcategory::getallItemcategory();
                    foreach ($itemcatlist as $itemcat) {
                        echo "<tr><td>" . $itemcat->get_itemcatname() . "</td>
                        <td>" . $itemcat->get_itemcatdescription() . "</td>
                        <td>
                        <div class='dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' 
                        type='button' 
                        id='dropdownMenu2' 
                        data-toggle='dropdown' 
                        aria-expanded='false'>
                        Actions
                        </button>
                        <div class='dropdown-menu' 
                        aria-labelledby='dropdownMenu2'>
                            <button class='btn btn-primary dropdown-item'
                            data-toggle='modal' 
                            data-target='#editItemcatModal' 
                            role='button' 
                            data-id='".$itemcat->get_itemcatid()."'>
                            <i class='fas fa-user-edit'></i> 
                                Edit Category
                           </button>
                           <button class='btn btn-primary dropdown-item'
                           data-toggle='modal' 
                           data-target='#deleteCategoryModal' 
                           name='delete_button' 
                           role='button' 
                           data-id='" . $itemcat->get_itemcatid() . "'>
                            <i class='fas fa-trash-alt'></i>
                              Delete Category
                          </button>
                        </div>
                    </div>     
                        </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<div class="modal fade" id=itemcatModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data"
            action="../Controller/item_categorycontroller.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Category Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemcatname" id="itemcatname" class="form-control" required
                                    data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Category Description<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <textarea  name="itemcatdescription" id="itemcatdescription" class="form-control"
                                    required ></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="hidden" name="itemcatcreatedby" id="itemcatcreatedby" class="form-control"
                                    required data-parsley-type="integer" data-parsley-minlength="10"
                                    data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemcatmodifiedby" id="itemcatmodifiedby"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id=editItemcatModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="post" id="itemcat_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Category Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemcatname" id="editedItemcatname" class="form-control"
                                    required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                                <input type="hidden" name="itemcatid" id="itemcatid" value="">
                            </div>
                        </div>
                    </div>
                    


                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Category Description<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <textarea  name="editedItemcatdescription" id="editedItemcatdescription" class="form-control"
                                    required ></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="hidden" name="itemcatcreatedby" id="editedItemcatcreatedby"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="hidden" name="itemcatmodifiedby" id="editedItemcatmodifiedby"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="submit" name="submit" id="editbutton" class="btn btn-success" value="Save" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id=deleteCategoryModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_category_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete Item Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this category record.
                    </p>
                    <input type="hidden" name="itemcatid" id="itemcatid" value="">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="submit" name="submit" id="deletebutton" class="btn btn-danger" value="Confirmed" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {

    $('#editItemcatModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#itemcatid').val(rowid);

    });
    var dataTable = $('#itemcat_table').DataTable({

    });

    var nEditing = null;

    $('#itemcat_table tbody').on('click', 'tr', function() {
        /* Get the row as a parent of the link that was clicked on */
        $('#editedItemcatname').val(this.cells[0].innerHTML);
        $('#editedItemcatdescription').val(this.cells[1].innerHTML);

    });
    $('#editbutton').click(function(event) {
        var formData = {
            itemcatid: $('#itemcatid').val(),
            itemcatname: $('#editedItemcatname').val(),
            itemcatdescription: $('#editedItemcatdescription').val(),
            itemcatcreatedby: $('#editedItemcatcreatedby').val(),
            itemcatmodifiedby: $('#editedItemcatmodifiedby').val(),
        };

        $.ajax({
            type: "POST",
            url: config.developmentPath+
                "/Admin/Controller/item_categorycontroller.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function(data) {
            console.log(data);
        });
        $('#editbutton').dispose();
        event.preventDefault();
    });
    $('#deleteCategoryModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#itemcatid').val(rowid);
    });
    $('#deletebutton').click(function() {
        $.ajax({
            url:  config.developmentPath+"/Admin/Controller/item_categorycontroller.php/",
            method: "POST",
            data: {
                id: $('#itemcatid').val(),
                action: 'delete'
            },
            success: function(data) {
                $('#message').html(data);
                dataTable.ajax.reload();
                setTimeout(function() {
                    $('#message').html('');
                }, 5000);
            }
        });
    });
});
</script>