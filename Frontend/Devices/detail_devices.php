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
        const device_id = urlParams.get('id'); // Get the device ID from the query parameter

        // Fetch the specific device details from the backend API using the device_id
        fetch(`http://127.0.0.1:3000/api/devices/detail/${device_id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Device Data:', data);
                // Ensure data is an array and get the first element if needed
                const devicesArray = Array.isArray(data) ? data : [data];
                // Call the function to load device details into the UI
                loadDeviceDetails(devicesArray[0]);
            })
            .catch(error => {
                console.error('Error fetching device details:', error);
                // Handle error by showing a message in the UI
                document.getElementById('device-container').innerHTML = `<p class="text-red-500">Gerät nicht gefunden.</p>`;
            });
    }

    function loadDeviceDetails(device) {
        const deviceContainer = document.getElementById('device-container');

        const deviceBlock = document.createElement('div');
        deviceBlock.classList.add('space-y-4', 'p-4', 'border', 'border-gray-300', 'rounded-md', 'bg-gray-50', 'shadow-sm');
        deviceBlock.innerHTML = `<h3 class="text-lg font-semibold">Gerät Details</h3>`;

        // Assuming device has properties device_name, serialnumber, and os
        deviceBlock.innerHTML += `
            <div>
                <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
                <input type="text" value="${device.device_name || ''}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                <input type="text" value="${device.serialnumber || ''}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Betriebssystem</label>
                <input type="text" value="${device.os || ''}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
            </div>
        `;

        deviceContainer.appendChild(deviceBlock);
    }

    function goBack() {
        window.history.back();
    }
</script>



    <?php
    // Include the footer
    include '../Footer/footer.php';
    ?>

</body>
</html>
