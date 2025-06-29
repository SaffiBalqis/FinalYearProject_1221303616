<!doctype html>
<html lang="en">
    <head>
        
    @include('home.homecss')

    </head>
    
    <body id="section_1">

        @include('home.header')
        
        <main>

            <section class="hero-section hero-section-full-height">
                @include('home.banner')
            </section>

            <section class="section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-10 col-12 text-center mx-auto">
                            <h2 class="mb-5">Welcome to KongsiMakan</h2>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="featured-block d-flex justify-content-center align-items-center">
                                <a href="{{route('register')}}" class="d-block">
                                    <img src="images/icons/hands.png" class="featured-block-image img-fluid" alt="">

                                    <p class="featured-block-text">Become a <strong>contributor</strong></p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                            <div class="featured-block d-flex justify-content-center align-items-center">
                                <a href="{{route('register')}}" class="d-block">
                                    <img src="images/icons/heart.png" class="featured-block-image img-fluid" alt="">

                                    <p class="featured-block-text"><strong>Caring</strong> Community</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                            <div class="featured-block d-flex justify-content-center align-items-center">
                                <a href="{{route('register')}}" class="d-block">
                                    <img src="images/icons/receive.png" class="featured-block-image img-fluid" alt="">

                                    <p class="featured-block-text">Claim<strong> now!</strong></p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="featured-block d-flex justify-content-center align-items-center">
                                <a href="{{route('login')}}" class="d-block">
                                    <img src="images/icons/scholarship.png" class="featured-block-image img-fluid" alt="">

                                    <p class="featured-block-text"><strong>Login</strong> now</p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="section-padding section-bg" id="section_2">
               @include('home.aboutus')
            </section>

            <section class="section-padding" id="section_3">
               @include('home.causes')
            </section>

            <section class="news-section section-padding" id="section_5">
                @include('home.news')
            </section>

        </main>

        <footer class="site-footer">
            @include('home.footer')
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>