<template>
  <div class="container">
    <div class="mail-box">
      <app-sidebar :messages="mails"></app-sidebar>
      <app-content :messages="mails"></app-content>
    </div>
  </div>
</template>

<script>
  import Sidebar from './views/Sidebar.vue';
  import Content from './views/Content.vue';
  import { eventBus } from './index';

  export default {
    name: "App",
    created() {
      this.$store.dispatch("mail/getAll");
      eventBus.$on('sentMessage', (data) => {
          this.$store.dispatch("mail/create", {data});
      });
    },
    computed: {
        mails() {
        return this.$store.getters["mail/mails"];
        }
    },
    components: {
        appSidebar: Sidebar,
        appContent: Content
    }
  }
</script>