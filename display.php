<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <div class="table-responsive">

    <form action="pdf.php" method="post" target="_blank">
            <input type="submit" class="btn btn-primary mt-3 mb-3 float-end" value="Download"/>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-secondary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Run Date</th>
                <th scope="col">Database Name</th>
                <th scope="col">Table Name</th>
                <th scope="col">Number of Records</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Include your database connection file
            require_once "dbconfig.php";

            // Fetch data from database
            $sql = "SELECT id, rundate, dbname, tablename, noof_rec FROM db_tables";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any records
            if ($result) {
                // Display each record as a table row
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['rundate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dbname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tablename']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['noof_rec']) . "</td>";
                    echo "</tr>";
                }
            } else {
                // Display a message if no records are found
                echo '<tr><td colspan="5" class="text-center">No records found.</td></tr>';
            }

            // Close statement and database connection
            $stmt = null; 
            $conn = null; 
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
