<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer Registrierung</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Registrierung</h2>
        <form id="registerForm" action="register_process.php" method="POST" class="space-y-6">
            <!-- Vorname -->
            <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">Vorname</label>
                <input type="text" id="firstName" name="firstName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Nachname -->
            <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Nachname</label>
                <input type="text" id="lastName" name="lastName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Emails -->
            <div id="emailFields">
                <div class="email-entry">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email1" name="email[]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            <button type="button" id="addEmailButton" class="mt-2 text-blue-500 hover:underline text-sm">+ Weitere Email hinzufügen</button>

            <!-- Passwort -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Passwort bestätigen -->
            <div>
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Passwort bestätigen</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Benutzername -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Benutzername</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Rolle -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Rolle</label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Mitarbeiter">Mitarbeiter</option>
                    <option value="Gast">Gast</option>
                    <option value="System">System</option>
                    <option value="Admin">Admin</option>
                    <option value="Swisscom">Swisscom</option>
                    <option value="Arbeitsplatz">Arbeitsplatz</option>
                </select>
            </div>

            <!-- Auth Token Generator -->
            <div>
                <label for="authToken" class="block text-sm font-medium text-gray-700">Auth Token</label>
                <div class="flex">
                    <input type="text" id="authToken" name="authToken" readonly class="flex-grow mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="button" id="generateTokenButton" class="ml-2 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">Generieren</button>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Registrieren</button>
            </div>
        </form>
    </div>

    <script>
        // Email-Feld Dynamik
        const addEmailButton = document.getElementById('addEmailButton');
        const emailFields = document.getElementById('emailFields');
        let emailCount = 1;

        addEmailButton.addEventListener('click', function() {
            if (emailCount < 3) {
                emailCount++;
                const newEmailField = document.createElement('div');
                newEmailField.classList.add('email-entry');
                newEmailField.innerHTML = `
                    <label for="email${emailCount}" class="block text-sm font-medium text-gray-700">Email ${emailCount}</label>
                    <input type="email" id="email${emailCount}" name="email[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                `;
                emailFields.appendChild(newEmailField);
            }
        });

        // Auth Token Generator
        document.getElementById('generateTokenButton').addEventListener('click', function () {
            const authToken = Math.random().toString(36).substr(2, 12);
            document.getElementById('authToken').value = authToken;
        });

        // Formular Validierung
        document.getElementById('registerForm').addEventListener('submit', function (event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                event.preventDefault();
                alert("Passwörter stimmen nicht überein.");
            }
        });
    </script>
</body>
</html>
