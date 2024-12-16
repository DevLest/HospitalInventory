<?php
// Execute PHP code to fetch data from the database
$conn = new mysqli("localhost", "root", "", "data");
$result = $conn->query("SELECT id, medicine_name FROM pharmacy_medicine_details");
$options = "";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['medicine_name'] . "</option>";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add CSS style for alternating row colors */
        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
        .button-container form {
            display: inline-block;
            margin-right: 10px; /* Adjust as needed for spacing */
        }
        body {
            background-color: #E5E7E9;
        }
        td {
            text-align: center; /* Center the content inside table cells */
        }

    </style>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="Addpatient.php"> 🏥 HMCO</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="PharmacyDashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                            <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                            Customers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddCostu.php">Add Customers</a>
                                <a class="nav-link" href="PharmacyListCostu.php">Manage Customers</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-pills "></i></div>
                            Medicines
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyListMed.php">Manage Medicines</a>
                                <a class="nav-link" href="PharmacyListMedStock.php">Manage Medicines Stock</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                            Invoice
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts3" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddInvoice.php">Add Invoice</a>
                                <a class="nav-link" href="PharmacyInvoiceList.php">Manage Invoice</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Supplier
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts4" aria-labelledby="headingFour" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddSupplier.php">Add Supplier</a>
                                <a class="nav-link" href="SupplierList.php">Manage Supplier</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Purchase
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts5" aria-labelledby="headingFive" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddPurchase.php">Add Purchase</a>
                                <a class="nav-link" href="PharmacyPurchaseList.php">Manage Purchase</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Report
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts6" aria-labelledby="headingSix" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddSupplier.php">Add Report</a>
                                <a class="nav-link" href="SupplierList.php">Manage Report</a>
                            </nav>
                        </div>
                </nav>
            </div>

<div id="layoutSidenav_content">
    <div>
        <h1 style="margin-left: 3%; margin-top: 1%;"><i class="fas fa-chart-bar"></i> Add Purchase</h1>
        <p style="font-weight: bold; margin-left: 8%;">Add New Purchase</p>
    </div>
    <div class="container mt-1" style="opacity: 0.9; border-top: 2px solid black; margin-bottom: 5px;">
        <br>
    <div class="container" style="margin-top: 10px;">
        <form method="post" action="PharmacyProcessInvoice.php">
    <div class="container2" style="margin-top: 1px;"></div>
    <div class="container" style="margin-top: 1%;">
<div class="row">
                <div class="col-md-2 mb-3">
                    <label for="customer" class="form-label" style="font-weight: bold;">Customer:</label>
                    <select class="form-control" id="customer" name="customer_id" style="width: 100%;">
                        <option value="">Select Customer</option>
                        <?php
                        // Fetch customers from the database
                        $conn = new mysqli("localhost", "root", "", "data");
                        $result = $conn->query("SELECT customer_id, customer_name FROM pharmacycustomers");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name'] . "</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="address" class="form-label" style="font-weight: bold;">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" style="width: 100%; background-color:lightgray;" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="invoice" class="form-label" style="font-weight: bold;">Invoice Number:</label>
                    <input type="text" class="form-control" id="invoice" name="invoice_number" placeholder="Invoice Number" style="width: 100%;">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="paymentType" class="form-label" style="font-weight: bold;">Payment Type:</label>
                    <div class="custom-select-wrapper">
                        <select class="custom-select" id="paymentType" name="payment_type" style="width: 100%;">
                            <option value="Cash Payment">Cash Payment</option>
                            <option value="Net Banking">Net Banking</option>
                            <option value="Payment Due">Payment Due</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="date" class="form-label" style="font-weight: bold;">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" style="width: 100%;">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="contactNumber" class="form-label" style="font-weight: bold; ">Contact Number:</label>
                    <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact Number" style="width: 100%; background-color:lightgray;" readonly>
                </div>
            </div>
            <div>
                <a class="nav-link" href="PharmacyAddCostu.php">
                    <div class="sb-nav-link-icon" style="color: green; font-weight: bold;">
                        <i class="fas fa-plus" style="color: green; font-weight: bold;"></i>New Costumer
                    </div>
                </a><br>
            </div>
        </div>
    </div>

    <div class="head1" style="opacity: 0.9; border-top: 4px solid #5DADE2;">
        <br>
        <div class="container2" style="margin-top: 1px;"></div>
        <div class="container" style="margin-top: 1%;">
            <div class="row product-row">
                <div class="col-md-2 mb-3">
                    <label for="medicineName" class="form-label" style="font-weight: bold;">Medicine Name:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="packing" class="form-label" style="font-weight: bold;">Avail. Qty.:</label>
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
                    <label for="amount" class="form-label" style="font-weight: bold;">Discount:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="amount" class="form-label" style="font-weight: bold;">Total:</label>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="amount" class="form-label" style="font-weight: bold;">Action:</label>
                </div>
            </div>

            <div class="head2" style="opacity: 0.9; border-top: 4px solid #5DADE2;">
                <br>
                           <div class="container3">
                <div class="row product-row">
                    <div class="col-md-2 mb-3">
                        <select class="form-control medicine" name="medicine[]" style="width: 100%;">
                            <option value="">Select Medicine</option>
                            <?php
                            // Fetch medicines from the database
                            $conn = new mysqli("localhost", "root", "", "data");
                            $result = $conn->query("SELECT id, medicine_name FROM pharmacy_medicine_details");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['medicine_name'] . "</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                     <div class="col-md-1 mb-3">
                        <input type="text" class="form-control packing" name="packing[]">
                        <input type="hidden" class="original-packing" name="original_packing[]">
                    </div>
                    <div class="col-md-1 mb-3" style="width: 120px;">
                        <input type="date" class="form-control expiryDate" name="expiryDate[]">
                    </div>
                    <div class="col-md-1 mb-3">
                        <input type="number" class="form-control quantity" name="quantity[]">
                    </div>
                    <div class="col-md-1 mb-3">
                        <input type="number" class="form-control price" name="price[]">
                    </div>
                    <div class="col-md-1 mb-3">
                        <input type="number" class="form-control discount" name="Discount[]">
                    </div>
                    <div class="col-md-1 mb-3">
                        <input type="number" class="form-control total" name="Total[]" style="background-color: lightgray; width: 110%;" readonly>
                    </div>
                    <div class="col-md-1 mb-3">
                        <button type="button" class="btn btn-primary removeRow" style="background-color: red;"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
                    </div>

                    <div class="row">
    <div class="col-md-2 mb-3">
        <button type="button" class="btn btn-primary addRow">Add Row</button>
    </div>
    <div class="row justify-content-end">
        <div class="col-md-3 mb-3">
            <label for="grandTotal1" class="form-label" style="font-weight: bold; margin-left: 80%; width: 80%; ">Total Amount:</label>
            <input type="text" class="form-control grandTotal" id="grandTotal1" name="total_amount" style="margin-left: 80%; background-color: lightgray; width: 60%;" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label for="grandTotal2" class="form-label" style="font-weight: bold; margin-left: 40%;">Total Discount:</label>
            <input type="text" class="form-control grandTotal" id="grandTotal2" name="total_discount" style="margin-left: 40%; background-color: lightgray; width: 60%;" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label for="grandTotal3" class="form-label" style="font-weight: bold;">Net Total:</label>
            <input type="text" class="form-control grandTotal" id="grandTotal3" name="net_total" style="background-color: lightgray; width: 60%;" readonly>
        </div>
    </div>
 <div class="head" style="opacity: 0.9; border-top: 4px solid black;"><br>
    <div class="row justify-content-end">
        <div class="col-md-3 mb-3">
            <label for="paidAmount" class="form-label" style="font-weight: bold; margin-left: 35%;">Paid Amount:</label>
            <input type="text" class="form-control" id="paidAmount" name="paid_amount" style=" width: 60%; margin-left: 35%;">
        </div>
        <div class="col-md-3 mb-3">
            <label for="changeAmount" class="form-label" style="font-weight: bold; margin-left: -5%;">Change:</label>
            <input type="text" class="form-control" id="changeAmount" name="change_amount" style="background-color: lightgray; width: 60%; margin-left: -5%;" readonly>
        </div>
    </div>
</div>

                        <div class="col-md-4 mb-4" id="saveButtonContainer">
    <button type="submit" class="btn btn-primary saveInvoice" style="width: 50%; justify-content: center; background-color: green;">SAVE</button>
</div>

                        </div>
                    </form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function() {
            // Populate address and contact number based on selected customer
            $('#customer').change(function() {
                var customerId = $(this).val();
                if (customerId) {
                    $.ajax({
                        url: 'fetch_customer.php',
                        type: 'POST',
                        data: { customer_id: customerId },
                        dataType: 'json',
                        success: function(response) {
                            $('#address').val(response.address);
                            $('#contactNumber').val(response.contact_number);
                        },
                        error: function() {
                            alert("Error fetching customer details.");
                        }
                    });
                } else {
                    $('#address').val('');
                    $('#contactNumber').val('');
                }
            });
        });
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Populate address and contact number based on selected customer
    $('#customer').change(function() {
        var customerId = $(this).val();
        if (customerId) {
            $.ajax({
                url: 'fetch_customer.php',
                type: 'POST',
                data: { customer_id: customerId },
                dataType: 'json',
                success: function(response) {
                    $('#address').val(response.address);
                    $('#contactNumber').val(response.contact_number);
                },
                error: function() {
                    alert("Error fetching customer details.");
                }
            });
        } else {
            $('#address').val('');
            $('#contactNumber').val('');
        }
    });

    // Function to add a new row
    $('.addRow').click(function() {
        var newRow = `
            <div class="row product-row">
                <div class="col-md-2 mb-3">
                    <select class="form-control medicine" name="medicine[]" style="width: 100%;">
                        <option value="">Select Medicine</option>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "data");
                        $result = $conn->query("SELECT id, medicine_name FROM pharmacy_medicine_details");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['medicine_name'] . "</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <input type="text" class="form-control packing" name="packing[]">
                    <input type="hidden" class="original-packing" name="original_packing[]">
                </div>
                <div class="col-md-1 mb-3" style="width: 120px;">
                    <input type="date" class="form-control expiryDate" name="expiryDate[]">
                </div>
                <div class="col-md-1 mb-3">
                    <input type="number" class="form-control quantity" name="quantity[]">
                </div>
                <div class="col-md-1 mb-3">
                    <input type="number" class="form-control price" name="price[]">
                </div>
                <div class="col-md-1 mb-3">
                    <input type="number" class="form-control discount" name="Discount[]">
                </div>
                <div class="col-md-1 mb-3">
                    <input type="number" class="form-control total" name="Total[]" style="background-color: lightgray; width: 110%;" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="btn btn-primary removeRow" style="background-color: red;"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>`;
        $('.container3').append(newRow);
    });

    // Function to remove a row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('.product-row').remove();
        calculateGrandTotal();
    });

    // Populate medicine details based on selected medicine
    $(document).on('change', '.medicine', function() {
        var medicineId = $(this).val();
        var row = $(this).closest('.product-row');
        if (medicineId) {
            $.ajax({
                url: 'fetch_medicine.php',
                type: 'POST',
                data: { medicine_id: medicineId },
                dataType: 'json',
                success: function(response) {
                    row.find('.packing').val(response.packing);
                    row.find('.original-packing').val(response.packing);
                    row.find('.batchID').val(response.batch_id);
                    row.find('.expiryDate').val(response.expiry_date);
                    row.find('.price').val(response.price);
                },
                error: function() {
                    alert("Error fetching medicine details.");
                }
            });
        } else {
            row.find('.packing').val('');
            row.find('.original-packing').val('');
            row.find('.batchID').val('');
            row.find('.expiryDate').val('');
            row.find('.price').val('');
        }
    });

    // Function to calculate the total for each row and adjust packing
    $(document).on('input', '.quantity', function() {
        var row = $(this).closest('.product-row');
        var quantity = parseFloat(row.find('.quantity').val()) || 0;
        var price = parseFloat(row.find('.price').val()) || 0;
        var discount = parseFloat(row.find('.discount').val()) || 0;
        var originalPacking = parseFloat(row.find('.original-packing').val()) || 0;
        var newPacking = originalPacking - quantity;

        if (newPacking < 0) {
            alert('Quantity exceeds available packing!');
            row.find('.quantity').val(originalPacking); // Reset to original quantity
            newPacking = 0;
        }

        var total = (quantity * price) - discount;
        row.find('.total').val(total.toFixed(2));
        row.find('.packing').val(newPacking);

        // Update the packing in the database
        $.ajax({
            url: 'PharmacyUpdateQuantityInvoice.php',
            type: 'POST',
            data: {
                medicine_id: row.find('.medicine').val(),
                new_packing: newPacking
            },
            success: function(response) {
                // Optional: Show a success message or handle response
            },
            error: function() {
                alert("Error updating packing in the database.");
            }
        });

        calculateGrandTotal();
    });

    // Function to calculate grand totals
    function calculateGrandTotal() {
        var totalAmount = 0;
        var totalDiscount = 0;
        $('.product-row').each(function() {
            var quantity = parseFloat($(this).find('.quantity').val()) || 0;
            var price = parseFloat($(this).find('.price').val()) || 0;
            var discount = parseFloat($(this).find('.discount').val()) || 0;
            totalAmount += quantity * price;
            totalDiscount += discount;
        });
        var netTotal = totalAmount - totalDiscount;
        $('#grandTotal1').val(totalAmount.toFixed(2));
        $('#grandTotal2').val(totalDiscount.toFixed(2));
        $('#grandTotal3').val(netTotal.toFixed(2));
    }

    // Function to calculate change amount
    $('#paidAmount').on('input', function() {
        var paidAmount = parseFloat($(this).val()) || 0;
        var netTotal = parseFloat($('#grandTotal3').val()) || 0;
        var changeAmount = paidAmount - netTotal;
        $('#changeAmount').val(changeAmount.toFixed(2));
    });

    // Function to handle form submission
    $('form').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            url: $(this).attr('action'), // Form action URL
            type: $(this).attr('method'), // Form method (POST)
            data: formData, // Form data
            success: function(response) {
                // Hide the save button
                $('#saveButtonContainer').hide();
                // Add new button for printing
                $('.head').append('<button type="button" class="btn btn-success printInvoice" style="margin-left: 1%;">Print Invoice</button>');
                // Add new button for creating a new invoice
                $('.head').append('<a href="PharmacyAddInvoice.php" class="btn btn-primary newInvoice" style="margin-left: 10px;">New Invoice</a>');
                // Add text indicating that the invoice has been saved
                $('.head').append('<p style="text-align: center; font-size: 150%; font-weight: bold; color: green;">Invoice Saved.</p>');
                // Clear specific form fields if needed
                $('#invoice').val(''); // Clear invoice number field
                $('#date').val(''); // Clear date field
                $('#paidAmount').val(''); // Clear paid amount field
            },
            error: function() {
                alert("Error saving invoice.");
            }
        });
    });

        // Function to calculate the total for each row and adjust packing
$(document).on('input', '.quantity, .discount', function() {
    var row = $(this).closest('.product-row');
    var quantity = parseFloat(row.find('.quantity').val()) || 0;
    var price = parseFloat(row.find('.price').val()) || 0;
    var discount = parseFloat(row.find('.discount').val()) || 0;
    var originalPacking = parseFloat(row.find('.original-packing').val()) || 0;
    var newPacking = originalPacking - quantity;

    if (newPacking < 0) {
        alert('Quantity exceeds available packing!');
        row.find('.quantity').val(originalPacking); // Reset to original quantity
        newPacking = 0;
    }

    var total = (quantity * price) - discount;
    row.find('.total').val(total.toFixed(2));
    row.find('.packing').val(newPacking);

    // Update the packing in the database
    $.ajax({
        url: 'PharmacyUpdateQuantityInvoice.php',
        type: 'POST',
        data: {
            medicine_id: row.find('.medicine').val(),
            new_packing: newPacking
        },
        success: function(response) {
            // Optional: Show a success message or handle response
        },
        error: function() {
            alert("Error updating packing in the database.");
        }
    });

    calculateGrandTotal();
});
        
    // Print invoice function
    $(document).on('click', '.printInvoice', function() {
        // Get invoice details
        var customerName = $('#customer option:selected').text();
        var invoiceNumber = $('#invoice').val();
        var date = $('#date').val();
        var address = $('#address').val();
        var paymentType = $('#paymentType').val();
        var contactNumber = $('#contactNumber').val();

        // Create printable content
        var printableContent = `
            <h2 style="text-align: center; font-weight: bold;">PHARMACY INVOICE</h2>
            <div style="text-align: right; margin-right: 20%;">
                <h2 style="color: red; font-weight: bold;">DETAILS</h2>
            </div>
            <p style="text-align: right; margin-right: 20%;"><strong>Date:</strong> ${date}</p>
            <p style="text-align: right; margin-right:            18%;"><strong>Invoice Number:</strong> ${invoiceNumber}</p>
            <h2 style= "color: red; font-weight: bold;">BILL TO</h2>
            <p><strong>Customer Name:</strong> ${customerName}</p>
            <p><strong>Address:</strong> ${address}</p>
            <p><strong>Payment Type:</strong> ${paymentType}</p>
            <p><strong>Contact Number:</strong> ${contactNumber}</p>

            <table style="width:100%; border-collapse: collapse; border: 1px solid black;">
                <tr>
                    <th style="border: 1px solid black; padding: 8px; color: red;">Medicine Name</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">Quantity</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">Price</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">Discount</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">Total</th>
                </tr>
        `;

        // Extract medicine details
        $('.medicine').each(function() {
            var medicineName = $(this).find(':selected').text();
            var quantity = $(this).closest('.product-row').find('.quantity').val();
            var price = $(this).closest('.product-row').find('.price').val();
            var discount = $(this).closest('.product-row').find('.discount').val();
            var total = $(this).closest('.product-row').find('.total').val();
            printableContent += `
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">${medicineName}</td>
                    <td style="border: 1px solid black; padding: 8px;">${quantity}</td>
                    <td style="border: 1px solid black; padding: 8px;">${price}</td>
                    <td style="border: 1px solid black; padding: 8px;">${discount}</td>
                    <td style="border: 1px solid black; padding: 8px;">${total}</td>
                </tr>
            `;
        });

        printableContent += `</table>`;

        // Get total amount
        var totalAmount = 0;
        $('.total').each(function() {
            totalAmount += parseFloat($(this).val());
        });

        // Get paid amount
        var paidAmount = parseFloat($('#paidAmount').val());

        // Calculate change
        var change = paidAmount - totalAmount;

        // Add paid amount and change to the printable content
        printableContent += `
            <p style="text-align: right; color: green;"><strong>Paid Amount:</strong> ${paidAmount}</p>
            <p style="text-align: right; color: green"><strong>Change:</strong> ${change}</p>
        `;

        // Open a new window and write the printable content
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Invoice</title></head><body>' + printableContent + '</body></html>');
        // Print the window
        printWindow.print();
        printWindow.close();
    });

    // Function to handle creating a new invoice
    $(document).on('click', '.newInvoice', function() {
        // Show the save button
        $('#saveButtonContainer').show();
        // Remove the new invoice and print buttons
        $('.printInvoice').remove();
        $('.newInvoice').remove();
        // Remove the text indicating that the invoice has been saved
        $('p').remove();
    });
});
</script>


<br>


</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
