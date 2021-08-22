<?php
require_once "salesorderheader.php";
include('../DB Operations/salesorderOps.php');
$salesId = $_GET['id'];
$firstsales = DBsales::getSalesForPrint($salesId);
?>
<link rel="stylesheet" href="../css/inword.css" />
<style>
    .form-switch .form-check-input {
        width: 2em;
        margin-left: 0em;
    }

    .form-check-label {
        margin-bottom: 0;
        margin-left: 2.5em !important;
    }

    btn-group-sm>.btn,
    .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
        margin-left: 1em;
    }

    .table tr {
        color: black;
    }

    .border-dark tr th,
    td {
        border: 2px solid black !important;

    }
</style>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class='container-fluid' id="printsales">
            <table class="table table-bordered border-dark border-4" id="GeneralQuote">
                <tr>
                    <td style="text-align:center" colspan="6">
                        <h1>Sales Order</h1>
                        <p>Ganesh Sweets Dharwad</p>
                    </td>
                </tr>
                <tr>
                    <!-- <th >Customer Name </th> -->
                    <td rowspan="3" colspan="5"> To: <?php echo $firstsales->getCustomerName() ?> <br>
                        <?php echo $firstsales->getCustomerAddress() ?> <br />
                        <?php echo $firstsales->getCustomerContactNumber() ?>
                    </td>
                </tr>
                <tr>
                    <td>Sales Id&nbsp: &nbsp <?php echo $firstsales->getSOCode() ?>
                        <p id="salescode" style="display: none;"> <?php echo $firstsales->getSOCode() ?></p>
                    </td>
                </tr>
                <tr>
                    <td> Date&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp <?php echo $firstsales->get_salesdate() ?> </td>
                </tr>
                <tr>
                    <th style="text-align:center" colspan="1">Sl</th>
                    <th colspan="3" style="text-align:center">Description</th>
                    <th style="text-align:center">Qty</th>


                    <th style="text-align:center">Amount</th>
                </tr>
                <?php
                $count = 1;
                $sum = 0;
                $sumquantity = 0;
                foreach ($saleslist as $sales) {
                    echo '<tr  id="' . $count . '">
            <td  style="text-align:center">' . $count . '<button type="button" onclick="callMe(' . $count . ')" class="btn btn-secondary btn-sm">Remove</button></td>
            <td colspan="3">' . $sales->getName() . '</td>
            <td  style="text-align:center">' . $sales->getQuantity() . " " . $sales->get_unit() . '</td>
           
            <td  style="text-align:center"id="sales-' . $count . '">' . $sales->get_totalAmount() . '</td>
        </tr>';
                    $sum = $sum + floatval($sales->get_totalAmount());
                    $sumquantity = $sumquantity + floatval($sales->getQuantity());
                    $payable = $sum + floatval($sales->get_pendingAmount());
                    $count++;
                }
                echo "<input type='hidden' id='totalRow' value='" . --$count . "'/>";
                ?>
                <tr>
                    <td style="text-align:right" rowspan="2" colspan="3">
                        Returns
                    </td>
                    <td style="text-align:right">Total</td>
                    <td style="text-align:center"><?php echo $sumquantity ?> </td>
                    <td id="totalAmount" style="text-align:center">
                        <?php echo $sum ?>
                    </td>

                </tr>

                <tr>
                    <td style="text-align:right">Payable</td>
                    <td colspan="2" style="text-align:center"><?php echo $payable ?> </td>
                </tr>

                <tr>
                    <td colspan="6">
                        <h3 id="inwords"></h3>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">
                        Terms and Conditions
                    </th>
                </tr>

            </table>
        </div>
        <div>
            <form name="salesOrder" method="POST" id="itemListForm" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <div class="row">
                        <input type="hidden" name="createdby" id="createdby" class="form-control" required value="<?php echo $_SESSION['login_user']; ?>" />
                        <input type="hidden" name="modifiedby" id="modifiedby" class="form-control" required value="<?php echo $_SESSION['login_user']; ?>" />
                        <input type="hidden" id="salesId" value="<?php echo $firstsales->get_Id(); ?>" />
                    </div>
                </div>
                <input type="submit" name="submit" id="PDF" class="btn btn-success" value="Save AS PDF" />
            </form>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>
<script src="../js/inword.js"></script>
<script>
    function callMe(rowId) {
        debugger;
        var newTotal = 0;
        console.log(parseFloat($("#totalAmount").text()));
        console.log(parseFloat($('#' + rowId + ' td[id=sales-' + rowId + ']').text()));
        newTotal = parseFloat($("#totalAmount").text()) - parseFloat($('#' + rowId + ' td[id=sales-' + rowId + ']')
            .text());
        $("#totalAmount").text(newTotal);
        $('#totalAmount').inword({
            type: "placer",
            value: parseFloat($("#totalAmount").text()),
            placerId: "inwords",
            case: "ucfirst"
        });
        $("#" + rowId + "").remove();
        rowId;
        var totalRow = $('#totalRow').val();
        while (rowId <= totalRow) {

            $("#" + rowId + " td:first").text(rowId - 1);
            $("#" + rowId + " td:first").append('<button type="button" onclick="callMe(' + rowId +
                ')" class="btn btn-secondary btn-sm">Remove</button>');
            rowId++;
        }
    }

    function callmeForPI(rowId) {
        debugger;
        rowId = "PI-TR-" + rowId;
        var res = rowId.split("-");
        var totalRow = $('#totalRow').val();
        var newTotal = 0;
        console.log(parseFloat($("#subtotal").text()));
        console.log(parseFloat($('#' + rowId + ' td[id=PI-' + res[2] + ']').text()));
        newTotal = parseFloat($("#subtotal").text()) - parseFloat($('#' + rowId + ' td[id=PI-' + res[2] + ']').text());
        $("#subtotal").text(newTotal);
        $('#subtotal').inword({
            type: "placer",
            value: parseFloat($("#subtotal").text()),
            placerId: "PIinwords",
            case: "ucfirst"
        });
        $("#" + rowId + "").remove();
        rowId;
        while (res[2] <= totalRow) {

            $("#" + rowId + " td:first").text(res[2] - 1);
            $("#" + rowId + " td:first").append('<button type="button" onclick="callMe(' + rowId +
                ')" class="btn btn-secondary btn-sm">Remove</button>');
            res[2]++;
            rowId = res.join('-');
        }
    }

    $(document).ready(function() {
        var waterMarked = false;
        $('#estimatedTotal').text($('#subtotal').text() + '/-');
        $('#totalAmount').inword({
            type: "placer",
            value: parseFloat($("#totalAmount").text()),
            placerId: "inwords",
            case: "ucfirst"
        });
        $('#subtotal').inword({
            type: "placer",
            value: parseFloat($("#subtotal").text()),
            placerId: "PIinwords",
            case: "ucfirst"
        });


        $('#flexSwitchCheckDefault').on('click', function(e) {
            if ($(this).attr('checked') != 'checked') {
                $(this).attr('checked', 'checked');
                waterMarked = true;
            } else {
                $(this).removeAttr('checked');
                waterMarked = false;
            }
        })
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
                    "salesId": $('#salesId').val(),
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
            
            window.open(config.developmentPath +'/Admin/pdfs/salesorder/'+fileName.trim()+'.pdf');
        });
        // $('#PIForm').submit(function(e) {
        //     var content = $('#printPI').html();
        //     var fileName = $('#customerCode').text() + $('#listquoteCode').text() + '_PROFORMA_Invoice';
        //     var uniturl = config.developmentPath +
        //         "/Admin/Controller/pdfGeneratorContorller.php";
        //     $.ajax({
        //         type: "POST",
        //         url: uniturl,
        //         data: {
        //             "modifiedby": $('#modifiedby').val(),
        //             "quoteId": $('#quoteId').val(),
        //             "fileType": "quotations",
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
    });
</script>