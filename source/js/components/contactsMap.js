// Хелпер: ждем пока Google Maps API реально загрузится
function onGoogleMapsReady(callback) {
  if (typeof google !== "undefined" && google.maps) {
    callback();
  } else {
    const interval = setInterval(() => {
      if (typeof google !== "undefined" && google.maps) {
        clearInterval(interval);
        callback();
      }
    }, 100);
  }
}

// --- Карта контактов ---
function initContactsMap(mapEl) {
  if (mapEl.dataset.inited) return;
  mapEl.dataset.inited = "true";

  const items = mapEl.closest(".section-map__wrapp").querySelectorAll(".section-map__item");
  if (!items.length) return;

  const firstLat = parseFloat(items[0].dataset.lat);
  const firstLng = parseFloat(items[0].dataset.lng);

  const map = new google.maps.Map(mapEl, {
    zoom: 6,
    center: { lat: firstLat, lng: firstLng },
  });

  const bounds = new google.maps.LatLngBounds();

  items.forEach((item) => {
    const lat = parseFloat(item.dataset.lat);
    const lng = parseFloat(item.dataset.lng);

    if (!isNaN(lat) && !isNaN(lng)) {
      const marker = new google.maps.Marker({
        position: { lat, lng },
        map,
      });
      bounds.extend(marker.position);
    }
  });

  if (items.length > 1) map.fitBounds(bounds);
}

function initContactsMaps() {
  const contactsMaps = document.querySelectorAll("[data-contacts-map]");
  if (!contactsMaps.length) return;
  contactsMaps.forEach(initContactsMap);
}

// --- Запуск строго после загрузки DOM + API ---
document.addEventListener("DOMContentLoaded", () => {
  onGoogleMapsReady(initContactsMaps);
});
