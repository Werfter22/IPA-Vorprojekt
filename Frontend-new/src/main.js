import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Import the router

// Create the Vue app and use the router
createApp(App)
  .use(router)
  .mount('#app');
