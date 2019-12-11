const geoFindMe = {
    msg: "hola",
    lat: "",
    lng: "",
    geoMarker: [],

    async findMe() {
        if (!navigator.geolocation) {
            this.msg = "Geolocalización no soportada";
            return null;
        }
        if (navigator.geolocation) {
            this.msg = "Localizando..";
            navigator.geolocation.getCurrentPosition(response => {
                this.lat = response.coords.latitude;
                this.lng = response.coords.longitude;
                this.geoMarker = [this.lat, this.lng];
                return this.geoMarker;
            });
        }
    }
};

export default geoFindMe;
