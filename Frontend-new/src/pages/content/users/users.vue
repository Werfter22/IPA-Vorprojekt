<template>
  <div class="bg-gray-100 font-sans text-xs">
    <NavBar />

    <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
      <h1 class="text-2xl font-bold text-center mb-4">Benutzer Liste</h1>

      <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mb-2 text-xs" @click="addUser">Hinzufügen</button>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
          <thead class="bg-yellow-400">
            <tr>
              <th class="py-1 px-2 border-b text-left text-gray-700">Nachname</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Vorname</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Email 1</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Email 2</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Email 3</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">QR Code</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Barcode</th>
              <th class="py-1 px-2 border-b text-left text-gray-700">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!users.length">
              <td colspan="8" class="text-center py-4">Keine Benutzerdaten gefunden.</td>
            </tr>
            <tr v-for="user in users" :key="user.user_id" :id="'user-' + user.user_id" class="hover:bg-gray-50">
              <td class="py-1 px-2 border-b">
                <span class="user-lastname">{{ user.lastname }}</span>
                <input type="text" class="user-lastname-input hidden" v-model="user.lastname" />
              </td>
              <td class="py-1 px-2 border-b">
                <span class="user-firstname">{{ user.firstname }}</span>
                <input type="text" class="user-firstname-input hidden" v-model="user.firstname" />
              </td>
              <td class="py-1 px-2 border-b">
                <span class="user-email_1">{{ user.email_1 }}</span>
                <input type="text" class="user-email_1-input hidden" v-model="user.email_1" />
              </td>
              <td class="py-1 px-2 border-b">
                <span class="user-email_2">{{ user.email_2 }}</span>
                <input type="text" class="user-email_2-input hidden" v-model="user.email_2" />
              </td>
              <td class="py-1 px-2 border-b">
                <span class="user-email_3">{{ user.email_3 }}</span>
                <input type="text" class="user-email_3-input hidden" v-model="user.email_3" />
              </td>
              <td class="py-1 px-2 border-b">
                <div class="qr-code" style="width: 40px; height: 40px;" :data-qr="`Name: ${user.firstname} ${user.lastname}, Email: ${user.email_1}`"></div>
              </td>
              <td class="py-1 px-2 border-b">{{ user.barcode }}</td>
              <td class="py-1 px-2 border-b">
                <div class="flex space-x-1">
                  <button class="bg-black text-white py-1 px-1 rounded hover:bg-gray-800 text-xs" @click="viewDetails(user.user_id)">
                    <i class="fas fa-eye" style="font-size: 20px;"></i>
                  </button>
                  <button class="bg-yellow-500 text-white py-1 px-1 rounded hover:bg-yellow-600 text-xs" @click="editUser(user.user_id)">
                    <i class="fas fa-pencil-alt" style="font-size: 20px;"></i>
                  </button>
                  <button class="bg-red-500 text-white py-1 px-1 rounded hover:bg-red-600 text-xs" @click="deleteUser(user.user_id)">
                    <i class="fas fa-trash" style="font-size: 20px;"></i>
                  </button>
                </div>
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
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRouter } from 'vue-router';

const router = useRouter();
const users = ref([]);

// Fetch users from the API
const fetchUsers = async () => {
  try {
    const response = await fetch('http://127.0.0.1:3000/api/users');
    if (!response.ok) throw new Error('Network response was not ok');
    users.value = await response.json();
  } catch (error) {
    console.error('Fehler beim Abrufen der Benutzerdaten:', error);
  }
};

onMounted(fetchUsers);

const addUser = () => {
  router.push('/create_users'); // Route to the create user page
};

const viewDetails = (userId) => {
  router.push(`/detail_users?id=${userId}`); // Route to user detail page
};

const editUser = (userId) => {
  router.push(`/edit_users?id=${userId}`); // Route to edit user page
};

const deleteUser = async (userId) => {
  if (confirm('Möchten Sie diesen Benutzer wirklich löschen?')) {
    try {
      const response = await fetch(`http://127.0.0.1:3000/api/users/${userId}`, {
        method: 'DELETE',
      });
      if (response.ok) {
        alert('Benutzer erfolgreich gelöscht.');
        fetchUsers(); // Refresh the user list
      } else {
        alert('Fehler beim Löschen des Benutzers.');
      }
    } catch (error) {
      console.error('Fehler beim Löschen des Benutzers:', error);
    }
  }
};
</script>

<style scoped>
/* Add additional styles here if necessary */
</style>
