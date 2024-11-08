<template>
  <div class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
      <h2 class="text-2xl font-bold text-center mb-6">Benutzer Registrierung</h2>
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <!-- Vorname -->
        <div>
          <label for="firstName" class="block text-sm font-medium text-gray-700">Vorname</label>
          <input type="text" id="firstName" v-model="firstName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Nachname -->
        <div>
          <label for="lastName" class="block text-sm font-medium text-gray-700">Nachname</label>
          <input type="text" id="lastName" v-model="lastName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Emails -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email1" v-model="emails[0]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <button type="button" @click="addEmail" class="mt-2 text-blue-500 hover:underline text-sm">+ Weitere Email hinzufügen</button>
        </div>

        <!-- Passwort -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
          <input type="password" id="password" v-model="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Passwort bestätigen -->
        <div>
          <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Passwort bestätigen</label>
          <input type="password" id="confirmPassword" v-model="confirmPassword" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Benutzername -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Benutzername</label>
          <input type="text" id="username" v-model="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Rolle -->
        <div>
          <label for="role" class="block text-sm font-medium text-gray-700">Rolle</label>
          <select id="role" v-model="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
            <input type="text" id="authToken" v-model="authToken" readonly class="flex-grow mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="button" @click="generateToken" class="ml-2 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">Generieren</button>
          </div>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Registrieren</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const firstName = ref('');
const lastName = ref('');
const emails = ref(['']);
const password = ref('');
const confirmPassword = ref('');
const username = ref('');
const role = ref('Mitarbeiter');
const authToken = ref('');

// Add a new email input field
const addEmail = () => {
  if (emails.value.length < 3) {
    emails.value.push('');
  }
};

// Generate a random auth token
const generateToken = () => {
  const token = Math.random().toString(36).substr(2, 12);
  authToken.value = token;
};

// Handle form submission
const handleSubmit = () => {
  if (password.value !== confirmPassword.value) {
    alert("Passwörter stimmen nicht überein.");
    return;
  }
  // Handle registration logic here
  console.log("Form submitted", {
    firstName: firstName.value,
    lastName: lastName.value,
    emails: emails.value,
    password: password.value,
    username: username.value,
    role: role.value,
    authToken: authToken.value,
  });
};
</script>

<style scoped>
/* Add any additional styles here if necessary */
</style>
