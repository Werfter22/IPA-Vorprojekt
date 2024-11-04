<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Machine Details</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Maschinen Detail Ansicht</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Is Obsolete -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ist nicht mehr gebräuchlich?</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Yes</p>
            </div>
        </div>

        <!-- Machine Name -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Maschinen Name</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Machine A</p>
            </div>
        </div>

        <!-- Machine Function -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Maschinen Funktion</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Production</p>
            </div>
        </div>

        <!-- Machine Description -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Maschinen Berschreibung</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">High-speed machine for production</p>
            </div>
        </div>

        <!-- Is Virtual -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ist Virtuell?</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">No</p>
            </div>
        </div>

        <!-- VM Host -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">VM Host</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Host A</p>
            </div>
        </div>

        <!-- CPU -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">CPU</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Intel i7</p>
            </div>
        </div>

        <!-- Cores -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Cores</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">8</p>
            </div>
        </div>

        <!-- RAM (MB) -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">RAM (MB)</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">16384</p>
            </div>
        </div>

        <!-- OS -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Windows 10</p>
            </div>
        </div>

        <!-- OS Info -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Betriebsystem Information</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Version 21H2</p>
            </div>
        </div>

        <!-- Location -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ort</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Factory Floor 1</p>
            </div>
        </div>

        <!-- Lowest Unit -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kleinste Einheit</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">Unit A</p>
            </div>
        </div>

        <!-- Buy Date -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kauf Datum</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">2022-01-01</p>
            </div>
        </div>

        <!-- Value of Hardware -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Wert der Hardware</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">€2000</p>
            </div>
        </div>

        <!-- Restore Hours -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Wiederherstellungsdauer</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">5</p>
            </div>
        </div>

        <!-- Serial Number -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">SN123456789</p>
            </div>
        </div>

        <!-- Production Date -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Produktionsdatum</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">2021-06-15</p>
            </div>
        </div>

        <!-- Disposal Date -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Entsorgungsdatum</label>
                <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">N/A</p>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-6">
        <a href="../Machines/machines.php">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600" onclick="goBack()">Zurück</button>
        </a>
    </div>
</div>

<script>
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
