<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Geräte Details</title>
</head>

<body class="bg-gray-100 font-sans">

    <?php
    // Include the navigation bar
    include '../Nav/nav.php';
    ?>

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6">Geräte Detail Ansicht</h2>
        <div id="deviceDetails">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
                <!-- Device details will be inserted here -->
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="../Devices/devices.php">
                    <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600" onclick="goBack()">Zurück</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchDeviceDetails();
        });

        function fetchDeviceDetails() {
            const urlParams = new URLSearchParams(window.location.search);
            const deviceId = urlParams.get('id'); // Get the device ID from the query parameter

            fetch(http://127.0.0.1:8081/api/devices/detail/${deviceId}) // Updated URL to include device ID
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(device => {
                    // Check if device data contains values
                    if (!device || Object.keys(device).length === 0) {
                        throw new Error('Keine Gerätedaten erhalten');
                    }
                    loadDeviceDetails(device);
                })
                .catch(error => {
                    console.error('Fehler beim Abrufen der Gerätedetails:', error);
                    alert(Fehler: ${error.message}); // Optional: User-friendly error message
                });
        }

        function loadDeviceDetails(device) {
            const deviceContainer = document.getElementById('device-container');

            const deviceBlock = document.createElement('div');
            deviceBlock.classList.add('space-y-4', 'p-4', 'border', 'border-gray-300', 'rounded-md', 'bg-gray-50', 'shadow-sm');
            deviceBlock.innerHTML = <h3 class="text-lg font-semibold">Gerät Details</h3>;

            for (let i = 1; i <= 12; i++) {
                // Add Device Name
                deviceBlock.innerHTML += 
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Geräte Name ${i}</label>
                        <input type="text" value="${device[Device_Name_${i}]}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>
                ;

                // Add Serial Number
                deviceBlock.innerHTML += 
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Seriennummer ${i}</label>
                        <input type="text" value="${device[Serialnumber_${i}]}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>
                ;

                // Add OS
                deviceBlock.innerHTML += 
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Betriebssystem ${i}</label>
                        <input type="text" value="${device[OS_${i}]}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>
                ;

                // Add QR Code
                deviceBlock.innerHTML += 
                    <div>
                        <label class="block text-sm font-medium text-gray-700">QR Code ${i}</label>
                        <img src="generate_qr.php?data=${device.QR_Code}" alt="QR Code" class="mt-2 w-32 h-32">
                        <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md" onclick="generateQRCode('${device.QR_Code}')">Generate QR Code</button>
                    </div>
                ;

                // Add Barcode
                deviceBlock.innerHTML += 
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barcode ${i}</label>
                        <img src="generate_barcode.php?data=${device.Barcode}" alt="Barcode" class="mt-2 w-32 h-16">
                        <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md" onclick="generateBarcode('${device.Barcode}')">Generate Barcode</button>
                    </div>
                ;

                // Add Werft or Private Device
                deviceBlock.innerHTML += 
                    <div class="flex items-center justify-between space-x-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Werft Gerät ${i}?</label>
                            <input type="checkbox" ${device[IS_Werft_Device_${i}] ? 'checked' : ''} class="mt-1" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Privat Gerät ${i}?</label>
                            <input type="checkbox" ${device[IS_Private_Device_${i}] ? 'checked' : ''} class="mt-1" disabled>
                        </div>
                    </div>
                ;
            }

            deviceContainer.appendChild(deviceBlock);
        }

        function goBack() {
            window.history.back();
        }

        function generateQRCode(data) {
            alert(Generate QR Code for: ${data});
            // Add functionality to generate QR Code
        }

        function generateBarcode(data) {
            alert(Generate Barcode for: ${data});
            // Add functionality to generate Barcode
        }
    </script>

    <?php
    // Include the footer
    include '../Footer/footer.php';
    ?>

</body>
</html>