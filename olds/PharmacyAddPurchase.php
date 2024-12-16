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
        <form method="post" action="PharmacyAddPurchaseProcess.php">
    <div class="container2" style="margin-top: 1px;"></div>
    <div class="container" style="margin-top: 1%;">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="supplier" class="form-label" style="font-weight: bold;">Supplier:</label>
                <select class="form-control" id="supplier" name="supplier" style="width: 100%;">
                    <?php
                    // Fetch suppliers from the database
                    $conn = new mysqli("localhost", "root", "", "data");
                    $result = $conn->query("SELECT id, name FROM pharmacy_suppliers");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
                  <div class="col-md-3 mb-3">
                <label for="invoice" class="form-label" style="font-weight: bold;">Invoice Number:</label>
                <input type="text" class="form-control" id="invoice" name="invoice" placeholder="Invoice Number" style="width: 80%;">
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
                <label for="date" class="form-label" style="font-weight: bold; margin-left: -40%;">Date:</label>
                <input type="date" class="form-control" id="date" name="date" style="width: 80%; margin-left: -40%;">
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
