<?php include('inventoryheader.php');
require_once("../DB Operations/item_detailsOps.php");
require_once("../DB Operations/item_categoryOps.php");
require_once("../DB Operations/item_subcategoryOps.php");
require_once("../Model/item_detailsmodel.php");
?>
<h1 class="h3 mb-4 text-gray-800">Inventory Management</h1>

<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Item List</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#itemdetailsModal>
                    <button type="button" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered" id="item_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th style='display:none'>Category Id</th>
                        <th>Item Category</th>
                        <th style='display:none'>SubCategory Id</th>
                        <th>Item Subcategory</th>
                         <th style='display:none'>Item image </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $itemdetailslist = DBitemdetails::getallItemdetails();
                    foreach ($itemdetailslist as $itemdetails) {
                        echo "<tr><td>" . $itemdetails->get_itemname() . "</td>
                        <td>" . $itemdetails->get_itemdescription() . "</td>
                        <td style='display:none'>" . $itemdetails->get_itemcatid() . "</td>
                        <td>" . $itemdetails->get_itemcategoryname() . "</td>
                        <td style='display:none'>" . $itemdetails->get_itemsubcatid() . "</td>
                        <td>" . $itemdetails->get_itemsubcategoryname() . "</td>

                        <td style='display:none'>" . $itemdetails->get_itemimage() . "</td>

                        <td>  <div class='dropdown'>
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
                            data-target='#detailsItemModal' 
                            role='button' data-id='" . $itemdetails->get_itemid() . "'> 
                            <i class='fas fa-info-circle'></i>
                               Item Info
                            </button>
                            <button class='btn btn-primary dropdown-item'
                            data-toggle='modal' 
                            data-target='#edititemdetailsModal' 
                            role='button' data-id='" . $itemdetails->get_itemid() . "'> 
                            <i class='fas fa-user-edit'></i>
                                Edit Item
                           </button>
                           <button class='btn btn-primary dropdown-item'
                           data-toggle='modal' 
                           data-target='#deleteItemModal' 
                           role='button' 
                           data-id='" . $itemdetails->get_itemid() . "'>
                            <i class='fas fa-trash-alt'></i>
                              Delete Item
                          </button>
                        </div>
                    </div>

                       </td></tr>
                        </span></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<div class="modal fade" id=itemdetailsModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <form method="post" id="itemdetails_form" enctype="multipart/form-data"
           action="../Controller/item_detailscontroller.php" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Item Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemname" id="itemname" class="form-control" required
                                    data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                                <input type="hidden" id="itemcatid" name="itemcatid" value="">
                                <input type="hidden" id="itemsubcatid" name="itemsubcatid" value="">
                                <input type="hidden" id="itemcompid" name="itemcompid" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Category<span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <select id="itemCategory" class="form-select" required name="itemCategory">
                                   
                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-primary" data-toggle='modal' data-target='#itemcatModal'><i
                                        class="fas fa-plus-circle"></i> Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Subcategory<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <select id="subCategory" class="form-select" required name="subCategory">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-primary" data-toggle='modal' data-target='#itemsubcatModal'><i
                                        class="fas fa-plus-circle"></i> SubCategory</a>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Description<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <textarea  name="itemdescription" id="itemdescription" class="form-control"
                                    required ></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Upload Item Image <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="file" name="itemimage" id="itemimage"
                                 class="form-control"
                                     />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemcreatedby" id="itemcreatedby" class="form-control"
                                    required data-parsley-type="integer" data-parsley-minlength="10"
                                    data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemmodifiedby" id="itemmodifiedby" class="form-control"
                                    required data-parsley-type="integer" data-parsley-minlength="10"
                                    data-parsley-maxlength="12" data-parsley-trigger="keyup"
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
<div class="modal fade " id=edititemdetailsModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <form method="post" id="editeditemdetails_form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Edit Item Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Name <span class="text-danger">*</span></label>

                            <div class="col-md-8">
                                <input type="text" name="itemname" id="editeditemname" class="form-control" required
                                    data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                                <input type="hidden" id="itemid" name="itemid" value="">
                                <input type="hidden" id="editeditemcatid" name="itemcatid" value="">
                                <input type="hidden" id="editeditemsubcatid" name="itemsubcatid" value="">
                                <input type="hidden" id="editeditemcompid" name="itemcompid" value="">
                            </div>
                        </div>
                    </div>


              
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Category<span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <select id="editeditemCategory" class="form-select" required name="itemCategory">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-primary" data-toggle='modal' data-target='#itemcatModal'><i
                                        class="fas fa-plus-circle"></i> Category</a>
                            </div>
                        </div>
                    </div>

                    



                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Subcategory <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <select id="editedsubCategory" class="form-select" required name="subCategory">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-primary" data-toggle='modal' data-target='#itemsubcatModal'><i
                                        class="fas fa-plus-circle"></i> SubCategory</a>
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Description<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <textarea  name="itemdescription" id="editeditemdescription" class="form-control"
                                    required ></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Upload Item Image <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="file" name="itemimage" id="editeditemimage" class="form-control"
                                    data-parsley-minlength="6" data-parsley-maxlength="16"
                                    data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemcreatedby" id="editeditemcreatedby" class="form-control"
                                    required data-parsley-type="integer" data-parsley-minlength="10"
                                    data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemmodifiedby" id="editeditemmodifiedby"
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
<div class="modal fade" id=deleteItemModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_item_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this Item.
                    </p>
                    <input type="hidden" name="itemid" id="deleteitemid" value="">
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
<div class="modal fade" id=itemcatModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="addCategoryForm" enctype="multipart/form-data">
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
                            <label class="col-md-4 text-right">Category Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemcatdescription" id="itemcatdescription"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12"
                                    data-parsley-trigger="keyup" />
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
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="submit" id="addCategorybtn" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>
<div class="modal fade" id=itemsubcatModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="subCategoryForm" enctype="multipart/form-data">
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
                                <select id="additemCategory" class="form-select" required name="itemcatid">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">SubCategory Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemsubcatname" id="itemsubcatname" class="form-control"
                                    required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">SubCategory Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemsubcatdescription" id="itemsubcatdescription"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12"
                                    data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemsubcatcreatedby" id="itemsubcatcreatedby"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="hidden" name="itemsubcatmodifiedby" id="itemsubcatmodifiedby"
                                    class="form-control" required data-parsley-type="integer"
                                    data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="submit" id="addSubCategorybtn" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id=detailsItemModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Item Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="" alt="..." id="itemImage" width="200px" height="200px">
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displayItemName">Item Name</label>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title" id="displayItemName"></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displayItemCategory">Item Category</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displayItemCategory"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displayItemSubCategory">Item Subcategory</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displayItemSubCategory"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <label for="displayItemDescription">Description</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displayItemDescription"></p>
                                    </div>
                                </div>
                               


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

$('#editedunitFactor').on('change', function(){
    calculateeditedTotalMPR();
})

    $('#edititemdetailsModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#itemid').val(rowid);
       
        
    });
     var uniturl = config.developmentPath+
        "/Admin/Controller/unitsContoller.php"
    $.getJSON(uniturl, function(data) {
        loadEditedUnitFactor(data[0].unitId);
        $.each(data, function(index, value) {
            // APPEND OR INSERT DATA TO SELECT ELEMENT.
            $('#editedunit').append('<option value="' + value.unitId + '">' + value
                .unitName + '</option>');
        });
       
    });

    function loadEditedUnitFactor(unitId) {

        $('#editedunitFactor').empty();
        unitFactorurl =
            config.developmentPath+
            "/Admin/Controller/unitFactorController.php/?unitId=" + unitId;
        $.getJSON(unitFactorurl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#editedunitFactor').append('<option value="' + value.unitFactorId +
                    '">' + value.unitFactor + '</option>');
            });
        });
    }
    var dataTable = $('#item_table').DataTable({});
    var nEditing = null;
    $('#item_table tbody').on('click', 'tr', function() {
     
        /* Get the row as a parent of the link that was clicked on */
        $('#editeditemname').val(this.cells[0].innerHTML);
        $('#displayItemName').text(this.cells[0].innerHTML);


        $('#editeditemdescription').val(this.cells[1].innerHTML);
        $('#displayItemDescription').text(this.cells[1].innerHTML);


        $('#editeditemCategory').val(this.cells[3].innerHTML);
        $('#displayItemCategory').text(this.cells[3].innerHTML);

        $('#displayItemSubCategory').text(this.cells[5].innerHTML);

      
        $('#editedsubCategory').empty();

        $('#itemImage').attr('src', config.developmentPath+
            "/Admin/img/items/" + this.cells[6].innerHTML)

        var fetchsubcaturl = config.developmentPath+
            "/Admin/Controller/item_subcategorycontroller.php/?catId=" + $(
                '#editeditemCategory').val();
                var subcatid=this.cells[5].innerHTML;
        $.getJSON(fetchsubcaturl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                
                if(value.itemsubcatid== subcatid){
                    $('#editedsubCategory').append('<option selected value="' + value
                    .itemsubcatid +
                    '">' + value
                    .itemsubcatname + '</option>');
                }else{
                    $('#editedsubCategory').append('<option value="' + value
                    .itemsubcatid +
                    '">' + value
                    .itemsubcatname + '</option>');
                }
                
            });
        });
 
    });
    var uniturl = config.developmentPath+
        "/Admin/Controller/unitsContoller.php"
    $.getJSON(uniturl, function(data) {
        loadUnitFactor(data[0].unitId);
        $.each(data, function(index, value) {
            $('#unit').append('<option hidden disabled selected value>-- select an option --</option>');
            $('#unit').append('<option value="' + value.unitId + '">' + value
                .unitName + '</option>');
        });
       
    });

    function loadUnitFactor(unitId) {
        $('#unitFactor').empty();
        unitFactorurl =
            config.developmentPath+
            "/Admin/Controller/unitFactorController.php/?unitId=" + unitId;
        $.getJSON(unitFactorurl, function(data) {
            $.each(data, function(index, value) {
                $('#unitFactor').append('<option hidden disabled selected value>Blank</option>');
                $('#unitFactor').append('<option value="' + value.unitFactorId +
                    '">' + value.unitFactor + '</option>');
            });
        });
    }

    $('#editeditemdetails_form').submit(function(event) {

        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: config.developmentPath+
                "/Admin/Controller/item_detailscontroller.php/",
            data: formData,
            processData: false,
            contentType: false
        }).done(function(data) {
            console.log(data);
        });
        $('#edititemdetailsModal').dispose();
        event.preventDefault();
    });
    var url = config.developmentPath+ "/Admin/Controller/item_categorycontroller.php";
    let isSelectedSet = false;
    let catId = 0;
    $.getJSON(url, function(data) {
      
        $.each(data, function(index, value) {
            if (isSelectedSet === false) {
                $('#itemCategory').append('<option selected value="' + value.itemcatid +
                    '">' +
                    value
                    .itemcatname + '</option>');
                $('#editeditemCategory').append('<option selected value="' + value
                    .itemcatid +
                    '">' + value
                    .itemcatname + '</option>');
                isSelectedSet = true;
                setSubCategory(value.itemcatid);
                
            } else {
                $('#itemCategory').append('<option hidden disabled selected value>-- select an option --</option>');
                $('#itemCategory').append('<option value="' + value.itemcatid + '">' + value
                    .itemcatname + '</option>');
                $('#editeditemCategory').append('<option value="' + value.itemcatid + '">' +
                    value
                    .itemcatname + '</option>');
            }
        });
    });

    function setSubCategory(catId) {
        var fetchsubcaturl = config.developmentPath+
            "/Admin/Controller/item_subcategorycontroller.php/?catId=" +
            catId;
        $.getJSON(fetchsubcaturl, function(data) {
            
            $('#subCategory').append('<option hidden disabled selected value>-- select an option --</option>');
            $.each(data, function(index, value) {
                
                $('#subCategory').append('<option value="' + value.itemsubcatid + '">' +
                    value
                    .itemsubcatname + '</option>');
                $('#editedsubCategory').append('<option value="' + value.itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
            });
        });
    }
    // var fetchcompany = config.developmentPath+ "/Admin/Controller/brandcontroller.php/"
    // $.getJSON(fetchcompany, function(data) {

    //     $.each(data, function(index, value) {
    //         $('#company').append('<option hidden disabled selected value>-- select an option --</option>');
    //         $('#company').append('<option value="' + value.brandid + '">' + value
    //             .brandname + '</option>');
    //         $('#editedcompany').append('<option value="' + value.brandid + '">' + value
    //             .brandname + '</option>');
    //     });
    // });

    $('#unit').on('change', function() {
        $('#unitFactor').empty();
        unitFactorurl =
            config.developmentPath+
            "/Admin/Controller/unitFactorController.php/?unitId=" + this
            .value;
        $.getJSON(unitFactorurl, function(data) {
            
            $.each(data, function(index, value) {
                
                $('#unitFactor').append('<option value="' + value.unitFactorId +
                    '">' +
                    value
                    .unitFactor + '</option>');
            });
        });
    });
    $('#editedunit').on('change', function() {
        $('#editedunitFactor').empty();
        unitFactorurl =
            config.developmentPath+
            "/Admin/Controller/unitFactorController.php/?unitId=" + this
            .value;
        $.getJSON(unitFactorurl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#editedunitFactor').append('<option value="' + value.unitFactorId +
                    '">' +
                    value
                    .unitFactor + '</option>');
            });
        });
    });
    $('#itemCategory').on('change', function() {
        $('#subCategory').empty();
        fetchsubcaturl =
            config.developmentPath+
            "/Admin/Controller/item_subcategorycontroller.php/?catId=" + this
            .value;
            
        $.getJSON(fetchsubcaturl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#subCategory').append('<option value="' + value.itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
            });
        });
    });
    $('#editeditemCategory').on('change', function() {
        $('#editedsubCategory').empty();
        fetchsubcaturl =
            config.developmentPath+
           "/Admin/Controller/item_subcategorycontroller.php/?catId=" + this
            .value;
            
        $.getJSON(fetchsubcaturl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#editedsubCategory').append('<option value="' + value
                    .itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
            });
        });
    });

    $('#itemsubcatModal').on('show.bs.modal', function(e) {
        $('#additemCategory').empty();
        $.getJSON(url, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#additemCategory').append('<option value="' + value.itemcatid +
                    '">' + value
                    .itemcatname + '</option>');
            });
        });
    });

    $('#deleteItemModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#deleteitemid').val(rowid);
    });
    $('#deletebutton').click(function() {
        $.ajax({
            url:  config.developmentPath+"/Admin/Controller/item_detailscontroller.php/",
            method: "POST",
            data: {
                id: $('#deleteitemid').val(),
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
    $('#addCategoryForm').submit(function(event) {

        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: config.developmentPath+
                "/Admin/Controller/item_categorycontroller.php/",
            data: formData,
            processData: false,
            contentType: false
        }).done(function(data) {
            console.log(data);
        });
        reloadCategoryList();
        $('#itemcatModal').hide();
    });
    $('#subCategoryForm').submit(function(event) {
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: config.developmentPath+
                "/Admin/Controller/item_subcategorycontroller.php/",
            data: formData,
            processData: false,
            contentType: false
        }).done(function(data) {
            console.log(data);
        });
        reloadSubCategoryList();
        $('#itemsubcatModal').hide();
    });
   
    function reloadCategoryList() {
        $('#itemCategory').empty();
        $.getJSON(url, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#itemCategory').append('<option value="' + value.itemcatid + '">' +
                    value
                    .itemcatname + '</option>');
            });
        });
    }

    function reloadSubCategoryList() {
        var selectedCategory = $('#itemCategory').val();
        fetchcompany = config.developmentPath+
            "/Admin/Controller/item_compdetailscontroller.php/?catId=" + selectedCategory;

        $('#subCategory').empty();
        $.getJSON(fetchsubcaturl, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.

                $('#subCategory').append('<option value="' + value.itemsubcatid + '">' +
                    value.itemsubcatname + '</option>');
            });
        });
    }




</script>