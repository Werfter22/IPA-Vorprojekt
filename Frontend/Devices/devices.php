<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://davidshimjs.github.io/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@latest/dist/JsBarcode.all.min.js"></script>

    <title>Geräte Liste</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Geräte Liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_devices.php'">Hinzufügen</button>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left text-gray-700">Geräte Name</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Seriennummer</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Betriebssystem</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Ist ein Werft Gerät</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Ist ein Privat Gerät</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">QR-Code</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Barcode</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Aktion</th>
            </tr>
        </thead>
        <tbody id="device-list">
            <!-- Device rows will be dynamically inserted here via JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-semibold mb-4" id="modalTitle">Gerät Löschen</h2>
        <p class="mb-4">Möchten Sie das Gerät <span id="deviceName"></span> wirklich löschen?</p>
        <div class="flex justify-end">
            <button id="cancelButton" class="bg-gray-300 text-gray-700 py-2 px-4 rounded mr-2" onclick="closeModal()">Abbrechen</button>
            <button id="confirmButton" class="bg-red-500 text-white py-2 px-4 rounded" onclick="confirmDelete()">Löschen</button>
        </div>
    </div>
</div>

<script>
    // Fetch devices from the API and populate the table
    async function fetchDevices() {
        try {
            const response = await fetch('http://127.0.0.1:3000/api/devices'); // Your API endpoint
            const devices = await response.json();

            const deviceList = document.getElementById('device-list');
            deviceList.innerHTML = '';  // Clear existing rows

            devices.forEach(device => {
                // Prepare device names, serial numbers, OS, etc.
                const deviceNames = [
                    device.device_name_1, device.device_name_2, device.device_name_3,
                    device.device_name_4, device.device_name_5, device.device_name_6,
                    device.device_name_7, device.device_name_8, device.device_name_9,
                    device.device_name_10, device.device_name_11, device.device_name_12
                ].filter(Boolean); // Filter out undefined values

                const serialNumbers = [
                    device.serialnumber_1, device.serialnumber_2, device.serialnumber_3,
                    device.serialnumber_4, device.serialnumber_5, device.serialnumber_6,
                    device.serialnumber_7, device.serialnumber_8, device.serialnumber_9,
                    device.serialnumber_10, device.serialnumber_11, device.serialnumber_12
                ].filter(Boolean);

                const operatingSystems = [
                    device.os_1, device.os_2, device.os_3,
                    device.os_4, device.os_5, device.os_6,
                    device.os_7, device.os_8, device.os_9,
                    device.os_10, device.os_11, device.os_12
                ].filter(Boolean);

                // Create a row for each device name
                deviceNames.forEach((name, index) => {
                    const qrData = `${name}, Serial: ${serialNumbers[index] || 'N/A'}`; // Define QR code data
                    const row = `
                        <tr class='hover:bg-gray-50'>
                            <td class='py-2 px-4 border-b'>${name}</td>
                            <td class='py-2 px-4 border-b'>${serialNumbers[index] || 'N/A'}</td>
                            <td class='py-2 px-4 border-b'>${operatingSystems[index] || 'N/A'}</td>
                            <td class='py-2 px-4 border-b'>${device[`is_werft_device_${index + 1}`] ? 'Ja' : 'Nein'}</td>
                            <td class='py-2 px-4 border-b'>${device[`is_private_device_${index + 1}`] ? 'Ja' : 'Nein'}</td>
                            <td class='py-2 px-4 border-b'>
                                <div class="qr-code" style="width: 60px; height: 60px;" data-qr="${qrData}"></div>
                            </td>
                            <td class='py-2 px-4 border-b'>${device.barcode}</td>
                            <td class='py-2 px-4 border-b w-48'>
                                <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800 mb-2' onclick="window.location.href='detail_devices.php?id=${device.device_id}'">Ansicht</button>
                                <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 mb-2' onclick="window.location.href='edit_devices.php?id=${device.device_id}'">Bearbeiten</button>
                                <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick="openModal(${device.device_id}, '${device.name}')">Löschen</button>
                            </td>
                        </tr>`;
                    deviceList.insertAdjacentHTML('beforeend', row);
                });
            });

            // Generate QR codes after populating the device list
            generateQRCodes();
        } catch (error) {
            console.error('Error fetching devices:', error);
        }
    }

    function generateQRCodes() {
        $('.qr-code').each(function() {
            const qrData = $(this).data('qr'); // Get the QR data from the div's data attribute
            const qrcode = new QRCode(this, {
                text: qrData,
                width: 60,
                height: 60,
            });
        });
    }

    // Fetch devices when the page loads
    document.addEventListener('DOMContentLoaded', fetchDevices);
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
