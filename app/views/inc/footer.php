    </div>
    <script src="<?= ROOT_URL ?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?= ROOT_URL ?>/js/proper.min.js"></script>
    <script src="<?= ROOT_URL ?>/js/bootstrap.min.js"></script>
<!--    Fontawesome-->
    <script src="https://kit.fontawesome.com/dd74dfb74e.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT_URL ?>/js/owl.carousel.min.js"></script>
    <script src="<?= ROOT_URL ?>/js/main.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            });
        });
    </script>
</body>
</html>