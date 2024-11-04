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
                        <td class='py-2 px-4 border-b'>${item.name}</td>
                        <td class='py-2 px-4 border-b'>${item.barcode}</td>
                        <td class='py-2 px-4 border-b'><img src='${item.qr_code}' alt='QR-Code' class='w-12 h-12'></td>
                        <td class='py-2 px-4 border-b'>${item.details}</td>
                        <td class='py-2 px-4 border-b'>${item.transport_unit}</td>
                        <td class='py-2 px-4 border-b'>${item.location}</td>
                        <td class='py-2 px-4 border-b'>
                            <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800 mb-2' onclick="window.location.href='detail_inventory.php?id=${item.inventar_liste_original_id}'">Ansicht</button>
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

    // Fetch inventory items when the page loads
    document.addEventListener('DOMContentLoaded', fetchInventory);
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
