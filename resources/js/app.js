import "./bootstrap";

function toggleFullscreen() {
    const fullscreenIcon = document.getElementById("fullscreenIcon");
    const fullscreenTooltip = document.getElementById("fullscreenTooltip");
    const fullscreenToggle = document.getElementById("fullscreenToggle");

    if (!document.fullscreenElement) {
        // Check browser's fullscreen state
        // Enter fullscreen
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.msRequestFullscreen) {
            document.documentElement.msRequestFullscreen();
        }
    } else {
        // Exit fullscreen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
    // UI updates are handled by handleFullscreenChange event listener
}

// Listen for fullscreen change events from browser
document.addEventListener("fullscreenchange", handleFullscreenChange);
document.addEventListener("webkitfullscreenchange", handleFullscreenChange);
document.addEventListener("mozfullscreenchange", handleFullscreenChange);
document.addEventListener("MSFullscreenChange", handleFullscreenChange);

function handleFullscreenChange() {
    const fullscreenIcon = document.getElementById("fullscreenIcon");
    const fullscreenTooltip = document.getElementById("fullscreenTooltip");
    const fullscreenToggle = document.getElementById("fullscreenToggle");

    // Check if currently in fullscreen
    const isCurrentlyFullscreen =
        document.fullscreenElement ||
        document.webkitFullscreenElement ||
        document.mozFullScreenElement ||
        document.msFullscreenElement;

    isFullscreen = isCurrentlyFullscreen; // Update internal state

    if (isFullscreen) {
        fullscreenIcon.className = "fas fa-compress";
        fullscreenTooltip.textContent = "Keluar Layar Penuh";
        fullscreenToggle.classList.add("active");
    } else {
        fullscreenIcon.className = "fas fa-expand";
        fullscreenTooltip.textContent = "Mode Layar Penuh";
        fullscreenToggle.classList.remove("active");
    }

    // Trigger map resize after fullscreen state changes
    setTimeout(() => {
        if (map) {
            // Ensure map is initialized
            google.maps.event.trigger(map, "resize");
        }
    }, 100);
}

// ESC key to exit fullscreen (already handled by browser for native fullscreen)
// This part might be redundant as native fullscreen handles ESC, but good as a fallback
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && isFullscreen) {
        // No need to call toggleFullscreen() here, browser handles exit
        // If you had custom fullscreen, you would call it
    }
});
