document.getElementById("tarih").addEventListener("change", function () {
  let tarih = this.value;
  let saatSelect = document.getElementById("saat");

  saatSelect.innerHTML = '<option value="">Saat Seçiniz</option>';

  fetch("saatler.php?tarih=" + tarih)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((item) => {
        let option = document.createElement("option");
        option.value = item.saat;
        option.textContent = item.saat;

        if (item.dolu) {
          option.disabled = true;
          option.textContent += " (Dolu)";
        }

        saatSelect.appendChild(option);
      });
    });
});
