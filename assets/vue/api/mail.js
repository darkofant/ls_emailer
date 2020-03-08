import axios from "axios";

export default {
  create(data) {
    return axios.post("/api/mails/create", data);
  },
  getAll() {
    return axios.get("/api/mails/list");
  },
  getInbox() {
    return axios.get("/api/mails/inbox");
  },
  getOutbox() {
    return axios.get("/api/mails/outbox");
  },
  getTrash() {
    return axios.get("/api/mails/trash");
  }
};