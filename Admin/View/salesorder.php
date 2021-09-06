<?php
require_once("session.php");
include "salesorderheader.php";
require_once("../DB Operations/salesorderOps.php");
require_once("../Model/salesorderModel.php");
?>
<style>


</style>
<h1 class="h3 mb-4 text-gray-800">Sales Order Management</h1>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Sales Order</h6>
            </div>
            <form class="" method="POST" id="saleOrder_form" enctype="multipart/form-data" novalidate>
                <div class="accordion-item">
                    <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3 text-right">Customer Name <span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <select id="customer" class="form-select" required name="customer">

                                        </select>
                                    </div> 
                                    <label class="col-md-3 text-right">Category Name <span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <select id="itemCategory" class="form-select" required name="itemCategory">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3 text-right">Item Sub Category Name <span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <select id="itemsubCategory" class="form-select" required name="itemsubCategory">

                                        </select>
                                    </div>
                                    <label class="col-md-3 text-right">Item <span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <select id="itemid" class="form-select" required name="itemid">

                                        </select>
                                        <input type="hidden" name="selectedItemName" id="selectedItemName" class="form-control" value="" />
                                    </div>
                                    <br />

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3 text-right">Item Quantity <span class="text-danger">*</span></label>
                                    <div class="col-md-3 input-group">
                                        <input type="number" name="itemquantity" id="itemquantity" class="form-control" pattern="[0-9]+" title="please enter number only" required/>
                                        <select class="input-group-text" id="unit" class="form-select" required name="unit"></select>
                                    </div>
                                    <label class="col-md-3 text-right">Per Unit Price<span class="text-danger">*</span></label>
                                    <div class="col-md-3 input-group">
                                        <input type="text" name="itemperpieceprice" id="itemperpieceprice" class="form-control" required />
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3 text-right">Date of Sales <span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id="salesdate" name="salesdate" value="">
                                    </div>
                                    <label class="col-md-3 text-right">Total Amount <span class="text-danger">*</span></label>
                                    <div class="col-md-3 input-group">
                                        <input type="text" name="totalAmount" id="totalAmount" class="form-control" required readonly />
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3 text-right">Total Order Amount <span class="text-danger">*</span></label>
                                    <div class="col-md-3 input-group">
                                        <input type="text" name="totalOrderAmount" id="totalOrderAmount" class="form-control" required readonly />
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="lineItemTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                        <div class="form-group">
                            <div class="row ">

                                <div class="col-md-8">
                                    <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required value="<?php echo $_SESSION['login_user']; ?>" />
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="createQuote">Add Item</button>
                                <button type="submit" class="btn btn-primary disabled" id="Quote"  formnovalidate="off">Create Sales
                                    Order</button>

                            </div>
                        </div>

                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
<?php
include "footer.php";
?>
<script>
    var sales = [];

    function removeItem(itemId) {
       
        document.getElementById(itemId).remove();
        sales.forEach(function(item, index, arr) {
            if (item.itemid == itemId) {
                document.getElementById('totalOrderAmount').value = parseFloat(document.getElementById('totalOrderAmount').value) - parseFloat(item.totalAmount);
                sales.splice(index, 1);
                sales[sales.length-1].totalOrderAmount=document.getElementById('totalOrderAmount').value;
            }
        })
    }

    function editItem(itemId) {
       document.getElementById("edit_"+itemId).classList.add("disabled");;
       document.getElementById("save_"+itemId).classList.remove('disabled');
        var row = document.getElementById(itemId);
        var quantity=row.cells[1].innerHTML;
        var price=row.cells[2].innerHTML;
        var total=row.cells[3].innerHTML;
        row.cells[1].innerHTML='<input type="text" onchange="qChange('+itemId+')" name="quantity" id="editedquantity" class="form-control" required value="'+quantity+'" size="8" >';
        row.cells[2].innerHTML='<input type="text" onchange="qChange('+itemId+')" name="itemperpieceprice" id="editeditemperpieceprice" class="form-control" value="'+price+'" required size="8"/>'
        row.cells[3].innerHTML='<input type="text" name="totalAmount" id="editedtotalAmount" class="form-control" required readonly value="'+total+'" size="8"/>'
    }
    function qChange(itemId){
        var quantity=document.getElementById('editedquantity').value;
        var price=document.getElementById('editeditemperpieceprice').value;
        var totalPrice=document.getElementById('editedtotalAmount').value;
        var totalOrderAmt=document.getElementById('totalOrderAmount').value;
        document.getElementById('editedtotalAmount').value=parseFloat(quantity)*parseFloat(price);
        totalOrderAmt-=totalPrice;
        document.getElementById('totalOrderAmount').value=totalOrderAmt;
        document.getElementById('totalOrderAmount').value=parseFloat(document.getElementById('editedtotalAmount').value)+parseFloat(document.getElementById('totalOrderAmount').value);
        sales.forEach(function(item, index, arr) {
            if (item.itemid == itemId) {
                item.quantity=quantity;
                item.itemperpieceprice=price;
                item.totalAmount=parseFloat(quantity)*parseFloat(price);
            }
        })

    }
    function pChange(){
        var quantity=document.getElementById('editedquantity').value;
        var price=document.getElementById('editeditemperpieceprice').value;
        document.getElementById('editedtotalAmount').value=parseFloat(quantity)*parseFloat(price);

    }
    function saveItem(itemId){
        debugger;
        document.getElementById("edit_"+itemId).classList.remove("disabled");;
       document.getElementById("save_"+itemId).classList.add('disabled');
        var row = document.getElementById(itemId);
        var quantity=document.getElementById('editedquantity').value;
        var price=document.getElementById('editeditemperpieceprice').value;
        var total=document.getElementById('editedtotalAmount').value;
        row.cells[1].innerHTML=quantity;
        row.cells[2].innerHTML=price;
        row.cells[3].innerHTML=total;
    }
    $(document).ready(function() {
        var d = new Date();
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1; //Months are zero based
        var curr_year = d.getFullYear();
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var today = curr_year + "-" + curr_month + "-" + curr_date;
        document.getElementById("salesdate").defaultValue = today;

        $('#totalOrderAmount').val(0);

        $('#createQuote').click(function() {
            var formData = $('#saleOrder_form').serializeJSON();
           
            let obj=sales.find(obj => obj.itemid == formData['itemid']);
            if(obj){
                alert("Item is already added in the list");
                console.log(sales);
            }else{
            sales.push(formData);
            console.log(sales);
            $('#totalOrderAmount').val(parseFloat(formData['totalAmount']) + parseFloat($('#totalOrderAmount').val()));
            formData.totalOrderAmount=$('#totalOrderAmount').val();
            if (formData['itemquantity'] != "" && formData['itemquantity'] != "0") {
                $('#lineItemTable tbody').
                append($(document.createElement('tr')).prop({
                    id: formData['itemid']
                }));

                $('#lineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: formData['selectedItemName']
                }));
                $('#lineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: formData['itemquantity']
                }));
                $('#lineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: formData['itemperpieceprice']
                }));

                $('#lineItemTable tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: formData['totalAmount']
                }));
                $('#lineItemTable tr:last').
                append($(document.createElement('td')).append(
                    '<div class="btn-group" role="group" aria-label="Basic mixed styles example"><a class="btn btn-success" onclick="removeItem(' + formData['itemid'] + ')" href="#" role="button"><i class="far fa-trash-alt"></i></a>'
                    +'<a onclick="editItem(' + formData['itemid'] + ')" id="edit_'+formData['itemid']+'"class="btn btn-warning btn-small" href="#" role="button"><i class="fas fa-pencil-alt"></i></a>'
                    +'<a onclick="saveItem(' + formData['itemid'] + ')" id="save_'+formData['itemid']+'"class="btn btn-primary btn-small disabled" href="#" role="button" ><i class="fas fa-sd-card"></i></a></div>'));
                $('#Quote').removeClass('disabled');
            } else {
                alert("Please add the appropriate values in the Quantity")
            }
        }
        });
        $('#itemquantity').on('change', function(e) {
            $('#totalAmount').val(this.value * $('#itemperpieceprice').val());
        })
        $('#itemperpieceprice').on('change', function(e) {
            $('#totalAmount').val(this.value * $('#itemquantity').val());
        })
        $('#saleOrder_form').submit(function(event) {
        debugger;
            $.ajax({
                type: "POST",
                url: config.developmentPath + "/Admin/Controller/salesordercontroller.php",
                data: {
                    "obj": sales
                },
                dataType: "json",
                encode: true,
            }).done(function(data) {
                window.location.replace(config.developmentPath+"/Admin/View/SOview.php");
            });

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
        $('#unit').on('change', function() {
            $('#unitFactor').empty();
            unitFactorurl =
                config.developmentPath +
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

        var fetchcompany = config.developmentPath + "/Admin/Controller/customerController.php/"
        $.getJSON(fetchcompany, function(data) {
            $.each(data, function(index, value) {
                $('#customer').append(
                    '<option hidden disabled selected value>-- select an option --</option>'
                );
                $('#customer').append('<option value="' + value.customerId + '">' + value
                    .customerName + '</option>');
                $('#editedcompany').append('<option value="' + value.customerId + '">' + value
                    .customerName + '</option>');
            });
        });

        // $('#unit').change(function(e) {
        //     debugger;
        //     if ($(this).val() == "KG") {

        //         $('#totalAmount').val((parseFloat($('#itemquantity').val() * parseFloat($(
        //                 '#itemperpieceprice')
        //             .val()))).toFixed(2));
        //     } else if ($('#unit').val() == "GRAM") {
        //         $('#totalAmount').val((parseFloat($('#itemquantity').val() * parseFloat($(
        //                 '#itemperpieceprice')
        //             .val()))).toFixed(2)) / 1000;
        //     }

        // });



        $('#itemid').empty();
        var url = config.developmentPath + "/Admin/Controller/item_detailscontroller.php";
        $.getJSON(url, function(data) {

            itemDetails = data;
            mappItemPrice(data[0].itemperpieceprice,
                data[0].itemname,
                data[0].unitFactor);
            $.each(data, function(index, value) {
                $('#itemid').append('<option value="' + value.itemid + '">' + value
                    .itemname + '</option>');
            });
        });

        $('#itemid').on('change', function(e) {

            for (var i = 0; i < itemDetails.length; i++) {
                // look for the entry with a matching `code` value
                if (itemDetails[i].itemid == this.value) {
                    $('#itemquantity').val("");
                    $('#totalAmount').val("");
                    mappItemPrice(itemDetails[i].itemperpieceprice,
                        itemDetails[i].itemname,
                        itemDetails[i].unitFactor);
                }
            }
        });

        function mappItemPrice(price, name, unitFactor) {
            $('#itemperpieceprice').val(price);
            $('#selectedItemName').val(name);
            $('#unitFactor').val(unitFactor);
        }
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
                // setSubCategory(value.itemcatid);

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
        debugger;
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
</script>