<?php

require_once 'dashboard/lib/data.php';

$home = selectHomePageData();
$events = selectEventsData();
$about = selectAboutData();
$testimonials = selectTestimonialsData();
$contact = selectContactData();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoboRave - Egypt</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" href="dashboard/upload/<?= $home['icon']; ?>" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="loader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

    <a href="#home" data-scroll id="to-top" style="display: none;">
        <i class="fas fa-chevron-up"></i>
    </a>

    <a href="rate.php" data-scroll id="rate" title="Rate Us">
        <i class="fas fa-star"></i>
    </a>


    <!-- Header -->
    <header class="wow animate__animated animate__fadeInDown" data-wow-delay="1s">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="dashboard/upload/<?= $home['logo'] ?>" alt="RoboRave"></a>
            </div>
            <nav>
                <ul>
                    <li class="active"><a href="#home" data-scroll>home</a></li>
                    <li><a href="#events" data-scroll>events</a></li>
                    <li><a href="#about-us" data-scroll>about us</a></li>
                    <li><a href="#testimonial" data-scroll>testimonial</a></li>
                    <li><a href="#blog" data-scroll>blog</a></li>
                    <li><a href="#contact-us" data-scroll>contact us</a></li>
                </ul>
            </nav>

            <!-- Navbar for mobile screens -->
            <nav class="mobile">
                <div class="icon" onclick="show_hide()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul id="menu" hidden>
                    <li><a href="#home">home</a></li>
                    <li><a href="#events">events</a></li>
                    <li><a href="#about-us">about us</a></li>
                    <li><a href="#testimonial">testimonial</a></li>
                    <li><a href="#blog">blog</a></li>
                    <li><a href="#contact-us">contact us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Landing -->
    <div class="landing" id="home">
        <div class="container">
            <div class="text wow animate__animated animate__fadeInLeft" data-wow-delay=".5s">
                <span><?= $home['slogan_first_line']; ?></span>
                <span><?= $home['slogan_second_line']; ?></span>
                <p><?= $home['description']; ?></p>
                <a href="<?= $home['read_more_link'] ?>" target="_blank" class="link">read more</a>
            </div>
            <div class="image wow animate__animated animate__fadeInRight" data-wow-delay=".5s">
                <img src="assets/img/img.png" alt="RoboRave - Egypt">
            </div>
            <div class="background wow animate__animated animate__fadeInRight" data-wow-delay=".5s"></div>
        </div>
    </div>

    <!-- Events -->
    <div class="events" id="events">
        <div class="container">
            <div class="title wow animate__animated animate__zoomIn" >events</div>

            <span class="no-event-data <?php if (!empty($events)) echo 'hide-data'; ?>">No events at the moment</span>

            <div class="events-content wow animate__animated animate__zoomIn owl-carousel owl-theme <?php if (empty($events)) echo 'hide-data'; ?>">
                <?php foreach ($events as $event): ?>
                <div class="event item">
                    <div class="icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="info">
                        <h2><?= $event['event_name'] ?></h2>
                        <span><?= $event['starting_time'] . ' - ' . $event['ending_time']; ?> </span>
                    </div>
                    <a href="<?= $event['event_info'] ?>" target="_blank">read more</a>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <!-- About Us -->
    <div class="about-us" id="about-us">
        <div class="container">
            <div class="title wow animate__animated animate__zoomIn" >about us</div>

            <p class="wow animate__animated animate__fadeInLeft" ><?= $about['description']; ?></p>
            <iframe width="100%" height="500px" src="https://www.youtube.com/embed/<?= $about['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="testimonials" id="testimonial">
        <div class="container">
            <div class="title wow animate__animated animate__zoomIn" >testimonial</div>
            <span class="no-event-data <?php if (!empty($testimonials)) echo 'hide-data'; ?>">No Rates</span>
            <div class="wow animate__animated animate__fadeInRight owl-carousel owl-theme">
                
                <?php foreach ($testimonials as $testimonial): if ($testimonial['accepted'] == '1'): ?>
                <div class="shape item" >
                    <img src="dashboard/upload/<?= $testimonial['avatar'] ?>" alt="<?= $testimonial['name']; ?>">
                    <div class="text">
                        <div class="rate">
                            <?php for ($i = 0; $i < $testimonial['rate']; $i++): ?>
                            <i class="fas fa-star active"></i>
                            <?php endfor; ?>
                        </div>
                        <h3><?= $testimonial['name']; ?></h3>
                        <p><?= $testimonial['description']; ?></p>
                    </div>
                </div>
                <?php endif; endforeach; ?>

            </div>
        </div>
    </div>

    <!-- Blog -->
    <div class="blog" id="blog">
        <div class="container">
            <div class="title wow animate__animated animate__zoomIn" >blog</div>
            <span class="no-data wow animate__animated animate__fadeInLeft" >comming soon</span>
        </div>
    </div>

    <!-- Contact Us -->
    <div class="contact-us" id="contact-us">
        <div class="container">
            <div class="title wow animate__animated animate__zoomIn" >contact us</div>
            <div class="contact-content">
                <div class="info wow animate__animated animate__fadeInLeft" >
                    <div class="data">
                        <div class="contact">
                            <i class="fas fa-mobile-alt"></i><span>+2<?= $contact['phone']; ?></span>
                        </div>
                        <div class="contact">
                            <i class="fas fa-envelope"></i><span><?= $contact['email']; ?></span>
                        </div>
                        <div class="contact">
                            <i class="fas fa-map-marker-alt"></i><span><?= $contact['location']; ?></span>
                        </div>
                    </div>
                    <div class="social">
                        <a href="<?= $contact['facebook']; ?>"><i class="fab fa-facebook-f"></i></a><a href="<?= $contact['twitter']; ?>"><i class="fab fa-twitter"></i></a><a href="<?= $contact['youtube']; ?>"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="wow animate__animated animate__fadeInUp">
        all copyrights reserved © <?= date("Y"); ?>
    </footer>

    <script src="assets/js/jq.js"></script>
    <!-- <script src="nicescroll/jquery.nicescroll.min.js"></script> -->
    <script src="assets/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="assets/js/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".events-content").owlCarousel({
                loop:true,
                margin: 16,
                responsiveClass:true,
                responsive:{
                    0:{
                        items: 1,
                        nav:false,
                    },
                    991:{
                        items: <?php echo count($events) < 2 ? 1 : 2 ?>,
                        nav:false,
                        loop:true
                    }
                }
            });
        });
    </script>

    <script src="assets/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>