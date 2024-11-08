<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Geräte Liste</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Kontaktinformation</h1>
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Sven Weidenmann</h2>
        <p class="text-gray-700">Arbeitgeber: Werft22 AG</p>
        <p class="text-gray-700">E-Mail: <a href="mailto:sven.weidenmann@werft22.com" class="text-blue-500 hover:underline">sven.weidenmann@werft22.com</a></p>
        <p class="text-gray-700">Position: Junior Applikationsentwickler / ICT-Fachmann</p>
    </div>
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Standort</h2>
        <div class="w-full h-64 rounded-lg overflow-hidden shadow-md">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1dX....!2dX....!3dX....!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zTGFuZHN0cmFzc2UgMSw1NDE1IFJpZWRlbiDwn5mD!5e0!3m2!1sde!2sch!4vX...." 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
        <p class="mt-2 text-gray-700">Landstrasse 1, 5415 Rieden</p>
    </div>
</div>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
