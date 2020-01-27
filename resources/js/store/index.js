import { getlocalUser } from "../apis/Auth"

const user = getlocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,

    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoading;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        login_success(state, payload) {
            state.auth_error = null;
            state.isLoading = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token})
            
            localStorage.setItem('user', JSON.stringify(state.currentUser))
        },
        login_failed(state, payload) {

            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem('user');
            state.isLoggedIn = false;
            state.currentUser = null;
        }

    },
    actions: {
        login(context) {
            context.commit('login')
        }
    }
}
