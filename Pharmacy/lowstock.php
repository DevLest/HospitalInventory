
<!-- Bootstrap Modal for Low Stock and Expiring Medicines -->
<div class="modal fade" id="lowStockModal" tabindex="-1" role="dialog" aria-labelledby="lowStockModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lowStockModalLabel">Low Stock and Expiring Medicines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Low Stock Medicines Table -->
        <h6>Low Stock Medicines</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Remaining Quantity</th>
              <th>Expiry Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($lowStockMedicinesResult->num_rows > 0) {
                while ($row = $lowStockMedicinesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['medicine_product']}</td>";
                    echo "<td>{$row['remain_quantity']}</td>";
                    echo "<td>{$row['expiry']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No low stock medicines found.</td></tr>";
            }
            ?>
          </tbody>
        </table>

        <!-- Low Stock Products Table -->
        <h6>Low Stock Products</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Remaining Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($lowStockProductsResult->num_rows > 0) {
                while ($row = $lowStockProductsResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['product']}</td>";
                    echo "<td>{$row['remaining_quantity']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No low stock products found.</td></tr>";
            }
            ?>
          </tbody>
        </table>

        <!-- Expiring Medicines Table -->
        <h6>Expiring Medicines (This Year)</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($expiringMedicinesResult->num_rows > 0) {
                while ($row = $expiringMedicinesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['medicine_product']}</td>";
                    echo "<td>{$row['expiry']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No expiring medicines found for this year.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
