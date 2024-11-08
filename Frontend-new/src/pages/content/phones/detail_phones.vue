<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Telefon Nummer Details</h2>
      <form id="phoneDetailsForm" @submit.prevent="handleSubmit">
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
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <router-link to="/phones">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Änderungen speichern</button>
        </div>
      </form>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const route = useRoute();

const mobilePhones = ref(['', '', '', '', '', '', '', '', '', '']);
const workPhones = ref(['', '', '', '', '', '', '', '', '', '']);
const qrCode = ref('');
const barcode = ref('');

onMounted(() => {
  const phoneId = route.query.id; // Get phone ID from route
  fetchPhoneDetails(phoneId);
});

const fetchPhoneDetails = (id) => {
  // Mock fetching phone details for now
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
    tel_work_1: '123-456-7890',
    tel_work_2: '123-456-7891',
    tel_work_3: '123-456-7892',
    tel_work_4: '123-456-7893',
    tel_work_5: '123-456-7894',
    tel_work_6: '123-456-7895',
    tel_work_7: '123-456-7896',
    tel_work_8: '123-456-7897',
    tel_work_9: '123-456-7898',
    tel_work_10: '123-456-7899',
    qr_code: 'QRCodeSample',
    barcode: 'BarcodeSample'
  };

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
  const phoneData = {
    mobilePhones: mobilePhones.value,
    workPhones: workPhones.value,
    qrCode: qrCode.value,
    barcode: barcode.value,
  };
  console.log('Submitted Phone Data:', phoneData);
  // Add your API call logic here to save the data
};
</script>

<style scoped>
/* Additional styles can be added here if needed */
</style>
