<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Geräte erstellen</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Gerät erstellen</h2>
    <form id="createDevicesForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
            <!-- Device blocks will be inserted here -->
        </div>

        <!-- QR Code and Barcode Fields (global) -->
        <div class="mt-4">
            <!-- QR Code -->
            <div class="flex items-center justify-between">
                <label class="block text-sm font-medium text-gray-700">QR Code</label>
                <input type="text" id="qrCodeField" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateQRCode()">Neuer QR Code erstellen</button>
            </div>

            <!-- Barcode -->
            <div class="flex items-center justify-between mt-4">
                <label class="block text-sm font-medium text-gray-700">Barcode</label>
                <input type="text" id="barcodeField" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateBarcode()">Neuer Barcode erstellen</button>
            </div>
        </div>

        <!-- Add More Devices Button -->
        <div class="mt-4">
            <button type="button" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700" onclick="addDeviceBlock()">Mehr Geräte Hinzufügen</button>
        </div>

        <!-- Save and Buttons -->
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Erstellen</button>

            <a href="../Devices/devices.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">
                    Zurück
                </button>
            </a>
        </div>
    </form>
</div>

<!-- Modal for Confirmation -->
<div id="deleteConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <h2 class="text-lg font-semibold mb-4">Bestätigung</h2>
        <p class="mb-4">Bist du sicher, dass du dieses Gerät entfernen möchtest?</p>
        <div class="flex justify-end space-x-2">
            <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" id="confirmDelete">Ja, entfernen</button>
            <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" onclick="closeModal()">Abbrechen</button>
        </div>
    </div>
</div>

<script>
    let currentDeviceBlock = null;

    document.addEventListener("DOMContentLoaded", function() {
        // Add the initial 12 device blocks on page load
        for (let i = 1; i <= 12; i++) {
            addDeviceBlock(i);
        }
    });

    function addDeviceBlock(index = null) {
        const deviceContainer = document.getElementById('device-container');
        const deviceNumber = index || deviceContainer.children.length + 1;

        const deviceBlock = document.createElement('div');
        deviceBlock.classList.add('space-y-4', 'p-4', 'border', 'border-gray-300', 'rounded-md', 'bg-gray-50', 'shadow-sm');
        deviceBlock.innerHTML = `
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Gerät ${deviceNumber}</h3>
                <button type="button" class="text-gray-500 hover:text-red-500" onclick="confirmDelete(this)">&#10006;</button>
            </div>

            <!-- Device Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
                <input type="text" name="device_name[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- Serial Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                <input type="text" name="serial_number[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- OS -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
                <input type="text" name="os[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- Werft or Private Device -->
            <div class="flex items-center justify-between space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Werft Gerät?</label>
                    <input type="checkbox" name="is_werft_device[]" class="mt-1" onclick="toggleDeviceType(this)">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Privat Gerät?</label>
                    <input type="checkbox" name="is_private_device[]" class="mt-1" onclick="toggleDeviceType(this)">
                </div>
            </div>
        `;
        deviceContainer.appendChild(deviceBlock);
    }

    function toggleDeviceType(checkbox) {
        const parent = checkbox.closest('.flex');
        const [werftDevice, privateDevice] = parent.querySelectorAll('input[type="checkbox"]');

        if (checkbox === werftDevice && werftDevice.checked) {
            privateDevice.disabled = true;
        } else if (checkbox === privateDevice && privateDevice.checked) {
            werftDevice.disabled = true;
        } else {
            werftDevice.disabled = false;
            privateDevice.disabled = false;
        }
    }

    function confirmDelete(button) {
        currentDeviceBlock = button.closest('div').parentElement; // Get the device block
        document.getElementById('deleteConfirmationModal').classList.remove('hidden'); // Show modal
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (currentDeviceBlock) {
            currentDeviceBlock.remove(); // Remove the device block
            closeModal();
        }
    });

    function closeModal() {
        document.getElementById('deleteConfirmationModal').classList.add('hidden'); // Hide modal
        currentDeviceBlock = null; // Reset current device block
    }

    function generateQRCode() {
        document.getElementById('qrCodeField').value = "Generated QR Code"; // Simulated generation
        alert("QR Code generated!");
    }

    function generateBarcode() {
        document.getElementById('barcodeField').value = "Generated Barcode"; // Simulated generation
        alert("Barcode generated!");
    }
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
