<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Phone Details</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';

// Fetch phone details from the database using the provided ID (assumed to be passed via GET request)
$phoneId = $_GET['id'];
// Here you would include your database connection and query logic to get the phone details
// For demonstration purposes, let's assume the details are retrieved and stored in an associative array
$phoneDetails = [
    'tel_mobile_1' => '123-456-7890',
    'tel_mobile_2' => '123-456-7891',
    'tel_mobile_3' => '123-456-7892',
    'tel_mobile_4' => '123-456-7893',
    'tel_mobile_5' => '123-456-7894',
    'tel_mobile_6' => '123-456-7895',
    'tel_mobile_7' => '123-456-7896',
    'tel_mobile_8' => '123-456-7897',
    'tel_mobile_9' => '123-456-7898',
    'tel_mobile_10' => '123-456-7899',
    'tel_work_1' => '123-456-7890',
    'tel_work_2' => '123-456-7891',
    'tel_work_3' => '123-456-7892',
    'tel_work_4' => '123-456-7893',
    'tel_work_5' => '123-456-7894',
    'tel_work_6' => '123-456-7895',
    'tel_work_7' => '123-456-7896',
    'tel_work_8' => '123-456-7897',
    'tel_work_9' => '123-456-7898',
    'tel_work_10' => '123-456-7899',
    'qr_code' => 'QRCodeSample',
    'barcode' => 'BarcodeSample'
];
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Telefon Nummer Details</h2>
    <form id="phoneDetailsForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tel. Mobile 1 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 1</label>
                    <input type="text" name="tel_mobile_1" value="<?php echo $phoneDetails['tel_mobile_1']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Tel. Mobile 2 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 2</label>
                    <input type="text" name="tel_mobile_2" value="<?php echo $phoneDetails['tel_mobile_2']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 3 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 3</label>
                    <input type="text" name="tel_mobile_3" value="<?php echo $phoneDetails['tel_mobile_3']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 4 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 4</label>
                    <input type="text" name="tel_mobile_4" value="<?php echo $phoneDetails['tel_mobile_4']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 5 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 5</label>
                    <input type="text" name="tel_mobile_5" value="<?php echo $phoneDetails['tel_mobile_5']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 6 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 6</label>
                    <input type="text" name="tel_mobile_6" value="<?php echo $phoneDetails['tel_mobile_6']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 7 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 7</label>
                    <input type="text" name="tel_mobile_7" value="<?php echo $phoneDetails['tel_mobile_7']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 8 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 8</label>
                    <input type="text" name="tel_mobile_8" value="<?php echo $phoneDetails['tel_mobile_8']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 9 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 9</label>
                    <input type="text" name="tel_mobile_9" value="<?php echo $phoneDetails['tel_mobile_9']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Mobile 10 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Mobile 10</label>
                    <input type="text" name="tel_mobile_10" value="<?php echo $phoneDetails['tel_mobile_10']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>


              <!-- Tel. Work 1 -->
              <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 1</label>
                    <input type="text" name="tel_work_1" value="<?php echo $phoneDetails['tel_work_1']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 2 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 2</label>
                    <input type="text" name="tel_work_2" value="<?php echo $phoneDetails['tel_work_2']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 3 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 3</label>
                    <input type="text" name="tel_work_3" value="<?php echo $phoneDetails['tel_work_3']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 4 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 4</label>
                    <input type="text" name="tel_work_4" value="<?php echo $phoneDetails['tel_work_4']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 5 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 5</label>
                    <input type="text" name="tel_work_5" value="<?php echo $phoneDetails['tel_work_5']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 6 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 6</label>
                    <input type="text" name="tel_work_6" value="<?php echo $phoneDetails['tel_work_6']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 7 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 7</label>
                    <input type="text" name="tel_work_7" value="<?php echo $phoneDetails['tel_work_7']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 8 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 8</label>
                    <input type="text" name="tel_work_8" value="<?php echo $phoneDetails['tel_work_8']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 9 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 9</label>
                    <input type="text" name="tel_work_9" value="<?php echo $phoneDetails['tel_work_9']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Tel. Work 10 -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tel. Arbeit 10</label>
                    <input type="text" name="tel_work_10" value="<?php echo $phoneDetails['tel_work_10']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        

            <!-- QR Code -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">QR Code</label>
                    <input type="text" name="qr_code" value="<?php echo $phoneDetails['qr_code']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Barcode -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" value="<?php echo $phoneDetails['barcode']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
            <a href="../Phones/phones.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
            </a>
        </div>

    </div>


    </form>
</div>

<script>
    function generateQRCode() {
        // Logic to generate QR code
        alert('Generating QR Code...');
    }

    function generateBarcode() {
        // Logic to generate barcode
        alert('Generating Barcode...');
    }

    // Handle form submission
    document.getElementById('phoneDetailsForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Add your AJAX or form submission logic here
        alert('Form submitted!');
    });
</script>


<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
