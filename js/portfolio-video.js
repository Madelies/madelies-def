/**
 * Portfolio Video enhancement script
 * Zorgt ervoor dat video's correct worden afgespeeld in de Swiper
 */
(function() {
  "use strict";
  
  // Wacht tot de DOM volledig is geladen
  document.addEventListener('DOMContentLoaded', function() {
    
    // Zoek portfolio video slides
    const portfolioVideos = document.querySelectorAll('.portfolio-details-slider video');
    
    if (portfolioVideos.length > 0) {
      portfolioVideos.forEach(function(video) {
        // Zorg ervoor dat video's automatisch afspelen
        video.addEventListener('loadeddata', function() {
          video.play();
        });
        
        // Pauzeer video's wanneer ze niet in beeld zijn
        video.closest('.swiper-slide').addEventListener('transitionend', function(e) {
          if (!this.classList.contains('swiper-slide-active')) {
            video.pause();
          } else {
            video.play();
          }
        });
      });
      
      // Voeg event toe om video's te pauzeren bij tab wisselen
      document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
          portfolioVideos.forEach(function(video) {
            video.pause();
          });
        } else {
          const activeVideo = document.querySelector('.swiper-slide-active video');
          if (activeVideo) {
            activeVideo.play();
          }
        }
      });
    }
    
  });
  
})();
