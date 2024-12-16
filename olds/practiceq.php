<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Purchase Form</title>
</head>
<body>

<form method="post" action="PharmacyAddPurchaseProcess.php">
    <div class="container2" style="margin-top: 1px;"></div>
    <div class="container" style="margin-top: 1%;">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="supplier" class="form-label" style="font-weight: bold;">Supplier:</label>
                <select class="form-control" id="supplier" name="supplier" style="width: 100%;">
                    <?php
                    // Fetch suppliers from the database
                    $conn = new mysqli("localhost", "root", "", "pharmacy_db");
                    $result = $conn->query("SELECT id, name FROM suppliers");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="contactNumber" class="form-label" style="font-weight: bold;">Invoice Number:</label>
                <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Invoice Number" style="width: 80%;">
            </div>
            <div class="col-md-3 mb-3">
                <label for="paymentType" class="form-label" style="font-weight: bold; margin-left: -20%;">Payment Type:</label>
                <div class="custom-select-wrapper">
                    <select class="custom-select" id="paymentType" name="paymentType" style="width: 80%; margin-left: -20%;">
                        <option value="Cash Payment">Cash Payment</option>
                        <option value="Net Banking">Net Banking</option>
                        <option value="Payment Due">Payment Due</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="doctorName" class="form-label" style="font-weight: bold; margin-left: -40%;">Date:</label>
                <input type="date" class="form-control" id="doctorName" name="doctorName" style="width: 80%; margin-left: -40%;">
            </div>
            <div>
                <a class="nav-link" href="PharmacyAddSupplier.php">
                    <div class="sb-nav-link-icon" style="color: green; font-weight: bold;">
                        <i class="fas fa-plus" style="color: green; font-weight: bold;"></i>Add New Supplier
                    </div>
                </a><br>
            </div>
        </div>
    </div>

    <div class="head" style="opacity: 0.9; border-top: 4px solid #5DADE2;">
        <br>
        <div class="container2" style="margin-top: 1px;"></div>
        <div class="container" style="margin-top: 1%;">
            <div class="row product-row">
                <div class="col-md-2 mb-3">
                    <label for="medicineName" class="form-label" style="font-weight: bold;">Medicine Name:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="packing" class="form-label" style="font-weight: bold;">Packing:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="batchID" class="form-label" style="font-weight: bold;">Batch ID:</label>
                </div>
                <div class="col-md-1 mb-3" style="width: 120px;">
                    <label for="expiryDate" class="form-label" style="font-weight: bold;">Expiry Date:</label>
                </div>

                <div class="col-md-1 mb-3">
                    <label for="quantity" class="form-label" style="font-weight: bold;">Quantity:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="price" class="form-label" style="font-weight: bold;">Price:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="amount" class="form-label" style="font-weight: bold;">Amount:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="amount" class="form-label" style="font-weight: bold;">Action:</label>
                </div>
            </div>

            <div class="head" style="opacity: 0.9; border-top: 4px solid #5DADE2;">
                <br>
                <div class="container2" style="margin-top: 1px;">
                    <div class="row product-row">
                        <div class="col-md-2 mb-3">
                            <input type="text" class="form-control" name="medicineName[]" />
                        </div>
                        <div class="col-md-1 mb-3">
                            <input type="text" class="form-control" name="packing[]">
                        </div>
                        <div class="col-md-1 mb-3">
                            <input type="text" class="form-control" name="batchID[]">
                        </div>
                        <div class="col-md-1 mb-3" style="width: 120px;">
                            <input type="date" class="form-control" name="expiryDate[]">
                        </div>

                        <div class="col-md-1 mb-3">
                            <input type="number" class="form-control quantity" name="quantity[]">
                        </div>
                        <div class="col-md-1 mb-3">
                            <input type="number" class="form-control price" name="price[]">
                        </div>
                        <div class="col-md-1 mb-3">
                            <input type="number" class="form-control amount" name="amount" style="background-color: lightgray; width: 110%;" readonly>
                        </div>
                        <div class="col-md-1 mb-3">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary removeRow" style="background-color: red;"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <button type="button" class="btn btn-primary addRow">Add Row</button>
                        </div>
                        <div class="row">
                    </div>
                        <div class="col-md-3 mb-3" style="margin-left: 70%;">
                            <label for="grandTotal" class="form-label" style="font-weight: bold;">Grand Total:</label>
                            <input type="text" class="form-control grandTotal" name="grandTotal" style="background-color: lightgray;" readonly>
                        </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4 mb-4" style="justify-content: center; margin-left: 30%;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: centers;">SAVE</button>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add Row
        $(document).on('click', '.addRow', function() {
            var newRow = '<div class="row product-row">' +
                '<div class="col-md-2 mb-3">' +
                '<input type="text" class="form-control" name="medicineName[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<input type="text" class="form-control" name="packing[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<input type="text" class="form-control" name="batchID[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3" style="width: 9.5%;">' +
                '<input type="date" class="form-control" name="expiryDate[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<input type="number" class="form-control quantity" name="quantity[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<input type="number" class="form-control price" name="price[]">' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<input type="number" class="form-control amount" name="amount[]" style="background-color: lightgray; width: 110%;" readonly>' +
                '</div>' +
                '<div class="col-md-1 mb-3">' +
                '<button type="button" class="btn btn-primary removeRow" style="background-color: red;"><i class="fas fa-trash-alt"></i></button>' +
                '</div>' +
                '</div>';
            $(this).closest('.row').before(newRow);
        });

        // Calculate Amount and Quantity
        $(document).on('input', '.quantity, .price', function() {
            var row = $(this).closest('.product-row');
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var price = parseFloat(row.find('.price').val()) || 0;
            var amount = quantity * price;
            row.find('.amount').val(amount.toFixed(2));
            calculateGrandTotal();
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('.product-row').remove();
            calculateGrandTotal();
        });

        // Calculate Grand Total
        function calculateGrandTotal() {
            var grandTotal = 0;
            $('.amount').each(function() {
                grandTotal += parseFloat($(this).val()) || 0;
            });
            $('.grandTotal').val(grandTotal.toFixed(2));
        }
    });
</script>

</body>
</html>

