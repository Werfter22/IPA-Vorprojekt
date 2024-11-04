<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit User</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';

// Fetch user details from the database using the provided ID (assumed to be passed via GET request)
$userId = $_GET['id'];
// Here you would include your database connection and query logic to get the user details
// For demonstration purposes, let's assume the details are retrieved and stored in an associative array
$userDetails = [
    'lastname' => 'Doe',
    'firstname' => 'John',
    'email_1' => 'john.doe@example.com',
    'email_2' => 'johndoe@gmail.com',
    'email_3' => 'john@example.com',
    'qr_code' => 'QRCodeSample',
    'barcode' => 'BarcodeSample'
];
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Benutzer Bearbeiten</h2>
    <form id="editUserForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Lastname -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nachname</label>
                    <input type="text" name="lastname" value="<?php echo $userDetails['lastname']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Firstname -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Vorname</label>
                    <input type="text" name="firstname" value="<?php echo $userDetails['firstname']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Email 1 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email 1</label>
                    <input type="email" name="email_1" value="<?php echo $userDetails['email_1']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Email 2 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email 2</label>
                    <input type="email" name="email_2" value="<?php echo $userDetails['email_2']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Email 3 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email 3</label>
                    <input type="email" name="email_3" value="<?php echo $userDetails['email_3']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- QR Code -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">QR Code</label>
                    <input type="text" name="qr_code" value="<?php echo $userDetails['qr_code']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600" onclick="generateQRCode()">Neuer QR Code generieren</button>
            </div>

            <!-- Barcode -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" value="<?php echo $userDetails['barcode']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600" onclick="generateBarcode()">Neuer Barcode generieren</button>
            </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Änderungen Speichern</button>
            <a href="../Users/users.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
            </a>
        </div>
    </form>
</div>

<?php
// Include the footer
include '../Footer/footer.php';
?>

<script>
    function generateQRCode() {
        // Add your logic here to generate a new QR code
        alert("Generating a new QR code...");
        // Update the input field with the new QR code value
        document.getElementsByName("qr_code")[0].value = "NewQRCodeSample"; // Example
    }

    function generateBarcode() {
        // Add your logic here to generate a new barcode
        alert("Generating a new barcode...");
        // Update the input field with the new barcode value
        document.getElementsByName("barcode")[0].value = "NewBarcodeSample"; // Example
    }
</script>

</body>
</html>
