<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();



include 'db.php'; // Ensure this path is correct

// Check if the connection is established
if (!isset($conn)) {
    die("Database connection failed.");
}
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <title>Cryptocurrency Website</title>
</head>

<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="">
            <ul>
                <li><a href="#">HOMEPAGE</a></li>
                <li><a href="#">PAGES</a></li>
                <li><a href="#">SERVICES</a></li>
                <li><a href="#">ROADMAP</a></li>
                <li><a href="#">NEWS</a></li>
                <li><a href="#">CONTACTS</a></li>
            </ul>
        <button>   <a href="register.php" >REGISTER</a></button>
        </nav>
        <section>
            <div class="content">
                <h1>Buy and Sell <br> Digital Currency <br> Here.</h1>
                <p>We are very exited to have you here with us. Now let's get you started. </p>
                <button><a href="login.php">LOGIN</a></button>
            </div>
            <div class="img_data">
                <img src="img/Crypto Earth 1.png" alt="">
            </div>
        </section>
    </header>
    <aside>
        <h1>How to get started?</h1>
        <p>Do not worry about that we got you covered.<br> All you need to do is to get one of this trading applications(APPS) from the list (1)Binance (2)Yellowcard (3)luno (4)Skrill (5)Neteller. And get it verified and fund it with the amount which you will use to activate your minig machines. <br> Because without you funding your account, the machines can not facilitate an empty account else it is funded. Once your account is created and funded with the amount you will use to start your mining,<br> you will need to connect your trading account to our Antminers, but if you are far from us, after your registration into this company, your secrete bitcoin wallet will be given to you through our company emails. <br> And when you want to start, you will need to send your investing amount to your bitcoin address given to you through the email. Any other address apart from that address is useless.<br> After your mining starts, your profit will be available in 5-7 working days which<br> you can now withdraw to your trading account and sell out to vendors and companies available to buy in higher price, and also withdraw to your live bank account direct.</p>
        <img src="img/grow line.png" alt="Grow">
        <div class="time">
            <!-- <span>30 <br>
                <h6>DAYS</h6>
            </span>
            <h5>:</h5>
            <span>30 <br>
                <h6>HOURS</h6>
            </span>
            <h5>:</h5>
            <span>30 <br>
                <h6>MINUTES</h6>
            </span>
            <h5>:</h5>
            <span>30 <br>
                <h6>SECONDS</h6>
            </span> -->
        </div>
        <button>BUY TOKEN NOW</button>
    </aside>
    <div class="app">
        <div class="app_img_bx">
            <img src="img/Crypto App.png" alt="">
        </div>
        <div class="app_content_bx">
            <h1>Awesome App Which Works For Your Business</h1>
            <p>Our popular app works on all platforms and devices. You can also downlaod it on the specified platforms. TRY IT OUT!! </p>
            <img src="img/All Store.png" alt="">
        </div>
    </div>

    
    <div class="converter">
        <h1>Crypto Converter</h1>
        <div class="cards">
            <div class="card">
                <div class="select">
                    <h4 id="coin_first">B</h4>
                    <div class="select1">
                        <h6>GIVE</h6>
                        <select id="coin" value="Bitcoin">
                            <option value="Bitcoin">Bitcoin</option>
                            <option value="Ethereum">Ethereum</option>
                            <option value="Tether">Tether</option>
                            <option value="BNB">BNB</option>
                        </select>
                    </div>
                </div>
                <div class="enter_bitcoin">
                    <input type="text" value="0.1" id="crypto">
                    <h6 id="btc">BTC</h6>
                </div>
                <p>Rate expressed in Digital Currency</p>
            </div>
            <div class="card2"><i class="bi bi-arrow-left-right"></i></div>
            <div class="card">
                <div class="select">
                    <h4 id="gov_coins">$</h4>
                    <div class="select1">
                        <h6>GET</h6>
                        <select id="coins" value="Dollar">
                            <option value="Dollar">Dollar</option>
                            <option value="Rupee">Rupee</option>
                            <option value="Riyal">Riyal</option>
                            <option value="Dirham">Dirham</option>
                        </select>
                    </div>
                </div>
                <div class="enter_bitcoin">
                    <input type="text" value="1997.45" id="gov">
                    <h6 id="gov_coinss">USD</h6>
                </div>
                <p>Rate expressed in Government Currency</p>
            </div>
        </div>
    </div>
    <div class="rocket">
        <div class="rocket_content">
            <h1>Cryptos Perfect Services That Works For You!</h1>
            <p>Our services are made world wide and anyone can access our platform through all available means.  </p>
            <ul>
                <li>Mobile App:</li>
                <li>Exchange Services:</li>
                <li>Insurance Protection:</li>
                <li>Credit Card User:</li>
                <li>Secure Storage:</li>
                <li>Mult-currency Wallet:</li>
                <li>Verified deposits and withdrawals:</li>
                <li>Licensed</li>
            </ul>
            <button>DISCOVER NOW</button>
        </div>
        <div class="rocket_img">
            <img src="img/Crypto Rocket.png" alt="">
        </div>
    </div>
    <div class="road_map">
        <h1>Crypto Road Map</h1>
        <p>We took off to the moon after discovering the potentials we can offer on the international financial market. Our services are unique, transparent, accountabe and reliable without the cause to stress our investors.</p>
        <div class="map">
            <div class="card">
                <div class="title">
                    <h6>2 JAN 2024</h6>
                    <h4>To The MOON</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>25 JAN 2023</h6>
                    <h4>Set For The Moon</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>27 DEC 2022</h6>
                    <h4>Launched Over 97 Crypto Assets</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>1 JUN 2021</h6>
                    <h4>Traded Over 700 Crytpo Pairs</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>25 APR 2020</h6>
                    <h4>Globally Recognized</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>24 MAY 2019</h6>
                    <h4>Starts Massive Employment</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
            <div class="card">
                <div class="title">
                    <h6>20 APR 2018</h6>
                    <h4>Starts Center</h4>
                </div>
                <h5></h5>
                <h2></h2>
            </div>
        </div>
    </div>
    <div class="man">
        <div class="man_img">
            <img src="img/Crypto Man.png" alt="">
        </div>
        <div class="man_content">
            <h1>Review From Our Clients About Our Company ICO</h1>
            <p>The most legit and secured place for all investments. This is the only place one can trust and have 100% confidence of investing on any package available on the platform. Thanks to CRYPTOS</p>
            <div class="client_cole">
                <div class="cont">
                    <div class="star">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <h4>Joshphine Dan</h4>
                    <p>INVESTOR</p>
                </div>
                <div class="img">
                    <img src="img/user.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="news">
        <h1>Crypto Know How</h1>
        <div class="cards">
            <div class="card">
                <h6>BITCOIN</h6>
                <h2>Mining Cryptocurrency</h2>
                <p>Mining bitcoin is an act of getting more coins by passing the difficulty and getting smaller bits of bitcoins known as Satoshi which then sums up to bitcoins, the official currency it mines depends on your location it could also depending on the price of it in the market. The mining Antminers S9 and X3 required constant electricity and hashpower. We have this electricity difficultis solved because we have our owned electrical machines mining for us. 
                    <!--<h5>AUG, 23 2022</h5> -->
            </div>
            <div class="card">
                <h6>CRYPTO</h6>
                <h2>How Bitcoin Mining<br>is Profitable</h2>
                <p>With proper account management someone can make over $100,000 in a weekly basis without any fear of losing your money. Mining crypto is 90% risk free, and you get to monitor your account progress from the comfort of your home or office. Be fearless and start investing on crypto mining to change your financial status. Do not let the fear of losing be greater than the excitement of winning.
                    <!--<h5>AUG, 23 2022</h5>-->
            </div>
            <div class="card">
                <h6>BLOCKCHAIN</h6>
                <h2>Blockchain Security</h2>
                <p>Our trading and mining ecosystem is always secured and safe for all investors and contributors. Deposits made are all credited within the blockchain count. Withdrawals made are also using the speed of light after the blockchian confirmations. We keep all clients safe and secured.
                    <!--<h5>AUG, 23 2022</h5>-->
            </div>
        </div>
        <div class="btn">
            <button>READ MORE</button>
        </div>
    </div>
    
    <script src="app.js"></script>
</body>

</html>