/**
 * Script principal du thème InfoLibertaire Inspired
 */

jQuery(document).ready(function($) {
    
    // Preloader
    $(window).on('load', function() {
        $('.preloader').fadeOut(1000);
    });
    
    // Animation des cartes d'articles au scroll
    function animateOnScroll() {
        $('.article-card').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-in');
            }
        });
    }
    
    animateOnScroll();
    $(window).scroll(animateOnScroll);
    
    // Partage social avec popup
    $('.social-share a').click(function(e) {
        var url = $(this).attr('href');
        
        if (url.includes('facebook.com') || url.includes('twitter.com') || url.includes('t.me')) {
            e.preventDefault();
            
            var width = 600;
            var height = 400;
            var left = (screen.width / 2) - (width / 2);
            var top = (screen.height / 2) - (height / 2);
            
            window.open(url, 'share', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
        }
    });
    
    // Bouton "Retour en haut"
    var backToTop = $('<div class="back-to-top"><i class="fas fa-arrow-up"></i></div>');
    $('body').append(backToTop);
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTop.fadeIn();
        } else {
            backToTop.fadeOut();
        }
    });
    
    backToTop.click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
    });
    
});

// CSS pour les animations
var additionalCSS = `
    .article-card {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }
    
    .article-card.animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary-color);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: none;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 1000;
        transition: all 0.3s ease;
    }
    
    .back-to-top:hover {
        background: var(--hover-color);
        transform: translateY(-3px);
    }
`;

jQuery(document).ready(function($) {
    $('<style>').prop('type', 'text/css').html(additionalCSS).appendTo('head');
});