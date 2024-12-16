<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="outpatient.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   
</head>

<style>
    body {
        background-color: #f4f6f6;
    }
        .form-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
        padding: 30px;
        max-width: 100%;
        margin: auto;
        margin-top: 20px;
    }
    .form-container h2 {
        font-size: 1.8em;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
        border-bottom: 2px solid #b2babb;
        padding-bottom: 10px;
    }
    .form-label {
        font-weight: bold;
        color: #34495e;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #b2babb;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        border-color: #2980b9;
        box-shadow: 0px 0px 5px rgba(41, 128, 185, 0.3);
    }
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    .form-row .col-md-4,
    .form-row .col-md-3,
    .form-row .col-md-12 {
        flex: 1;
    }
    .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
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
        <a class="nav-link" href="PatientDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <a class="nav-link" href="OutpatientAdd.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇t</span>
            </div>
        </a>
        <a class="nav-link" href="OutpatientList.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Appointments.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>Appointments</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖣𝗈𝖼𝗍𝗈𝗋'𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖣𝗈𝖼𝗍𝗈𝗋'𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>
</div>


  <!-- Main Content -->
<div id="mainContent" class="main-content" style="margin-top: -80px;">
    <h3 style="text-align: center;">𝖣𝗈𝖼𝗍𝗈𝗋/'𝗌 𝗐𝗁𝗈 𝖺𝗋𝖾 𝗂𝗇 𝗍𝗂𝗍𝗅𝖾𝖽 𝖺𝗌 𝖱𝖺𝖽𝗂𝗈𝗅𝗈𝗀𝗒</h3>
    <div style="flex-shrink: 0;">
    <button onclick="openModal()" style="background-color: transparent; border: 1px solid #e74c3c; color: #e74c3c; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 43%;">
        Set Appointment
    </button>
</div>
<?php
require_once('../connection/dbconfig.php'); 


// Fetch doctors in the "Cardiology" specialty
$query = "SELECT doctor_id, name, email, clinic_address, contact_number, image, license, specialties FROM doctors WHERE specialties LIKE '%Pediatricians%'";
$result = mysqli_query($conn, $query);

// Fetch specialties from the database for dynamic display
$doctor_specialties = [];
while ($doctor = mysqli_fetch_assoc($result)) {
    $doctor_specialties[] = $doctor;
}

// Close database connection after fetching data
?>

<?php foreach ($doctor_specialties as $doctor): ?>
    <div class="form-container" style="display: flex; align-items: center; margin-bottom: 20px; width: 800px;">
       <!-- Doctor Image -->
        <div style="width: 120px; height: 120px; margin-right: 20px;">
            <?php if (!empty($doctor['image'])): ?>
                <img src="<?= htmlspecialchars($doctor['image']) ?>" alt="Dr. <?= htmlspecialchars($doctor['name']) ?>" style="width: 150%; height: 200%; object-fit: cover; border-radius: 10px; margin-top: -50px;">
            <?php else: ?>
                <div style="width: 100%; height: 100%; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                    <span>No Image</span>
                </div>
            <?php endif; ?>
        </div>        
        <!-- Doctor Information -->
        <div style="flex-grow: 1; margin-left: 60px;">
            <h2 style="font-size: 20px; color: #333;">Name: <strong>Dr. <?= htmlspecialchars($doctor['name']) ?></strong></h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($doctor['email']) ?></p>
            <p><strong>License:</strong> <?= htmlspecialchars($doctor['license']) ?></p>
            <p><strong>Clinic Address:</strong> <?= htmlspecialchars($doctor['clinic_address']) ?></p>
            <p><strong>Contact #:</strong> <?= htmlspecialchars($doctor['contact_number']) ?></p>
            <p><span style="color: #e74c3c;">&#128197;</span> <a href="#" id="scheduleLink" style="color: #e74c3c; text-decoration: none;">Schedule</a></p>

<!-- Modal Structure -->
<div id="scheduleModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content" style="background-color: white; max-width: 800px; margin: 10% auto; padding: 20px; border-radius: 10px;">
        <span class="close" id="closeModal" style="font-size: 24px; cursor: pointer; float: right;">&times;</span>

        <h3>Schedule Availability</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Availability</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="scheduleTableBody">
                <?php
               require_once('../connection/dbconfig.php'); 


                // Fetch scheduling data from the Calendar Availability table
                $query = "SELECT * FROM `calendar_availability`";  // Replace with your actual table name
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Loop through and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['date']}</td>
                                <td>{$row['availability']}</td>
                                <td>𝖥𝗂𝗋𝗌𝗍 𝖢𝗈𝗆𝖾 𝖥𝗂𝗋𝗌𝗍 𝖲𝖾𝗋𝗏𝖾</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
                   ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript to Open and Close the Modal -->
<script>
    document.getElementById('scheduleLink').onclick = function(event) {
        event.preventDefault();
        document.getElementById('scheduleModal').style.display = "block";
    }

    document.getElementById('closeModal').onclick = function() {
        document.getElementById('scheduleModal').style.display = "none";
    }

    // Click outside the modal to close it
    window.onclick = function(event) {
        if (event.target == document.getElementById('scheduleModal')) {
            document.getElementById('scheduleModal').style.display = "none";
        }
    }
</script>

            
            <!-- Specialties -->
            <div style="margin-top: 20px;">
                <h3 style="margin-bottom: 10px;">Specialties:</h3>
                <div style="display: flex; gap: 10px;">
                    <?php 
                    $specialties = explode(',', $doctor['specialties']); 
                    foreach ($specialties as $specialty) {
                        echo '<span style="background-color: #f0f0f0; padding: 5px 10px; border-radius: 5px;">' . htmlspecialchars(trim($specialty)) . '</span>';
                    }
                    ?>
                </div>
                <div style="margin-top: 20px; border-top: 2px solid #e74c3c;"></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Appointment Modal -->
<div id="appointmentModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 600px; padding: 20px; border-radius: 10px; background-color: white;">
        <span class="close" onclick="closeModal()" style="float: right; font-size: 24px; cursor: pointer; text-align: right;">&times;</span>

        <!-- Patient Information Section -->
        <h3 style="background-color: #1abc9c; color: white; text-align: center; padding: 10px;">𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖨𝗇𝖿𝗈𝗋𝗆𝖺𝗍𝗂𝗈𝗇</h3><br>
        <form method="POST" action="AppointmentsSave.php">
            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                <input type="text" name="first_name" placeholder="First Name *" required style="flex: 1;">
                <input type="text" name="middle_initial" placeholder="Middle Initial" style="width: 100px;">
                <input type="text" name="last_name" placeholder="Last Name *" required style="flex: 1;">
            </div>
           <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                <span style="flex: 1; padding: 8px; border: 1px solid #ccc; text-align: center;" id="fixedDate"></span>
                <span style="flex: 1; padding: 8px; border: 1px solid #ccc; text-align: center;" id="fixedTime"></span>
            </div>

            <!-- Hidden Inputs to Store Fixed Date and Time -->
            <input type="hidden" name="fixed_date" id="hiddenFixedDate">
            <input type="hidden" name="fixed_time" id="hiddenFixedTime">

            <!-- JavaScript to set current date and time -->
            <script>
                // Function to display current date and time and set hidden inputs
                function setFixedDateTime() {
                    let today = new Date();
                    let currentDate = today.toISOString().split('T')[0]; // Gets the current date in YYYY-MM-DD format
                    let currentTime = today.toTimeString().split(' ')[0].slice(0, 5); // Gets current time in HH:MM format

                    // Display the fixed date and time
                    document.getElementById('fixedDate').textContent = currentDate;
                    document.getElementById('fixedTime').textContent = currentTime;

                    // Set the hidden inputs with the current date and time
                    document.getElementById('hiddenFixedDate').value = currentDate;
                    document.getElementById('hiddenFixedTime').value = currentTime;
                }

                // Call the function to set the date and time when the page loads
                window.onload = setFixedDateTime;
            </script>

            <p>Is this your first visit to our offices? *</p>
            <label><input type="radio" name="first_visit" value="yes" required> Yes</label>
            <label><input type="radio" name="first_visit" value="no" required> No</label>

            <!-- Appointment Information Section -->
            <h3 style="background-color: #1abc9c; color: white; text-align: center; padding: 10px; margin-top: 20px;">𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍 𝖨𝗇𝖿𝗈𝗋𝗆𝖺𝗍𝗂𝗈𝗇</h3>
            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                <input type="date" name="appointment_date" placeholder="Date *" required style="flex: 1;">
            </div>

            <textarea name="reason_for_visit" placeholder="Please describe the reason for this visit *" required style="width: 100%; height: 100px; margin-top: 10px;"></textarea>  

            <!-- Doctor Selection (Assuming dynamic fetching of doctor data) -->
            <label for="doctor_id">Choose Doctor:</label>
            <select name="doctor_id" required>
                <?php
                // Fetch doctor names dynamically from the database
                foreach ($doctor_specialties as $doctor) {
                    echo "<option value='{$doctor['doctor_id']}'>Dr. {$doctor['name']}</option>";
                }
                ?>
            </select>

            <!-- Submit Button -->
            <button type="submit" style="background-color: #1abc9c; color: white; padding: 10px 20px; margin-top: 10px; border: none; border-radius: 5px;">𝖲𝗎𝖻𝗆𝗂𝗍 𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍</button>
        </form>
    </div>
</div>


                    </div>
                </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    <!--new -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
  // Show modal
  function openModal() {
    document.getElementById("appointmentModal").style.display = "flex";
  }

  // Close modal
  function closeModal() {
    document.getElementById("appointmentModal").style.display = "none";
  }

  // Event listener for the Set Appointment button
  document.querySelector("button").addEventListener("click", function(event) {
    event.preventDefault();
    openModal();
  });
</script>
</body>
</html>
