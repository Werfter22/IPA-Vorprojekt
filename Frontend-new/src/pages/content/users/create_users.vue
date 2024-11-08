<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Benutzer Erstellen</h2>
      <form @submit.prevent="handleSubmit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Lastname -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nachname</label>
              <input type="text" v-model="user.lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Firstname -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Vorname</label>
              <input type="text" v-model="user.firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Email 1 -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Email 1</label>
              <input type="email" v-model="user.email_1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Email 2 -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Email 2</label>
              <input type="email" v-model="user.email_2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Email 3 -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Email 3</label>
              <input type="email" v-model="user.email_3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- QR Code -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">QR Code</label>
              <input type="text" v-model="user.qr_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="flex items-center justify-between">
              <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateQRCode">Neuer QR Code generieren</button>
            </div>
          </div>

          <!-- Barcode -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Barcode</label>
              <input type="text" v-model="user.barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="flex items-center justify-between">
              <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateBarcode">Neuer Barcode generieren</button>
            </div>
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Benutzer erstellen</button>
          <router-link to="/users">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </form>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const user = ref({
  lastname: '',
  firstname: '',
  email_1: '',
  email_2: '',
  email_3: '',
  qr_code: '',
  barcode: ''
});

// Function to handle form submission
const handleSubmit = () => {
  // Logic to save the user data
  console.log('User Data:', user.value);
  alert('User created!');
};

// Function to generate QR Code
const generateQRCode = () => {
  // Logic to generate QR Code
  alert('Generating QR Code...');
};

// Function to generate Barcode
const generateBarcode = () => {
  // Logic to generate Barcode
  alert('Generating Barcode...');
};
</script>

<style scoped>
/* Add additional styles here if necessary */
</style>
