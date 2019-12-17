const geoFindMe = {
    msg: "hola",
    lat: "",
    lng: "",
    geoMarker: [],

    getCoordinates() {
        return new Promise(function(resolve, reject) {
            navigator.geolocation.getCurrentPosition(resolve, reject);
        });
    },
    async findMe() {
        if (!navigator.geolocation) {
            this.msg = "Geolocalización no soportada";
            return null;
        }
        if (navigator.geolocation) {
            this.msg = "Localizando..";
            let response = await this.getCoordinates();

            this.lat = response.coords.latitude;
            this.lng = response.coords.longitude;
            this.geoMarker = [this.lat, this.lng];
            return this.geoMarker;
        }
    }
};

export default geoFindMe;
