<?php
include "salesorderheader.php";
include('../DB Operations/SOlineItemOps.php');
include('../DB Operations/salesorderOps.php');
$id = $_GET['id'];
?>
<h1 class="h3 mb-4 text-gray-800">Sales Order Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Sales Order line Item</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#AddModal data-id=<?php echo "'" . $id . "'" ?>>
                    <button type="button" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>
    <?php
                    $saleOrder = DBSales::getsalesForPrint($id);
                    
    ?>
    <fieldset class="container border">
            <legend>Sale Order Info :</legend>
            <div class="row">
                <div class="col">
                    <label>Customer Id :
                        <span><?php echo $saleOrder->getCustomerCode() ?></span>
                    </label>
                </div>
                <div class="col">
                    <label>Customer Name :
                        <span><?php echo $saleOrder->getCustomerName() ?></span>
                    </label>
                </div>
                <div class="col">
                <label>Customer Phone :
                        <span><?php echo $saleOrder->getCustomerContactNumber() ?></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Sale Order Id :
                        <span><?php echo $saleOrder->getSOcode() ?></span>
                    </label>
                </div>
                <div class="col">
                    <label>Sales Order value :
                        <span><?php echo $saleOrder->get_totalAmount() ?></span>
                    </label>
                </div>
                <div class="col">
                <label>DOS :
                        <span><?php echo $saleOrder->get_salesdate() ?></span>
                    </label>
                </div>
            </div>
    </fieldset>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered" id="lineItem_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style='display:none'>SOlineitem ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th> Price</th>
                        <th>Total Amount</th>
                        <th style='display:none'>Item Category</th>
                        <th style='display:none'>Item Sub Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $SOListItem = DBSOLineItem::getLineItemBySalesIdForOrder($id);
                    foreach ($SOListItem as $Item) {
                        echo "<tr>
                        <td style='display:none'>" . $Item->get_SOlineitemId() . "</td>
                        <td>" . $Item->getName() . "</td>
                        <td>" . $Item->get_quantity() . "</td>
                        <td>" . $Item->getunitName() . "</td>
                        <td>" . $Item->get_price() . "</td>
                        <td>" . $Item->get_totalamt() . "</td>
                        <td style='display:none'>" . $Item->getItemcatname() . "</td>
                        <td style='display:none'>" . $Item->getItemsubcatname() . "</td>
                  
                        <td><div class='dropdown'>
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
                            data-target='#EditModal' 
                            role='button' 
                            data-id='" . $Item->get_SOlineitemId() . "'>
                            <i class='fas fa-user-edit'></i> 
                                Edit Item
                           </button>
                           <button class='btn btn-primary dropdown-item'
                           data-toggle='modal' data-target='#deleteLineItemModal' 
                           name='delete_button' 
                           role='button' 
                           data-id='" . $Item->get_SOlineitemId() . "'>
                            <i class='fas fa-trash-alt'></i>
                              Delete Item
                          </button>
                        </div>
                    </div> </td></tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <div class="modal fade" id=AddModal tabindex=-1 role=dialog aria-hidden=true>
        <div class="modal-dialog modal-xl">
            <form class="" method="POST" id="add_form" enctype="multipart/form-data" action="../Controller/SOlineItemController.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Category Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <select id="additemCategory" class="form-select" required name="itemCategory">

                                    </select>
                                </div>
                                <label class="col-md-3 text-right">Item Sub Category Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <select id="additemsubCategory" class="form-select" required name="itemsubCategory">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Item Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <select id="additemid" class="form-select" required name="additemid">

                                    </select>

                                    <input type="hidden" name="SOID" id="SOID" value="">
                                    <input type="hidden" name="selectedItemName" id="addselectedItemName" class="form-control" value="" />
                                    <input type="hidden" name="unitFactor" id="unitFactor" class="form-control" value="" />
                                </div>

                                <label class="col-md-3 text-right">Item Quantity <span class="text-danger">*</span></label>
                                <div class="col-md-3 input-group">
                                    <input type="number" name="quantity" id="quantity" class="form-control" pattern="[0-9]+" title="please enter number only"required>
                                    <select class="input-group-text" id="unit" class="form-select" required name="unit"></select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Item per piece MRP <span class="text-danger">*</span></label>
                                <div class="col-md-3 input-group">
                                    <input type="text" name="price" id="price" class="form-control" required />
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                </div>
                                <label class="col-md-3 text-right">Total Amount <span class="text-danger">*</span></label>
                                <div class="col-md-3 input-group">
                                    <input type="text" name="totalamt" id="totalamt" class="form-control" required />
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="createdby" id="createdby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="">Add Line Item</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id=EditModal tabindex=-1 role=dialog aria-hidden=true>
        <div class="modal-dialog modal-xl">
            <form class="" method="POST" id="edit_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Line Item Details</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Category Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type=text id="editeditemCategory" class="form-control" required readonly name="itemCategory">
                                </div>
                                <label class="col-md-3 text-right">Item Sub Category Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type=text id="editeditemsubCategory" class="form-control" required readonly name="itemsubCategory">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Item Name <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" name="editeditemname" id="editeditemname" class="form-control" readonly />
                                    <input type=hidden id="additemid" class="form-control" required readonly name="itemid">
                                    <input type="hidden" name="SOlineItemId" id="SOlineItemId" value="">
                                    <input type="hidden" name="SOID" id="SOID" value="">
                                    <input type="hidden" name="selectedItemName" id="addselectedItemName" class="form-control" value="" />

                                </div>
                                <label class="col-md-3 text-right">Item Quantity <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="number" name="editedquantity" id="editedquantity" class="form-control" pattern="[0-9]+" title="please enter number only"required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 text-right">Item per piece MRP <span class="text-danger">*</span></label>
                                <div class="col-md-3 input-group">
                                    <input type="text" name="editedprice" id="editedprice" class="form-control" required />
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                </div>
                                <label class="col-md-3 text-right">Total Amount <span class="text-danger">*</span></label>
                                <div class="col-md-3 input-group">
                                    <input type="text" name="editedtotalamt" id="editedtotalamt" class="form-control" required readonly />
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="createdby" id="createdby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="UpdateLineItem">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id=deleteLineItemModal tabindex=-1 role=dialog aria-hidden=true>
        <div class="modal-dialog">
            <form method="SOST" id="delete_lineItem_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">Delete Purchase Order Line Item</h4>
                        <button type="button" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            Are you sure. Would you like to delete this Line Item.
                        </p>
                        <input type="hidden" name="SOlineItemId" id="SOlineItemId" value="">
                        <input type="hidden" name="SOID" id="deleteSOID" value="">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="submit" name="submit" id="deleteLineItembutton" class="btn btn-danger" value="Confirmed" />
                        <button type="button" class="btn btn-default">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            var catId;
            var subcatId;
            var dataTable = $('#lineItem_table').DataTable({

            });
            $('#deleteLineItemModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $('#SOlineItemId').val(rowid);

            });
            var uniturl = config.developmentPath +
                "/Admin/Controller/unitsContoller.php"
            var selected = false;
            $.getJSON(uniturl, function(data) {

                loadUnitFactor(data[0].unitId);
                $.each(data, function(index, value) {
                    if (!selected) {
                        $('#unit').append('<option value="' + value.unitId + ' " selected >' + value
                            .unitName + '</option>');
                        selected = true;
                    } else {
                        $('#unit').append('<option value="' + value.unitId + '">' + value
                            .unitName + '</option>');
                    }
                });

            });

            $('#EditModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $('#SOlineItemId').val(rowid);

                var url = config.developmentPath + "/Admin/Controller/item_categorycontroller.php";
                let isSelectedSet1 = false;
                $('#editeditemCategory').empty();
                $('#editeditemsubCategory').empty();
                $('#additemid').empty();

                // var catid=
                $.getJSON(url, function(data) {
                    $.each(data, function(index, value) {
                        if (catId == value.itemcatid) {
                            $('#editeditemCategory').append('<option selected value ="' + value
                                .itemcatid + '">' +
                                value
                                .itemcatname + '</option>');

                        } else {
                            $('#editeditemCategory').append('<option value="' + value
                                .itemcatid + '">' +
                                value
                                .itemcatname + '</option>');
                        }


                    });

                });
                setSubCategory(catId);
            });



            $('#additemid').empty();
            var url = config.developmentPath + "/Admin/Controller/item_detailscontroller.php";
            $.getJSON(url, function(data) {

                itemDetails = data;
                mappItemPrice(data[0].price,
                    data[0].name,
                    data[0].unitFactor);
                $.each(data, function(index, value) {
                    $('#additemid').append('<option value="' + value.itemid + '">' + value
                        .itemname + '</option>');
                });
            });

            $('#additemid').on('change', function(e) {
                debugger;
                for (var i = 0; i < itemDetails.length; i++) {
                    // look for the entry with a matching `code` value
                    if (itemDetails[i].itemid == this.value) {
                        $('#quantity').val("");
                        $('#totalamt').val("");
                        mappItemPrice(itemDetails[i].price,
                            itemDetails[i].name,
                            itemDetails[i].unitFactor);
                    }
                }
            });

            function mappItemPrice(price, name, unitFactor) {
                $('#price').val(price);
                $('#addselectedItemName').val(name);
                $('#unitFactor').val(unitFactor);
            }

            $('#additemid').on('change', function(e) {

                for (var i = 0; i < itemDetails.length; i++) {
                    // look for the entry with a matching `code` value
                    if (itemDetails[i].itemid == this.value) {
                        $('#quantity').val("");
                        $('#totalamt').val("");
                        mappItemPrice(itemDetails[i].price,
                            itemDetails[i].name,
                            itemDetails[i].unitFactor);
                    }
                }
            });
            $('#price').blur(function(e) {

                $('#totalamt').val((parseFloat($('#quantity').val() * parseFloat($(
                        '#price')
                    .val()))).toFixed(2));

            });



            $('#delete_lineItem_form').submit(function(event) {
                $.ajax({
                    url: config.developmentPath +
                        "/Admin/Controller/SOlineItemController.php/",
                    method: "SOST",
                    data: {
                        id: $('#SOlineItemId').val(),
                        quoteId: $('#deleteSOID').val(),
                        action: 'delete'
                    },
                }).done(function(data) {
                    console.log(data);
                });
            });
            $('#lineItem_table tbody').on('click', 'tr', function() {

                $('#SOlineItemId').val(this.cells[0].innerHTML);
                $('#editeditemname').val(this.cells[1].innerHTML);
                $('#editedquantity').val(this.cells[2].innerHTML);
                $('#unit').val(this.cells[3].innerHTML);
                $('#editedprice').val(this.cells[4].innerHTML);
                $('#editedtotalamt').val(this.cells[5].innerHTML);



                $('#editeditemCategory').val(this.cells[6].innerHTML);
                $('#editeditemsubCategory').val(this.cells[7].innerHTML);

            });
            $('#editedquantity').blur(function(e) {
                calculateAmount();
            });
            $('#editedprice').blur(function(e) {
                calculateAmount();
            });

            function calculateAmount() {
                var quantity = $('#editedquantity').val();
                var price = $('#editedprice').val();
                var unitFactor = $('#unitFactor').val();

                $('#editedtotalamt').val((parseFloat($('#editedquantity').val() * parseFloat($(
                    '#editedprice').val()))).toFixed(2));

            };
            $('#editedquantity').on('keydown', function(e) {
                calculateAmount();
            });
            $('#editedquantity').on('keyup', function(e) {
                calculateAmount();
            });
            $('#editedprice').on('keydown', function(e) {
                calculateAmount();
            });
            $('#editedprice').on('keyup', function(e) {
                calculateAmount();
            });



            $('#edit_form').submit(function(event) {
                debugger;
                var formData = new FormData(this);
                $.ajax({
                    url: config.developmentPath +
                        "/Admin/Controller/SOlineItemController.php/",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function(data) {
                    console.log(data);
                });
                location.reload();
            });


            $('#AddModal').on('show.bs.modal', function(e) {

                var rowid = $(e.relatedTarget).data('id');
                $('#SOID').val(rowid);
                var url = config.developmentPath + "/Admin/Controller/item_categorycontroller.php";
                let isSelectedSet1 = false;
                let catId = 0;
                $.getJSON(url, function(data) {
                    $.each(data, function(index, value) {
                        if (isSelectedSet1 === false) {
                            $('#additemCategory').append(
                                '<option selected value="' + value
                                .itemcatid +
                                '">' +
                                value
                                .itemcatname + '</option>');

                            isSelectedSet1 = true;
                            setSubCategory(value.itemcatid);

                        } else {
                            $('#additemCategory').append(
                                '<option hidden disabled selected value>-- select an option --</option>'
                            );
                            $('#additemCategory').append('<option value="' + value
                                .itemcatid +
                                '">' + value
                                .itemcatname + '</option>');
                            $('#editeditemCategory').append('<option value="' +
                                value
                                .itemcatid + '">' +
                                value
                                .itemcatname + '</option>');
                        }
                    });
                });
            });

            function setSubCategory(catId) {

                var fetchsubcaturl = config.developmentPath +
                    "/Admin/Controller/item_subcategorycontroller.php/?catId=" +
                    catId;

                $.getJSON(fetchsubcaturl, function(data) {
                    $('#additemsubCategory').append(
                        '<option hidden disabled selected value>-- select an option --</option>'
                    );
                    $.each(data, function(index, value) {
                        // APPEND OR INSERT DATA TO SELECT ELEMENT.
                        $('#additemsubCategory').append('<option value="' +
                            value
                            .itemsubcatid +
                            '">' +
                            value
                            .itemsubcatname + '</option>');
                        if (subcatId == value.itemsubcatid) {
                            $('#editeditemsubCategory').append('<option selected value="' +
                                value
                                .itemsubcatid +
                                '">' +
                                value
                                .itemsubcatname + '</option>');
                        } else {
                            $('#editeditemsubCategory').append('<option value="' +
                                value
                                .itemsubcatid +
                                '">' +
                                value
                                .itemsubcatname + '</option>');
                        }
                    });
                });
            }

            function setItemlist(catId, subcatId) {

                $('#quantity').val("");
                $('#totalamt').val("");
                $('#price').val("");

                var fetchitemlisturl = config.developmentPath +
                    "/Admin/Controller/item_detailscontroller.php/?catId=" + catId +
                    "&subcatId=" +
                    subcatId;
                console.log(fetchitemlisturl);
                $.getJSON(fetchitemlisturl, function(data) {
                    itemDetails = data;
                    $('#additemid').append(
                        '<option hidden disabled selected value>-- select an option --</option>'
                    );
                    $.each(data, function(index, value) {
                        $('#additemid').append('<option value="' + value
                            .itemid + '">' +
                            value
                            .itemname + '</option>');

                        // $('#editedsubCategory').append('<option value="' + value.itemsubcatid +
                        //     '">' +
                        //     value
                        //     .itemsubcatname + '</option>');
                    });
                });
            }
            $('#additemCategory').on('change', function() {
                $('#additemsubCategory').empty();
                $('#additemid').empty();
                $('#quantity').val("");
                $('#totalamt').val("");
                $('#price').val("");

                fetchsubcaturl =
                    config.developmentPath +
                    "/Admin/Controller/item_subcategorycontroller.php/?catId=" + this
                    .value;
                $.getJSON(fetchsubcaturl, function(data) {
                    $('#additemsubCategory').append(
                        '<option hidden disabled selected value>-- select an option --</option>'
                    );
                    $.each(data, function(index, value) {
                        // APPEND OR INSERT DATA TO SELECT ELEMENT.
                        $('#additemsubCategory').append(
                            '<option value="' + value
                            .itemsubcatid +
                            '">' +
                            value
                            .itemsubcatname + '</option>');
                    });
                });
            });

            $('#editeditemCategory').on('change', function() {
                $('#editeditemsubCategory').empty();
                $('#additemid').empty();
                $('#editedquantity').val("");
                $('#editedtotalamt').val("");
                $('#editedprice').val("");

                fetchsubcaturl =
                    config.developmentPath +
                    "/Admin/Controller/item_subcategorycontroller.php/?catId=" + this
                    .value;
                $.getJSON(fetchsubcaturl, function(data) {
                    $('#editeditemsubCategory').append(
                        '<option hidden disabled selected value>-- select an option --</option>'
                    );
                    $.each(data, function(index, value) {
                        // APPEND OR INSERT DATA TO SELECT ELEMENT.
                        $('#editeditemsubCategory').append(
                            '<option value="' + value
                            .itemsubcatid +
                            '">' +
                            value
                            .itemsubcatname + '</option>');
                    });
                });
            });

            $('#additemsubCategory').on('change', function() {
                $('#additemid').empty();
                setItemlist($('#additemCategory').val(), this.value);
            });
            $('#editeditemsubCategory').on('change', function() {
                $('#additemid').empty();
                setItemlist($('#editeditemCategory').val(), this.value);
            });
            
        function loadUnitFactor(unitId) {
            $('#unitFactor').empty();
            unitFactorurl =
                config.developmentPath +
                "/Admin/Controller/unitFactorController.php/?unitId=" + unitId;
            $.getJSON(unitFactorurl, function(data) {
                $.each(data, function(index, value) {
                    $('#unitFactor').append(
                        '<option hidden disabled selected value>Blank</option>');
                    $('#unitFactor').append('<option value="' + value.unitFactorId +
                        '">' + value.unitFactor + '</option>');

                });
            });
        }
        });
    </script>