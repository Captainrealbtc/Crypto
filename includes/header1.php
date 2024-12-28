<!-- Navigation Bar -->
<header>
<nav>
            <img src="img/logo.png" alt="company-logo">
            <ul>
                <li><a href="index.php">HOMEPAGE</a></li>
                <li><a href="deposit.php">DEPOSIT</a></li>
                <li><a href="withdrawal.php">WITHDRAW</a></li>
                <li><a href="loan.php">LOAN</a></li>
                <li><a href="referal.php">TRANSFER</a></li>
                <li><a href="complains.php">COMPLAINS</a></li>
            </ul>
       
        </nav>
    <marquee behavior="" direction="">Welcome to Cryptos</marquee>
        <p></p>
    </div>
   
</header>
<style>
/* Google Font Poppins  */

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

/* Reset */

* {
    padding: 0%;
    margin: 0%;
    box-sizing: border-box;
}

html {
    font-family: 'Poppins', sans-serif;
}

:root {
    --color-1: #fff;
    --color-2: rgb(255, 255, 255, .8);
    --color-3: #000;
    --color-4: #00002c;
    --color-5: #000024;
    --color-6: #00b7c5;
    --color-7: #08d3d3;
}

.company-logo {
    width: 100px;
    height: 100px;
    margin: -20px;
    border: 2px solid #000;
    border-radius: 50px;
    box-shadow: 0px 0px 100px #000;
}



header {
    width: 100%;
    height: 100%;
    background: var(--color-4);
    overflow: hidden;
}

header nav {
    width: 70%;
    height: 10%;
    margin: auto;
    /* border: 1px solid var(--color-1); */
    display: flex;
    align-items: center;
    justify-content: space-between;
}
header nav, .img{
    height: 100px;
    width: -70px;
}

header nav ul {
    list-style: none;
    display: flex;
    align-items: center;
}

header nav ul li {
    position: relative;
    padding: 3px 15px;
    z-index: 2;
}

header nav ul li:nth-child(1)::before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: rgb(154, 154, 150, .5);
    border-radius: 50%;
    top: 6px;
    right: 9px;
    z-index: -1;
}

header nav ul li a {
    text-decoration: none;
    font-size: 12px;
    color: var(--color-1);
    font-weight: 600;
    transition: .3s linear;
}

header nav ul li a:hover {
    color: var(--color-2);
}

header nav button {
    padding: 12px 25px;
    background: linear-gradient(0deg, #ae2c86, #d0498d);
    border-radius: 30px;
    color: var(--color-1);
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: .3s linear;
}

header nav button:hover {
    background: linear-gradient(0deg, #d0498d, #ae2c86);
}
</style>