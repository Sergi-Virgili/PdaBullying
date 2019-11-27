let places = [
    {
        name: "Centro1",
        type: "Formación",
        logo: "https://pdabullying.com/img/logo.png",
        lat: 41.39886,
        long: 2.16339
    },
    {
        name: "Centro1",
        type: "Formación",
        logo: "https://pdabullying.com/img/logo.png",
        lat: 41.3876768,
        long: 2.169259
    }
];

//Print PopUp
let popupHtml = `
    <img style='width:200px' src='${places[0].logo}'>
    <h3>${places[0].name}</h3>
    `;

var map = L.map("map").setView([41.39886, 2.16339], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {}).addTo(
    map
);

places.forEach(place => {
    createPlace(place.lat, place.long);
});

function createPlace(lat, long) {
    L.marker([lat, long])
        .addTo(map)
        .bindPopup(popupHtml);
}
