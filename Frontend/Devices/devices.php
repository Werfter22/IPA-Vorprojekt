<!DOCTYPE html>
<html lang="de">

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
                <th class="py-2 px-4 border-b text-left text-gray-700">Geräte Bild</th>
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
                const deviceNames = [
                    device.device_name_1, device.device_name_2, device.device_name_3,
                    device.device_name_4, device.device_name_5, device.device_name_6,
                    device.device_name_7, device.device_name_8, device.device_name_9,
                    device.device_name_10, device.device_name_11, device.device_name_12
                ].filter(Boolean);

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

                const deviceImages = {
                    "Apple_iMac": "../../Backend/Images/Content/Devices/Apple_iMac.png",
                    "Apple_iPad_11_pro": "../..//Backend/Images/Content/Devices/Apple_iPad_11_pro.png",
                    "Apple_iPad_pro_2021": "../../Backend/Images/Content/Devices/Apple_iPad_pro_2021.png",
                    "Apple_iPhone_7": "../../Backend/Images/Content/Devices/Apple_iPhone_7.png",
                    "Apple_iPhone_12": "../../Backend/Images/Content/Devices/Apple_iPhone_12.png",
                    "Apple_iPhone_13_pro": "../../Backend/Images/Content/Devices/Apple_iPhone_13_pro.png",
                    "Apple_iPhone_14_pro": "../../Backend/Images/Content/Devices/Apple_iPhone_14_pro.png",
                    "Apple_iPhone_15_pro": "../../Backend/Images/Content/Devices/Apple_iPhone_15_pro.png",
                    "Apple_iPhone_pro_max": "../../Backend/Images/Content/Devices/Apple_iPhone_pro_max.png",
                    "Apple_iPhone_SE": "../../Backend/Images/Content/Devices/Apple_iPhone_SE.png",
                    "Apple_iPhone_XS": "../../Backend/Images/Content/Devices/Apple_iPhone_XS.png",
                    "Apple_Mac_Mini": "../../Backend/Images/Content/Devices/Apple_Mac_Mini.png",
                    "Apple_Mac_Studio": "../../Backend/Images/Content/Devices/Apple_Mac_Studio.png",
                    "Apple_MacBook_Air": "../../Backend/Images/Content/Devices/Apple_MacBook_Air.png",
                    "Apple_MacBook_Pro": "../../Backend/Images/Content/Devices/Apple_MacBook_Pro.png",
                    "Lenovo_Fibocom": "../../Backend/Images/Content/Devices/Lenovo_Fibocom.png",
                    "Tablet_Surface": "../../Backend/Images/Content/Devices/Tablet_Surface.png",
                    "ThinkCentre_Lenovo": "../../Backend/Images/Content/Devices/ThinkCentre_Lenovo.png",
                    "ThinkPad_Lenovo": "/Backend/Images/Content/Devices/ThinkPad_Lenovo.png",
                    "default": "../../Backend/Images/Content/Devices/default.png"
                };

                // Create a row for each device name
                deviceNames.forEach((name, index) => {
                    const qrData = `${name}, Serial: ${serialNumbers[index] || 'N/A'}`; // Define QR code data
                    const row = `
                        <tr class='hover:bg-gray-50'>
                            
                            <td class="py-4 px-4 border-b text-left">
                                <img src="${deviceImages[name] || '../../Backend/Images/Content/Devices/default.png'}" alt="Gerät" class="w-12 h-12 rounded-full object-cover">
                            </td>
                            <td class='py-2 px-4 border-b'>
                                <span class="device-name">${name}</span>
                                <input type="text" class="device-name-input hidden" value="${name}" />
                                <span class="edit-icon cursor-pointer text-blue-500" onclick="editDevice(this)">✏️</span>
                            </td>
                            <td class='py-2 px-4 border-b'>
                                <span class="serial-number">${serialNumbers[index] || 'N/A'}</span>
                                <input type="text" class="serial-number-input hidden" value="${serialNumbers[index] || ''}" />
                            </td>
                            <td class='py-2 px-4 border-b'>
                                <span class="operating-system">${operatingSystems[index] || 'N/A'}</span>
                                <input type="text" class="operating-system-input hidden" value="${operatingSystems[index] || ''}" />
                            </td>
                            <td class='py-2 px-4 border-b'>${device[`is_werft_device_${index + 1}`] ? 'Ja' : 'Nein'}</td>
                            <td class='py-2 px-4 border-b'>${device[`is_private_device_${index + 1}`] ? 'Ja' : 'Nein'}</td>
                            <td class='py-2 px-4 border-b'>
                                <div class="qr-code" id="qr-code-${device.id}_${index}"></div>
                            </td>
                            <td class='py-2 px-4 border-b'>
                                <svg id="barcode-${device.id}_${index}"></svg>
                            </td>
                            <td class='py-2 px-4 border-b'>
                                <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800 mb-2' onclick="window.location.href='detail_devices.php?id=${device.device_id}'">Ansicht</button>
                                 <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 mb-2' onclick="window.location.href='edit_devices.php?id=${device.device_id}'">Bearbeiten</button>
                                <button class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" onclick="openModal('${name}', ${device.id})">Löschen</button>
                            </td>
                        </tr>
                    `;

                    deviceList.insertAdjacentHTML('beforeend', row);

                    // Generate QR Code
                    const qrCode = new QRCode(document.getElementById(`qr-code-${device.id}_${index}`), {
                        text: qrData,
                        width: 64,
                        height: 64,
                    });

                    // Generate Barcode
                    JsBarcode(`#barcode-${device.id}_${index}`, serialNumbers[index] || '', {
                        format: "CODE39",
                        displayValue: false
                    });
                });
            });
        } catch (error) {
            console.error('Error fetching devices:', error);
        }
    }

    // Edit device functionality
    function editDevice(element) {
        const row = $(element).closest('tr');
        row.find('.device-name-input, .serial-number-input, .operating-system-input').removeClass('hidden');
        row.find('.device-name, .serial-number, .operating-system').addClass('hidden');
        $(element).text('✔️').attr('onclick', 'saveDevice(this, ' + row.data('id') + ')');
    }

    async function saveDevice(element, deviceId) {
        const row = $(element).closest('tr');
        const updatedName = row.find('.device-name-input').val();
        const updatedSerial = row.find('.serial-number-input').val();
        const updatedOS = row.find('.operating-system-input').val();

        const confirmed = confirm('Möchten Sie die Änderungen speichern?');
        if (!confirmed) return; // Stop if user cancels

        try {
            const response = await fetch(`http://127.0.0.1:3000/api/devices/${deviceId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    device_name: updatedName,
                    serialnumber: updatedSerial,
                    os: updatedOS,
                }),
            });

            if (response.ok) {
                fetchDevices(); // Refresh the device list
            } else {
                console.error('Error saving device:', response.statusText);
            }
        } catch (error) {
            console.error('Error saving device:', error);
        }
    }

    // Open modal for confirmation
    function openModal(name, id) {
        $('#deviceName').text(name);
        $('#confirmButton').attr('onclick', `confirmDelete(${id})`);
        $('#deleteModal').removeClass('hidden');
    }

    // Close modal
    function closeModal() {
        $('#deleteModal').addClass('hidden');
    }

    // Confirm deletion
    async function confirmDelete(deviceId) {
        try {
            const response = await fetch(`http://127.0.0.1:3000/api/devices/${deviceId}`, {
                method: 'DELETE',
            });

            if (response.ok) {
                fetchDevices(); // Refresh the device list
                closeModal(); // Close the modal
            } else {
                console.error('Error deleting device:', response.statusText);
            }
        } catch (error) {
            console.error('Error deleting device:', error);
        }
    }

    // Fetch devices on page load
    $(document).ready(() => {
        fetchDevices();
    });
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
