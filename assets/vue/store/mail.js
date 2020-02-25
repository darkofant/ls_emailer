import MailAPI from "../api/mail";

const CREATING_MAIL = "CREATING_MAIL",
  CREATING_MAIL_SUCCESS = "CREATING_MAIL_SUCCESS",
  CREATING_MAIL_ERROR = "CREATING_MAIL_ERROR",
  FETCHING_MAILS = "FETCHING_MAILS",
  FETCHING_MAILS_SUCCESS = "FETCHING_MAILS_SUCCESS",
  FETCHING_MAILS_ERROR = "FETCHING_MAILS_ERROR";

export default {
  namespaced: true,
  state: {
    isLoading: false,
    error: null,
    mails: []
  },
  getters: {
    isLoading(state) {
      return state.isLoading;
    },
    hasError(state) {
      return state.error !== null;
    },
    error(state) {
      return state.error;
    },
    hasMails(state) {
      return state.mails.length > 0;
    },
    mails(state) {
      return state.mails;
    }
  },
  mutations: {
    [CREATING_MAIL](state) {
      state.isLoading = true;
      state.error = null;
    },
    [CREATING_MAIL_SUCCESS](state, post) {
      state.isLoading = false;
      state.error = null;
      state.posts.unshift(post);
    },
    [CREATING_MAIL_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.posts = [];
    },
    [FETCHING_MAILS](state) {
      state.isLoading = true;
      state.error = null;
      state.mails = [];
    },
    [FETCHING_MAILS_SUCCESS](state, mails) {
      state.isLoading = false;
      state.error = null;
      state.mails = mails;
    },
    [FETCHING_MAILS_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.mails = [];
    }
  },
  actions: {
    async create({ commit }, data) {
      commit(CREATING_MAIL);
      try {
        let response = await MailAPI.create(data);
        commit(CREATING_MAIL_SUCCESS, response.data);
        return response.data;
      } catch (error) {
        commit(CREATING_MAIL_ERROR, error);
        return null;
      }
    },
    async getAll({ commit }) {
      commit(FETCHING_MAILS);
      try {
        let response = await MailAPI.getAll();
        commit(FETCHING_MAILS_SUCCESS, response.data);
        return response.data;
      } catch (error) {
        commit(FETCHING_MAILS_ERROR, error);
        return null;
      }
    }
  }
};