/**
 * Cart FAB (Floating Action Button) functionaliteit
 * Alleen zichtbaar wanneer er items in de cart zitten
 */
document.addEventListener('DOMContentLoaded', function() {
    const cartFab = document.getElementById('cart-fab');
    const cartCount = document.getElementById('cart-fab-count');
    
    if (!cartFab) return;
    
    // Toon FAB alleen wanneer er items in de cart zitten
    function toggleFabVisibility() {
        const hasItems = parseInt(cartCount.textContent) > 0;
        
        if (hasItems) {
            cartFab.classList.add('show');
            cartCount.classList.remove('empty');
        } else {
            cartFab.classList.remove('show');
            cartCount.classList.add('empty');
        }
    }
    
    // Check bij page load
    toggleFabVisibility();
    
    // Update cart count via AJAX wanneer product wordt toegevoegd
    document.addEventListener('added_to_cart', function() {
        // Update cart count
        fetch(woocommerce_params.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=get_cart_count'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cartCount.textContent = data.data.count;
                toggleFabVisibility();
            }
        })
        .catch(error => console.log('Error updating cart count:', error));
    });
    
    // Luister naar cart updates (bijvoorbeeld bij quantity changes)
    document.body.addEventListener('updated_wc_div', function() {
        // Herlaad de pagina om de cart count bij te werken
        // Dit gebeurt bijvoorbeeld na quantity updates in de cart
        setTimeout(toggleFabVisibility, 100);
    });
});