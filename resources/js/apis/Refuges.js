import Api from "./Api";

export default {
    all() {
        return Api.get("refuges");
    },

    store(data) {
        return Api.post("refuges", data);
    },

    show(id) {
        return Api.get(`refuges/${id}`);
    },

    update(id, data) {
        return Api.patch(`refuges/${id}`, data);
    }
};
