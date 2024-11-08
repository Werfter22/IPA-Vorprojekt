<template>
  <div>
    <NavBar /> <!-- Navigation component -->

    <div class="home_content-Container">
      <div class="home_container_welcome">
        <h1 class="home_h1_welcome">Welcome</h1>
      </div>
    </div>

    <Footer /> <!-- Footer component -->
  </div>
</template>

<script setup>
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
</script>

<style scoped>
/* You can include additional styles specific to this component here */
</style>
