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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Benutzer Liste</title>
</head>

<body class="bg-gray-100 font-sans text-xs">

<?php
include '../Nav/nav.php';

function fetch_users_from_api() {
    $api_url = 'http://127.0.0.1:3000/api/users';
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        return [];
    }

    return json_decode($response, true);
}

$users = fetch_users_from_api();
?>

<div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-center mb-4">Benutzer Liste</h1>

    <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mb-2 text-xs" onclick="window.location.href='create_users.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
            <thead class="bg-yellow-400">
                <tr>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Nachname</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Vorname</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Email 1</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Email 2</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Email 3</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">QR Code</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Barcode</th>
                    <th class="py-1 px-2 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody id="user-list">
    <?php
    if (empty($users)) {
        echo "<tr><td colspan='8' class='text-center py-4'>Keine Benutzerdaten gefunden.</td></tr>";
    } else {
        foreach ($users as $user) {
            echo "<tr class='hover:bg-gray-50' id='user-{$user['user_id']}'>
                    <td class='py-1 px-2 border-b'>
                        <span class='user-lastname'>{$user['lastname']}</span>
                        <input type='text' class='user-lastname-input hidden' value='{$user['lastname']}' />
                    </td>
                    <td class='py-1 px-2 border-b'>
                        <span class='user-firstname'>{$user['firstname']}</span>
                        <input type='text' class='user-firstname-input hidden' value='{$user['firstname']}' />
                    </td>
                    <td class='py-1 px-2 border-b'>
                        <span class='user-email_1'>{$user['email_1']}</span>
                        <input type='text' class='user-email_1-input hidden' value='{$user['email_1']}' />
                    </td>
                    <td class='py-1 px-2 border-b'>
                        <span class='user-email_2'>{$user['email_2']}</span>
                        <input type='text' class='user-email_2-input hidden' value='{$user['email_2']}' />
                    </td>
                    <td class='py-1 px-2 border-b'>
                        <span class='user-email_3'>{$user['email_3']}</span>
                        <input type='text' class='user-email_3-input hidden' value='{$user['email_3']}' />
                    </td>
                    <td class='py-1 px-2 border-b'>
                        <div class='qr-code' style='width: 40px; height: 40px;' data-qr='Name: {$user['firstname']} {$user['lastname']}, Email: {$user['email_1']}'></div>
                    </td>
                    <td class='py-1 px-2 border-b'>{$user['barcode']}</td>
                    <td class='py-1 px-2 border-b'>
                        <div class='flex space-x-1'>
                            <button class='bg-black text-white py-1 px-1 rounded hover:bg-gray-800 text-xs' onclick=\"window.location.href='detail_users.php?id={$user['user_id']}'\">Ansicht</button>
                            <a class='bg-yellow-500 text-white py-1 px-1 rounded hover:bg-yellow-600 text-xs edit-button' onclick='toggleEdit({$user['user_id']})'>
                                <i class='fas fa-pencil-alt'></i>
                            </a>
                             <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600' onclick=\"window.location.href='edit_users.php?id={$user['user_id']}'\">Bearbeiten</button>
                            <button class='bg-green-500 text-white py-1 px-1 rounded hover:bg-green-600 text-xs save-button hidden' onclick='saveChanges({$user['user_id']})'>✔️</button>
                            <button class='bg-red-500 text-white py-1 px-1 rounded hover:bg-red-600 text-xs' onclick=\"if(confirm('Möchten Sie diesen Benutzer wirklich löschen?')) window.location.href='delete_users.php?id={$user['user_id']}';\">Löschen</button>
                        </div>
                    </td>
                </tr>";
        }
    }
    ?>
</tbody>

        </table>
    </div>
</div>

<script>
    function generateQRCodes() {
        $('.qr-code').each(function() {
            const qrData = $(this).data('qr');
            const qrcode = new QRCode(this, {
                text: qrData,
                width: 40,
                height: 40,
            });
        });
    }

    function toggleEdit(userId) {
        const row = $(`#user-${userId}`);
        row.find('.user-lastname, .user-firstname, .user-email_1, .user-email_2, .user-email_3').toggleClass('hidden');
        row.find('.user-lastname-input, .user-firstname-input, .user-email_1-input, .user-email_2-input, .user-email_3-input').toggleClass('hidden');
        row.find('.edit-button').toggleClass('hidden');
        row.find('.save-button').toggleClass('hidden');
    }

    function saveChanges(userId) {
        const row = $(`#user-${userId}`);
        const updatedData = {
            user_id: userId,
            lastname: row.find('.user-lastname-input').val(),
            firstname: row.find('.user-firstname-input').val(),
            email_1: row.find('.user-email_1-input').val(),
            email_2: row.find('.user-email_2-input').val(),
            email_3: row.find('.user-email_3-input').val(),
        };

        $.ajax({
            type: "PUT",
            url: `http://127.0.0.1:3000/api/users/${userId}`,
            data: JSON.stringify(updatedData),
            contentType: "application/json",
            success: function() {
                row.find('.user-lastname').text(updatedData.lastname);
                row.find('.user-firstname').text(updatedData.firstname);
                row.find('.user-email_1').text(updatedData.email_1);
                row.find('.user-email_2').text(updatedData.email_2);
                row.find('.user-email_3').text(updatedData.email_3);
                toggleEdit(userId);
                alert('Benutzerdaten erfolgreich aktualisiert.');
            },
            error: function() {
                alert('Fehler beim Aktualisieren der Benutzerdaten.');
            }
        });
    }

    $(document).ready(function() {
        generateQRCodes();
    });
</script>

<?php
include '../Footer/footer.php';
?>

</body>
</html>
