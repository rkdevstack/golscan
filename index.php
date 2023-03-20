<?php 

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


//print_r($arr[data][9670][category]);exit;


// *** PUT YOUR API KEY HERE:
$myAPIKey = '448a054e-cbb6-413d-8859-773456bc4e85';
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
$parameters = array ( 'symbol' => 'GOL' );
 
$headers = array ( 
 'Accepts: application/json', 
 'X-CMC_PRO_API_KEY: ' . $myAPIKey 
);
// query string encode the parameters
$qs = http_build_query($parameters);
// create the request URL
$request = "{$url}?{$qs}";
// Get cURL resource
$curl = curl_init();
// Set cURL options
curl_setopt_array($curl, array(
 CURLOPT_URL => $request,      // set the request URL
 CURLOPT_HTTPHEADER => $headers, // set the headers 
 CURLOPT_RETURNTRANSFER => 1     // ask for raw response instead of bool
));
// Send the request, save the response
$responsea = curl_exec($curl);
// print json decoded response (here as an array)
//echo '<pre>';
//print_r(json_decode($responsea, true)); 
//echo '</pre>';
// Close request

$arri = json_decode($responsea, true);


//print_r($arri[data][GOL][quote][USD][price]);
curl_close($curl);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=gogolcoin',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responsed = curl_exec($curl);

curl_close($curl);
//echo $response;
$arrd = json_decode($responsed, true);


//print_r($arri[0][symbol]);



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
                                    <li><a href="https://coinmarketcap.com/currencies/gogolcoin/">coinmarketcap</a></li>
                                    <li><a href="https://cn.etherscan.com/token/0x083d41d6dd21ee938f0c055ca4fb12268df0efac#balances">tokens</a></li>
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
                    <div class="col-sm-12">
                        <div class="card generic-table table-responsive generic-table-negative">
                            <table class="table" id="no-data">
                                <!--thead>
                                <tr>
                                    <th scope="col" colspan="3">
                                        <img src="images/bitcoin-symble.png" class="flex-shrink-0 mr-2" alt="coin-img">
                                    </th>
                                </tr>
                                </thead-->
                                <tbody>
                                    <tr>
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
                                            <small>295,000,000</small>
                                            <p class="theme-color">190,974,999.99</p>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <img src="images/gol-symble.png" class="float-left mr-2" alt="coin-img">
                                            <h3>GogolCoin <span class="badge badge-dark font-size-14 top-minus-4">GOL</span> <i class="fa fa-star font-size-14 top-minus-4"></i></h2>
                                            <p>
                                                <span class="badge badge-dark">Rank #<?php echo $arri[data][GOL][cmc_rank];?>
</span>
                                                <span class="badge badge-light"><?php echo $arr[data][9670][category];?></span>
                                                <span class="badge badge-light">On 2,673 watchlists</span>
                                            </p>
                                        </td>
                                        <td scope="col" colspan="2">
                                            GogolCoin Price (GOL)
                                            <h3>$  <?php echo round($arri[data][GOL][quote][USD][price],2);?>
 <!--span class="badge badge-danger font-size-14 top-minus-4">&darr; </span--></h3>
                                            <!--p>0.0001586 BTC <span class="text-danger font-size-14">&darr; 3.28%</span></p>
                                            <p>0.002228 ETH <span class="text-success font-size-14">&uarr; 3.28%</span></p-->
                                            <p class="font-size-12">
                                                <span>Low <b>$<?php echo $arrd[0][low_24h];?></b></span> - 
                                                <!--input type="range" class="form-control-range top-plus-4" id="formControlRange"-->
                                                <span>High <b>$<?php echo $arrd[0][high_24h];?></b></span>
                                                <span class="badge badge-light">&darr; 24h</span>
                                            </p>
                                        </td>
                                    </tr>
                                    
                                    <tr class="crypto-data">
                                        <td>Market Cap <i class="far fa-info-circle"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i> <i class="far fa-comment-alt-exclamation text-danger"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i><br>$<?php echo number_format($arr[data][9670][self_reported_market_cap]);?><br><!--span class="text-success">&uarr;0.00%</span--></td>
                                        <td>Fully Diluted Market Cap <i class="far fa-info-circle"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i><br>$<?php echo number_format(round($arri[data][GOL][quote][USD][fully_diluted_market_cap],2));?><br><!--span class="text-danger">&darr;5.91%</span--></td>
                                        <td>Volume <span class="badge badge-light">24h</span> <i class="far fa-info-circle"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i><br>$<?php echo number_format(round($arri[data][GOL][quote][USD][volume_24h],2));?><br><!--span class="text-danger">&darr;17.83%</span--><br><br>Volume / Market Cap<br>0.007586</td>
                                        <td>Self Reported Circulating Supply <i class="far fa-info-circle"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i> <i class="far fa-comment-alt-exclamation text-danger"  data-toggle="tooltip" data-placement="top" title="The total market value of a cryptocurrency's circulating supply. It is analogous to the free-float capitalization in the stock market."></i><br><?php echo number_format($arr[data][9670][self_reported_circulating_supply]);?> GOL<br><!--span class="text-success">&uarr;0.00%</span-->
                                            <br>
                                            <p style="background: #ccc; height: 6px; border-radius: 10px; margin-bottom: 10px; margin-top: 10px;">&nbsp;</p>
                                            Max Supply <i class="far fa-info-circle"></i> <span class="float-right"><?php echo number_format(round($arri[data][GOL][max_supply],2));?></span><br>Total Supply <i class="far fa-info-circle"></i> <span class="float-right"><?php echo number_format(round($arri[data][GOL][total_supply],2));?></span>
                                        </td>
                                    </tr>
                                    
                                    <!--tr>
                                        <td class="">
                                            <img src="images/notfound.png" class="flex-shrink-0 mr-2" alt="coin-img" width="80">
                                            <br>
                                            <p class="text-uppercase">No Reports</p>
                                        </td>
                                    </tr-->
                                </tbody>
                            </table>
                            <table class="table" id="data" style="display: none;">
                                
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
                                                <li><span id="day" class="numbers">00</span>
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
                                            <button class="btn btn-dark btn-sm" disabled>Claim Now</button>
                                        </td>
                                    </tr>
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


</body>

</html>