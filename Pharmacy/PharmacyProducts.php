<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar Only</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Product.css">
    <style>

</style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <img src="img/hini.png" alt="Logo" class="nav-logo" style="width: 4%; margin-left: 1%;">
    <div class="nav-left" style="margin-right: 45%;">HMDH Pharmacy System</div>
    <div class="nav-right">
        <a href="PharmacyPOS.php">🏚️ Home</a>
        <a href="PharmacyProducts.php">🛒 Products</a>
        <a href="PharmacySalesReport.php">📉 Sales Report</a>
        <a href="#">🔴 Logout</a>
    </div>
</nav>

<!-- Date and Time Display -->
<section id="datetime"><br><br><br><br>
    <div class="fas fa-calendar-alt" id="current-date" style="font-weight: bold;"></div><br>
    <div id="current-time" style="font-weight: bold; background-color:black; width: 10%; text-align: center; color: white; border-radius: 3px;"></div>
</section><br>

<!-- Medicines Table -->
<section >
    <div style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.9);">
        <h2 style="text-align: center;">MEDICINES</h2>
        <!-- Search Input for Medicines -->
        <div style="margin-bottom: 15px;">
            <input type="text" id="search-medicines" placeholder="Search for medicine..." style="padding: 8px; width: calc(100% - 20px);">
        </div>

        <table id="medicines-table" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Medicines / Products</th>
                    <th>Generic Name</th>
                    <th>Category</th>
                    <th>Registered Quantity</th>
                    <th>Sold Quantity</th>
                    <th>Remaining Quantity</th>
                    <th>Registered Date</th>
                    <th>Expiry Date</th>
                    <th>Selling Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('../connection/dbconfig.php'); 


                // Set the number of rows per page
                $rows_per_page = 5;

                // Get the current page number from the query string, default is 1
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $rows_per_page;

                // SQL query to fetch medicines data with limit and offset
                $sql = "SELECT * FROM pharmacy_medicines_products LIMIT $offset, $rows_per_page";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Display image (assuming the 'image' field stores the file path)
                        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='width: 100px; height: 100px;'></td>";
                        echo "<td>" . $row["medicine_product"] . "</td>";
                        echo "<td>" . $row["generic_name"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>" . $row["registered_quantity"] . "</td>";
                        echo "<td>" . $row["sold_quantity"] . "</td>";
                        echo "<td>" . $row["remain_quantity"] . "</td>";
                        echo "<td>" . $row["registered"] . "</td>";
                        echo "<td>" . $row["expiry"] . "</td>";
                        echo "<td>₱ " . $row["selling_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align: center;'>No records found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Pagination Controls for Medicines -->
        <div style="margin-top: 15px; text-align: center;">
            <button style="padding: 10px; margin: 0 5px; " onclick="navigateMedicines(-1)">Previous</button>
            <span>Page <?php echo $page; ?> of <?php echo ceil($result->num_rows / $rows_per_page); ?></span>
            <button style="padding: 10px; margin: 0 5px;" onclick="navigateMedicines(1)">Next</button>
        </div>
    </div>
</section><br><br>

<!-- Products Table -->
<section >
    <div style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.9);">
        <h2 style="text-align: center;">PRODUCTS</h2>
        <!-- Search Input for Products -->
        <div style="margin-bottom: 15px;">
            <input type="text" id="search-products" placeholder="Search for products..." style="padding: 8px; width: calc(100% - 20px);">
        </div>

        <table id="products-table" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Products Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Registered Date</th>
                    <th>Selling Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch products data with limit and offset
                $sql = "SELECT * FROM pharmacy_products LIMIT $offset, $rows_per_page";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Display image (assuming the 'image' field stores the file path)
                        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='width: 100px; height: 100px;'></td>";
                        echo "<td>" . $row["product"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>" . $row["brand"] . "</td>";
                        echo "<td>" . $row["date_registered"] . "</td>";
                        echo "<td>₱ " . $row["selling_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No records found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Pagination Controls for Products -->
        <div style="margin-top: 15px; text-align: center;">
            <button style="padding: 10px; margin: 0 5px;" onclick="navigateProducts(-1)">Previous</button>
            <span>Page <?php echo $page; ?> of <?php echo ceil($result->num_rows / $rows_per_page); ?></span>
            <button style="padding: 10px; margin: 0 5px;" onclick="navigateProducts(1)">Next</button>
        </div>
    </div>
</section>

<script>
    // Add search functionality for Medicines
    document.getElementById('search-medicines').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#medicines-table tbody tr');

        rows.forEach(row => {
            const medicineName = row.cells[1].textContent.toLowerCase();
            if (medicineName.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Add search functionality for Products
    document.getElementById('search-products').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#products-table tbody tr');

        rows.forEach(row => {
            const productName = row.cells[1].textContent.toLowerCase();
            if (productName.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Pagination navigation for Medicines
    function navigateMedicines(direction) {
        const currentPage = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
        const newPage = currentPage + direction;
        window.location.search = `?page=${newPage}`;
    }

    // Pagination navigation for Products
    function navigateProducts(direction) {
        const currentPage = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
        const newPage = currentPage + direction;
        window.location.search = `?page=${newPage}`;
    }
</script>


<script>
//calendar and time
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
<script>
    let lowStockItems = []; // Store low stock items

    function checkLowStock() {
        const lowStockThreshold = 20; // Set the threshold for low stock
        lowStockItems = []; // Reset the low stock items

        // Get all quantity cells from the table
        const quantityCells = document.querySelectorAll('td[data-quantity]');

        // Loop through each cell to check the quantity
        quantityCells.forEach(cell => {
            const quantity = parseFloat(cell.textContent);
            if (quantity < lowStockThreshold) {
                lowStockItems.push({
                    name: cell.closest('tr').querySelector('td').textContent,
                    quantity: quantity
                });
                cell.style.backgroundColor = 'red'; // Highlight low stock cells
            }
        });

        // Update notification count
        const notifBadge = document.getElementById('notif-badge');
        notifBadge.textContent = lowStockItems.length;
    }

    function openNotifModal(event) {
        event.preventDefault();
        const notifModal = document.getElementById('notif-modal');
        const notifContent = document.getElementById('notif-content');

        if (lowStockItems.length > 0) {
            notifContent.innerHTML = lowStockItems.map(item => `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                </tr>
            `).join('');
        } else {
            notifContent.innerHTML = '<tr><td colspan="2">No low stock items</td></tr>';
        }

        notifModal.style.display = 'block';
    }

    function closeNotifModal() {
        document.getElementById('notif-modal').style.display = 'none';
    }

    // Call the function on page load
    document.addEventListener('DOMContentLoaded', () => {
        checkLowStock();
    });

    // Optional: Call the function periodically if your data updates dynamically
    // setInterval(checkLowStock, 60000); // Check every 60 seconds
</script>

</body>
</html>
