<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the number of records per page
$records_per_page = 5;

// Get the current page from the URL, if not set, default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting record based on the current page
$start_from = ($page - 1) * $records_per_page;

// SQL query to fetch medicines data with LIMIT for pagination
$sql = "SELECT * FROM pharmacy_medicines_products LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// SQL query to get the total number of records
$total_records_sql = "SELECT COUNT(*) FROM pharmacy_medicines_products";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="Med.css">
    <link rel="stylesheet" href="Receipt.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-color: #f4f6f6;
    }

</style>

<body>

    <!-- Fixed Top Navigation -->
    <div class="top-nav">
    <!-- Left-aligned logo and title -->
    <div class="icon-container">
        <img src="img/Hinigaran.png" alt="Logo">
        <h1>𝙷𝚒𝚗𝚒𝚐𝚊𝚛𝚊𝚗 𝙼𝚎𝚍𝚒𝚌𝚊𝚕 𝙲𝚕𝚒𝚗𝚒𝚌 𝙷𝚘𝚜𝚙𝚒𝚝𝚊𝚕</h1>
    </div>

    <!-- Right-aligned notification and user icons -->
    <div class="icon-group">
        <div class="user-icon" onclick="toggleUserMenu(event)">
            <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
        </div>
    </div>
    <div class="user-menu" id="user-menu">
        <a href="#settings">⚙️ Settings</a>
        <a href="#logout">● Log Out</a>
    </div>
</div>

    <!-- Side Navigation -->
       <div id="mySidenav" class="side-nav">
        <div class="logo-container">
           <img src="img/hini.png" alt="Logo" style="width: 40%;">
            <h2>𝐇 𝐌 𝐂 𝐇</h2>
        </div>
         <a class="nav-link" href="ChiefAdmin.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <!-- Medicines Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicines" aria-expanded="false" aria-controls="collapseMedicines">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                <span> 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseMedicines">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PharmacyMedicine.php" style="width: 100%;">◽ Add Medicines</a>
                <a class="nav-link" href="PharmacyMedicineList.php" style="width: 100%;">◽ Medicines List</a>
            </nav>
        </div>

        <!-- Products Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span> 𝖯𝗋𝗈𝖽𝗎𝖼𝗍</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseProducts">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PharmacyProduct.php" style="width: 100%;">◽ Add Products</a>
                <a class="nav-link" href="PharmacyProductList.php" style="width: 100%;">◽ Products List</a>
            </nav>
        </div>
        <!-- Patients Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatients" aria-expanded="false" aria-controls="collapsePatients">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span>Patients</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapsePatients">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PatientAdd.php" style="width: 100%;">◽ Add Patient</a>
                <a class="nav-link" href="PatientList.php" style="width: 100%;">◽ Patient List</a>
            </nav>
        </div>
        <a class="nav-link" href="ManageUser.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Receipt.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Reports.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>𝖱𝖾𝗉𝗈𝗋𝗍𝗌</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌 𝖫𝗂𝗌𝗍</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌 𝖫𝗂𝗌𝗍
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>
<!-- Form Card -->
         <section id="datetime">
        <div class="fas fa-calendar-alt" id="current-date" style="font-weight: bold; margin-left: 4%; "></div>
        <div id="current-time" style="font-weight: bold; background-color:black; width: 20%; text-align: center; color: white; border-radius: 3px;"></div>
    </section>
<div class="container mt-4">
<div class="medicines-content-wrapper" style="width: 112%; margin-left: -67px;">
    <input type="text" id="searchInput" onkeyup="searchMedicine()" placeholder="Search for medicine name..." class="form-control mb-3">
    <table id="medicines-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Medicines Name</th>
                <th>Generic Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Registered Quantity</th>
                <th>Sold Quantity</th>
                <th>Remaining Quantity</th>
                <th>Registered Date</th>
                <th>Expiry Date</th>
                <th>Selling Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?= $row["image"] ?>" alt="Product Image"></td>
                        <td><?= $row["medicine_product"] ?></td>
                        <td><?= $row["generic_name"] ?></td>
                        <td><?= $row["category"] ?></td>
                        <td><?= $row["brand"] ?></td>
                        <td><?= $row["registered_quantity"] ?></td>
                        <td><?= $row["sold_quantity"] ?></td>
                        <td><?= $row["remain_quantity"] ?></td>
                        <td><?= $row["registered"] ?></td>
                        <td><?= $row["expiry"] ?></td>
                        <td>₱ <?= $row["selling_price"] ?></td>
                        <td>
                            <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; font-size: 30px">
                                •••
                            </button>

                            <!-- Dropdown menu -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal<?= $row["id"] ?>">
                                    <i class="fas fa-edit" style="color: blue;"></i> Edit
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal<?= $row["id"] ?>">
                                    <i class="fas fa-trash" style="color: red;"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
<div class="modal fade" id="editModal<?= $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row["id"] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?= $row["id"] ?>">Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="editmedicine.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    
                    <!-- Form fields -->
                    <div class="form-group">
                        <label for="medicine_product">Medicine Name</label>
                        <input type="text" class="form-control" name="medicine_product" value="<?= $row["medicine_product"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image URL</label>
                        <input type="text" class="form-control" name="image" value="<?= $row["image"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="generic_name">Generic Name</label>
                        <input type="text" class="form-control" name="generic_name" value="<?= $row["generic_name"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" value="<?= $row["category"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" name="brand" value="<?= $row["brand"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="registered_quantity">Registered Quantity</label>
                        <input type="text" class="form-control" name="registered_quantity" value="<?= $row["registered_quantity"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="registered">Registered Date</label>
                        <input type="date" class="form-control" name="registered" value="<?= $row["registered"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="date" class="form-control" name="expiry" value="<?= $row["expiry"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" value="<?= $row["selling_price"] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal<?= $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $row["id"] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel<?= $row["id"] ?>">Delete Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product?
                                </div>
                                <div class="modal-footer">
                                    <form action="deletemedicine.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="11">No records found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">Previous</a>
        <?php else: ?>
            <a class="disabled">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>">Next</a>
        <?php else: ?>
            <a class="disabled">Next</a>
        <?php endif; ?>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        function toggleNav() {
            var sideNav = document.getElementById("mySidenav");
            var mainContent = document.getElementById("mainContent");

            if (sideNav.classList.contains('side-nav-hidden')) {
                sideNav.classList.remove('side-nav-hidden');
                mainContent.classList.remove('main-content-expanded');
            } else {
                sideNav.classList.add('side-nav-hidden');
                mainContent.classList.add('main-content-expanded');
            }
        }
        function toggleUserMenu(event) {
            const userMenu = document.getElementById('user-menu');
            // Prevent the click event from bubbling to the window
            event.stopPropagation(); 
            
            // Toggle the display of the user menu
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        }

        function showNotifications() {
            // Function to show notifications (implement as needed)
            alert("Notifications clicked!");
        }

        // Hide the user menu if clicking outside of it
        window.onclick = function(event) {
            const userMenu = document.getElementById('user-menu');
            if (!event.target.matches('.user-icon') && !event.target.matches('#user-menu')) {
                if (userMenu.style.display === 'block') {
                    userMenu.style.display = 'none';
                }
            }
        }

    </script>
    <script>
        function searchMedicine() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("medicines-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Get the medicine name column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
   // Calendar and time
    function updateDateTime() {
        const now = new Date();
        const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

        document.getElementById('current-date').innerText = now.toLocaleDateString(undefined, optionsDate);
        document.getElementById('current-time').innerText = now.toLocaleTimeString(undefined, optionsTime);
    }

    // Update date and time every second
    setInterval(updateDateTime, 1000);

    // Initial call to display date and time immediately
    updateDateTime();
</script>
</body>
</html>
