<?php
session_start();

// Check if the 'admin' session variable is not set or is false (user not logged in)
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true || !isset($_SESSION['adminID'])) {
    // Redirect the user to the login page
    header("Location: Admin Login.php");
    exit(); // Terminate the script
}

// Include your database connection file
require_once 'pawfect_connect.php';

// Get the AdminID from the sessionw
$adminID = $_SESSION['adminID'];

// Prepare and execute the SQL query to fetch admin information
$sql = "SELECT * FROM admininformation WHERE AdminID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $adminID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there is a row returned
if ($row = mysqli_fetch_assoc($result)) {
    // Admin information retrieved successfully
    $firstName = $row['firstname'];
 
    $lastName = $row['lastname'];
    $adminPhoto = $row['adminphoto'];

    // Now you can use these variables to display the admin information in your HTML
} else {
    // Admin information not found
    echo "Admin information not found!";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"  rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="hamburgers.css" rel="stylesheet">
  <link href="userdashboard.css" rel="stylesheet">
  <title>Tenant Dashboard</title>
  <style>
    /* Hide sorting icons for the first column */
    .sorting_asc {
     background-image: none !important;
    }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="main-container">
        <!-- Header and Sidebar -->
        <?php include 'admin_header.php'; ?>
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>


<!--Profile Picture and Details-->
        <div class="content" id="content">
        <div class="row  mr-5 ml-3 ">
        <div class="col-md-12">
                    <div class="card mx-auto  table-card">
                        <div class="table-header-1">
                        <h3 class="card-title text-center main-font-color mt-3 ml-2"><b>LIST OF PATIENTS</b></h3>
</div>


                        <div id="buttonContainer" class="d-flex flex-column flex-md-row align-items-center mb-2 ml-2 mt-1">
    <!-- Edit button on the left -->
    <button id="toggleButtons" class="btn btn-edit btn-outline-info mr-2">Save Table</button>
    <button id="editButton" class="btn btn-gray-color btn-custom mb-2 mb-sm-0 mr-sm-2" style="color:white">Action</button>

    <!-- Additional buttons next to Edit -->
    <div class="d-flex flex-row flex-wrap align-items-center">
     
        <button id="viewButton" class="btn btn-custom btn-blue-color btn-outline-info mr-2" style="white-space: nowrap; color:white;">View </button>
        <button id="deleteButton" class="btn btn-custom btn-blue-color btn-outline-info mr-2" style="white-space: nowrap; color:white;"  onclick="deleteSelectedRows()">Archive</button>
        <button id="updateButton" class="btn btn-custom btn-blue-color btn-outline-info mr-2" style="white-space: nowrap; color:white;" onclick="redirectToEdit()">Edit</button>

    </div>


                    
                        <!-- Spacer to push custom search and Excel export buttons to the right -->
                            <div class="flex-grow-1"></div>
                            <button id="editButton" class="btn greener  mb-2 mb-sm-0 mr-sm-2 pt-2 pb-2">Existing Account</button> 
                            <button id="addPatient" class="btn greener  mb-2 mb-sm-0 mr-sm-2 pt-2 pb-2">Add Patient</button> 
                        <!-- Custom search on the right -->
                        
                    
                        <!-- Excel export button at the far right -->
                    
                    </div>
                   <!-- Custom search input -->
<div class="custom-search mx-4">

    <input type="text" id="customSearchInput" placeholder="Search..."  class="form-control search-input">
</div>



                    <form id="deleteForm" action="deletetenant.php" method="post">
    <input type="hidden" name="selectedRows[]" id="selectedRowsInput">

         
                <div class="card-body">
    <table class="table" id="example">
  <thead class="table-header">
    <tr>
      <th scope="col" class="pl-3"><input type="checkbox" id="selectAllCheckbox"> </th>
      <th scope="col">Patient ID</th>
      <th scope="col">Full Name</th>
      <th scope="col">Current Session</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Type of Exposure</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td scope="row" class="pl-3"><input type="checkbox" class="select-checkbox "></td>
    <td>0001</td>
    <td>Emily Johnson</td>
    <td>Day 14</td>
    <td>03/28/2024</td>
    <td>Category I</td>
</tr>
<tr>
    <td scope="row" class="pl-3"><input type="checkbox" class="select-checkbox"></td>
    <td>0002</td>
    <td>John Doe</td>
    <td>Day 7</td>
    <td>04/01/2024</td>
    <td>Category II</td>
</tr>
<tr>
    <td scope="row" class="pl-3"><input type="checkbox" class="select-checkbox"></td>
    <td>0003</td>
    <td>Jane Smith</td>
    <td>Day 21</td>
    <td>03/25/2024</td>
    <td>Category III</td>
</tr>
<tr>
    <td scope="row" class="pl-3"><input type="checkbox" class="select-checkbox"></td>
    <td>0004</td>
    <td>Michael Johnson</td>
    <td>Day 10</td>
    <td>03/30/2024</td>
    <td>Category II</td>
</tr>
<tr>
    <td scope="row" class="pl-3"><input type="checkbox" class="select-checkbox"></td>
    <td>0005</td>
    <td>Sarah Williams</td>
    <td>Day 5</td>
    <td>04/05/2024</td>
    <td>Category I</td>
</tr>

  
  </tbody>
</table>
                
</div>
                
            </div>
         
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
    </div>
</div>
       
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Data Table JS -->
    
    <!-- Data Table JS -->
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>

    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>


    <!-- ... (your existing script imports) ... -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById("profileDropdown").addEventListener("mousedown", function(event) {
    event.preventDefault(); // Prevent the default action of the mousedown event
    var dropdownContent = document.getElementById("dropdownContent");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
});
</script>



<script>
 // Get all sidebar items
const sidebarItems = document.querySelectorAll('.sidebar-item');

// Loop through each sidebar item
sidebarItems.forEach(function(sidebarItem) {
    // Find the icon within the sidebar item
    const sidebarIcon = sidebarItem.querySelector('.sidebar-icon');

    // Get the paths to the default and hover icons from data attributes
    const defaultIcon = sidebarItem.dataset.defaultIcon;
    const hoverIcon = sidebarItem.dataset.hoverIcon;

    // Add mouseenter event listener
    sidebarItem.addEventListener('mouseenter', function() {
        // Change the source of the icon to the hover icon upon hover
        sidebarIcon.src = hoverIcon;
    });

    // Add mouseleave event listener
    sidebarItem.addEventListener('mouseleave', function() {
        // Change the source of the icon back to the default icon upon mouse leave
        sidebarIcon.src = defaultIcon;
    });
});

$(document).ready(function () {
    $('#sidebarCollapse1').on('click', function () {
        $('#sidebar').toggleClass('collapsed'); // Toggle 'collapsed' class on #sidebar
        $('#content').toggleClass('collapsed'); // Toggle 'collapsed' class on #content
    });
});


</script>
<script>
    function redirectToEdit() {
        // Assuming PatientID is stored in a variable called patientID
        var patientID = "your_patient_id_here";
        // Redirect to Edit Patient.php with the PatientID parameter
        window.location.href = "Edit Patient.php?PatientID=" + patientID;
    }
</script>

<script>

$(document).ready(function () {
    $('#generateInvoiceButton').on('click', function () {
        var selectedRows = $('.select-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (selectedRows.length === 0) {
            alert('No rows selected to generate invoices.');
            return;
        }

        console.log('Sending AJAX request...');
        $.ajax({
            type: 'POST',
            url: 'generateinvoice.php',
            data: { selectedRows: selectedRows },
            dataType: 'json', // Specify that you expect JSON data
            success: function (response) {
                console.log(response);

                // Check the 'status' property in the JSON response
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Invoice generation failed: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (if any) with an alert
                if (xhr.status === 404) {
                    alert('Error: Resource not found (404).');
                } else if (xhr.status === 500) {
                    alert('Error: Internal server error (500).');
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            }
        });
    });




    $(".select-checkbox").change(function () {
    var selectedCheckboxValue = $(this).val();
    var dropdown1 = $("select[name='statusUpdate[" + selectedCheckboxValue + "]']");

    if ($(this).prop('checked')) {
        // Check if the option doesn't already exist and the current status is "Pending"
        if (dropdown1.find("option[value='Received']").length === 0 && dropdown1.val() === 'Pending') {
            // Add more options to the dropdown dynamically using JavaScript
            dropdown1.append('<option value="Received">Received</option>');
            
            // Add more options as needed
        }
    } else {
        // If checkbox is unchecked and the current status is "Pending," remove the added options
        if (dropdown1.val() === 'Pending') {
            dropdown1.find("option[value='Received']").remove();
            
            // Remove more options as needed
        }
    }

    var checkboxId = $(this).val();
    var dropdown = $("select[name='statusUpdate[" + checkboxId + "]']");
    dropdown.prop("disabled", !$(this).prop("checked"));
});

        
    // Function to toggle checkbox visibility
    function toggleCheckboxesVisibility() {
        var checkboxes = $('.select-checkbox');
        checkboxes.toggle();

        // If the checkboxes are being hidden, uncheck all of them
        if (!checkboxes.is(':visible')) {
            checkboxes.prop('checked', false);
        }
    }
    


    // Function to toggle buttons visibility based on the number of checkboxes checked
    function toggleButtonsVisibility() {
        var checkedCheckboxes = $('.select-checkbox:checked');
        if (checkedCheckboxes.length === 1) {
            $('#updateButton').show();
            $('#deleteButton').show();
            $('#viewButton').show();
            $('#generateInvoiceButton').show();
        } else if (checkedCheckboxes.length > 1) {
            $('#updateButton').hide();
            $('#viewButton').hide();
            $('#deleteButton').show();
            $('#generateInvoiceButton').show();
        } else {
            $('#updateButton, #deleteButton,#viewButton,#generateInvoiceButton').hide();
        }
    }

    // Initially hide the Delete and Update buttons
    $('#deleteButton, #updateButton, #selectAllCheckbox,#viewButton,#generateInvoiceButton').hide();

    // Handle "Edit" button click
    $('#editButton').on('click', function () {
        toggleCheckboxesVisibility();
        toggleButtonsVisibility(); 

    
        

        // Toggle the visibility and state of the "Select All" button
        $('#selectAllCheckbox').toggle();
        $('#selectAllCheckbox').data('checked', false);

        $('.status-dropdown').prop('disabled', true);

        // Hide "Select All" button if no checkboxes are visible
        if ($('.select-checkbox:visible').length === 0) {
            $('#selectAllCheckbox').hide();
        }
    });

    
    $(document).ready(function() {
      let editClickCount = 0;

      $('#editButton').on('click', function() {
        editClickCount++;

        if (editClickCount % 2 === 0) {
          // If editButton is clicked twice (even click count), uncheck the selectAllCheckbox
          $('#selectAllCheckbox').prop('checked', false);
        }
      });
    });
 
    $("#updateButton").on("click", function () {
        var updates = {};
        $(".select-checkbox:checked").each(function () {
            var applicantID = $(this).val();
            var newStatus = $("select[name='statusUpdate[" + applicantID + "]']").val();
            updates["statusUpdate[" + applicantID + "]"] = newStatus;
        });

        // Set the updates directly as form parameters
        $("#updateForm").find(":input[name^='statusUpdate']").remove();
        $.each(updates, function (name, value) {
            $("#updateForm").append('<input type="hidden" name="' + name + '" value="' + value + '">');
        });

        // Submit the form
        $("#updateForm").submit();
    });
    // Handle "Select All" button click
    $('#selectAllCheckbox').on('click', function () {
        var checkboxes = $('.select-checkbox');
        var allChecked = checkboxes.length === checkboxes.filter(':checked').length;

        // Toggle the state of all checkboxes
        checkboxes.prop('checked', !allChecked);
        checkboxes.each(function () {
            var applicantID = $(this).val();
            var dropdown = $("select[name='statusUpdate[" + applicantID + "]']");
            dropdown.prop("disabled", !$(this).prop("checked"));
        });


        // Update buttons visibility
        toggleButtonsVisibility();
    });

    // Handle individual checkboxes
    $('#example tbody').on('change', '.select-checkbox', function () {
        // Update buttons visibility
        toggleButtonsVisibility();
    });




        // Implement your update logic here
        $('#viewButton').on('click', function () {
    var selectedCheckbox = $('.select-checkbox:checked');

    // Check if exactly one checkbox is checked
    if (selectedCheckbox.length === 1) {
        var applicantID = selectedCheckbox.val();

        // Redirect to the view profile page with the selected Applicant ID
        window.location.href = 'patientdetails-profile.php?ApplicantID=' + applicantID;
    } else {
        // If no checkbox or more than one checkbox is checked, show an alert
        alert('Please select exactly one row to view.');
    }
});
$(document).ready(function () {
    // DataTable initialization
    var table = $('#example').DataTable({
        paging: true,
        responsive: true,
        searching: true,
        "pageLength": 5, // Set default page length
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]], // Customize page length menu
        "dom": "<'row'<'col-sm-12'f>>" + // Place search input at the top
               "<'row'<'col-sm-12't>>" + // Place table in a row
               "<'row'<'col-sm-12 ml-5 mt-3'l>><<'col-sm-12'p>>", // Place length menu and pagination in separate rows
       
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<img style="width:25px; height:25px;" src="copy_image.png" alt="Copy">',
                titleAttr: 'Copy',
                className: 'btn-img'
            },
            {
                extend: 'excelHtml5',
                text: '<img style="width:25px; height:25px;" src="excel_image.png" alt="Excel">',
                titleAttr: 'Excel',
                className: 'btn-img'
            },
            {
                extend: 'csvHtml5',
                text: '<img style="width:25px; height:25px;" src="csv_image.png" alt="CSV">',
                titleAttr: 'CSV',
                className: 'btn-img'
            },
            {
                extend: 'pdfHtml5',
                text: '<img style="width:25px; height:25px;" src="pdf_image.png" alt="PDF">',
                titleAttr: 'PDF',
                className: 'btn-img'
            }
        ],
        "columnDefs": [
            { "orderable": false, "targets": 0 } // Disable sorting for the first column (index 0)
        ],
        pageLength: 5,
        lengthMenu: [ [5, 25, 50, -1], [5, 25, 50, "All"] ],
        language: { "lengthMenu": "Display _MENU_ "
          
        }
       
    });
    function updatePageInfo() {
        var pageInfo = table.page.info();
        var currentPage = pageInfo.page + 1; // Add 1 to convert zero-based index to one-based index
        var totalPages = pageInfo.pages;
        var pageLengthContainer = $('.dataTables_length');

        // Update the page information with styles
        pageLengthContainer.find('.page-info').remove(); // Remove previous page info to avoid duplication
        pageLengthContainer.append('<span class="page-info" style="margin-left: 10px;">Page: <b>' + currentPage + '</b> of <b>' + totalPages + '</b></span>');
    }

    // Initial update of page information
    updatePageInfo();

    // Update page information whenever the table is redrawn
    table.on('draw', function() {
        updatePageInfo();
    });


    $('.btn-img').hide();

    // Toggle button visibility
    $('#toggleButtons').on('click', function () {
        $('.btn-img').toggle();
    });

    // Link custom search input with DataTable
    var customSearchInput = $('#customSearchInput');

    // Add an input event listener to trigger DataTables search on input
    customSearchInput.on('input', function () {
        table.search(this.value).draw();
    });

    // Button click event for exporting to Excel
    $('#button-excel').on('click', function () {
        // Trigger the DataTables Excel export
        table.buttons('excelHtml5').trigger();
    });

    // Toggle sidebar functionality
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });
});






});
</script>
<script>
    document.getElementById("addPatient").addEventListener("click", function() {
        // Redirect to Add Patient.php
        window.location.href = "Add Patient.php";
    });
</script>

</body>
</html>
