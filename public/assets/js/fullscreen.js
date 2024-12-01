// function requestFullScreen() {
//     if (!document.fullscreenElement) {
//         if (document.documentElement.requestFullscreen) {
//             document.documentElement.requestFullscreen();
//         } else if (document.documentElement.mozRequestFullScreen) { // Firefox
//             document.documentElement.mozRequestFullScreen();
//         } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
//             document.documentElement.webkitRequestFullscreen();
//         } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
//             document.documentElement.msRequestFullscreen();
//         }
//     }
// }

// // Function to exit full-screen mode
// function exitFullScreen() {
//     if (document.fullscreenElement) {
//         if (document.exitFullscreen) {
//             document.exitFullscreen();
//         } else if (document.mozCancelFullScreen) { // Firefox
//             document.mozCancelFullScreen();
//         } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
//             document.webkitExitFullscreen();
//         } else if (document.msExitFullscreen) { // IE/Edge
//             document.msExitFullscreen();
//         }
//     }
// }

// // Function to toggle full-screen mode and store the state in sessionStorage
// function toggleFullScreen() {
//     if (!document.fullscreenElement) {
//         requestFullScreen();
//         sessionStorage.setItem('isFullScreen', 'true');
//     } else {
//         exitFullScreen();
//         sessionStorage.removeItem('isFullScreen');
//     }
// }

// // Check the full-screen state on page load and apply it if needed
// document.addEventListener('DOMContentLoaded', (event) => {
//     if (sessionStorage.getItem('isFullScreen') === 'true') {
//         requestFullScreen();
//     }
// });

// Function to request full-screen mode
function requestFullScreen() {
    if (!document.fullscreenElement) {
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) { // Firefox
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
            document.documentElement.msRequestFullscreen();
        }
    }
}

// Function to exit full-screen mode
function exitFullScreen() {
    if (document.fullscreenElement) {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { // Firefox
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { // IE/Edge
            document.msExitFullscreen();
        }
    }
}

// Function to toggle full-screen mode and store the state in sessionStorage
function toggleFullScreen() {
    if (!document.fullscreenElement) {
        requestFullScreen();
        sessionStorage.setItem('isFullScreen', 'true');
    } else {
        exitFullScreen();
        sessionStorage.removeItem('isFullScreen');
    }
}

// Event listener to check full-screen state and reapply it with user interaction
document.addEventListener('DOMContentLoaded', (event) => {
    if (sessionStorage.getItem('isFullScreen') === 'true') {
        requestFullScreen();
    }
});