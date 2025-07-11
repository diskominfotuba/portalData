document.addEventListener("DOMContentLoaded", function () {
    // --- TANGGAL & WAKTU ---
    function updateTanggalWaktu() {
        const hari = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];
        const bulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        const now = new Date();
        const teksTanggal = `${hari[now.getDay()]}, ${now.getDate()} ${
            bulan[now.getMonth()]
        } ${now.getFullYear()} ${now
            .getHours()
            .toString()
            .padStart(2, "0")}:${now.getMinutes().toString().padStart(2, "0")}`;
        const el = document.getElementById("tanggalWaktu");
        if (el) el.textContent = teksTanggal;
    }

    updateTanggalWaktu();
    setInterval(updateTanggalWaktu, 60000);

    // --- FLIP CARD ---
    const flipCards = document.querySelectorAll(".flip-card");
    let currentCardIndex = 0;
    let currentSide = 0;
    setInterval(() => {
        flipCards.forEach((card) => {
            card.classList.remove("rotate-0", "rotate-1", "rotate-2");
        });
        const activeCard = flipCards[currentCardIndex];
        activeCard.classList.add(`rotate-${currentSide}`);
        currentSide = (currentSide + 1) % 3;
        if (currentSide === 0) {
            currentCardIndex = (currentCardIndex + 1) % flipCards.length;
        }
    }, 3000);

    // --- FULLSCREEN ---
    window.toggleFullScreen = function () {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch((err) => {
                alert(`Gagal masuk full screen: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    };

    // --- CUACA ---
    const API_KEY = "196ac04ee31d6f509b0eaa9fd8c9558c";
    const city = "Menggala";
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city},id&appid=${API_KEY}&units=metric&lang=id`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const arah = arahAngin(data.wind.deg);
            document.getElementById("cuaca-tanggal").innerText =
                new Date().toLocaleDateString("id-ID", {
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                });
            document.getElementById("suhu").innerText = Math.round(
                data.main.temp
            );
            document.getElementById("cuaca-kondisi").innerText =
                data.weather[0].description;
            document.getElementById(
                "kelembapan"
            ).innerText = `${data.main.humidity}%`;
            document.getElementById(
                "angin"
            ).innerText = `${data.wind.speed} km/jam`;
            document.getElementById("arah").innerText = arah;
            document.getElementById(
                "icon-cuaca"
            ).src = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
        })
        .catch((err) => {
            console.error("Gagal mengambil data cuaca:", err);
        });

    // --- ARAH ANGIN ---
    function arahAngin(degree) {
        const arah = [
            "Utara",
            "Timur Laut",
            "Timur",
            "Tenggara",
            "Selatan",
            "Barat Daya",
            "Barat",
            "Barat Laut",
        ];
        return arah[Math.round(degree / 45) % 8];
    }

    // --- FILTER KATEGORI ---
    const dropdown = document.getElementById("dropdownSearch");
    const cards = document.querySelectorAll("[data-kategori]");

    function filterCards(value) {
        cards.forEach((card) => {
            const kategori = card.getAttribute("data-kategori");
            if (value === "" || kategori === value) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }
    dropdown.addEventListener("change", function () {
        filterCards(this.value);
    });
    filterCards("");
    // --- TOMBOL KEMBALI KE ATAS ---
});
