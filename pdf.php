<?php

require __DIR__ . "/vendor/autoload.php"; // Adjust the path as per your setup

use Dompdf\Dompdf;

// Function to generate HTML content
function generateHTMLTable() {
    ob_start(); // Start output buffering

    // Include your database connection file
    require_once "dbconfig.php";

    // Fetch data from database
    $sql = "SELECT id, rundate, dbname, tablename, noof_rec FROM db_tables";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any records
    if ($result) {
        echo '<table style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;">';
        echo '<thead style="background-color: #f2f2f2; text-align: left;">';
        echo '<tr>';
        echo '<th style="border: 1px solid #dddddd; padding: 8px;">ID</th>';
        echo '<th style="border: 1px solid #dddddd; padding: 8px;">Run Date</th>';
        echo '<th style="border: 1px solid #dddddd; padding: 8px;">Database Name</th>';
        echo '<th style="border: 1px solid #dddddd; padding: 8px;">Table Name</th>';
        echo '<th style="border: 1px solid #dddddd; padding: 8px;">Number of Records</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Display each record as a table row
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>" . htmlspecialchars($row['rundate']) . "</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>" . htmlspecialchars($row['dbname']) . "</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>" . htmlspecialchars($row['tablename']) . "</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>" . htmlspecialchars($row['noof_rec']) . "</td>";
            echo "</tr>";
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        // Display a message if no records are found
        echo '<p>No records found.</p>';
    }

    // Close statement and database connection
    $stmt = null; 
    $conn = null; 

    $html = ob_get_clean(); 

    return $html;
}

// Generate HTML content
$html = '<html><head></head><body>';
$html .= '<h1 style="text-align: center;">Database</h1>';
$html .= generateHTMLTable();
$html .= '</body></html>';

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait'); // Set paper size and orientation
$dompdf->render();

// Output PDF to browser
$dompdf->stream("tables.pdf", ["Attachment"=> false]);
?>
