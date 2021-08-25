<?php
include('header.php');
require_once("../DB Operations/customerOps.php");
require_once("../DB Operations/paymentOps.php");
require_once("../Model/customerModel.php");
require_once  "../DB Operations/salesorderOps.php";


if ($_SERVER["REQUEST_METHOD"]=="GET") {
    $saleOrder=null;
    if (isset($_GET["salesOrderNumber"])){    
    $salesOrderNumber=$_GET["salesOrderNumber"];
  
    $saleOrder=DBsales::GetSaleOrderBasedOnCode($salesOrderNumber);
   
    }
    
}

?>
<h1 class="h3 mb-4 text-gray-800">Payment Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
            </div>
            <div class="col" align="right">
                <span data-toggle=modal data-target=#paymentinfoModal>
                    <button type="button" + class="btn btn-success btn-circle btn-sm"><i
                            class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form class="d-flex">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Sales Order Number" aria-label="Search"
                            required pattern="[GS]{2}-[0-9]{6}-[A-Za-z]{2}-[SO][0-9]{+}" id="salesOrderNumber"
                            name="salesOrderNumber">

                        <button class="btn btn-outline-success" type="submit"><i
                                class="fas fa-search-dollar"></i></button>

                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <?php 
            $count = 1;
        if($saleOrder!=null)
        {
            echo '<table class="table table-bordered border-dark border-4 container" id="GeneralQuote">
            <tr>
                <td style="text-align:center" colspan="8">
                    <h1>Payment Info</h1>
                    <p>Ganesh Sweets Dharwad</p>
                </td>
            </tr>
            <tr>
                <!-- <th >Customer Name </th> -->
                <td rowspan="3" colspan="7">
                    <h5>Customer Details</h5>
                    Customer Code :'.  $saleOrder->getCustomerCode() .' <br>
                    To : '. $saleOrder->getCustomerName() .' <br>
                    Address :'.  $saleOrder->getCustomerAddress() .'<br />
                    Phone :'. $saleOrder->getCustomerContactNumber().'
                </td>
            </tr>
            <tr>
            
                <td>
                <h5>Sales Order Details</h5>
                Sales Code&nbsp: &nbsp'. $saleOrder->getSOCode() .'<br> Sales Date : '.$saleOrder->get_salesdate().
                '<br> Total Amount : '.$saleOrder->get_totalAmount().
                  
                '</td>
            </tr>
            <tr>
              
            </tr>

            
            <tr>
                <th style="text-align:center" colspan="1">Sl</th>
                <th colspan="3" style="text-align:center">Total Amount</th>
                <th style="text-align:center">Recived Amount</th>
                <th style="text-align:center">Pending Amount</th>
                <th style="text-align:center">Paid Amount</th>
                <th style="text-align:center">Mode of payment</th>
                
               
            </tr>';
            $paymentList= DBpayment ::getPaymentInfoBySalesOrderId($saleOrder->get_Id());
            foreach($paymentList as $paymentInfo){
                echo '<tr>
                <td  style="text-align:center">' . $count . '</td>
            <td  colspan="3" style="text-align:center">' . $paymentInfo->get_totalAmt() .  '</td>
            <td  style="text-align:center">' . $paymentInfo->get_receivedamt() . '</td>
            <td  style="text-align:center">' . $paymentInfo->get_pendingAmt() .  '</td>
            <td  style="text-align:center">' . $paymentInfo->get_paidAmt() . '</td>
            <td  style="text-align:center">' . $paymentInfo->get_paymentmode() . '</td>
           
           
                </tr>';
                
            }
            

            


           
            echo '<tr>
                <td style="text-align:right" rowspan="" colspan="3">
                    Returns
                </td>
                <td style="text-align:right">Total</td>
                <td style="text-align:center"></td>
                <td id="totalAmount" style="text-align:center">
                    <?php echo $sum ?>
    </td>

    </tr>

    <tr>
        <td colspan="8">
            <h3 id="inwords"></h3>
        </td>
    </tr>
    <tr>
        <th colspan="8">
            Terms and Conditions
        </th>
    </tr>

    </table>';
    }
    ?>


    <!--<div>
        <form name="salesOrder" method="POST" id="itemListForm" enctype="multipart/form-data" action="">
            <div class="form-group">
                <div class="row">
                    <input type="hidden" name="createdby" id="createdby" class="form-control" required
                        value="<?php echo $_SESSION['login_user']; ?>" />
                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                        value="<?php echo $_SESSION['login_user']; ?>" />
                    <input type="hidden" id="salesOrderNumber" value="<?php echo $saleOrder-> get_id(); ?>" />
                </div>
            </div>
            <input type="submit" name="submit" id="PDF" class="btn btn-success" value="Save AS PDF" />
        </form>
    </div>-->


</div>
<?php include('footer.php'); ?>
<div class="modal fade" id=paymentinfoModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-xl">
        <form method="post" id="paymentinfo_form" enctype="multipart/form-data"
            action="../Controller/paymentcontroller.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-md-12">
                    <form class="form" action="../Controller/paymentcontroller.php" method="POST" id="myForm"
                        enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Sales Order Code <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="Socode" id="Socode" class="form-control"
                                                    required data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                    data-parsley-maxlength="150" data-parsley-trigger="keyup" readonly value="<?php echo  $saleOrder->getSOCode() ?>"/>
                                                
                                                <input type="hidden" id="paymentid" name="paymentid" value="">
                                                <input type="hidden" id="SOID" name="SOID" value="">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Total Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="totalamt" id="totalamt" class="form-control"
                                                    required data-parsley-trigger="keyup" value="<?php echo   $saleOrder->get_totalAmount() ?>" disabled/>
                                            </div>
                                        </div>
                                        <br />

                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label"> Paid Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="paidamt" id="paidamt" class="form-control"
                                                    data-parsley-trigger="keyup"    disabled/>
                                            </div>
                                        </div>
                                        <br />

                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Received Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="receivedamt" id="receivedamt"
                                                    class="form-control" required data-parsley-trigger="keyup" />
                                            </div>
                                        </div>
                                        <br />

                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label">Pending Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="pendingamt" id="pendingamt"
                                                    class="form-control" required data-parsley-trigger="keyup" disabled />
                                            </div>
                                        </div>
                                        <br />

                                        <div id="duedatediv" class="col-md-6" style="display: none">
                                            <label for="duedate" class="col-md-6 control-label"> Next payment
                                                on:</label>
                                            <div class="col-sm-12">
                                                <input type="date" id="duedate" name="duedate" class="form-control"
                                                    required />
                                            </div>
                                        </div>
                                        <br />

                                        <div class="col-md-6">
                                            <label for="pmode" class="col-md-6 control-label">Payment Mode</label>
                                            <div class="col-sm-12">
                                                <select class="form-select" id="paymentmode" name="paymentmode"
                                                    required>
                                                    <option value=""></option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="UPI transaction">UPI transaction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-6">
                                            <label for="paymentdescription" class="col-md-6 control-label">Payment
                                                Comments</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" id="paymentdescription" name="paymentdescription"
                                                    placeholder="Payment Comments" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <br />

                                        <div class="col-md-6">
                                            <input type="hidden" name="modifiedby" id="modifiedby" class="form-control"
                                                required data-parsley-type="integer" data-parsley-minlength="10"
                                                data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                                value="<?php echo $_SESSION['login_user']; ?>" />

                                        </div>

                                        <div>
                                            <button class="btn btn-success" id="btn" type="submit"
                                                name="submit">Update</button>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <input type="hidden" name="createdby" id="createdby" class="form-control" required
                        data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                        data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                        data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                        data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="hidden" name="action" id="action" value="Add" />
               
            </div>
    </div>
    </form>
</div>


<div class="modal fade" id=infoCustomerModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Customer Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerName">Name</label>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title" id="displaycustomerName"></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerDov">Date Of Visit</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerDov"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerEmail">Email</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerEmail"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerPhone">Mobile Number</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerPhone"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerAddress">Address</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerAddress"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerCity">City</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerCity"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerState">State</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerState"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id=paymentinfoModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-xl">
        <div class="row gutters-sm">
            <div class="col-md-2 mb-2">

                <br />
                <div class="form-check text-center">
                    <input type="radio" class="btn-check" name="edit" id="option2">
                    <label class="btn btn-danger" for="option2">Edit</label>
                </div>
            </div>

            <!-- Payment code -->

            <!-- <div class="col-md-10">
                <form class="form" action="../Controller/paymentcontroller.php" method="POST" id="myForm"
                    enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Customer Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="custname" id="custname" class="form-control"
                                                required data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                data-parsley-maxlength="150" data-parsley-trigger="keyup" />
                                            <input type="hidden" id="custid" name="custid" value="">
                                            <input type="hidden" id="paymentid" name="paymentid" value="">
                                            <input type="hidden" id="SOID" name="SOID" value="">
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Customer Contact No.<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="custcontactno" id="custcontactno"
                                                class="form-control" required data-parsley-trigger="keyup" />
                                        </div>
                                    </div>
                                    <br />


                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Total Amount<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="totalamt" id="totalamt" class="form-control"
                                                required data-parsley-trigger="keyup" />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Total Paid Amount<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="paidamt" id="paidamt" class="form-control"
                                                data-parsley-trigger="keyup" />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Received Amount<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="receivedamt" id="receivedamt" class="form-control"
                                                required data-parsley-trigger="keyup" />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Pending Amount<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="pendingamt" id="pendingamt" class="form-control"
                                                required data-parsley-trigger="keyup" />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label class="col-md-6 control-label">Payment Plan<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="paymentplan" name="paymentplan" required>
                                                <option value="">Payment Plan</option>
                                                <option value="Part Payment">Part Payment</option>
                                                <option value="Full Payment">Full Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br />


                                    <div id="duedatediv" class="col-md-6" style="display: none">
                                        <label for="duedate" class="col-md-6 control-label"> Next payment on:</label>
                                        <div class="col-sm-12">
                                            <input type="date" id="duedate" name="duedate" class="form-control"
                                                required />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <label for="pmode" class="col-md-6 control-label">Payment Mode</label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="paymentmode" name="paymentmode" required>
                                                <option value=""></option>
                                                <option value="Cash">Cash</option>
                                                <option value="UPI transaction">UPI transaction</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br />



                                    <div class="col-md-6">
                                        <label for="paymentdescription" class="col-md-6 control-label">Payment
                                            Description</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="paymentdescription" name="paymentdescription"
                                                placeholder="Payment Description" class="form-control" required>
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col-md-6">
                                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control"
                                            required data-parsley-type="integer" data-parsley-minlength="10"
                                            data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                            value="<?php echo $_SESSION['login_user']; ?>" />

                                    </div>

                                    <div>
                                        <button class="btn btn-success" id="btn" type="submit"
                                            name="submit">Update</button>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

            </div>-->
        </div>
    </div>
</div>
    <div class="modal fade" id=editedpaymentinfoModal tabindex=-1 role=dialog aria-hidden=true>
        <div class="modal-dialog modal">
            <br />
            <form class="form" action="../Controller/paymentcontroller.php" method="POST" id="myForm"
                enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Customer Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="custname" id="editedcustname" class="form-control" required
                                        data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                        data-parsley-trigger="keyup" />
                                    <input type="hidden" id="custid" name="custid" value="">
                                    <input type="hidden" id="paymentid" name="paymentid" value="">
                                    <input type="hidden" id="SOID" name="SOID" value="">
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Customer Contact No.<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="custcontactno" id="editedcustcontactno"
                                        class="form-control" required data-parsley-trigger="keyup" />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Total Amount<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="totalamt" id="editedtotalamt" class="form-control" required
                                        data-parsley-trigger="keyup" />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Paid Amount<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="paidamt" id="editedpaidamt" class="form-control" required
                                        data-parsley-trigger="keyup" />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Received Amount<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="receivedamt" id="editedreceivedamt" class="form-control"
                                        required data-parsley-trigger="keyup" />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Pending Amount<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="pendingamt" id="editedpendingamt" class="form-control"
                                        required data-parsley-trigger="keyup" />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label class="col-md-6 control-label">Payment Plan<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-select" id="editedpaymentplan" name="paymentplan" required>
                                        <option value="">Payment Plan</option>
                                        <option value="Part Payment">Part Payment</option>
                                        <option value="Full Payment">Full Payment</option>
                                    </select>
                                </div>
                            </div>
                            <br />


                            <div id="duedatediv" class="col-md-6" style="display: none">
                                <label for="duedate" class="col-md-6 control-label"> Next payment on:</label>
                                <div class="col-sm-12">
                                    <input type="date" id="editedduedate" name="duedate" class="form-control"
                                        required />
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <label for="pmode" class="col-md-6 control-label">Payment Mode</label>
                                <div class="col-sm-12">
                                    <select class="form-select" id="editedpaymentmode" name="paymentmode" required>
                                        <option value=""></option>
                                        <option value="Cash">Cash</option>
                                        <option value="UPI transaction">UPI transaction</option>

                                    </select>
                                </div>
                            </div>
                            <br />


                            <div class="col-md-6">
                                <label for="paymentdescription" class="col-md-6 control-label">Payment
                                    Description</label>
                                <div class="col-sm-12">
                                    <input type="text" id="editedpaymentdescription" name="paymentdescription"
                                        placeholder="Payment Description" class="form-control" required>
                                </div>
                            </div>
                            <br />

                            <div class="col-md-6">
                                <input type="hidden" name="modifiedby" id="editedmodifiedby" class="form-control"
                                    required data-parsley-type="integer" data-parsley-minlength="10"
                                    data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                    value="<?php echo $_SESSION['login_user']; ?>" />

                            </div>

                            <div>
                                <button class="btn btn-success" id="btn" type="submit" name="submit">Update</button>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                $('#itemListForm').submit(function(e) {
                    var content = $('#printsales').html();
                    var fileName = $('#salescode').text() + $('#listquoteCode').text() + '_SO';
                    var uniturl = config.developmentPath + "/Admin/Controller/pdfGeneratorContorller.php";
                    $.ajax({
                        type: "POST",
                        url: uniturl,
                        data: {
                            "modifiedby": $('#modifiedby').val(),
                            "salesOrderNumber": $('#salesOrderNumber').val(),
                            "fileType": "salesorder",
                            "waterMarked": waterMarked,
                            "fileName": fileName.trim(),
                            "html": content
                        },
                        dataType: "json",
                        encode: true,
                    }).done(function(data) {
                        console.log(data);
                    });

                    window.open(config.developmentPath + '/Admin/pdfs/salesorder/' + fileName.trim() + '.pdf');
                });

                    $('#paymentinfoModal').on('show.bs.modal', function(e) {
                        var rowid = $(e.relatedTarget).data('id');
                        $('#Socode').val(rowid);

                    });
                    var dataTable = $('#Customer_table').DataTable({

                    });

                    var nEditing = null;

                    $('#Customer_table tbody').on('click', 'tr', function() {
                        /* Get the row as a parent of the link that was clicked on */
                        $('#custname').val(this.cells[1].innerHTML);
                        $('#custcontactno').val(this.cells[2].innerHTML);
                        $('#totalamt').val(this.cells[3].innerHTML);
                        $('#pendingamt').val(this.cells[5].innerHTML);
                        $('#paidamt').val(this.cells[4].innerHTML);
                    });
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
                            debugger;
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

                    $("#receivedamt").change(function() {
                        debugger;
                        if (parseInt($(this).val()) < parseInt($("#totalamt").val())) {
                            if ($("#pendingamt").val() == 0) {
                                var pendingfees = $("#totalamt").val() - $("#receivedamt").val();
                            } else {
                                var pendingfees = $("#pendingamt").val() - $("#receivedamt").val();
                            }
                            $("#pendingamt").val(pendingfees);
                        }
                        var paidfees = $("#totalamt").val() - $("#pendingamt").val();
                        $("#paidamt").val(paidfees);
                    });
                    if (parseInt($("#receivedamt").val()) == parseInt($("#totalamt").val())) {
                        $("#myForm :input").prop("disabled", true);
                        $("#option2").prop("disabled", true);
                    }
                });
                
    
    </script>