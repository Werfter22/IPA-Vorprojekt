<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Create Machine</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Maschine erfassen</h2>
    <form id="createMachineForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Is Obsolete -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ist nicht mehr gebräuchlich?</label>
                    <select name="is_obsolete" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="no" selected>No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
            </div>

            <!-- Machine Name -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Maschinen Name</label>
                    <input type="text" name="machine_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Machine Function -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Maschinen Funktion</label>
                    <input type="text" name="machine_function" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Machine Description -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Maschinen Beschreibung</label>
                    <textarea name="machine_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="3" required></textarea>
                </div>
            </div>

            <!-- Is Virtual -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ist Virtuell?</label>
                    <select name="is_virtual" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="no" selected>No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
            </div>

            <!-- VM Host -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">VM Host</label>
                    <input type="text" name="vm_host" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- CPU -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">CPU</label>
                    <input type="text" name="cpu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Cores -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cores</label>
                    <input type="number" name="cores" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- RAM (MB) -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">RAM (MB)</label>
                    <input type="number" name="ram_mb" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- OS -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
                    <input type="text" name="os" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- OS Info -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Betriebsystem Information</label>
                    <input type="text" name="os_info" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Location -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ort</label>
                    <input type="text" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Lowest Unit -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kleinste Einheit</label>
                    <input type="text" name="lowest_unit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Buy Date -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kauf Datum</label>
                    <input type="date" name="buy_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Value of Hardware -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Wert der Hardware</label>
                    <input type="number" name="value_of_hardware" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Restore Hours -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Wiederherstellungsdauer</label>
                    <input type="number" name="restore_hours" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Serial Number -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                    <input type="text" name="serial_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Production Date -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Produktionsdatum</label>
                    <input type="date" name="production_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Disposal Date -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Entsorgungsdatum</label>
                    <input type="date" name="disposal_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Erstellen
            </button>
            <a href="../Machines/machines.php">
                <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
            </a>
        </div>
    </form>
</div>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
