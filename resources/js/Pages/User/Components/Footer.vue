<template>
    <footer class="container footer">
   <section class="row">
      <div class="col-md-3 box flex flex-column">
         <h3 class="font-semibold">quick links</h3>
         <a href="home.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Home</a>
         <a href="about.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> About</a>
         <a href="shop.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Shop</a>
         <a href="contact.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Contact</a>
         <a href="wishlist.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Wishlist</a>
      </div>
      <div class="col-md-3 box flex flex-column">
         <h3 class="font-semibold">extra links</h3>
         <a href="user_login.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Login</a>
         <a href="user_register.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Register</a>
         <a href="cart.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Cart</a>
         <a href="orders.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Orders</a>
         <a href="admin/admin_login.php"><font-awesome-icon icon="fa-solid fa-chevron-right" /> Admin Login</a>
      </div>
      <div class="col-md-3 box flex flex-column">
         <h3 class="font-semibold">contact us</h3>
         <a href="tel:1234567890"><font-awesome-icon icon="fa-solid fa-phone" /> +123 456 7899</a>
         <a href="tel:11122233333"><font-awesome-icon icon="fa-solid fa-phone" /> +111 222 3333</a>
         <a href="mailto:sephora@gmail.com"><font-awesome-icon icon="fa-solid fa-envelope" /> sephora@gmail.com</a>
         <a href="https://goo.gl/maps/eqHj3ttDVEWnhaMC9" target="_blank"><font-awesome-icon icon="fa-solid fa-location-dot" /> Yangon, Myanmar</a>
      </div>
      <div class="col-md-3 box flex flex-column">
         <h3 class="font-semibold">follow us</h3>
         <a href="https://www.facebook.com/" target="_blank"><font-awesome-icon icon="fa-brands fa-facebook" /> Facebook</a>
         <a href="https://twitter.com/i/flow/login" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
         <a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
         <a href="https://www.linkedin.com/login" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
         <a href="https://www.tiktok.com/login" target="_blank"><i class="fab fa-tiktok"></i>Tiktok</a>
      </div>
   </section>
</footer>

</template>

<script></script>

<style scoped>
.footer {
  background-color: white;
  /* padding-bottom: 7rem; */
}


.footer .box h3 {
  font-size: 20px;
  color: black;
  margin-bottom: 1rem;
  text-transform: capitalize;
}

.footer .box a {
  display: block;
  margin: 0.5rem 0;
  font-size: 16px;
  color: #FE919D;
  text-decoration: none;
}

.footer .box a i {
  padding-right: 1rem;
  color: #FE919D;
  transition: 0.2s linear;
}

.footer .box a:hover {
  color: #FE919D;
}

.footer .box a:hover i {
  padding-right: 2rem;
}

.footer .credit {
  text-align: center;
  padding: 2.5rem 2rem;
  font-size: 2rem;
  color: black;
}

.footer .credit span {
  color: #FE919D;
}

</style>
