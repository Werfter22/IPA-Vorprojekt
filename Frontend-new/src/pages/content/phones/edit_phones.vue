<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Telefon Nummer Bearbeiten</h2>
      <form @submit.prevent="handleSubmit">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Tel. Mobile -->
          <div class="space-y-4" v-for="(mobilePhone, index) in mobilePhones" :key="'mobile-' + index">
            <div>
              <label class="block text-sm font-medium text-gray-700">Tel. Mobile {{ index + 1 }}</label>
              <input
                type="text"
                v-model="mobilePhone"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required
              />
            </div>
          </div>

          <!-- Tel. Work -->
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
              <button type="button" @click="generateQRCode" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700">
                Neuer QR Code erstellen
              </button>
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
              <button type="button" @click="generateBarcode" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700">
                Neuer Barcode erstellen
              </button>
            </div>
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
            Änderungen übernehmen
          </button>
          <router-link to="/phones">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">
              Zurück
            </button>
          </router-link>
        </div>
      </form>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const mobilePhones = ref(Array(10).fill('')); // Initializes 10 mobile phone inputs
const workPhones = ref(Array(10).fill('')); // Initializes 10 work phone inputs
const qrCode = ref('');
const barcode = ref('');

// Fetch phone details when the component mounts
const route = useRoute();
const phoneId = route.query.id; // Get phone ID from the query parameters

onMounted(() => {
  fetchPhoneDetails(phoneId);
});

const fetchPhoneDetails = (id) => {
  // Fetch details from API or mock data
  // Mock data for demonstration purposes
  const phoneDetails = {
    tel_mobile_1: '123-456-7890',
    tel_mobile_2: '123-456-7891',
    tel_mobile_3: '123-456-7892',
    tel_mobile_4: '123-456-7893',
    tel_mobile_5: '123-456-7894',
    tel_mobile_6: '123-456-7895',
    tel_mobile_7: '123-456-7896',
    tel_mobile_8: '123-456-7897',
    tel_mobile_9: '123-456-7898',
    tel_mobile_10: '123-456-7899',
    tel_work_1: '098-765-4321',
    tel_work_2: '098-765-4322',
    tel_work_3: '098-765-4323',
    tel_work_4: '098-765-4324',
    tel_work_5: '098-765-4325',
    tel_work_6: '098-765-4326',
    tel_work_7: '098-765-4327',
    tel_work_8: '098-765-4328',
    tel_work_9: '098-765-4329',
    tel_work_10: '098-765-4330',
    qr_code: 'QRCodeSample',
    barcode: 'BarcodeSample',
  };

  // Populate the reactive variables
  mobilePhones.value = [
    phoneDetails.tel_mobile_1,
    phoneDetails.tel_mobile_2,
    phoneDetails.tel_mobile_3,
    phoneDetails.tel_mobile_4,
    phoneDetails.tel_mobile_5,
    phoneDetails.tel_mobile_6,
    phoneDetails.tel_mobile_7,
    phoneDetails.tel_mobile_8,
    phoneDetails.tel_mobile_9,
    phoneDetails.tel_mobile_10,
  ];

  workPhones.value = [
    phoneDetails.tel_work_1,
    phoneDetails.tel_work_2,
    phoneDetails.tel_work_3,
    phoneDetails.tel_work_4,
    phoneDetails.tel_work_5,
    phoneDetails.tel_work_6,
    phoneDetails.tel_work_7,
    phoneDetails.tel_work_8,
    phoneDetails.tel_work_9,
    phoneDetails.tel_work_10,
  ];

  qrCode.value = phoneDetails.qr_code;
  barcode.value = phoneDetails.barcode;
};

const handleSubmit = () => {
  // Handle form submission
  const phoneData = {
    mobilePhones: mobilePhones.value,
    workPhones: workPhones.value,
    qrCode: qrCode.value,
    barcode: barcode.value,
  };
  console.log('Submitted Phone Data:', phoneData);
  // Here, you can implement an API call to save the data
};

const generateQRCode = () => {
  alert('Generating QR Code...');
  // Add your QR code generation logic here
};

const generateBarcode = () => {
  alert('Generating Barcode...');
  // Add your barcode generation logic here
};
</script>

<style scoped>
/* Additional styles can be added here if needed */
</style>
