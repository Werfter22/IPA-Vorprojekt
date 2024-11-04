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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Inventarliste</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Inventar liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_inventar.php'">Hinzufügen</button>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left text-gray-700">Name</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Barcode</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">QR-Code</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Details</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Transport Einheit</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Standort</th>
                <th class="py-2 px-4 border-b text-left text-gray-700">Aktion</th>
            </tr>
        </thead>
        <tbody id="inventar-list">
            <!-- Inventory rows will be dynamically inserted here via JavaScript -->
        </tbody>
    </table>
</div>

<script>
    // Fetch inventory items from the API and populate the table
    async function fetchInventory() {
        try {
            const response = await fetch('http://127.0.0.1:3000/api/inventar_liste_original'); // Your API endpoint
            const inventar = await response.json();

            const inventarList = document.getElementById('inventar-list');
            inventarList.innerHTML = '';  // Clear existing rows

            inventar.forEach(item => {
                const row = `
                    <tr class='hover:bg-gray-50'>
                        <td class='py-2 px-4 border-b'>
                            <span class="device-name">${item.name}</span>
                            <input type="text" class="device-name-input hidden" value="${item.name}" />
                        </td>
                        <td class='py-2 px-4 border-b'>
                            <span class="device-barcode">${item.barcode}</span>
                            <input type="text" class="device-barcode-input hidden" value="${item.barcode}" />
                        </td>
                        <td class='py-2 px-4 border-b'><img src='${item.qr_code}' alt='QR-Code' class='w-12 h-12'></td>
                        <td class='py-2 px-4 border-b'>
                            <span class="device-details">${item.details}</span>
                            <input type="text" class="device-details-input hidden" value="${item.details}" />
                        </td>
                        <td class='py-2 px-4 border-b'>
                            <span class="device-transport">${item.transport_unit}</span>
                            <input type="text" class="device-transport-input hidden" value="${item.transport_unit}" />
                        </td>
                        <td class='py-2 px-4 border-b'>
                            <span class="device-location">${item.location}</span>
                            <input type="text" class="device-location-input hidden" value="${item.location}" />
                        </td>
                        <td class='py-2 px-4 border-b'>
                            <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800 mb-2' onclick="window.location.href='detail_inventory.php?id=${item.inventar_liste_original_id}'">Ansicht</button>
                            <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 mb-2' onclick="editInventory(${item.inventar_liste_original_id}, this)">
                                <i class='fas fa-pencil-alt' style='font-size: 30px;'></i>
                            </button>
                            <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 mb-2' onclick="window.location.href='edit_inventory.php?id=${item.inventar_liste_original_id}'">Bearbeiten</button>
                            <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick="openModal(${item.inventar_liste_original_id}, '${item.name}')">Löschen</button>
                        </td>
                    </tr>`;
                inventarList.insertAdjacentHTML('beforeend', row);
            });
        } catch (error) {
            console.error('Error fetching inventory:', error);
        }
    }

    // Function to toggle edit mode for all inventory fields
    function editInventory(id, buttonElement) {
        const row = buttonElement.closest('tr');

        const nameSpan = row.querySelector('.device-name');
        const nameInput = row.querySelector('.device-name-input');
        const barcodeSpan = row.querySelector('.device-barcode');
        const barcodeInput = row.querySelector('.device-barcode-input');
        const detailsSpan = row.querySelector('.device-details');
        const detailsInput = row.querySelector('.device-details-input');
        const transportSpan = row.querySelector('.device-transport');
        const transportInput = row.querySelector('.device-transport-input');
        const locationSpan = row.querySelector('.device-location');
        const locationInput = row.querySelector('.device-location-input');

        // Toggle visibility of spans and inputs
        const isEditing = nameInput.classList.toggle('hidden');

        nameSpan.classList.toggle('hidden');
        barcodeSpan.classList.toggle('hidden');
        detailsSpan.classList.toggle('hidden');
        transportSpan.classList.toggle('hidden');
        locationSpan.classList.toggle('hidden');

        barcodeInput.classList.toggle('hidden');
        detailsInput.classList.toggle('hidden');
        transportInput.classList.toggle('hidden');
        locationInput.classList.toggle('hidden');

        if (isEditing) {
            // Focus on the name input when it becomes visible
            nameInput.focus();
        } else {
            // Handle saving the updated data (e.g., via an API call)
            const updatedData = {
                id: id,
                name: nameInput.value,
                barcode: barcodeInput.value,
                details: detailsInput.value,
                transport_unit: transportInput.value,
                location: locationInput.value
            };
            console.log(`Updated data:`, updatedData);
            // Here, you could implement an API call to update the inventory item
        }
    }

    // Fetch inventory items when the page loads
    document.addEventListener('DOMContentLoaded', fetchInventory);
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
