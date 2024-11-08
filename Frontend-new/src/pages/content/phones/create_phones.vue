<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Telefon Nummern erfassen</h2>
      <form @submit.prevent="handleSubmit" id="createPhonesForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Tel. Mobile 1 -->
          <div class="space-y-4" v-for="(phone, index) in mobilePhones" :key="'mobile-' + index">
            <div>
              <label class="block text-sm font-medium text-gray-700">Tel. Mobile {{ index + 1 }}</label>
              <input
                type="text"
                v-model="phone"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required
              />
            </div>
          </div>

          <!-- Tel. Work 1 -->
          <div class="space-y-4" v-for="(workPhone, index) in workPhones" :key="'work-' + index">
            <div>
              <label class="block text-sm font-medium text-gray-700">Tel. Arbeit {{ index + 1 }}</label>
              <input
                type="text"
                v-model="workPhone"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
          </div>

          <!-- QR Code -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">QR Code</label>
              <input
                type="text"
                v-model="qrCode"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div class="flex items-center justify-between">
              <button type="button" @click="generateQRCode" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700">Neuer QR Code generieren</button>
            </div>
          </div>

          <!-- Barcode -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Barcode</label>
              <input
                type="text"
                v-model="barcode"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div class="flex items-center justify-between">
              <button type="button" @click="generateBarcode" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700">Neuer Barcode generieren</button>
            </div>
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700">Erstellen</button>
          <router-link to="/phones">
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
import { useRouter } from 'vue-router';

const router = useRouter();

const mobilePhones = ref(Array(10).fill('')); // Initialize with 10 empty fields for mobile phones
const workPhones = ref(Array(10).fill('')); // Initialize with 10 empty fields for work phones
const qrCode = ref('');
const barcode = ref('');

const handleSubmit = () => {
  const phoneData = {
    mobile: mobilePhones.value,
    work: workPhones.value,
    qr_code: qrCode.value,
    barcode: barcode.value,
  };
  console.log('Phone Data:', phoneData);
  // Here you can make an API call to save the data
};

const generateQRCode = () => {
  alert('Generate QR Code button clicked!');
  // Add functionality to generate QR Code
};

const generateBarcode = () => {
  alert('Generate Barcode button clicked!');
  // Add functionality to generate Barcode
};
</script>

<style scoped>
/* Additional styles can be added here if needed */
</style>
