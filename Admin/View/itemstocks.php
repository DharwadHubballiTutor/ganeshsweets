<?php
require_once("session.php");
include('inventoryheader.php');
require_once("../DB Operations/item_stocksOps.php");
require_once("../Model/item_stocksmodel.php");
?>
<h1 class="h3 mb-4 text-gray-800">Inventory Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Item Stock</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#itemstockModal>
                    <button type="button" + class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="itemstock_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style='display:none'>Item Id</th>
                        <th> Stock Batch No</th>
                        <th> Stock Quantity</th>
                        <th> Stock In Ward Date</th>
                        <th>Stock Comments</th>
                        <th>Stock Description</th>
                        <th>Action</th>
                    </tr>
                </thead>





                <tbody>
                    <?php
                    $itemstocklist = DBitemstock::getallItemstock();
                    foreach ($itemstocklist as $itemstock) {
                        echo "<tr>
                        <td style='display:none'>" . $itemstock->get_itemid() . "</td>
                        <td>" . $itemstock->get_itemstockbatchno() . "</td>
                        <td>" . $itemstock->get_itemstockquantity() . "</td>
                        <td>" . $itemstock->get_itemstockinwarddate() . "</td>
                        <td>" . $itemstock->get_itemstockcomments() . "</td>
                        <td>" . $itemstock->get_itemstockdescription() . "</td>
                        <td><a class='btn btn-secondary btn-circle btn-sm tooltip action-btn' data-toggle='modal' data-target='#editItemstockModal' role='button' data-id='" . $itemstock->get_itemstockid() . "'> <i class='fas fa-user-edit'></i> </a>
                        <a class='btn btn-danger btn-circle btn-sm tooltip action-btn' data-toggle='modal' data-target='#deleteStockModal' name='delete_button' role='button' data-id='" . $itemstock->get_itemstockid() . "'>
                        <i class='fas fa-trash-alt'></i>
                        <span class='tooltiptext'>Delete Stock</span>
                        </a>" . "</td></tr>
                    </span></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<div class="modal fade" id=itemstockModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="post" id="stock_form" enctype="multipart/form-data" action="../Controller/item_stockscontroller.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Items <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select id="itemid" class="form-select" required name="itemid">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item StockBatch Number <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockbatchno" id="itemstockbatchno" class="form-control" required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150" data-parsley-trigger="keyup" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Quantity <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockquantity" id="itemstockquantity" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Comments <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockcomments" id="itemstockcomments" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Description <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockdescription" id="itemstockdescription" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemstockcreatedby" id="itemstockcreatedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemstockmodifiedby" id="itemstockmodifiedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
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
<div class="modal fade" id=editItemstockModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
    <form id="editedstock_form" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Items <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select id="editeditemid" class="form-select" required name="itemid">

                                </select>
                             
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">stock Id <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="hidden" name="itemstockid" id="editeditemstockid" value="" class="form-control"/>
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item StockBatch Number <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockbatchno" id="editeditemstockbatchno" class="form-control" required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150" data-parsley-trigger="keyup" readonly />
                              
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Quantity <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockquantity" id="editeditemstockquantity" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Comments <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockcomments" id="editeditemstockcomments" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Item Stock Description <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="itemstockdescription" id="editeditemstockdescription" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemstockcreatedby" id="editeditemstockcreatedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="itemstockmodifiedby" id="editeditemstockmodifiedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="submit" id="editbutton" class="btn btn-success" value="Save" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id=deleteStockModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_stock_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete Stock</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this Stock record.
                    </p>
                    <input type="hidden" name="itemstockid" id="itemstockid" value="">
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
        var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();

        var url = config.developmentPath+ "/Admin/Controller/item_detailscontroller.php";
        $('#itemid').on('change', function(e) {

            $('#itemstockbatchno').val(day + '-' + month + '-' + year + '-' + $('#itemid').text().trim());
        })
        $.getJSON(url, function(data) {
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#itemid').append('<option value="' + value.itemid + '">' + value
                    .itemname + '</option>');
                $('#editeditemid').append('<option value="' + value.itemid + '">' + value
                    .itemname + '</option>');
            });
        });
        $('#itemstockModal').on('show.bs.modal', function(e) {
            var batchNo = day + "-" + month + "-" + year + "-" + $('#itemid').text().trim();
            $('#itemstockbatchno').val(batchNo);
        });


        $('#editItemstockModal').on('show.bs.modal', function(e) {
            debugger;
            var rowid = $(e.relatedTarget).data('id');
            $('#editeditemstockid').val(rowid);

        });
        var dataTable = $('#itemstock_table').DataTable({

        });
        var nEditing = null;

        $('#itemstock_table tbody').on('click', 'tr', function() {
            /* Get the row as a parent of the link that was clicked on */
            $('#editeditemid').val(this.cells[0].innerHTML);
            $('#editeditemstockbatchno').val(this.cells[1].innerHTML);
            $('#editeditemstockquantity').val(this.cells[2].innerHTML);
            $('#editeditemstockcomments').val(this.cells[4].innerHTML);
            $('#editeditemstockdescription').val(this.cells[5].innerHTML);
            $('#editItemstockModal').show();
        });
        
        $('#editedstock_form').submit(function(event) {
            // var formData = {itemid:$('#editeditemid').val(),
            //     itemstockid :$('#itemstockid').val(),
            //     itemstockbatchno :$('#editeditemstockbatchno').val(),
            //     itemstockquantity:  $('#editeditemstockquantity').val(),
            //     itemstockcomments: $('#editeditemstockcomments').val(),
            //     itemstockdescription:$('#editeditemstockdescription').val(),
            //     itemstockcreatedby:$('#itemstockcreatedby').val(),
            //     itemstockmodifiedby:$('#itemstockmodifiedby').val(),
            // };

            var formData= new FormData(this);
            debugger;
            $.ajax({
                type: "POST",
                url: config.developmentPath+"/Admin/Controller/item_stockscontroller.php",
                data: formData,
                processData: false,
                contentType: false
            }).done(function(data) {
                console.log(data);
            });
            $('#editItemstockModal').dispose();
            event.preventDefault();
        });

        $('#deleteStockModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#itemstockid').val(rowid);
    });
    $('#deletebutton').click(function() {
        $.ajax({
            url:  config.developmentPath+"/Admin/Controller/item_stockscontroller.php/",
            method: "POST",
            data: {
                id: $('#itemstockid').val(),
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