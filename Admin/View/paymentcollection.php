<?php
include('customerNavigation.php');
require_once("../DB Operations/customerOps.php");
require_once("../DB Operations/paymentOps.php");
require_once("../Model/customerModel.php");
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
                <span data-toggle=modal data-target=#customerModal>
                    <button type="button" + class="btn btn-success btn-circle btn-sm"><i
                            class="fas fa-plus"></i></button>
                </span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Customer_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        
                        <!-- <th>SOID</th> -->
                        <th>Customer Name</th>
                        <th>Customer Contact No.</th>
                        <th>Total Amount</th>
                        <th>Total Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $customerList = DBpayment::getcustomerpayment();
                    foreach ($customerList as $customer) {
                        echo "<tr>
                        
                        <td>" . $customer->get_customerName() . "</td>
                        <td>" . $customer->get_customerPhone() . "</td>
                        <td>" . $customer->gettotalAmt() . "</td>
                        <td>" . $customer->getpaidAmt() . "</td>
                        <td>" . $customer->getpendingAmt() . "</td>
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
                                    data-target='#infoCustomerModal' 
                                    role='button' 
                                    data-id='" . $customer->get_customerId() . "'> 
                                    <i class='fas fa-info'></i>
                                        Customer Info
                                   </button>
                                
                                   
                                    <button class='btn btn-danger dropdown-item' 
                                    data-toggle='modal'
                                    data-target='#paymentinfoModal' 
                                    name='delete_button' 
                                    role='button' 
                                    data-id='" . $customer->get_customerId() . "'>
                                        <i class='fas fa-trash-alt'></i>
                                        Payment Information
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
<div class="modal fade" id=customerModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="post" id="customer_form" enctype="multipart/form-data" action="../Controller/customer.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customerName" name="customerName">
                                <input type="hidden" class="form-control" id="enqId" name="enqId" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Date of visit. <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="customerDov" name="customerDov">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="customerEmail" name="customerEmail">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Mobile<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customerPhone" name="customerPhone">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <label class="col-md-4 text-right">Address line<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customerAddress" placeholder="1234 Main St"
                                    name="customerAddress">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">City <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customerCity" name="customerCity">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">State <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select id="customerState" name="customerState" class="form-select" required>
                                    <option selected="selected" value="">Select State</option>
                                    <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                    <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                    <option value="ASSAM">ASSAM</option>
                                    <option value="BIHAR">BIHAR</option>
                                    <option value="CHANDIGARH">CHANDIGARH</option>
                                    <option value="CHATTISGARH">CHATTISGARH</option>
                                    <option value="DADRA & NAGAR HAVELI">DADRA & NAGAR HAVELI</option>
                                    <option value="DAMAN & DIU">DAMAN & DIU</option>
                                    <option value="DELHI">DELHI</option>
                                    <option value="GOA">GOA</option>
                                    <option value="GUJARAT">GUJARAT</option>
                                    <option value="HARYANA">HARYANA</option>
                                    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                    <option value="JAMMU & KASHMIR">JAMMU & KASHMIR</option>
                                    <option value="JHARKHAND">JHARKHAND</option>
                                    <option value="KARNATAKA">KARNATAKA</option>
                                    <option value="KERALA">KERALA</option>
                                    <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                                    <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                    <option value="MAHARASHTRA">MAHARASHTRA</option>
                                    <option value="MANIPUR">MANIPUR</option>
                                    <option value="MEGHALAYA">MEGHALAYA</option>
                                    <option value="MIZORAM">MIZORAM</option>
                                    <option value="NAGALAND">NAGALAND</option>
                                    <option value="ODISHA">ODISHA</option>
                                    <option value="PONDICHERRY">PONDICHERRY</option>
                                    <option value="PUNJAB">PUNJAB</option>
                                    <option value="RAJASTHAN">RAJASTHAN</option>
                                    <option value="SIKKIM">SIKKIM</option>
                                    <option value="TAMIL NADU">TAMIL NADU</option>
                                    <option value="TELANGANA">TELANGANA</option>
                                    <option value="TRIPURA">TRIPURA</option>
                                    <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                    <option value="UTTARAKHAND">UTTARAKHAND</option>
                                    <option value="WEST BENGAL">WEST BENGAL</option>
                                </select>
                            </div>
                        </div>
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
                    <input type="submit" name="submit" id="addCustomer" class="btn btn-success" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
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
            <div class="col-md-10">
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
                                            <input type="text" name="receivedamt" id="receivedamt" class="form-control" required
                                                data-parsley-trigger="keyup" />
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
                                            <input type="text" name="receivedamt" id="editedreceivedamt" class="form-control" required
                                                data-parsley-trigger="keyup" />
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

        // $("#myForm :input").prop("disabled", true);
        
        // $('input[type=radio][name=edit]').click(function() {
        //     $('#myForm :input').prop('disabled', false);
        //     if (!parseInt($('#totalamt').val())) {
        //         $('#totalamt').focus();
        //         $('#paidamt').attr('disabled', true);
        //     } else {
        //         $('#totalamt').attr('readonly', true);
        //     }
            

        // });

        $('#paymentinfoModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            $('#custid').val(rowid);

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
                if (parseInt($("#paidamt").val()) > 0 && parseInt($("#pendingamt").val()) != 0) {
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


        // $("#paymentmode").change(function() {
        //     // debugger;
        //     // if ($(this).val() == "Net Banking") {
        //     //     $("#rtgsdiv").show();
        //     //     $("#chequediv").hide();
        //     // } else {
        //     //     if ($(this).val() == "Cheque") {
        //     //         $("#rtgsdiv").hide();
        //     //         $("#chequediv").show();
        //     //     }
        //     //     $("#rtgsdiv").hide();
        //     //     $("#chequediv").hide();
        //     // }
        // });
    });
    </script>