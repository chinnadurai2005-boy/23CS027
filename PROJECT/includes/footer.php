<!-- ===== FOOTER START ===== -->
<footer class="km-footer">
  <div class="footer-container">

    <!-- ABOUT -->
    <div class="footer-section about">
      <h3>Green Basket Grocery</h3>
      <p>Fresh groceries, dairy, fruits & vegetables delivered to your doorstep.</p>
      <p class="footer-contact">
        📧 <a href="mailto:support@greenbasket.com">support@greenbasket.com</a><br>
        📞 +91 98765 43210
      </p>
    </div>

    <!-- QUICK LINKS -->
    <div class="footer-section links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">🏠 Home</a></li>
        <li><a href="products.php">🛒 All Products</a></li>
        <li><a href="products.php?category=Fruits">🍎 Fruits</a></li>
        <li><a href="products.php?category=Vegetables">🥦 Vegetables</a></li>
        <li><a href="products.php?category=Dairy">🥛 Dairy</a></li>
        <li><a href="cart.php">🧺 Cart</a></li>
        <li><a href="contact.php">📨 Contact Us</a></li>
      </ul>
    </div>

    <!-- SOCIAL -->
    <div class="footer-section social">
      <h4>Follow Us</h4>
      <div class="icons">
        <a href="#"><img src="assets/images/facebook.png" alt="Facebook"></a>
        <a href="#"><img src="assets/images/instagram.png" alt="Instagram"></a>
        <a href="#"><img src="assets/images/whatsapp.png" alt="WhatsApp"></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom"> 
    © 2025 Green Basket Grocery — Fresh & Healthy Living
  </div>
  <style>
/* ================= FOOTER ================= */
.km-footer{
    background:linear-gradient(135deg,#020617,#0f172a);
    color:#e5e7eb;
    padding:45px 20px 20px;
    margin-top:50px;
    border-top:3px solid #22c55e;
    font-family:Arial, sans-serif;
}

/* CONTAINER */
.footer-container{
    width:92%;
    max-width:1100px;
    margin:auto;
    overflow:hidden; /* Old safe clearfix trick */
}

/* FOOTER SECTIONS */
.footer-section{
    width:30%;
    float:left;
    margin-right:3%;
    background:rgba(255,255,255,0.04);
    padding:18px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    transition:0.3s ease;
}

/* Remove margin from last column */
.footer-section:last-child{
    margin-right:0;
}

/* Hover Animation */
.footer-section:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 35px rgba(0,0,0,0.9);
}

/* TITLES */
.footer-section h3,
.footer-section h4{
    color:#22c55e;
    margin-bottom:12px;
    font-size:16px;
    border-bottom:1px solid rgba(255,255,255,0.08);
    padding-bottom:6px;
}

/* TEXT */
.footer-section p,
.footer-section li{
    font-size:13px;
    color:#cbd5f5;
    margin-bottom:7px;
    line-height:1.6;
}

/* LIST */
.footer-section ul{
    list-style:none;
    padding:0;
}

.footer-section ul li{
    margin-bottom:6px;
}

/* LINKS */
.footer-section a{
    color:#cbd5f5;
    text-decoration:none;
    transition:0.25s;
}

/* Hover Effect */
.footer-section a:hover{
    color:#22c55e;
    padding-left:4px;
}

/* CONTACT */
.footer-contact{
    margin-top:10px;
}

/* ================= SOCIAL ICONS ================= */
.icons{
    margin-top:10px;
}

.icons a{
    display:inline-block;
    margin-right:10px;
}

.icons img{
    width:32px;
    height:32px;
    border-radius:6px;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(0,0,0,0.6);
}

/* Icon Hover */
.icons img:hover{
    transform:scale(1.15);
    box-shadow:0 6px 18px rgba(34,197,94,0.6);
}

/* ================= COPYRIGHT ================= */
.footer-bottom{
    clear:both;
    margin-top:35px;
    padding-top:15px;
    text-align:center;
    font-size:13px;
    color:#94a3b8;
    border-top:1px solid rgba(255,255,255,0.08);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){

    .footer-section{
        width:100%;
        float:none;
        margin-bottom:15px;
    }

    .footer-section:last-child{
        margin-bottom:0;
    }
}
    </style>
</footer>
<!-- ===== FOOTER END ===== -->