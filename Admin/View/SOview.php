<?php
include "salesorderheader.php";
require_once("../DB Operations/salesorderOps.php");
require_once("../Model/salesorderModel.php");
?>
<style>
.pad {
    padding-right: .5rem;
}
</style>
<h1 class="h3 mb-4 text-gray-800">Sales Order Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Sales Order List</h6>
            </div>
            <!-- <div class="col" align="right">
                <span data-toggle=modal data-target=#SalesModal>
                    <button type="button" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                </span>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="quote_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style='display:none'> Sales Order Id</th>
                        <th>Sales Order Code</th>
                        <th>Sales Date</th>
                        <th style='display:none'>Customer Id</th>
                        <th>Customer Name</th>
                        <th style='display:none'>City</th>
                        
                        
                        
                       
                        
                       
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Total Amount</th>
                        
                        <th style='display:none'>Customer Address</th>
                        <th style='display:none'>FileName</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $SalesList = DBSales::getAllSales();
                    foreach ($SalesList as $SalesObj) {
                        echo "<tr>
                        <td style='display:none'>" . $SalesObj->get_Id() . "</td>
                        <td>" . $SalesObj->getSOcode() . "</td>
                        <td>" . $SalesObj->get_salesdate() . "</td>
                        <td style='display:none'>" . $SalesObj->get_customer() . "</td>
                        <td>" . $SalesObj->getCustomerName() . "</td>
                        <td style='display:none'>" . $SalesObj->getCity() . "</td>
                        
                        
                        <td>" . $SalesObj->getCustomerContactNumber() . "</td>
                        <td>" . $SalesObj->getCustomerEmail() . "</td>
                        <td>" . $SalesObj->get_totalAmount() . "</td>
                        <td style='display:none'>".$SalesObj->getCustomerAddress()."</td>
                        <td style='display:none'>".$SalesObj->get_salesPDFName()."</td>
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
                        <a class='btn btn-primary dropdown-item' 
                        role='button' 
                        href=printSales.php?id=" . $SalesObj->get_ID() . ">
                       <i class='fas fa-print'></i> 
                           Print Sale Order
                      </a>

                        <button class='btn btn-primary dropdown-item'
                        data-toggle='modal' 
                        data-target='#editSalesModal' 
                        role='button' 
                        data-id='" . $SalesObj->get_Id() . "'>
                        <i class='fas fa-user-edit'></i> 
                            Edit Sales Order
                         </button>

                        <button class='btn btn-primary dropdown-item'
                        data-toggle='modal' 
                        data-target='#viewModal' 
                        role='button' 
                        data-id='" . $SalesObj->get_Id() . "'>
                        <i class='fas fa-info'></i> 
                            Sales Order Info
                        </button>

                        <button class='btn btn-primary dropdown-item'
                        data-toggle='modal' data-target='#deleteSalesModal' 
                        name='delete_button' 
                        role='button' 
                        data-id='" . $SalesObj->get_Id() . "'>
                        <i class='fas fa-trash-alt'></i>
                            Delete Sales Order
                        </button>
                        </div>
                    </div> </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<div class="modal fade" id=viewModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Sales Order Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form_message"></span>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 text-right">Customer Name:</label>
                        <div class="col-md-3">
                            <p id="displayCustomerName" class=""></p>
                        </div>
                        <label class="col-md-3 text-right">Customer Phone:</label>
                        <div class="col-md-3">
                            <p id="displayPhone" class=""></p>
                        </div>
                        <label class="col-md-3 text-right">Address</label>
                        <div class="col-md-3">
                            <p id="displayAddress" class=""></p>
                        </div>
                        <label class="col-md-3 text-right">Email:</label>
                        <div class="col-md-3">
                            <p id="displayemail" class=""></p>
                        </div>
                        <label class="col-md-3 text-right">Total Amount:</label>
                        <div class="col-md-3 input-group">
                            <p id="displayTotalAmount" class="pad"></p>
                            <span class=""> <i class="fas fa-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover border border-dark"
                    id="displaySOlineItemTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>TotalAmount</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="hidden" name="action" id="action" value="Add" />
                <a name="button" target="_blank" href="" id="downloadSO" class="btn btn-success">Download Sales Order
                    Info</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id=editSalesModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Edit Sales Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form_message"></span>
                

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 text-right">Sales order Code <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="editedSaleOrderCode" id="editedSaleOrderCode" class="form-control"
                                readonly />
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 text-right">Customer Name <span class="text-danger">*</span></label>
                        <div class="col-md-8"> 
                            <input type="text" name="editedCustomerName" id="editedCustomerName" class="form-control"
                                readonly />
                        
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 text-right">Sales order date <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="editedSalesOrderDate" id="editedSalesOrderDate" class="form-control"
                                readonly />
                           
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 text-right">City <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="editedCity" id="editedCity" class="form-control"
                                readonly />
                           
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 text-right">Total Amount<span class="text-danger">*</span></label>
                        <div class="col-md-8 input-group">
                            <input id="editedTotalAmount" name="editedTotalAmount" class="form-control" required
                                readonly />
                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover border border-dark"
                    id="editedSOlineItemTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>TotalAmount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="row">
                        <input type="hidden" name="createdby" id="createdby" class="form-control" required
                            value="<?php echo $_SESSION['login_user']; ?>" />
                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                            value="<?php echo $_SESSION['login_user']; ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="hidden" name="action" id="action" value="Add" />
                <a name="button" id="editSOLineItem" class="btn btn-success">Edit Line Item</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id=itemListModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">
        <form method="post" id="itemListForm" enctype="multipart/form-data" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Item List </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="printtopdf">
                        <div class="card">

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            Ganesh Sweets
                                        </td>
                                        <td>
                                            <p id='customerCode'></p>
                                        </td>
                                        <td>
                                            <p id='listquoteCode'></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover border border-dark"
                                id="SOlineItemTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>TotalAmount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="createdby" id="createdby" class="form-control" required
                                value="<?php echo $_SESSION['login_user']; ?>" />
                            <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                                value="<?php echo $_SESSION['login_user']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Water Mark</label>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="submit" id="PDF" class="btn btn-success" value="Save AS PDF" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id=deleteSalesModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_quote_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete Sales Order</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this quotation.
                    </p>
                    <input type="hidden" name="id" id="id" value="">
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
    // var waterMarked = false;
    // $('#flexSwitchCheckDefault').on('click', function(e) {
    //     if ($(this).attr('checked') != 'checked') {
    //         $(this).attr('checked', 'checked');
    //         waterMarked = true;
    //     } else {
    //         $(this).removeAttr('checked');
    //         waterMarked = false;
    //     }
    // })
    // $('#itemListForm').submit(function(e) {
    //     var content = $('#printtopdf').html();
    //     var fileName = $('#customerCode').text() + $('#listquoteCode').text();
    //     var uniturl = config.developmentPath +
    //         "/Admin/Controller/pdfGeneratorContorller.php";
    //     $.ajax({
    //         type: "POST",
    //         url: uniturl,
    //         data: {
    //             "modifiedby": $('#modifiedby').val(),
    //             "quoteId": $('#quoteid').val(),
    //             "fileType": "itemList",
    //             "waterMarked": waterMarked,
    //             "fileName": fileName,
    //             "html": content
    //         },
    //         dataType: "json",
    //         encode: true,
    //     }).done(function(data) {
    //         console.log(data);
    //     });
    // });

    $('#editSalesModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');

        $('#id').val(rowid);
        $('#editSOLineItem').attr('href', 'SOlineitemview.php?id=' + rowid);
        var uniturl = config.developmentPath +
            "/Admin/Controller/SOitemlistcontroller.php?id=" + rowid;

        $.getJSON(uniturl, function(data) {
            debugger;
            $("#editedSOlineItemTable").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {
                $('#editedSOlineItemTable tbody').
                append($(document.createElement('tr')).prop({
                    id: value.Id

                }));
                $('#editedSOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.Name
                }));
                $('#editedSOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.quantity
                }));

                $('#editedSOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.unitName
                }));


                $('#editedSOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.price
                }));

                $('#editedSOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.totalamt
                }));


            });

        });
    });


    $('#viewModal').on('show.bs.modal', function(e) {

        var rowid = $(e.relatedTarget).data('id');

        $('#editSOLineItem').attr('href', 'SOlineitemview.php?id=' + rowid);
        var uniturl = config.developmentPath +
            "/Admin/Controller/SOitemlistcontroller.php?id=" + rowid;

        $.getJSON(uniturl, function(data) {
            $("#displaySOlineItemTable").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {
                $('#displaySOlineItemTable tbody').
                append($(document.createElement('tr')).prop({
                    id: value.SOlineitemId

                }));

                $('#displaySOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.Name
                }));

                $('#displaySOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.quantity
                }));


                $('#displaySOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.unitName
                }));


                $('#displaySOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.price
                }));

                $('#displaySOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.totalamt
                }));


            });
        });
    });

    var dataTable = $('#quote_table').DataTable({
        "order": [
            [1, "desc"]
        ]
    });
    var nEditing = null;
    $('#quote_table tbody').on('click', 'tr', function() {
        debugger;
        /* Get the row as a parent of the link that was clicked on */
        $('#id').val(this.cells[0].innerHTML);
        $('#SOcode').val(this.cells[1].innerHTML);
        $('#Salesdate').val(this.cells[2].innerHTML);
        $('#customer').val(this.cells[3].innerHTML);
        $('#edited').val(this.cells[1].innerHTML);
        $('#editedSalesOrderDate').val(this.cells[2].innerHTML);
        $('#editedSaleOrderCode').val(this.cells[1].innerHTML);

        $('#editedCity').val(this.cells[5].innerHTML);
        
        
        $('#editedCustomerName').val(this.cells[4].innerHTML);
        $('#displayCustomerName').text(this.cells[4].innerHTML);
        $('#editeditemcat').val(this.cells[6].innerHTML);
        $('#displayPhone').text(this.cells[6].innerHTML);
        $('#editeditemsubcat').val(this.cells[6].innerHTML);
        $('#displayemail').text(this.cells[7].innerHTML);
        $('#displayitemname').text(this.cells[8].innerHTML);
        $('#editeditemname').val(this.cells[8].innerHTML);
        $('#editedTotalAmount').val(this.cells[8].innerHTML);
        $('#displayTotalAmount').text(this.cells[8].innerHTML);
        $('#displayAddress').text(this.cells[9].innerHTML)
        // if (this.cells[11].innerHTML != "") {
        //     $('#downloadSOLineItem').attr('href', '../pdfs/itemList/' + this.cells[11].innerHTML);
        // } else {
        //     $('#downloadSOLineItem').removeAttr('target');
        //     $('#downloadSOLineItem').attr('onclick', 'alert("Please save the Item List as PDF")');
        // }
        if (this.cells[9].innerHTML != "") {

            $('#downloadSO').attr('href', '../pdfs/salesorder/' + this.cells[9].innerHTML);
        } else {
            $('#downloadSO').removeAttr('target');
            $('#downloadSO').attr('onclick', 'alert("Please save the Quotation as PDF")');
        }
    });

    $('#itemListModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#Id').val(rowid);
        reloadloadItemTable(rowid);
    });

    function reloadloadItemTable(rowid) {
        debugger;
        var uniturl = config.developmentPath +
            "/Admin/Controller/SOitemListController.php?id=" + rowid;

        $.getJSON(uniturl, function(data) {
            debugger;
            $("#SOlineItemTable").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {
                $('#SOlineItemTable tbody').
                append($(document.createElement('tr')).prop({
                    id: value.SOlineitemId

                }));

                $('#SOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.Name
                }));

                $('#SOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.quantity
                }));


                $('#SOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.unitName
                }));

                $('#SOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.price
                }));

                $('#SOlineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.totalamt
                }));


            });
        });
    }
});
</script>