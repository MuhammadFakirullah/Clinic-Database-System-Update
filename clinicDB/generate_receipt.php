<?php
// generate_receipt.php
date_default_timezone_set('Asia/Kuala_Lumpur'); // Set the time zone at the beginning of the script

require 'dbcon.php'; // Include your database connection code

// Define the generatePDFReceipt function here or include it from an external file
function generatePDFReceipt($patientData) {
    require('fpdf/fpdf.php'); // Include FPDF library

    // Create a new PDF instance with custom page size and margins to fit thermal paper
    $pdf = new FPDF('P', 'mm', array(80, 150)); // Adjust the width and height as needed
    $pdf->SetAutoPageBreak(false); // Disable automatic page breaks
    
    // Set font size to make sure the content fits
    $pdf->SetFont('Arial', '', 8); // Adjust the font size as needed

    // Add content to the PDF
    $pdf->AddPage();

    // Add minimal spacing at the top
    $pdf->Cell(0, 1, '', 0, 1);

    // Set font to bold for the clinic name
    $pdf->SetFont('Arial', 'B', 10);

    // Add the clinic name with bold font
    $pdf->Cell(0, 1, 'Your Clinic Name', 0, 1, 'C');

    // Insert your clinic logo below the clinic name
    $pdf->Image('cliniclogo.png', 10, $pdf->GetY() + 4, 60); // Adjust the path and position as needed

    $pdf->Cell(0, 40, '', 0, 1);

    // Reset font to regular for the following lines
    $pdf->SetFont('Arial', '', 8);

    $pdf->Cell(0, 4, '', 0, 1);

    // Add the current date and time
    $pdf->Cell(0, 5, 'Date & time: ' . date('d-m-Y H:i:s'), 0, 1, 'C'); // Format the date and time as 'd-m-Y H:i:s'

    // Add static information at the top of the receipt
    $pdf->Cell(0, 5, 'Address: 123 Main Street', 0, 1, 'C'); // Replace with your clinic address
    $pdf->Cell(0, 5, 'Phone: (123) 456-7890', 0, 1, 'C'); // Replace with your clinic phone number
    $pdf->Cell(0, 5, 'Email: clinic@example.com', 0, 1, 'C'); // Replace with your clinic email

    // Add space below the content
    $pdf->Cell(0, 6, '', 0, 1);

    // Add content to the PDF
    $pdf->Cell(0, 5, 'Patient Name: ' . $patientData['name'], 0, 1, 'C');
    $pdf->Cell(0, 5, 'IC Number: ' . $patientData['icno'], 0, 1, 'C');
    $pdf->Cell(0, 5, 'Timestamp: ' . $patientData['timestamp'], 0, 1, 'C');
    // $pdf->Cell(0, 5, 'Medicine Prescription: ' . $patientData['medicinePrescription'], 0, 1, 'C');
    // Medicine Prescription handling
    $medicinePrescription = $patientData['medicinePrescription'];
    $lines = explode("\n", wordwrap($medicinePrescription, 23, "\n"));
    $pdf->Cell(0, 5, 'Medicine Prescription: ' . array_shift($lines), 0, 1, 'C');
    foreach ($lines as $line) {
        $pdf->Cell(0, 5, $line, 0, 1, 'C');
    }

    $pdf->Cell(0, 5, 'Total Price (RM): ' . number_format($patientData['total_price'], 2), 0, 1, 'C');
    $pdf->Cell(0, 5, 'Payment Status: ' . $patientData['payment_status'], 0, 1, 'C');

    $pdf->Cell(0, 8, '', 0, 1);

    $pdf->Cell(0, 5, 'Thank you for coming. Get well soon', 0, 1, 'C');

    $pdf->Cell(0, 6, '', 0, 1);

    $pdf->Cell(0, 5, 'This receipt is computer generated.', 0, 1, 'C');
    $pdf->Cell(0, 5, 'No signature is required.', 0, 1, 'C');

    // Output PDF as a download or save it to a file
    // $pdf->Output('patient_receipt.pdf', 'D');  D is for download

    // Output PDF as a view file only
    $pdf->Output('patient_receipt.pdf', 'I');

}

$patientId = $_GET['id'];

// Retrieve patient data from the database based on $patientId
// Example code to fetch patient data from the database:
$query = "SELECT * FROM patient WHERE id = $patientId";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $patientData = mysqli_fetch_assoc($result);

    // Call the generatePDFReceipt function with the patient's data
    generatePDFReceipt($patientData);
} else {
    // Handle the case where the patient data is not found
    echo 'Patient not found.';
}
?>
