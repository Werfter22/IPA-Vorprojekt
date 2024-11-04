<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>User Profiles Overview</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Benutzer Profil</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-50 p-4 rounded-lg shadow">
            <img src="../../Backend/Images/Profile/profile.png" alt="User Image" class="rounded-full w-32 h-32 mx-auto mb-4">
            <h2 class="text-xl font-semibold">Nachname, Vorname</h2>
            <p class="text-gray-600">Email 1: email1@example.com</p>
            <p class="text-gray-600">Email 2: email2@example.com</p>
            <p class="text-gray-600">Email 3: email3@example.com</p>
            <div class="flex justify-between mt-4">
                <button class="bg-blue-500 text-white py-2 px-4 rounded">Bearbeiten</button>
                <button class="bg-red-500 text-white py-2 px-4 rounded">Löschen</button>
                <button class="bg-red-500 text-white py-2 px-4 rounded">Abmelden</button>
            </div>
        </div>

    </div>
</div>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
