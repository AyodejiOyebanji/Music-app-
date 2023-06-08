<script>
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

export default {
  // ...
  mounted() {
    this.$toast = VueToast;
  },
};
</script>

<template>
  <router-view></router-view>
</template>

<style scoped>

</style>
