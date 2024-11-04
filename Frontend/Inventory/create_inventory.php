<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Create Inventory</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Inventar Artikel erfassen</h2>
    <form id="inventoryForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Barcode -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="flex items-center justify-between">
                    <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateBarcode()">Neuer Barcode generieren</button>
                </div>
            </div>

            <!-- Details -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Details</label>
                    <textarea name="details" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>

            <!-- Name -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- QR Code -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">QR Code</label>
                    <input type="text" name="qr_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="flex items-center justify-between">
                    <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateQRCode()">Neuer QR Code generieren</button>
                </div>
            </div>

            <!-- Transport Unit -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Transport Einheit</label>
                    <input type="text" name="transport_unit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Location -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ort</label>
                    <input type="text" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Erstellen</button>
            
            <a href="../Inventory/inventory.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
            </a>
        </div>
    </form>
</div>

<script>
    function generateQRCode() {
        alert("Generate QR Code button clicked!");
        // Add functionality to generate QR Code
    }

    function generateBarcode() {
        alert("Generate Barcode button clicked!");
        // Add functionality to generate Barcode
    }
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
