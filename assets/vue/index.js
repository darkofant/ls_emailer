import Vue from "vue";
import App from "./App";
import router from "./router";

export const eventBus = new Vue();

new Vue({
  components: { App },
  template: "<App/>",
  router
}).$mount("#app");