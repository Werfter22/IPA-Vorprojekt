<template>
  <div class="bg-gray-100 font-sans text-xs">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
      <h1 class="text-2xl font-bold text-center mb-4">Telefon Nummer Liste</h1>

      <button @click="goToCreate" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mb-2 text-xs">Hinzufügen</button>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
          <thead class="bg-yellow-400">
            <tr>
              <th class="py-1 px-1 border-b text-left text-gray-700">Phone ID</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 1</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 2</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 3</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 4</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 5</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Work 1</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Work 2</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Work 3</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Work 4</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Work 5</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">QR Code</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Barcode</th>
              <th class="py-1 px-1 border-b text-left text-gray-700">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="phone in phones" :key="phone.phone_id" class="hover:bg-gray-50">
              <td class="py-1 px-1 border-b">{{ phone.phone_id }}</td>
              
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.mobile_number_1 }}</span>
                <input type="text" v-model="phone.mobile_number_1" class="phone-input hidden text-xs" />
                <span class="edit-icon cursor-pointer text-blue-500" @click="editPhone(phone)">✏️</span>
                <button class="save-button hidden bg-green-500 text-white py-1 px-1 rounded hover:bg-green-600 text-xs" @click="savePhone(phone)">✔️</button>
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.mobile_number_2 }}</span>
                <input type="text" v-model="phone.mobile_number_2" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.mobile_number_3 }}</span>
                <input type="text" v-model="phone.mobile_number_3" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.mobile_number_4 }}</span>
                <input type="text" v-model="phone.mobile_number_4" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.mobile_number_5 }}</span>
                <input type="text" v-model="phone.mobile_number_5" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.work_number_1 }}</span>
                <input type="text" v-model="phone.work_number_1" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.work_number_2 }}</span>
                <input type="text" v-model="phone.work_number_2" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.work_number_3 }}</span>
                <input type="text" v-model="phone.work_number_3" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.work_number_4 }}</span>
                <input type="text" v-model="phone.work_number_4" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">
                <span class="phone-value">{{ phone.work_number_5 }}</span>
                <input type="text" v-model="phone.work_number_5" class="phone-input hidden text-xs" />
              </td>
              <td class="py-1 px-1 border-b">{{ phone.qr_code }}</td>
              <td class="py-1 px-1 border-b">{{ phone.barcode }}</td>
              
              <td class="py-1 px-1 border-b">
                <button class="bg-black text-white py-1 px-1 rounded hover:bg-gray-800 text-xs" @click="goToDetail(phone.phone_id)">
                  <i class="fas fa-eye" style="font-size: 20px;"></i>
                </button>
                <button class="bg-yellow-500 text-white py-1 px-1 rounded hover:bg-yellow-600 text-xs" @click="goToEdit(phone.phone_id)">
                  <i class="fas fa-pencil-alt" style="font-size: 20px;"></i>
                </button>
                <button class="bg-red-500 text-white py-1 px-1 rounded hover:bg-red-600 text-xs" @click="confirmDelete(phone.phone_id)">
                  <i class="fas fa-trash" style="font-size: 20px;"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const phones = ref([]);
const router = useRouter();

// Fetch phone data when the component mounts
onMounted(async () => {
  await fetchPhones();
});

// Fetch phones from API
const fetchPhones = async () => {
  try {
    const response = await fetch('http://127.0.0.1:3000/api/phones');
    phones.value = await response.json();
  } catch (error) {
    console.error('Error fetching phones:', error);
  }
};

// Go to create phone page
const goToCreate = () => {
  router.push('/create-phones');
};

// Go to detail page for a specific phone
const goToDetail = (phoneId) => {
  router.push({ path: `/phones/${phoneId}` });
};

// Go to edit page for a specific phone
const goToEdit = (phoneId) => {
  router.push({ path: `/edit-phones/${phoneId}` });
};

// Confirm and delete a phone
const confirmDelete = (phoneId) => {
  const confirmed = confirm('Möchten Sie dieses Handy wirklich löschen?');
  if (confirmed) {
    deletePhone(phoneId);
  }
};

// Delete phone
const deletePhone = async (phoneId) => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/phones/${phoneId}`, {
      method: 'DELETE',
    });
    if (response.ok) {
      await fetchPhones(); // Refresh the list after deletion
    } else {
      console.error('Error deleting phone:', response.statusText);
    }
  } catch (error) {
    console.error('Error deleting phone:', error);
  }
};

// Edit phone information
const editPhone = (phone) => {
  // Logic to edit phone details
  console.log('Editing phone:', phone);
};

// Save changes to the phone data
const savePhone = async (phone) => {
  // Logic to save updated phone details
  console.log('Saving phone:', phone);
};
</script>

<style scoped>
/* Add additional styles here if necessary */
</style>
