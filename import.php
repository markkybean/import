<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once "lx.pdodb.php";
require_once "dbconfig.php";

// Check if POST request method is used
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("POST request method required");
}

// Check if a file was uploaded
if (empty($_FILES['txtfile']) || $_FILES['txtfile']['error'] != UPLOAD_ERR_OK) {
    exit("No file uploaded or there was an error during upload.");
}

// Validate uploaded file type (only allow .txt files)
$uploadedFileName = $_FILES['txtfile']['name'];
$fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
if ($fileExtension !== 'txt') {
    exit("Invalid file type. Only .txt files are allowed.");
}

// Directory for uploaded files
$target_path_dir = "import/";

// Create directory if it doesn't exist
if (!file_exists($target_path_dir)) {
    mkdir($target_path_dir, 0777, true);
}

// Move uploaded file to the import directory
$target_path = $target_path_dir . basename($uploadedFileName);
if (!move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_path)) {
    exit("Uploading failed!");
}

// Load text from the uploaded .txt file
$xdata = load_text($target_path);
if ($xdata === false) {
    exit("Failed to read the uploaded file.");
}

// Explode into an array of lines
$lines = explode("\r\n", $xdata);

// Initialize array to hold parsed data
$xarr_file = [];

// Parse each line into an array of values (assuming CSV format)
foreach ($lines as $line) {
    if (!empty(trim($line))) {
        $xarr_file[] = str_getcsv($line); // Using str_getcsv to parse CSV lines
    }
}

$xdata_ctr = 0;  
$xarr_count = count($xarr_file);

// Database connection using PDO
try {
    $link_id = new PDO($db2_cnstr, $db2_uname, $db2_pw, $db2_opt);
    $link_id->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
    exit();
}

// Loop through data and insert into db_tables table
try {
    while ($xdata_ctr < $xarr_count) {
        if (count($xarr_file[$xdata_ctr]) < 4) {
            // Skip lines with insufficient columns
            $xdata_ctr++;
            continue;
        }
        
        $xarr_params_dbtables = [
            'rundate' => $xarr_file[$xdata_ctr][0] ?? null,
            'dbname' => $xarr_file[$xdata_ctr][1] ?? null,
            'tablename' => $xarr_file[$xdata_ctr][2] ?? null,
            'noof_rec' => $xarr_file[$xdata_ctr][3] ?? null
        ];

        // Check for null values in required fields
        if ($xarr_params_dbtables['rundate'] === null || 
            $xarr_params_dbtables['dbname'] === null || 
            $xarr_params_dbtables['tablename'] === null || 
            $xarr_params_dbtables['noof_rec'] === null) {
            // Skip rows with null required values
            $xdata_ctr++;
            continue;
        }

        // Insert into db_tables table using explicit SQL statement
        $stmt = $link_id->prepare("INSERT INTO `db_tables` (`rundate`, `dbname`, `tablename`, `noof_rec`) VALUES (:rundate, :dbname, :tablename, :noof_rec)");
        $stmt->execute([
            ':rundate' => $xarr_params_dbtables['rundate'],
            ':dbname' => $xarr_params_dbtables['dbname'],
            ':tablename' => $xarr_params_dbtables['tablename'],
            ':noof_rec' => $xarr_params_dbtables['noof_rec']
        ]);

        $xdata_ctr++;
    }

    // Insert into runfile table
    $xarr_params_runfile = [
        'rundate' => $xarr_file[0][0] ?? null, // Assuming this is the run date from the first line
        'remarks' => 'Import'
    ];

    if ($xarr_params_runfile['rundate'] !== null) {
        $stmt = $link_id->prepare("INSERT INTO `runfile` (`rundate`, `remarks`) VALUES (:rundate, :remarks)");
        $stmt->execute([
            ':rundate' => $xarr_params_runfile['rundate'],
            ':remarks' => $xarr_params_runfile['remarks']
        ]);
    }

    // Success message
    echo "Imported " . basename($uploadedFileName) . " to database successfully!";
    
    // Redirect back to index.php after successful import
    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    exit("Database Error: " . $e->getMessage());
}

// Function to load text from a file
function load_text($filepath) {
    return file_get_contents($filepath);
}
?>
