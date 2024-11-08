<template>
  <div class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <div>
          <label for="loginOption" class="block text-sm font-medium text-gray-700">Login Methode</label>
          <select id="loginOption" v-model="loginOption" @change="toggleFields" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="emailPassword">Mit E-Mail und Passwort</option>
            <option value="authToken">Mit Auth Token</option>
          </select>
        </div>

        <!-- Email und Passwort Felder -->
        <div v-if="isEmailPassword">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" v-model="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
            <input type="password" id="password" v-model="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <!-- Auth Token Feld -->
        <div v-if="!isEmailPassword">
          <label for="authToken" class="block text-sm font-medium text-gray-700">Auth Token</label>
          <input type="text" id="authToken" v-model="authToken" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
          <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Login</button>
        </div>
      </form>
      <p class="text-center text-sm text-gray-500 mt-4">Noch kein Konto? 
        <router-link to="/register" class="text-blue-500 hover:underline">Registrieren</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const loginOption = ref('emailPassword');
const email = ref('');
const password = ref('');
const authToken = ref('');
const isEmailPassword = ref(true);

const toggleFields = () => {
  isEmailPassword.value = (loginOption.value === 'emailPassword');
};

const handleSubmit = () => {
  if (!isEmailPassword.value && !authToken.value) {
    alert("Bitte Auth Token eingeben.");
    return;
  }
  // Handle form submission here
  console.log("Form submitted", {
    email: isEmailPassword.value ? email.value : null,
    password: isEmailPassword.value ? password.value : null,
    authToken: !isEmailPassword.value ? authToken.value : null,
  });
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
