<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">User Details</h2>
      <form id="userDetailsForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Lastname -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Lastname</label>
              <input type="text" v-model="user.lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Firstname -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Firstname</label>
              <input type="text" v-model="user.firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Email 1 -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Email 1</label>
              <input type="email" v-model="user.email_1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
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
          </div>

          <!-- Barcode -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Barcode</label>
              <input type="text" v-model="user.barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <router-link to="/users">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Go Back</button>
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

const route = useRoute();
const user = ref({
  lastname: 'Doe', // Replace with actual user data
  firstname: 'John',
  email_1: 'john.doe@example.com',
  email_2: 'johndoe@gmail.com',
  email_3: 'john@example.com',
  qr_code: 'QRCodeSample',
  barcode: 'BarcodeSample'
});

// Here you would typically fetch the user details based on the route parameter (userId)
// For example:
// const userId = route.params.id;
// fetchUserDetails(userId);
</script>

<style scoped>
/* Add additional styles here if necessary */
</style>
