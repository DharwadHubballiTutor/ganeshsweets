<?php
require_once("session.php");
include "header.php";
require_once("../DB Operations/enquiryOps.php");
require_once("../Model/enquirymodel.php");
?>
<style>
.form-check-input {
    position: static;
    margin-top: .3rem;
    margin-left: 0rem;
}
</style>
<h1 class="h3 mb-4 text-gray-800">Enquiry Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Enquiry List</h6>
            </div>
            <div class="col" align="right">

                <div class='dropdown'>
                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu2'
                        data-toggle='dropdown' aria-expanded='false'>
                        Actions
                    </button>
                    <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>

                        <a class='btn btn-primary dropdown-item' href="enqcategory.php" role='button'>
                            <i class="fas fa-plus-circle"></i>
                            Enquiry Category
                        </a>
                        <button class='btn btn-primary dropdown-item' data-toggle='modal' data-target='#addEnquiryModal'
                            role='button'>
                            <i class="fas fa-plus-circle"></i>
                            Create Enquiry
                        </button>
                    </div>
                </div>
                </span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered" id="enquiry_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>DOE</th>
                        <th>Phone</th>
                        <th style='display:none'>Email</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Enquiry</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $enquiryList = DBenq::getAllenq();
                    foreach ($enquiryList as $enquiry) {
                        echo "<tr><td>" . $enquiry->get_enqname() . "</td>
                    <td>" . $enquiry->getCreatedDate() . "</td>
                    <td>" . $enquiry->get_enqphone() . "</td>
                    <td style='display:none'>" . $enquiry->get_enqemail() . "</td>
                    <td>" . $enquiry->getStatus() . "</td>
                    <td>" . $enquiry->get_enqaddress() . "</td>
                    <td>";

                        foreach ($enquiry->get_interestList() as $interest) {

                            echo '<li class="">' . $interest . '</li>';
                        }

                        echo "</td>
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
                                    data-target='#enqModal' 
                                    role='button' data-id='" . $enquiry->get_id() . "'> 
                                    <i class='fas fa-comment-dots'></i>
                                        Follow Up
                                    </button>
                                    <button class='btn btn-primary dropdown-item'
                                    data-toggle='modal' 
                                    data-target='#infoEnquiryModal' 
                                    role='button' data-id='" . $enquiry->get_id() . "'> 
                                    <i class='fas fa-info'></i>
                                        Enquiry Info
                                    </button>
                                    <button class='btn btn-primary dropdown-item'";
                        if ($enquiry->get_isCustomerCreated() == 1) echo "style='pointer-events: none;'";
                        echo "data-toggle='modal' 
                                    data-target='#customerModal' 
                                    role='button' data-id='" . $enquiry->get_id() . "'> 
                                    <i class='fas fa-angle-double-right'></i>
                                        Create Customer
                                   </button>
                                   <button class='btn btn-primary dropdown-item'
                                   data-toggle='modal' 
                                   data-target='#deleteEnquiryModal' 
                                   role='button' 
                                   data-id='" . $enquiry->get_id() . "'>
                                    <i class='fas fa-trash-alt'></i>
                                      Delete Enquiry
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
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="" method="POST" id="customer_form" enctype="multipart/form-data"
            action="../Controller/customerController.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-8">
                        <label for="customerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName">
                        <input type="hidden" class="form-control" id="enqId" name="enqId" />
                    </div>
                    <div class="col-md-4">
                        <label for="customerDov" class="form-label">Date of visit</label>
                        <input type="date" class="form-control" id="customerDov" name="customerDov">
                    </div>
                    <div class="col-md-8">
                        <label for="customerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail">
                    </div>
                    <div class="col-md-4">
                        <label for="customerPhone" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="customerPhone" name="customerPhone">
                    </div>
                    <div class="col-md-6">
                        <label for="customerAddress" class="form-label">Address line</label>
                        <input type="text" class="form-control" id="customerAddress" placeholder="1234 Main St"
                            name="customerAddress">
                    </div>
                    <div class="col-md-3">
                        <label for="customerCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="customerCity" name="customerCity">
                    </div>
                    <div class="col-md-3">
                        <label for="State" class="form-label">State</label>
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
                    <div class="col-md-8">
                        <input type="hidden" name="createdby" id="createdby" class="form-control" required
                            data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                            data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                    </div>
                    <div class="col-md-8">
                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required
                            data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                            data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createCustomer">Create Customer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="addEnquiryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form class="" method="POST" id="customer_form" enctype="multipart/form-data"
            action="../Controller/newenquiry.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enquiry Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Name <span class="">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" required
                                    maxlength="150" />
                                <input type="hidden" name="isAdmin" id="isAdmin" class="form-control" required
                                    value="true" />

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Phone <span class="">*</span></label>
                            <div class="col-md-8">
                                <input type="tel" name="phone" id="phone" class="form-control" required
                                    maxlength="10" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right"> Email <span class="">*</span></label>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right"> Address <span class="">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="address" id="address" class="form-control" required
                                    maxlength="500" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="coursesopted" class="col-md-4 text-right">
                                looking for
                            </label>
                            <div class="col-md-8" id="checkboxes">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createCustomer">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="enqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form method="post" id="followup_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Follow Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="followuptable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>

                                    Follwed By

                                </th>
                                <th>

                                    Comments

                                </th>
                                <th>

                                    Date

                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Comments:</legend>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="followcomment" style="height: 100px"
                                            data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-trigger="keyup"
                                            name="followcomment"></textarea>
                                        <label for="followcomment">Comments</label>
                                    </div>
                                    <input type="hidden" name="followenqid" id="followenqid" value="">
                                    <fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="followupBy" id="followupBy" class="form-control" required
                                    data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                                    data-parsley-trigger="keyup" value=<?php echo $_SESSION['login_user']; ?> />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">FollowUp</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id=enqcatModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data"
            action="../Controller/enqcategoryController.php">
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
                                <input type="text" name="catname" id="catname" class="form-control" required
                                    data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150"
                                    data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="hidden" name="catcreatedby" id="catcreatedby" class="form-control" required
                                    data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12"
                                    data-parsley-trigger="keyup" value="<?php echo $_SESSION['login_user']; ?>" />
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

<div class="modal fade" id="deleteEnquiryModal" tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog">
        <form method="POST" id="delete_enquiry_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure. Would you like to delete this user.
                    </p>
                    <input type="hidden" name="deleteenqid" id="deleteenqid" value="">
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

<div class="modal fade" id=infoEnquiryModal tabindex=-1 role=dialog aria-hidden=true>
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
                                        <label for="displaycustomerDov">Date Of Enquiry</label>
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
<script>
$(document).ready(function() {

    $('#deleteEnqCat').click(function() {});
    $('#closeEnqCat').click(function() {
        $('#deletenqcatModal').trigger('hidden.bs.modal');
        $('#deletenqcatModal').toggle();
        $('.modal-backdrop').remove();
        $('#deletenqcatModal').removeAttr('style');
        $('#deletenqcatModal').attr('style', 'display:none');
        $('#deletenqcatModal').attr('aria-hidden', 'true');
        $('#deletenqcatModal').removeAttr('aria-modal');
        $('#deletenqcatModal').removeClass('show');
        $('.modal-backdrop:last').remove();
        $('#deletenqcatModal').removeAttr('role');
    });
    $('#deletenqcatModal').on('show.bs.modal', function(e) {
        reloadCategory();
    });
    $('#confirmModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#enqcatId').val(rowid);
    });

    function reloadCategory() {
        var uniturl = config.developmentPath +
            "/Admin/Controller/enqcategoryController.php";
        $.getJSON(uniturl, function(data) {
            $("#enqCategoryTable").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {
                $('#enqCategoryTable tbody').
                append($(document.createElement('tr')).prop({
                    id: value.CatId
                }));
                $('#enqCategoryTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.catname
                }));
                $('#enqCategoryTable tr:last').
                append($(document.createElement('td')).append(
                    '<a class="btn btn-danger" id="deleteEnqCat" data-toggle="modal" data-target="#confirmModal" data-id="' +
                    value.CatId + '">delete</a>'
                ));
            });
        });
    }

    $('#deleteLineItembutton').click(function() {
        $.ajax({
            url: config.developmentPath + "/Admin/Controller/enqcategoryController.php/",
            method: "POST",
            data: {
                id: $('#enqcatId').val(),
                action: 'delete'
            }
        });
        reloadCategory();
        $('#confirmModal').attr('aria-hidden', 'true');
        $('#confirmModal').removeAttr('style');
        $('#confirmModal').removeAttr('aria-modal');
        $('#confirmModal').removeClass('show');
        $('#confirmModal').attr('style', 'display:none');
        $('.modal-backdrop:last').remove();
        $('#confirmModal').removeAttr('role');
    });
    var fetchsubcaturl = config.developmentPath + "/Admin/Controller/enqcategoryController.php";
    $.getJSON(fetchsubcaturl, function(data) {

        $.each(data, function(index, value) {
            $('#checkboxes').append(
                $(document.createElement('div')).prop({
                    class: 'form-check'
                }).append(
                    $(document.createElement('label')).prop({
                        for: 'myCheckBox'
                    }).html(value.catname)
                ).append(
                    $(document.createElement('input')).prop({
                        class: 'form-check-input',
                        id: 'myCheckBox',
                        name: 'interest_list[]',
                        value: value.CatId,
                        type: 'checkbox'
                    })
                ).append(document.createElement('br')));
        });
    });
    var baseurl = ""
    var dataTable = $('#enquiry_table').DataTable({

    });

    $('#enqModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#followenqid').val(rowid);
        var contactUrl = config.developmentPath + "/Admin/Controller/followupController.php/?id=" +
            rowid;
        $.getJSON(contactUrl, function(data) {
            $("#followuptable").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {
                $('#followuptable tbody').
                append($(document.createElement('tr')).prop({
                    id: value.followupid
                }));

                $('#followuptable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.followup_by
                }));
                $('#followuptable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.followup_comments
                }));
                $('#followuptable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.followup_on
                }));
            });
        });
    });
    $("form").submit(function(event) {
        var formData = {
            followenqid: $("#followenqid").val(),
            followupBy: $("#followupBy").val(),
            followcomment: $("#followcomment").val(),
            enqStatus: 'Attened'
        };

        $.ajax({
            type: "POST",
            url: config.developmentPath +
                "/Admin/Controller/followupController.php/",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function(data) {
            console.log(data);
        });
    });
    $('#enquiry_table tbody').on('click', 'tr', function() {
        /* Get the row as a parent of the link that was clicked on */
        $('#customerName').val(this.cells[0].innerHTML);
        $('#customerPhone').val(this.cells[2].innerHTML);
        $('#customerEmail').val(this.cells[3].innerHTML);
        $('#customerAddress').val(this.cells[5].innerHTML);

        $('#displaycustomerName').text(this.cells[0].innerHTML);
        $('#displaycustomerPhone').text(this.cells[2].innerHTML);
        $('#displaycustomerEmail').text(this.cells[3].innerHTML);
        $('#displaycustomerAddress').text(this.cells[5].innerHTML);
        $('#displaycustomerDov').text(this.cells[1].innerHTML);
        debugger;
        var today = new Date(this.cells[1].innerHTML);
        var day = today.getDate();
        var month = today.getMonth() + 1;
        if (month < 10) {
            month = "0" + month.toString();
        }
        var year = today.getFullYear();
        var datetoday = year.toString() + "-" + month.toString() + "-" + day.toString();
        $('#customerDov').val(datetoday);
    });

    $('#customerModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#enqId').val(rowid);

        $.ajax({
            cache: false,
            type: 'GET',
            url: config.developmentPath + "/Admin/Controller/companyController.php/",
            data: 'id=' + rowid,
            success: function(data) {

            }
        });
    });

    $('#deleteEnquiryModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#deleteenqid').val(rowid);
    });
    $('#deletebutton').click(function() {
        $.ajax({
            url: config.developmentPath + "/Admin/Controller/newenquiry.php/",
            method: "POST",
            data: {
                id: $('#deleteenqid').val(),
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