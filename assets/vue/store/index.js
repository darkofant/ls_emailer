import Vue from "vue";
import Vuex from "vuex";
import MailModule from "./mail";

Vue.use(Vuex);
Vue.use(require('vue-moment'));

export default new Vuex.Store({
  modules: {
    mail: MailModule
  }
});