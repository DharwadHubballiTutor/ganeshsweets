<?php
include('header.php');
require_once("../DB Operations/customerOps.php");
require_once("../DB Operations/paymentOps.php");
require_once("../Model/customerModel.php");
require_once  "../DB Operations/salesorderOps.php";

$saleOrder = null;
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["salesOrderNumber"])) {
        $salesOrderNumber = $_GET["salesOrderNumber"];
        $saleOrder = DBsales::GetSaleOrderBasedOnCode($salesOrderNumber);
    }
}
?>
<style>
    .table tr {
        color: black;
    }

    .border-dark tr th,
    td {
        border: 2px solid black !important;

    }
</style>
<h1 class="h3 mb-4 text-gray-800">Payment Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Payment info List</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#paymentinfoModal data-id=<?php
                                                                                if ($saleOrder != null) {
                                                                                    echo $saleOrder->get_Id();
                                                                                } ?>>
                    <button type="button" + class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>
    <div class="card-body container">
        <div class="row">
            <div class="col">
                <form class="">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Sales Order Number" aria-label="Search" required pattern="[GS]{2}-[0-9]{6}-[A-Za-z]{2}-[SO][0-9]{+}" id="salesOrderNumber" name="salesOrderNumber">

                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search-dollar"></i></button>

                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <?php
            $count = 1;
            if ($saleOrder != null) {
                echo '
            <div class="col-12" id="printsales">
             <table class="table table-bordered border-dark border-4 container" id="GeneralQuote">
            <tr>
                <td style="text-align:center" colspan="5">
                    <h1>Payment Receipt</h1>
                    <p>Ganesh Sweets Dharwad</p>
                </td>
            </tr>
            <tr>
                <!-- <th >Customer Name </th> -->
                <td colspan="3">
                    <h5>Customer Details</h5>
                </td>
                <td colspan="3">
                    <h5>Sales Order Details</h5>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Customer Code : ' .  $saleOrder->getCustomerCode() . ' <br>
                </td>
                <td colspan="3">
                    Sales Code : ' . $saleOrder->getSOCode() . '<br> 
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    To : ' . $saleOrder->getCustomerName() . ' <br>
                   
                </td>
                <td colspan="3">
                    Sales Date : ' . $saleOrder->get_salesdate() . '<br>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Address : ' .  $saleOrder->getCustomerAddress() . '<br />
                    Phone : ' . $saleOrder->getCustomerContactNumber() . '
                </td>
                <td colspan="3">
                    
                    Total Amount : ' . $saleOrder->get_totalAmount() .
                '</td>
                <div id="salesordercode" style="display:none">' . $saleOrder->getSOCode() . '</div>
            </tr>
            <tr>
              
            </tr>
            <tr>
                <th style="text-align:center" colspan="1">Sl</th>
                <th style="text-align:center">Payment Date</th>  
                <th style="text-align:center">Mode of payment</th>
                <th style="text-align:center">Pending Amount</th>
                <th style="text-align:center">Paid Amount</th>
              
                                
            </tr>';
                $paymentList = DBpayment::getPaymentInfoBySalesOrderId($saleOrder->get_Id());
                $totalPaidAmount = 0;
                $totalPendingAmount = 0;

                foreach ($paymentList as $paymentInfo) {
                    echo '<tr>
                    <td  style="text-align:center">' . $count . '</td>
                    <td style="text-align:center">'.   $paymentInfo->getModifiedDate().'</td>
                    <td  style="text-align:center">' . $paymentInfo->get_paymentmode() . '</td>
                    <td  style="text-align:center">' . $paymentInfo->get_pendingAmt() .  '</td>
                    <td  style="text-align:center">' . $paymentInfo->get_receivedamt() . '</td>
                  
                    
                 </tr>';
                    $count++;
                    $totalPaidAmount = $totalPaidAmount + $paymentInfo->get_receivedamt();
                    $totalPendingAmount = $paymentInfo->get_pendingAmt();
                }
                echo '<tr>
                <td  style="text-align:center" colspan=2></td>
                
                <td style="text-align:right" rowspan="" colspan="">Total</td>
                <td id="pending" style="text-align:center">' . $totalPendingAmount . '</td>
                <td id="totalAmount" style="text-align:center">' . $totalPaidAmount . '</td> 
            </tr>
    <tr>
        <th colspan="8">
            Terms and Conditions
        </th>
    </tr>

    </table>
</div>';
            }
            ?>
        </div>
    </div>
    <div class="card-footer">
        <form name="payments" method="POST" id="itemListForm" enctype="multipart/form-data" action="">
            <div class="form-group">
                <div class="row">
                    <input type="hidden" name="createdby" id="createdby" class="form-control" required value="<?php echo $_SESSION['login_user']; ?>" />
                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required value="<?php echo $_SESSION['login_user']; ?>" />
                    <?php
                    if ($saleOrder != null) {
                        echo  "<input type='hidden' id='soNumber' value='" . $saleOrder->get_Id() . "'/>";
                    }
                    ?>
                </div>
            </div>
            <input type="submit" name="submit" id="PDF" class="btn btn-success" value="Save AS PDF" />
        </form>
    </div>
<?php include('footer.php'); ?>
<div class="modal fade" id=paymentinfoModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-xl">
        <form method="post" id="paymentinfo_form" enctype="multipart/form-data" action="../Controller/paymentcontroller.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Sales Order Code <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="SOcode" id="SOcode" class="form-control" required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150" disabled value="<?php if ($saleOrder != null) {
                                                                                                                                                                                                        echo  $saleOrder->getSOCode();
                                                                                                                                                                                                    }  ?>" />
                                    <input type="hidden" id="paymentid" name="paymentid" value="">
                                    <input type="hidden" id="SOID" name="SOID" value="">
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Total Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="totalamt" id="totalamt" class="form-control" value="<?php if ($saleOrder != null) {
                                                                                                                        echo  $saleOrder->get_totalAmount();
                                                                                                                    } ?>" readonly />
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label class="col-md-6 control-label"> Paid Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="paidamt" id="paidamt" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Received Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="receivedamt" id="receivedamt" class="form-control" />
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Pending Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="pendingamt" id="pendingamt" class="form-control" required value="" readonly />
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label for="pmode" class="col-md-6 control-label">Payment Mode</label>
                                <div class="col-sm-12">
                                    <select class="form-select" id="paymentmode" name="paymentmode" required>
                                        <option value="Cash" selected>Cash</option>
                                        <option value="UPI transaction">UPI transaction</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="col-md-6">
                                <label for="paymentdescription" class="col-md-6 control-label">Payment
                                    Comments</label>
                                <div class="col-sm-12">
                                    <textarea type="text" id="paymentdescription" name="paymentdescription" placeholder="Payment Comments" class="form-control" required></textarea>
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <input type="hidden" name="createdby" id="createdby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" value="<?php echo $_SESSION['login_user']; ?>" />
                                <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" value="<?php echo $_SESSION['login_user']; ?>" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <button class="btn btn-success" id="btn" type="submit" name="submit">Update</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            $("#myForm :input").prop("disabled", true);

            $('input[type=radio][name=edit]').click(function() {
                $('#myForm :input').prop('disabled', false);
                if (!parseInt($('#totalamt').val())) {
                    $('#totalamt').focus();
                    $('#paidamt').attr('disabled', true);
                } else {
                    $('#totalamt').attr('readonly', true);
                }
            });
            $('#PDF').on('click', function(e) {

                $('#GeneralQuote tr').each(function() {
                    $(this).find('td:first button').remove();
                })
            });
            $('#PI-PDF').on('click', function(e) {

                $('#PI-table tr').each(function() {
                    $(this).find('td:first button').remove();
                })
            })
            //Payment pdf generation//

            $('#itemListForm').submit(function(e) {
                debugger;
                var content = $('#printsales').html();
                var fileName = $('#salesordercode').text() + '_PY';
                var uniturl = config.developmentPath +
                    "/Admin/Controller/pdfGeneratorContorller.php";
                    var salesId=$('#soNumber').val();
                    var modifiedBy=$('#modifiedby').val();
                $.ajax({
                    type: "POST",
                    url: uniturl,
                    data: {
                        "modifiedby": modifiedBy,
                        "salesId": salesId,
                        "fileType": "payments",
                        "waterMarked": true,
                        "fileName": fileName.trim(),
                        "html": content
                    },
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);
                });

                window.open(config.developmentPath + '/Admin/pdfs/payments/' + fileName.trim() +
                    '.pdf');
            });


            // end Payment pdf generation//

            $('#paymentinfoModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $('#SOID').val(rowid);
                $('#paidamt').val($('#totalAmount').text());
                $('#pendingamt').val($('#pending').text());
            });

            var dataTable = $('#Customer_table').DataTable({

            });
            var nEditing = null;


            $('#editbutton').click(function(event) {
                var formData = {
                    customerid: $('#custid').val(),
                    custname: $('#custname').val(),
                    custcontactno: $('#custcontactno').val(),
                };

                $.ajax({
                    type: "POST",
                    url: window.location.origin +
                        "/acedecor/Admin/Controller/paymentcontroller.php/",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);
                });
                $('#editbutton').dispose();
                event.preventDefault();
            });
            $("#paymentplan").change(function() {

                if ($(this).val() == "Part Payment") {
                    $("#duedatediv").show();
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;

                    $("#duedate").attr("min", today);
                    $("#duedate").attr('disabled', false);
                    $("#btn").attr("disabled", false);
                } else {
                    if (parseInt($("#paidamt").val()) > 0 && parseInt($("#pendingamt").val()) !=
                        0) {
                        $("#btn").attr("disabled", true);
                        alert("Payment is still due");
                    }

                    $("#duedate").attr('disabled', true);
                }
            });

            $("#totalamt").change(function() {
                if (parseInt($(this).val()) > 0) {
                    $('#paidamt').attr('disabled', false);
                }
            });
            $("#receivedamt").on('change',function(e) {
                    $("#pendingamt").val( parseInt($("#pending").text()) - $(this).val());
                    $('#paidamt').val($('#totalamt').val()-  $("#pendingamt").val());
                }
            );
            if (parseInt($("#receivedamt").val()) == parseInt($("#totalamt").val())) {
                $("#myForm :input").prop("disabled", true);
                $("#option2").prop("disabled", true);
            }
        });
    </script>