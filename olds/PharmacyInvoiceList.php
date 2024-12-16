<?php
$db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'database') or die(mysqli_error($db));

$query = "SELECT * FROM pharmacy_invoice";
$results = mysqli_query($db, $query);
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
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <main>  
        <div>
            <h1 style="margin-left: 3%; margin-top: 1%;"><i class="fas fa-shopping-cart"></i> Manage Purchase</h1>
            <p style="font-weight: bold; margin-left: 8%;">Manage Existing Purchase</p>
        </div>
        <div class="container mt-1" style="opacity: 0.9; border-top: 2px solid black; margin-bottom: 50%;"><br>
            <div class="card mb-4" style="margin-left: 2%; width:96%;">
                <div class="card-body">
                    <h1>Search Here:</h1>
                    <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="Customers" placeholder="By Customer" name="Customers">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="invoiceSearch" placeholder="By Invoice" name="invoiceSearch">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <label for="price" class="form-label" style="font-weight: bold;">By Purchase Date:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" id="purchaseDateSearch" name="purchaseDateSearch">
                    </div>
                    <div class="col-md-2">
                       <button class="btn btn-secondary" id="refreshButton" title="Refresh" style="background-color: white;">
                            <i class="fas fa-sync-alt" style="color: green;"></i>
                        </button>
                    </div>
                </div>

<!-- Table -->
<table id="datatablesSimple" class="table">
    <thead>
        <div class="container mt-1" style="opacity: 0.9; border-top: 4px solid #5DADE2; width: 100%;"><br>
        <tr>
            <th>SL.</th>
            <th>Invoice Number</th>
            <th>Costumer Name</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>Total Discount</th>
            <th>Net Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>SL.</th>
            <th>Invoice Number</th>
            <th>Costumer Name</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>Total Discount</th>
            <th>Net Total</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
<?php
// Assuming you have already established a database connection

// Fetch invoice data with customer names
$sql = "SELECT pi.invoice_id, pc.customer_name, pi.invoice_number, pi.date, pi.total_amount, pi.total_discount, pi.net_total 
        FROM pharmacy_invoice pi 
        INNER JOIN pharmacycustomers pc ON pi.customer_id = pc.customer_id";
$results = mysqli_query($db, $sql); // Use $db instead of $conn


// Check if there are results
if (mysqli_num_rows($results) > 0) {
    // Loop through each row of results
    while ($row = mysqli_fetch_array($results)) {
        ?>
        <tr>
            <td><?php echo $row['invoice_id'] ?? ''; ?></td>
            <td><?php echo $row['invoice_number'] ?? ''; ?></td>
            <td><?php echo $row['customer_name'] ?? ''; ?></td>
            <td><?php echo $row['date'] ?? ''; ?></td>
            <td><?php echo $row['total_amount'] ?? ''; ?></td>
            <td><?php echo $row['total_discount'] ?? ''; ?></td>
            <td><?php echo $row['net_total'] ?? ''; ?></td>
            <td>
                <div class="button-container">
                    <form method="post" action="edit.php">
                        <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </form>
                    <form method="get" action="PatientView.php">
                        <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>">
                        <button type="submit" class="btn btn-info btn-sm">View</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php
    }
} else {
    echo "No records found";
}
?>

    </tbody>
</table>
<div class="container mt-1" style="opacity: 0.9; border-top: 4px solid #5DADE2; width: 100%;"><br>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to filter table data based on search criteria
        function filterTable() {
            var invoice = $('#invoiceSearch').val().toLowerCase();
            var customers = $('#Customers').val().toLowerCase();

            $('#datatablesSimple tbody tr').each(function () {
                var rowInvoice = $(this).find('td:eq(1)').text().toLowerCase(); // Invoice column index
                var rowCustomer = $(this).find('td:eq(2)').text().toLowerCase(); // Customer column index

                // Show or hide table row based on search criteria
                if (rowInvoice.includes(invoice) && rowCustomer.includes(customers)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Call filterTable function on input change
        $('#invoiceSearch, #Customers').on('input', filterTable);

        // Function to filter table data based on purchase date
        function filterByPurchaseDate() {
            var purchaseDate = $('#purchaseDateSearch').val(); // Get the value of the purchase date input

            $('#datatablesSimple tbody tr').each(function () {
                var rowPurchaseDate = $(this).find('td:eq(3)').text(); // Get the purchase date from the current row

                // Show or hide table row based on whether the purchase date matches the selected date
                if (purchaseDate === '' || rowPurchaseDate === purchaseDate) {
                    $(this).show(); // Show the row if the purchase date matches or if no date is selected
                } else {
                    $(this).hide(); // Hide the row if the purchase date does not match
                }
            });
        }

        // Call the filterByPurchaseDate function when the purchase date input changes
        $('#purchaseDateSearch').on('change', filterByPurchaseDate);
    });
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
