<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Geräte bearbeiten Liste</title>
    <style>
        /* Blur effect for the background */
        .blur {
            filter: blur(5px);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg" id="main-container">
    <h2 class="text-2xl font-semibold mb-6">Gerät Bearbeiten</h2>
    <form id="devicesForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
            <!-- Device blocks will be inserted here -->
        </div>

        <!-- QR Code and Barcode Fields -->
        <div class="mt-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">QR Code</label>
                <input type="text" id="qrCodeField" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateQRCode()">Neuen QR Code generieren</button>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Barcode</label>
                <input type="text" id="barcodeField" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" onclick="generateBarcode()">Neuen Barcode generieren</button>
            </div>
        </div>

        <!-- Save and Buttons -->
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Speichern</button>
            
            <a href="../Devices/devices.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">
                    Zurück
                </button>
            </a>
        </div>
    </form>
    
    <!-- Notification Area -->
    <div id="notification" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md" role="alert">
        <span id="notification-message"></span>
    </div>
</div>

<!-- Alert Window -->
<div id="alert" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-2" id="alert-title">Bestätigung</h3>
        <p id="alert-message">Möchten Sie dieses Gerät wirklich löschen?</p>
        <div class="mt-4 flex justify-end space-x-2">
            <button id="alert-yes" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Ja</button>
            <button id="alert-no" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Nein</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deviceContainer = document.getElementById('device-container');

        for (let i = 1; i <= 12; i++) {
            const deviceBlock = document.createElement('div');
            deviceBlock.classList.add('space-y-4', 'p-4', 'border', 'border-gray-300', 'rounded-md', 'bg-gray-50', 'shadow-sm');
            deviceBlock.innerHTML = `
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Gerät ${i}</h3>
                    <button type="button" class="text-gray-500 hover:text-red-500" onclick="confirmDelete(this)">&#10006;</button>
                </div>

                <!-- Device Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
                    <input type="text" name="device_name[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Serial Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                    <input type="text" name="serial_number[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- OS -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
                    <input type="text" name="os[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
    });

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

    function generateQRCode() {
        showNotification("Neuer QR Code wurde generiert!");
    }

    function generateBarcode() {
        showNotification("Neuer Barcode wurde generiert!");
    }

    function confirmDelete(button) {
        const deviceBlock = button.closest('div').parentNode; // Get the parent device block
        showAlert("Möchten Sie dieses Gerät wirklich löschen?", function(confirmed) {
            if (confirmed) {
                deviceBlock.remove(); // Remove the device block
                showNotification("Gerät erfolgreich gelöscht!");
            }
        });
    }

    function showNotification(message) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');
        
        notificationMessage.textContent = message; // Set notification message
        notification.classList.remove('hidden'); // Show notification
        
        // Hide notification after 3 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 3000);
    }

    function showAlert(message, callback) {
        const alert = document.getElementById('alert');
        const mainContainer = document.getElementById('main-container'); // Main container for the blur effect
        const alertMessage = document.getElementById('alert-message');
        const alertYes = document.getElementById('alert-yes');
        const alertNo = document.getElementById('alert-no');

        alertMessage.textContent = message; // Set alert message
        alert.classList.remove('hidden'); // Show alert
        mainContainer.classList.add('blur'); // Add blur class to main container

        alertYes.onclick = function() {
            alert.classList.add('hidden'); // Hide alert
            mainContainer.classList.remove('blur'); // Remove blur effect
            if (callback) callback(true); // Execute callback with true
        };

        alertNo.onclick = function() {
            alert.classList.add('hidden'); // Hide alert
            mainContainer.classList.remove('blur'); // Remove blur effect
            if (callback) callback(false); // Execute callback with false
        };

        // Close alert on clicking outside of the alert window
        alert.onclick = function(event) {
            if (event.target === alert) {
                alert.classList.add('hidden'); // Hide alert
                mainContainer.classList.remove('blur'); // Remove blur effect
            }
        };
    }
</script>

</body>
</html>
