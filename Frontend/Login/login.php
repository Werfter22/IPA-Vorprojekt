<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form id="loginForm" action="login.php" method="POST" class="space-y-6">
            <div>
                <label for="loginOption" class="block text-sm font-medium text-gray-700">Login Methode</label>
                <select id="loginOption" name="loginOption" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="emailPassword">Mit E-Mail und Passwort</option>
                    <option value="authToken">Mit Auth Token</option>
                </select>
            </div>

            <!-- Email und Passwort Felder -->
            <div id="emailPasswordFields">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
                    <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Auth Token Feld -->
            <div id="authTokenField" style="display: none;">
                <label for="authToken" class="block text-sm font-medium text-gray-700">Auth Token</label>
                <input type="text" id="authToken" name="authToken" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Login</button>
            </div>
        </form>
        <p class="text-center text-sm text-gray-500 mt-4">Noch kein Konto? 
            <a href="register.php" class="text-blue-500 hover:underline">Registrieren</a>
        </p>
    </div>

    <script>
        const loginOption = document.getElementById('loginOption');
        const emailPasswordFields = document.getElementById('emailPasswordFields');
        const authTokenField = document.getElementById('authTokenField');

        loginOption.addEventListener('change', function () {
            if (loginOption.value === 'authToken') {
                emailPasswordFields.style.display = 'none';
                authTokenField.style.display = 'block';
            } else {
                emailPasswordFields.style.display = 'block';
                authTokenField.style.display = 'none';
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function (event) {
            if (loginOption.value === 'authToken' && !document.getElementById('authToken').value) {
                event.preventDefault();
                alert("Bitte Auth Token eingeben.");
            }
        });
    </script>
</body>
</html>
