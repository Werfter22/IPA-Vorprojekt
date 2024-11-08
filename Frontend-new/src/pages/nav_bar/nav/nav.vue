<template>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="hidden sm:block">
            <ul class="flex space-x-4">
              <li class="nav_home">
                <router-link to="../../content/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</router-link>
              </li>
              <li class="nav_users">
                <router-link to="../../content/users" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Benutzer</router-link>
              </li>
              <li class="nav_devices">
                <router-link to="../../content/devices" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Geräte</router-link>
              </li>
              <li class="nav_phones">
                <router-link to="../../content/phones" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Telefon</router-link>
              </li>
              <li class="nav_inventory">
                <router-link to="../../content/inventory" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inventar</router-link>
              </li>
              <li class="nav_machines">
                <router-link to="../../content/machines" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Maschinen</router-link>
              </li>
            </ul>
          </div>
        </div>

        <div class="flex items-center">
          <div class="nav_profile_container bg-white p-5">
            <router-link to="/profiles">
              <img class="h-8 w-8 rounded-[20%]" src="../../../../../Backend/Images/Profile/profile.png" alt="Profile Picture">
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
// You can add any script logic here if needed
</script>

<style scoped>
/* Add any additional styles specific to the navbar here */
</style>
