/**
 * Portfolio link enhancement script
 */
(function() {
  "use strict";
  
  document.addEventListener('DOMContentLoaded', function() {
    // Selecteer alle portfolio wraps
    const portfolioWraps = document.querySelectorAll('.portfolio-wrap');
    
    // Voeg click handler toe aan elke portfolio wrap
    if (portfolioWraps.length > 0) {
      portfolioWraps.forEach(function(wrap) {
        // Vind de detail link
        const detailLink = wrap.querySelector('.portfolio-details-link');
        
        if (detailLink) {
          const href = detailLink.getAttribute('href');
          
          // Als de hele portfolio wrap geklikt wordt, navigeer naar de detailpagina
          wrap.addEventListener('click', function(e) {
            // Voorkom dat het artikel opent in lightbox (als er op + wordt geklikt)
            if (e.target.closest('.portfolio-lightbox')) {
              return;
            }
            
            // Navigeer naar de detailpagina
            window.location.href = href;
          });
          
          // Maak de cursor een pointer om aan te geven dat het klikbaar is
          wrap.style.cursor = 'pointer';
        }
      });
    }
  });
  
})();
