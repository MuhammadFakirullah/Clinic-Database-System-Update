<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Awesome font CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Add this CSS for the slide-down animation */
        .slide-in {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .slide-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Splide Pagination */
        .splide__pagination {
            display: flex;
            justify-content: center;
            margin-top: 10px; /* Adjust the margin as needed */
        }

        /* For screens 768px and below (mobile) */
        @media screen and (max-width: 768px) {
            #desktopPage {
                display: none; /* Hide the desktop container in mobile mode */
            }
            #mobilePage {
                display: block; /* Show the mobile container in mobile mode */
            }
        }

        /* For screens above 768px (desktop) */
        @media screen and (min-width: 769px) {
            #desktopPage {
                display: block; /* Show the desktop container in desktop mode */
            }
            #mobilePage {
                display: none; /* Hide the mobile container in desktop mode */
            }
        }
    </style>

    <!-- Splide.js script & cdn -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
</head>
<body class="bg-warning">
    <div id="desktopPage"> <!-- Container for desktop -->
        
    <br><br>
    <div class="section1 slide-in my-5">
        <div class="header mt-5">
            <div class="d-flex justify-content-center align-items-center">
                <h1>Hello!</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <p class="mt-3">I'm a creative fullstack web developer &lt;/&gt;</p>
            </div>
        </div>
        <div class="body">
            <div class="d-flex justify-content-center mt-5">
                <div>
                    <img src="person.jpg" alt="person" width="230" height="270">
                </div>
                <div>
                    <div class="m-3">
                        <h5>About me</h5>
                        I embarked on my web development journey several years ago, <br> and since then, 
                        I've been on a thrilling adventure through the <br> ever-evolving landscape of web 
                        technologies. From front-end <br> development, where I meticulously bring designs 
                        to life with <br> HTML, CSS, and JavaScript, to back-end development, where I<br> 
                        architect robust and scalable server-side solutions, I've honed <br> my skills to 
                        create seamless, user-friendly websites and applica- <br> tions.
                    </div>
                </div>
                <div>
                    <div class="m-3">
                        <h5>Details</h5>
                        <p>
                            <b>Name:</b><br>
                            Muhammad Fakirullah
                        </p>
                        <p>
                            <b>Age:</b><br>
                            24 years
                        </p>
                        <p>
                            <b>Location:</b><br>
                            Jalan Ladang Sekolah, Kuala Terengganu
                        </p>
                        <div class="social">
                            <a href=""><i class="fab fa-facebook-f" style="color: #000000; font-size: 16px;"></i></a>&nbsp;
                            <a href=""><i class="fab fa-linkedin-in" style="color: #000000; font-size: 16px;"></i></a>&nbsp;
                            <a href=""><i class="fab fa-github" style="color: #000000; font-size: 16px;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="my-5">
        <div class="section2 slide-in">
            <div class="header mt-5">
                <div class="d-flex justify-content-center align-items-center">
                    <h2>My Projects</h2>
                </div>
                <div class="d-flex justify-content-center align-items-center"> 
                    <p class="mt-3 text-center">Discover my web projects, from practical tools like the Zakat Calculator and Weather API to collaborative<br> 
                        systems like the Courier and Voting Systems, showcasing my versatility as a fullstack web developer.</p>
                </div>
            </div>

            <div class="body">
                <div class="d-flex justify-content-center mt-2">
                <section class="splide" aria-labelledby="carousel-heading" style="width:80%;">
                <div class="splide__track">
                    <ul class="splide__list">
                        <!-- Content 1 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/zakat.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Zakat Calculator</h5>
                                                        <p class="card-text">The Zakat Calculator is a web tool built with HTML, CSS, and JavaScript for Muslims to calculate their Zakat, an important charity practice in Islam. View this project now.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Zakat-Calculator" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 2 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/weather.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Weather API</h5>
                                                        <p class="card-text">A Weather API developed using HTML, CSS, and JavaScript to provide real-time weather information for various regions in Malaysia, helping users stay updated on local weather.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Weather-API" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="splide_pagination mt-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 3 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/courier.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Courier System</h5>
                                                        <p class="card-text">"This is my pre final year project, a collaborative effort with my teammates. Thus far, the project adheres to established standards and fulfills the requirements set by our instructors."</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Courier-Web-Based-System-Courier-Express-" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 4 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/ecommerce.png" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">E-Commerce Homepage</h5>
                                                        <p class="card-text">E-Commerce Homepage is my project developed using HTML and Bootstrap, and it is actually self-learning projects to empower my skills in understanding bootstrap structures.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/e-commerce-homepage" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 5 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/temphumi.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Temperature & Humidity</h5>
                                                        <p class="card-text">This is my first IoT projects, develop using python, sensors and actuators, and integrated with FavorIoT platform  to get real time temperature & humidity readings.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Temp-Humi-project" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div><br>
                                                <!-- <div class="splide__pagination"></div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 6 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/rain.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Rain Detector System</h5>
                                                        <p class="card-text">This is Rain detector system IoT based project, developed it using python language and integrate with sensors and actuators and FavorIoT cloud platform.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Rain-detector-system-project" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                </section>

                </div>
            </div>
           
        </div>
    </div>
    
    <!-- JavaScript to trigger the slide-down animation on scroll -->
    <script>
        // Function to check if an element is in the viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Function to handle the slide-down animation
        function handleAnimation() {
            const elements = document.querySelectorAll('.slide-in');
            elements.forEach((element) => {
                if (isInViewport(element)) {
                    element.classList.add('active');
                }
            });
        }

        // Initial check and add scroll event listener
        handleAnimation();
        window.addEventListener('scroll', handleAnimation);
    </script>

    </div>
    <div id="mobilePage" style="display: none;"> <!-- Container for mobile/tablet -->
    
    <br><br>
    <div class="section1">
        <div class="header mt-3">
            <div class="d-flex justify-content-center align-items-center">
                <h1 style="font-size:60px;">Hello!</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <p class="mt-3" style="font-size:16px;">I'm a creative fullstack web developer &lt;/&gt;</p>
            </div>
        </div>
        <div class="body">
                <div class="mt-4 d-flex justify-content-center">
                    <img src="person.jpg" alt="person" width="320" height="350">
                </div>
                <div class="mt-4 m-4">
                    <h5>About me</h5>
                    <p style="text-align:justify;">
                    I embarked on my web development journey several years ago, and since then, 
                    I've been on a thrilling adventure through the ever-evolving landscape of web 
                    technologies. From front-end development, where I meticulously bring designs 
                    to life with HTML, CSS, and JavaScript, to back-end development, where I 
                    architect robust and scalable server-side solutions, I've honed my skills to 
                    create seamless, user-friendly websites and applications.
                    </p>
                </div>
                <div class="m-4">
                    <h5>Details</h5>
                    <p>
                        <b>Name:</b>
                        Muhammad Fakirullah
                    </p>
                    <p>
                        <b>Age:</b>
                        24 years
                    </p>
                    <p>
                        <b>Location:</b>
                        Jalan Ladang Sekolah, Kuala Terengganu
                    </p>
                    <div class="social">
                        <a href=""><i class="fab fa-facebook-f" style="color: #000000; font-size: 16px;"></i></a>&nbsp;
                        <a href=""><i class="fab fa-linkedin-in" style="color: #000000; font-size: 16px;"></i></a>&nbsp;
                        <a href=""><i class="fab fa-github" style="color: #000000; font-size: 16px;"></i></a>
                    </div>
                </div>
        </div>
    </div>
    <div class="my-5">
        <div class="section2">
            <div class="header mt-5">
                <div class="d-flex justify-content-center align-items-center">
                    <h1>My Projects</h1>
                </div>
                <div class="d-flex justify-content-center"> 
                    <p class="mt-4 m-4" style="text-align:justify;">Discover my web projects, from practical tools like the Zakat Calculator and Weather API to collaborative 
                        systems like the Courier and Voting Systems, showcasing my versatility as a fullstack web developer.</p>
                </div>
            </div>

            <div class="body">
                <div class="d-flex justify-content-center mt-2">
                <section class="splide" aria-labelledby="carousel-heading" style="width:80%;">
                <div class="splide__track">
                    <ul class="splide__list">
                        <!-- Content 1 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/zakat.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Zakat Calculator</h5>
                                                        <p class="card-text">The Zakat Calculator is a web tool built with HTML, CSS, and JavaScript for Muslims to calculate their Zakat, an important charity practice in Islam. View this project now.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Zakat-Calculator" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 2 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/weather.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Weather API</h5>
                                                        <p class="card-text">A Weather API developed using HTML, CSS, and JavaScript to provide real-time weather information for various regions in Malaysia, helping users stay updated on local weather.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Weather-API" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="splide_pagination mt-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 3 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/courier.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Courier System</h5>
                                                        <p class="card-text">"This is my pre final year project, a collaborative effort with my teammates. Thus far, the project adheres to established standards and fulfills the requirements set by our instructors."</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Courier-Web-Based-System-Courier-Express-" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 4 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/ecommerce.png" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">E-Commerce Homepage</h5>
                                                        <p class="card-text">E-Commerce Homepage is my project developed using HTML and Bootstrap, and it is actually self-learning projects to empower my skills in understanding bootstrap structures.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/e-commerce-homepage" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 5 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/temphumi.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Temperature & Humidity</h5>
                                                        <p class="card-text">This is my first IoT projects, develop using python, sensors and actuators, and integrated with FavorIoT platform  to get real time temperature & humidity readings.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Temp-Humi-project" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div><br>
                                                <!-- <div class="splide__pagination"></div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Content 6 -->
                        <li class="splide__slide">
                            <div class="body">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="container d-flex justify-content-center">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <img src="developerImg/rain.jpg" alt="" class="card-img-top img-fluid" style="height: 200px; width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Rain Detector System</h5>
                                                        <p class="card-text">This is Rain detector system IoT based project, developed it using python language and integrate with sensors and actuators and FavorIoT cloud platform.</p>
                                                        <a href="https://github.com/MuhammadFakirullah/Rain-detector-system-project" class="btn btn-outline-success btn-sm" target="_blank">View Code</a>
                                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                </section>

                </div>
            </div>
           
        </div>
    </div>
    
    </div>

    <!-- JavaScript to determine which container to display based on screen size -->
    <script>
        // Function to check screen size and show/hide containers
        function checkScreenSize() {
            const desktopContainer = document.getElementById('desktopPage');
            const mobileContainer = document.getElementById('mobilePage');
            
            if (window.innerWidth <= 768) { // Adjust the breakpoint as needed
                desktopContainer.style.display = 'none';
                mobileContainer.style.display = 'block';
            } else {
                desktopContainer.style.display = 'block';
                mobileContainer.style.display = 'none';
            }
        }

        // Initial check and add a resize event listener
        checkScreenSize();
        window.addEventListener('resize', checkScreenSize);
    </script>

    <!-- Modify your JavaScript for the Splide carousel -->
    <script>
        // Function to initialize the Splide carousel
        function initSplide() {
            var perPage = window.innerWidth <= 768 ? 1 : 3; // Adjust the breakpoint as needed

            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: perPage, // Set the number of cards per page based on screen size
                perMove: 1,
            });

            splide.mount();
        }

        // Initial check and add a resize event listener
        initSplide();
        window.addEventListener('resize', initSplide);
    </script>

</body>
</html>
