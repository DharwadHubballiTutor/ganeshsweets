<?php
require_once("session.php");
include('customerNavigation.php');
require_once("../DB Operations/customerOps.php");
require_once("../Model/customerModel.php");
require_once("../Model/enq_cat_mappingmodel.php");
?>
<style>
.paging-nav {
    text-align: right;
    padding-top: 2px;
}

.paging-nav a {
    margin: auto 1px;
    text-decoration: none;
    display: inline-block;
    padding: 1px 7px;
    background: #91b9e6;
    color: white;
    border-radius: 3px;
}

.paging-nav .selected-page {
    background: #187ed5;
    font-weight: bold;
}

#lineItemTable {
    height: 200px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}

#lineItemTable thead {
    background-color: grey;
    color: whitesmoke;
    position: sticky;
    top: 0;
}
</style>
<h1 class="h3 mb-4 text-gray-800">Customer Management</h1>
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
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>DOJ</th>
                        <th>City</th>
                        <th style="display:none">Customer Contact No.</th>
                        <th style="display:none">Customer Email</th>
                        <th style="display:none">Customer Address</th>
                        <th style="display:none">Customer State</th>
                        <!--<th style="display:none">enqid</th>--->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $customerList = DBcustomer::getAllcustomer();
                    foreach ($customerList as $customer) {
                        echo "<tr><td>" . $customer->getCustomerCode() . "</td>
                        <td>" . $customer->get_customerName() . "</td>
                        <td>" . $customer->get_customerDov() . "</td>
                        <td>" . $customer->get_customerCity() . "</td>
                        <td style='display:none'>" . $customer->get_customerPhone() . "</td>
                        <td style='display:none'>" . $customer->get_customerEmail() . "</td>
                        <td style='display:none'>" . $customer->get_customerAddress() . "</td>
                        <td style='display:none'>" . $customer->get_customerState() . "</td>
                        
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
                                     data-target='#editCustomerModal' 
                                     role='button' 
                                     data-id='" . $customer->get_customerId() . "'> 
                                        <i class='fas fa-user-edit'></i>
                                         Edit Customer
                                    </button>
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
                                    data-target='#deleteUserModal' 
                                    name='delete_button' 
                                    role='button' 
                                    data-id='" . $customer->get_customerId() . "'>
                                        <i class='fas fa-trash-alt'></i>
                                        Delete Customer
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
        <form method="post" id="customer_form" enctype="multipart/form-data" action="../Controller/customerController.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add New Customer</h4>
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
                            <label class="col-md-4 text-right">Date of join. <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="customerDov" name="customerDov">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email <span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="email" 
                                class="form-control" 
                                id="customerEmail" 
                                name="customerEmail"
                                placeholder="example@example.com">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Mobile<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="tel" class="form-control" 
                                id="customerPhone" 
                                name="customerPhone"   
                                placeholder="Enter your 10 digit Ph No"
                                maxlength="10"
                                pattern="^([6-9]{1})([0-9]{9})$"
                                title="Mobile Number is not in the correct format"
                                required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <label class="col-md-4 text-right">Address line<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <textarea  class="form-control" id="customerAddress" placeholder="1234 Main St"
                                    name="customerAddress" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">City <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customerCity" name="customerCity" required >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">State <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select id="customerState" name="customerState" class="form-select" required>
                               
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
                                    <option selected="selected" value="KARNATAKA">KARNATAKA</option>
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
<div class="modal fade" id=editCustomerModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="editedCustomer_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Edit Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Customer Id <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="editedcustomerCode" name="customerCode"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="editedcustomerName" name="customerName">
                                <input type="hidden" name="customerId" id="editedcustomerId" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Date of visit. <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="editedcustomerDov" name="customerDov">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email <span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="editedcustomerEmail" name="customerEmail">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Mobile<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="editedcustomerPhone" name="customerPhone" placeholder="Enter your 10 digit Ph No"
                                maxlength="10"
                                pattern="^([6-9]{1})([0-9]{9})$"
                                title="Mobile Number is not in the correct format"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Address line<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="editedcustomerAddress"
                                    placeholder="1234 Main St" name="customerAddress">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">City <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="editedcustomerCity" name="customerCity">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">State <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select id="editedcustomerState" name="customerState" class="form-select" required>
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
                            value="<?php echo $_SESSION['login_user']; ?>" />
                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                            value="<?php echo $_SESSION['login_user']; ?>" />
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="submit" id="editCustomer" class="btn btn-success" value="Save" />
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
                                        <label for="displayusername">Customer Id</label>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title" id="displayusername"></h5>
                                    </div>
                                </div>
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
                                        <label for="displaycustomerDov">Date Of Enquiry</label>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-title" id="displaycustomerDov"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="displaycustomerCity">Email</label>
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
                                        <label for="displaycustomerCity">Place</label>
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
<div class="modal fade" id=quoteModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-xl">
        <form class="" method="POST" id="quote_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quotation Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Customer Deatils
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body row g-3">
                                    <div class="col-md-12">
                                        <label for="State" class="form-label">Customer Id</label>
                                        <input id="quotecustomerCode" name="customerCode" class="form-control" required
                                            readonly />
                                    </div>
                                    <div class="col-md-8">
                                        <label for="quotecustomerName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="quotecustomerName"
                                            name="customerName" readonly>
                                        <input type="hidden" class="form-control" id="quoteenqId" name="enqId" />
                                        <input type="hidden" class="form-control" id="quotecustomerId"
                                            name="customerId" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quotecustomerDov" class="form-label">Date of visit</label>
                                        <input type="date" class="form-control" id="quotecustomerDov" name="customerDov"
                                            readonly>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="quotecustomerEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="quotecustomerEmail"
                                            name="customerEmail" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quotecustomerPhone" class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="quotecustomerPhone"
                                            name="customerPhone" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="quotecustomerAddress" class="form-label">Address line</label>
                                        <input type="text" class="form-control" id="quotecustomerAddress"
                                            name="customerAddress" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quotecustomerCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="quotecustomerCity"
                                            name="customerCity" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="State" class="form-label">State</label>
                                        <input id="quotecustomerState" name="customerState" class="form-control"
                                            required readonly />
                                    </div>

                                    <div class="col-md-8">
                                        <input type="hidden" name="createdby" id="createdby" class="form-control"
                                            required data-parsley-type="integer" data-parsley-minlength="10"
                                            data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                            value="<?php echo $_SESSION['login_user']; ?>" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control"
                                            required data-parsley-type="integer" data-parsley-minlength="10"
                                            data-parsley-maxlength="12" data-parsley-trigger="keyup"
                                            value="<?php echo $_SESSION['login_user']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Quotation Details
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Quotation Type <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <select id="quoteType" class="form-select" required name="quoteType">
                                                    <option value='General'>General</option>
                                                    <option value='Bank'>Bank</option>
                                                </select>
                                            </div>
                                            <label class="col-md-3 text-right">Quotation For<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <select id="enqCategory" class="form-select" required
                                                    name="enqCategory">
                                                </select>
                                                <input type="hidden" name="encatName" id="encatName"
                                                    class="form-control" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Category Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <select id="itemCategory" class="form-select" required
                                                    name="itemCategory">

                                                </select>
                                            </div>
                                            <label class="col-md-3 text-right">Item Sub Category Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <select id="itemsubCategory" class="form-select" required
                                                    name="itemsubCategory">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Item Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <select id="itemid" class="form-select" required name="itemid">

                                                </select>
                                                <input type="hidden" name="selectedItemName" id="selectedItemName"
                                                    class="form-control" value="" />
                                                <input type="hidden" name="unitFactor" id="unitFactor"
                                                    class="form-control" value="" />
                                            </div>
                                            <label class="col-md-3 text-right">Item Quantity <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <input type="text" name="itemquantity" id="itemquantity"
                                                    class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Item per piece MRP <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="itemppMRP" id="itemppMRP" class="form-control"
                                                    required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                            <label class="col-md-3 text-right">Total Amount <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="totalAmount" id="totalAmount"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Discount-1</label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="discount1" id="discount1"
                                                    class="form-control" />
                                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                            </div>
                                            <label class="col-md-3 text-right">Discount-2</label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="discount2" id="discount2"
                                                    class="form-control" />
                                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">Discounted-1 Amount <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="discountAmount1" id="discountAmount1"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                            <label class="col-md-3 text-right">Discounted-2 Amount <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="discountAmount2" id="discountAmount2"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 text-right">GST<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="GST" id="GST" class="form-control" required
                                                    readonly />
                                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                                <input type="hidden" name="GSTAmount" id="GSTAmount"
                                                    class="form-control" value="" />
                                            </div>
                                            <label class="col-md-3 text-right">Total Price<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="totalPrice" id="totalPrice"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="lineItemTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>MRP</th>
                                                <th>Quantity</th>
                                                <th>Total Amount</th>
                                                <th>Discount-1 %</th>
                                                <th>Discount-1 Amt</th>
                                                <th>Discount-2 %</th>
                                                <th>Discount-2 Amt</th>
                                                <th>GST %</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                    <div class="form-group">
                                        <div class="row ">

                                            <label class="col-md-3 text-right">Sum Total Amount <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="sumTotalAmount" id="sumTotalAmount"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>

                                            <label class="col-md-3 text-right">Sum Total Price <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="sumTotalPrice" id="sumTotalPrice"
                                                    class="form-control" required readonly />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <label class="col-md-3 text-right">Quote Amount <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-3 input-group">
                                                <input type="text" name="QuoteAmount" id="QuoteAmount"
                                                    class="form-control" required />
                                                <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createQuote">Add Item</button>
                    <button type="submit" class="btn btn-primary" id="createQuote">Create Quote</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id=deleteUserModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_customer_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this customer.
                    </p>
                    <input type="hidden" name="deletecustomerId" id="deletecustomerId" value="">
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
<script src="../vendor/jquery-ui-1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    var customers = [];
    var isInitialized = false;
    var lineItemTable
    var sumTotalAmount = 0;
    var sumTotalPrice = 0;
    var itemDetails = [];
    $('#createQuote').click(function() {

        var formData = $('#quote_form').serializeJSON();
        customers.push(formData);
        if (formData['itemquantity'] != "" && formData['itemquantity'] != "0") {
            $('#lineItemTable tbody').
            append($(document.createElement('tr')).prop({

            }));

            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['selectedItemName']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['itemppMRP']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['itemquantity']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['totalAmount']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['discount1']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['discountAmount1']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['discount2']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['discountAmount2']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['GST']
            }));
            $('#lineItemTable tr:last').
            append($(document.createElement('td')).prop({
                innerHTML: formData['totalPrice']
            }));
            sumTotalAmount = parseFloat(sumTotalAmount) + parseFloat(formData['totalAmount']);
            sumTotalPrice = parseFloat(sumTotalPrice) + parseFloat(formData['totalPrice']);
            $('#sumTotalAmount').val(sumTotalAmount);
            $('#sumTotalPrice').val(sumTotalPrice);
        } else {
            alert("Please add the appropriate values in the Quantity")
        }

    });
    $('#quote_form').submit(function(event) {

        customers[0].QuoteAmount = $('#QuoteAmount').val();
        $.ajax({
            type: "POST",
            url: config.developmentPath + "/Admin/Controller/quotationController.php/",
            data: {
                "obj": customers
            },
            dataType: "json",
            encode: true,
        }).done(function(data) {
            console.log(data);
        });

    });
    var url = config.developmentPath + "/Admin/Controller/item_categorycontroller.php";
    let isSelectedSet1 = false;
    let catId = 0;
    $.getJSON(url, function(data) {
        $.each(data, function(index, value) {
            if (isSelectedSet1 === false) {
                $('#itemCategory').append('<option selected value="' + value
                    .itemcatid +
                    '">' +
                    value
                    .itemcatname + '</option>');
                $('#editeditemCategory').append('<option selected value="' + value
                    .itemcatid +
                    '">' + value
                    .itemcatname + '</option>');
                isSelectedSet1 = true;
                setSubCategory(value.itemcatid);

            } else {
                $('#itemCategory').append(
                    '<option hidden disabled selected value>-- select an option --</option>'
                    );
                $('#itemCategory').append('<option value="' + value.itemcatid + '">' + value
                    .itemcatname + '</option>');
                $('#editeditemCategory').append('<option value="' + value.itemcatid + '">' +
                    value
                    .itemcatname + '</option>');
            }
        });
    });

    function setSubCategory(catId) {
        var fetchsubcaturl = config.developmentPath +
            "/Admin/Controller/item_subcategorycontroller.php/?catId=" +
            catId;
        let subcatId = 0;
        $.getJSON(fetchsubcaturl, function(data) {
            $('#itemsubCategory').append(
                '<option hidden disabled selected value>-- select an option --</option>');
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#itemsubCategory').append('<option value="' + value.itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
                $('#editeditemsubCategory').append('<option value="' + value
                    .itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
            });
        });
    }

    function setItemlist(catId, subcatId) {
        $('#itemquantity').val("");
        $('#totalPrice').val("");
        $('#totalAmount').val("");
        $('#discountAmount1').val("");
        $('#discountAmount2').val("");
        $('#sumTotalAmount').val("");
        $('#sumTotalPrice').val("");
        $('#discount1').val("");
        $('#discount2').val("");
        $('#itemppMRP').val("");
        $('#GST').val("");
        var fetchitemlisturl = config.developmentPath +
            "/Admin/Controller/item_detailscontroller.php/?catId=" + catId + "&subcatId=" + subcatId;
        console.log(fetchitemlisturl);
        $.getJSON(fetchitemlisturl, function(data) {
            itemDetails = data;
            $('#itemid').append(
                '<option hidden disabled selected value>-- select an option --</option>');
            $.each(data, function(index, value) {
                $('#itemid').append('<option value="' + value.itemid + '">' +
                    value
                    .itemname + '</option>');

                // $('#editedsubCategory').append('<option value="' + value.itemsubcatid +
                //     '">' +
                //     value
                //     .itemsubcatname + '</option>');
            });
        });
    }
    $('#itemCategory').on('change', function() {
        $('#itemsubCategory').empty();
        $('#itemid').empty();
        $('#itemquantity').val("");
        $('#totalPrice').val("");
        $('#totalAmount').val("");
        $('#discountAmount1').val("");
        $('#discountAmount2').val("");
        $('#sumTotalAmount').val("");
        $('#sumTotalPrice').val("");
        $('#discount1').val("");
        $('#discount2').val("");
        $('#itemppMRP').val("");
        $('#GST').val("");
        fetchsubcaturl =
            config.developmentPath +
            "/Admin/Controller/item_subcategorycontroller.php/?catId=" + this
            .value;
        $.getJSON(fetchsubcaturl, function(data) {
            $('#itemsubCategory').append(
                '<option hidden disabled selected value>-- select an option --</option>');
            $.each(data, function(index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $('#itemsubCategory').append('<option value="' + value.itemsubcatid +
                    '">' +
                    value
                    .itemsubcatname + '</option>');
            });
        });
    });
    $('#itemsubCategory').on('change', function() {
        $('#itemid').empty();
        setItemlist($('#itemCategory').val(), this.value);
    });

    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1;
    if (month < 10) {
        month = "0" + month.toString();
    }
    var year = today.getFullYear();
    var datetoday = year.toString() + "-" + month.toString() + "-" + day.toString();
    $('#customerDov').val(datetoday);
    $('#editCustomerModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#editedcustomerId').val(rowid);
    });
    var dataTable = $('#Customer_table').DataTable({});
    var nEditing = null;
    $('#itemquantity').blur(function(e) {

        $('#totalAmount').val((parseFloat($('#itemquantity').val() * parseFloat($('#itemppMRP').val()) *
            parseFloat($('#unitFactor').val()))).toFixed(2));
            $('#totalPrice').val((parseFloat($('#itemquantity').val() * parseFloat($('#itemppMRP').val()) *
            parseFloat($('#unitFactor').val()))).toFixed(2));
        // $('#totalPrice').val((parseFloat(($('#totalAmount').val()) * (parseFloat($('#GST').val() /
        //     100))) + parseFloat($('#totalAmount').val())).toFixed(2));
        // $('#GSTAmount').val((parseFloat(($('#totalAmount').val()) * (parseFloat($('#GST').val() /
        //     100)))).toFixed(2));
    });

    $('#discount1').blur(function(e) {
        if (this.value != "" && this.value != 0) {
            $('#totalPrice').val((parseFloat($('#totalAmount').val())) - (parseFloat(($('#totalAmount')
                .val()) * (parseFloat($('#discount1').val() / 100)))).toFixed(2));
            $('#discountAmount1').val((parseFloat($('#totalAmount').val())) - (parseFloat(($(
                    '#totalAmount')
                .val()) * (parseFloat($('#discount1').val() / 100)))).toFixed(2));
            $('#totalPrice').val((parseFloat(($('#discountAmount1').val()) * (parseFloat($('#GST')
                .val() /
                100))) + parseFloat($('#discountAmount1').val())).toFixed(2));
            $('#GSTAmount').val((parseFloat(($('#discountAmount1').val()) * (parseFloat($('#GST')
                .val() / 100)))).toFixed(2));
                $('#discount2').removeAttr('readonly');
        } else {
            $('#discountAmount1').val("");
            $('#discountAmount2').val("");
            $('#discount2').val("");
           
            $('#totalPrice').val((parseFloat(($('#totalAmount').val()))));
           
        }
    });

    $('#discount2').attr('readonly','readonly')

    $('#discount2').blur(function(e) {
        if ((this.value !== "" && this.value != 0)) {
            $('#discountAmount2').val(((parseFloat($('#discountAmount1').val())) - (parseFloat(($(
                    '#discountAmount1')
                .val()) * (parseFloat($('#discount2').val() / 100))))).toFixed(2));
            $('#totalPrice').val((parseFloat(($('#discountAmount2').val()) * (parseFloat($('#GST')
                .val() /
                100))) + parseFloat($('#discountAmount2').val())).toFixed(2));
            $('#GSTAmount').val((parseFloat(($('#discountAmount2').val()) * (parseFloat($('#GST')
                .val() / 100)))).toFixed(2));
        } else {
            $('#discountAmount2').val("");

            if ($('#discount1').val() != "" && $('#discount1').val() != 0) {
                $('#totalPrice').val((parseFloat($('#totalAmount').val())) - (parseFloat(($(
                        '#totalAmount')
                    .val()) * (parseFloat($('#discount1').val() / 100)))).toFixed(2));
                $('#discountAmount1').val((parseFloat($('#totalAmount').val())) - (parseFloat(($(
                        '#totalAmount')
                    .val()) * (parseFloat($('#discount1').val() / 100)))).toFixed(2));
                $('#totalPrice').val((parseFloat(($('#discountAmount1').val()) * (parseFloat($('#GST')
                    .val() /
                    100))) + parseFloat($('#discountAmount1').val())).toFixed(2));
                $('#GSTAmount').val((parseFloat(($('#discountAmount1').val()) * (parseFloat($('#GST')
                    .val() /
                    100)))).toFixed(2));
            }
        }
    });

    $('#quoteModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#quotecustomerId').val(rowid);
        $('#itemid').empty();
        var url = config.developmentPath + "/Admin/Controller/item_detailscontroller.php";
        $.getJSON(url, function(data) {
            itemDetails = data;
            mappItemPrice(data[0].itemppMRP,
                data[0].itemGST,
                data[0].itemname,
                data[0].unitFactor);
            // $.each(data, function(index, value) {
            //     $('#itemid').append('<option value="' + value.itemid + '">' + value
            //         .itemname + '</option>');
            // });
        });

        var url = config.developmentPath +
            "/Admin/Controller/enqcategorymappingController.php?id=" + $(
                '#quoteenqId').val();
        $('#enqCategory').empty();
        $.getJSON(url, function(data) {
            $('#encatName').val(data[0].name);
            $.each(data, function(index, value) {
                $('#enqCategory').append('<option value="' + value.catId + '">' + value
                    .name + '</option>');
            });
        });

        customers = [];
        sumTotalAmount = 0;
        sumTotalPrice = 0;
        $('#itemquantity').val("");
        $('#totalPrice').val("");
        $('#totalAmount').val("");
        $('#discountAmount1').val("");
        $('#discountAmount2').val("");
        $('#sumTotalAmount').val("");
        $('#sumTotalPrice').val("");
        $('#discount1').val("");
        $('#discount2').val("");
        $('#itemppMRP').val("");
        $('#GST').val("");
        $("#lineItemTable").find("tr:gt(0)").remove();
    });

    $('#itemid').on('change', function(e) {

        for (var i = 0; i < itemDetails.length; i++) {
            // look for the entry with a matching `code` value
            if (itemDetails[i].itemid == this.value) {
                $('#itemquantity').val("");
                $('#totalPrice').val("");
                $('#totalAmount').val("");
                $('#discountAmount1').val("");
                $('#discountAmount2').val("");
                $('#sumTotalAmount').val("");
                $('#sumTotalPrice').val("");
                $('#discount1').val("");
                $('#discount2').val("");
                $('#itemppMRP').val("");
                $('#GST').val("");
                mappItemPrice(itemDetails[i].itemppMRP,
                    itemDetails[i].itemGST,
                    itemDetails[i].itemname,
                    itemDetails[i].unitFactor);
            }
        }
    });
    $('#enqCategory').on('change', function(e) {

        $('#encatName').val($("#enqCategory option:selected").text());
    });

    function mappItemPrice(price, gst, name, unitFactor) {
        $('#itemppMRP').val(price);
        $('#GST').val(gst);
        $('#selectedItemName').val(name);
        $('#unitFactor').val(unitFactor);
    }
    $('#Customer_table tbody').on('click', 'tr', function() {
        /* Get the row as a parent of the link that was clicked on */
        $('#editedcustomerCode').val(this.cells[0].innerHTML);
        $('#editedcustomerName').val(this.cells[1].innerHTML);
        $('#editedcustomerPhone').val(this.cells[4].innerHTML);
        $('#editedcustomerEmail').val(this.cells[5].innerHTML);
        $('#editedcustomerAddress').val(this.cells[6].innerHTML);
        $('#editedcustomerCity').val(this.cells[3].innerHTML);
        $('#editedcustomerState').val(this.cells[7].innerHTML);
        $('#editedcustomerDov').val(this.cells[2].innerHTML);
        $('#displayusername').text(this.cells[0].innerHTML);

        $('#displaycustomerName').text(this.cells[1].innerHTML);
        $('#displaycustomerPhone').text(this.cells[4].innerHTML);
        $('#displaycustomerEmail').text(this.cells[5].innerHTML);
        $('#displaycustomerAddress').text(this.cells[6].innerHTML);
        $('#displaycustomerCity').text(this.cells[3].innerHTML);
        $('#displaycustomerState').text(this.cells[7].innerHTML);
        $('#displaycustomerDov').text(this.cells[2].innerHTML);


    });
    $('#editedCustomer_form').submit(function(event) {
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: config.developmentPath + "/Admin/Controller/customerController.php/",
            data: formData,
            processData: false,
            contentType: false
        }).done(function(data) {
            console.log(data);
        });
    });


    $('#deleteUserModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#deletecustomerId').val(rowid);
    });
    $('#delete_customer_form').submit(function() {
        $.ajax({
            url: config.developmentPath + "/Admin/Controller/customerController.php/",
            method: "POST",
            data: {
                id: $('#deletecustomerId').val(),
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