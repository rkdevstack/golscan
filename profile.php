<?php 
require "notify/admin/lib/config.php";

extract($_GET);
extract($_POST);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/info?id=9670&aux=urls,logo,description,tags,platform,date_added,notice,status',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-CMC_PRO_API_KEY: aabfa2f1-755e-4ae3-a3ac-b8e54e919ca2'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response; 



$arr = json_decode($response, true);
//echo "SELECT * FROM `transactions` where email = '$keywords' or address = '$keywords' ";
$user = $db->query ("SELECT * FROM `transactions` where email = '$keywords' or address = '$keywords' ")->fetch();


$l = $db->query ("SELECT * FROM `login` where guid = '1' ")->fetch();

    
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="GogolCoin"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>GogolCoin</title>

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png"/>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="css/jquery.fancybox.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<!-- start per-loader -->
<div class="loader-container">
    <div class="loader-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<!-- end per-loader -->

<!-- ================================
            START HEADER AREA
================================= -->
<header class="header-area">
    <div class="header-top py-2 font-size-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-top-info">
                        <ul class="list-items list-items-white">
                            <li class="pr-3 d-inline-block"><a href="mailto:example@gmail.com"><i class="fal fa-envelope mr-2 font-size-13"></i>contact@gogolcoin.io</a></li>
                            <!-- <li class="d-inline-block"><a href="tel:+1631237884"><i class="fal fa-phone mr-2 font-size-13"></i>+163 123 7884</a></li> -->
                        </ul>
                    </div> <!-- end header-top-info -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-top-info text-right">
                        <ul class="list-items list-items-white">
                            <!-- <li class="d-inline-block"><a href="login.html"><i class="fal fa-sign-out mr-2 font-size-13"></i>Logout</a></li> -->
                        </ul>
                    </div> <!-- end header-top-info -->
                </div><!-- end col-lg-6 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end header-top -->
    <div class="main-menu-header">
        <div class="container">
            <div class="main-menu-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <a href="index.php" class="main-logo"><img src="images/logo-black.png" alt="logo"></a>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="main-navbar d-flex align-items-center justify-content-end">
                            <nav class="main-nav text-capitalize">
                                <ul>
                                    <li><a href="#">home</a></li>
                                    <li><a href="#">coinmarketcap</a></li>
                                    <li><a href="#">tokens</a></li>
                                    <!--li>
                                        <a href="#">My Account <i class="fal fa-angle-down font-size-12"></i></a>
                                        <ul class="drop-menu">
                                            <li><a href="">Login</a></li>
                                            <li><a href="">Register</a></li>
                                            <li><a href="">My Profile</a></li>
                                            <li><a href="">Balance</a></li>
                                            <li><a href="">Logout</a></li>
                                        </ul>
                                    </li-->
                                </ul>
                            </nav>
                            <div class="navbar-toolbar d-flex align-items-center pl-lg-4">
                                <!--div class="navbar-toolbar-toolbar d-flex align-items-center">
                                    <div class="dropdown navbar-tool-search">
                                        <a class="nav-link dropdown-toggle search-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fal fa-search"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <form method="post">
                                                <div class="position-relative">
                                                    <span class="fal fa-search input-icon"></span>
                                                    <input class="form-control form--control pl-5" type="search" name="name" placeholder="Type keywords & hit enter...">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div-->
                                <div class="hamburger">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div><!-- end navbar-toolbar -->
                        </div><!-- end main-navbar -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div><!-- end main-menu-wrapper -->
        </div> <!-- end container -->
    </div><!-- end main-menu-header -->
</header>
<!-- ================================
         END HEADER AREA
================================= -->

<!-- ================================
    START HERO AREA
================================= -->
<section class="hero-area hero-shape bg-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content mb-5 mb-lg-0">
                    <h1 class="sec-title font-size-55 text-white mb-4">Search GolScan.io</h1>
                   <form action="profile.php" method="post" class="input-group">
                        <input type="text" name="keywords" class="form-control form--control bg-white border border-gray" placeholder="Enter your email address / Metamask ID" required/>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" id="find-data"  style="color: white;">Search <i class="fal fa-angle-right ml-1"></i></button>
                        </div>
                    </form>
                </div><!-- end hero-content -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="hero-img-box">
                    <img src="images/cryptocurrency-marketplace.png" data-src="images/v2.png" alt="vector image" class="hero__img w-100 lazy"/>
                </div> <!-- end hero-img-box -->
            </div> <!-- end col-lg-5 -->
        </div> <!-- end row -->
    </div><!-- end container -->
</section><!-- end hero-area -->
<!-- ================================
    END HERO AREA
================================= -->

<!-- ================================
       START FEATURE AREA
================================= -->
<section class="feature-area section--padding position-relative padding-bottom-10px">
    <span class="ring-shape ring-shape-1 position-absolute"></span>
    <span class="ring-shape ring-shape-2 position-absolute"></span>
    <span class="ring-shape ring-shape-3 position-absolute"></span>
    <span class="ring-shape ring-shape-4 position-absolute"></span>
    <span class="ring-shape ring-shape-5 position-absolute"></span>
    <div class="container">
        <div class="marketprice-area">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="card generic-table table-responsive generic-table-negative">
                            
                            <table class="table" id="data" >
                                
                                <tbody>
                                    <!--tr>
                                        <td class="d-flex align-items-center crypto-name-wrap" style="padding-top: 19px;" width="15%">
                                            <img src="images/gol-symble.png" class="flex-shrink-0 mr-2" alt="coin-img"/>
                                            <p class="line-height-18">
                                                GogolCoin <span class="d-block font-size-11 text-gray">GOL</span>
                                            </p>
                                        </td>
                                        <td class="text-left" colspan="2">
                                            <small>Total Supply</small>
                                            <p class="theme-color">Tokens Locked</p>
                                        </td>
                                        <td class="text-right">
                                            <small>1,200,000.000</small>
                                            <p class="theme-color">6,28,815,558.32</p>
                                        </td>
                                    </tr-->
                                    <?php if($user){ ?>
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            <img src="images/lock1.png" class="flex-shrink-0 mr-2" alt="coin-img" width="150">
                                            <br>
                                            <h4 class="text-uppercase theme-color">52%</h4>
                                            <small class="text-uppercase">Locked of total Supply</small>
                                            <p>Total 5 Tokens Locked</p>

                                            <div id="progressBar">
                                                <div></div>
                                            </div>
                                    
                                            <ul id="countdown" class="cdate">
                                                <li><span id="day" class="numbers"><?php echo $totaldays;?></span>
                                                    <p class="name">days</p></li>
                                                <li><span id="hour" class="numbers">00</span>
                                                    <p class="name">hours</p></li>
                                                <li><span id="minute" class="numbers">00</span>
                                                    <p class="name">minutes</p></li>
                                                <li><span id="second" class="numbers">00</span>
                                                    <p class="name">seconds</p></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <button class="btn btn-dark btn-sm" id="claimnow" disabled>Claim Now</button>
                                        </td>
                                    </tr>
                                    <?php }else{ ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <button class="btn btn-dark btn-sm" disabled>No data found</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <p id="demo"></p>

                                    <input type="hidden" id="countdowndate" value="<?php echo $l['dateandtime'];?>">
                                </tbody>
                            </table>
                            
                        </div><!-- end coin-price-table -->
                    </div>
                </div>
            </div><!-- end container -->
        </div>
    </div><!-- end container -->
 </section><!-- end feature-area -->
<!-- ================================
       START FEATURE AREA
================================= -->

<!-- ================================
         END FOOTER AREA
================================= -->
<section class="footer-area padding-top-80px pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-5">
                <div class="footer-item mb-5">
                    <a href="index.html" class="d-block">
                        <img src="images/logo-black.png" alt="logo">
                    </a>
                    <div class="row padding-top-35px">
                        <div class="col-lg-6">
                            <div class="footer-fact mb-3">
                                <h5 class="text-color font-weight-bold">$155.76B</h5>
                                <span class="font-size-14">Market Cap</span>
                            </div>
                            <div class="footer-fact mb-3">
                                <h5 class="text-color font-weight-bold">259K</h5>
                                <span class="font-size-14">Active Accounts</span>
                            </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="footer-fact mb-3">
                                <h5 class="text-color font-weight-bold">235K</h5>
                                <span class="font-size-14">Daily Transactions</span>
                            </div>
                            <div class="footer-fact mb-3">
                                <h5 class="text-color font-weight-bold">120</h5>
                                <span class="font-size-14">Countries Supported</span>
                            </div>
                        </div><!-- end col-lg-6 -->
                    </div>
                    <h6 class="mb-2 font-weight-semi-bold">Supported Payment Methods</h6>
                    <img class="mr-1 border border-gray" src="images/american-express.png" alt="american-express">
                    <img class="mr-1 border border-gray" src="images/mastercard.png" alt="mastercard">
                    <img class="mr-1 border border-gray" src="images/visa.png" alt="visa">
                    <img class="mr-1 border border-gray" src="images/paypal.png" alt="paypal">
                    <img class="mr-1 border border-gray" src="images/maestro.png" alt="maestro">
                </div><!-- end footer-item -->
            </div><!-- end col-lg-5 -->
            <div class="col-sm-4 col-lg-2">
                <div class="footer-item mb-5">
                    <h5 class="mb-3 font-weight-semi-bold">Company</h5>
                    <div class="title-shape border-bottom-0"><span></span></div>
                    <ul class="list-items list-items-hover pt-4">
                        <li class="mb-2"><a href="about.html">About Us</a></li>
                        <li class="mb-2"><a href="team-member.html">Our Team</a></li>
                        <li class="mb-2"><a href="pricing.html">Pricing</a></li>
                        <li class="mb-2"><a href="service.html">Services</a></li>
                        <li class="mb-2"><a href="contact.html">Contact Us</a></li>
                        <li class="mb-2"><a href="blog-grid-no-sidebar.html">Blog</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-2 -->
            <div class="col-sm-4 col-lg-2">
                <div class="footer-item mb-5">
                    <h5 class="mb-3 font-weight-semi-bold">Help & Support</h5>
                    <div class="title-shape border-bottom-0"><span></span></div>
                    <ul class="list-items list-items-hover pt-4">
                        <li class="mb-2"><a href="#">Guide</a></li>
                        <li class="mb-2"><a href="faq.html">Faq</a></li>
                        <li class="mb-2"><a href="#">Advertise</a></li>
                        <li class="mb-2"><a href="#">Help Center</a></li>
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                        <li class="mb-2"><a href="terms-of-services.html">Terms of Use</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-2 -->
            <div class="col-lg-3">
                <div class="footer-item mb-5">
                    <h5 class="mb-3 font-weight-semi-bold">Contact Us</h5>
                    <div class="title-shape border-bottom-0"><span></span></div>
                    <ul class="list-items pt-4">
                        <li class="mb-3"><a href="mailto:contact@gogolcoin.io"><i class="fal fa-envelope mr-1 font-size-14"></i> contact@gogolcoin.io</a></li>
                        <li class="mb-3"><a href="tel:0021621184010"><i class="fal fa-phone mr-1 font-size-14"></i> 00216 21 184 010</a></li>
                        <li class="mb-3"><i class="fal fa-map-marker-alt mr-1 font-size-14"></i> Dubai, United Arab Emirates</li>
                    </ul>
                    <div class="social-icons">
                        <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?php echo $arr[data][9670][urls][twitter][0];?>" class="icon-element icon-element-sm mr-1" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-instagram"></i></a>
                    </div>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <hr class="border-top-gray my-4">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <p class="copy-desc">Copyright &copy; 2022 GogolCoin. All Rights Reserved.</p>
        </div><!-- end copyright-content -->
    </div><!-- end container -->
</section><!-- end footer-area -->
<!-- ================================
          END FOOTER AREA
================================= -->
<!-- start scroll-to-top -->
<div id="scroll-to-top">
    <i class="far fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll-to-top -->

<!-- Template JS Files -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<!-- Start chart js -->
<script src="js/chart.js"></script>
<script src="js/result-chart.js"></script>
<script src="js/doughnut-chart.js"></script>
<!-- End chart js -->
<!-- Start counter js -->
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<!-- end counter js -->
<script src="js/jquery.lazy.min.js"></script>
<script src="js/calculate-script.js"></script>
<script src="js/main.js"></script>


<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 3, 2027 00:00:00").getTime();


//var countDownDate = new Date(document.getElementById("countdowndate").value).getTime();

//console.log(countDownDate);
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    console.log(days)
  // Output the result in an element with id="demo"
  //document.getElementById("demo").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
    
     document.getElementById("day").innerHTML =days ;
      document.getElementById("hour").innerHTML =hours;
      document.getElementById("minute").innerHTML = minutes;
      document.getElementById("second").innerHTML =seconds;
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    
    $("#countdown").css("display", "none");

   $('#claimnow').prop("disabled", false); // Element(s) are now enabled.

   // document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</body>

</html>