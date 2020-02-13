import Api from "./Api";

export function login(credentials) {
        return Api.post("login", credentials);
};

export function getlocalUser() {
    
    const userStr = localStorage.getItem('user')

    if(!userStr) {
        return null;
    }
 
    return JSON.parse(userStr);
}