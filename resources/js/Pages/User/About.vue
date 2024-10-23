<template>
    <Navbar />
    <div class="container">
        <!-- About Section -->
        <section class="about">
            <div class="row">
                <div class="col-md-6 image">
                    <img src="../../images/about-img.webp" alt="">
                </div>
                <div class="col-md-6 content">
                    <h3>Why you should choose Us?</h3>
                    <p>Sephora offers an extensive range of beauty products, including makeup, skincare, haircare,
                        fragrance, and more. With a vast selection of top-notch brands and exclusive products, you'll
                        have access to a wide variety of options to suit your preferences and needs.</p>
                    <p>Sephora's website stands out as a reliable and efficient platform for beauty shopping, offering a
                        wide selection of products, a supportive community, and exceptional customer service. Whether
                        you're a beauty enthusiast or a casual shopper, Sephora provides a seamless and enjoyable beauty
                        shopping journey.</p>
                    <Link :href="$route('contact')" class="btn">Contact Us</Link>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="my-5">
            <h2 class="text-center">Types of Categories</h2>
            <div class="row">
                <div class="col-md-2" v-for="category in categories" :key="category.id">
                    <div class="card card-body text-center font-semibold" style="color:#e91e63;">{{ category.name }}</div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="reviews">
            <h1 class="heading">Client's Reviews</h1>
            <div class="swiper reviews-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide flex justify-center" v-for="feedback in feedbacks" :key="feedback.id">
                        <img class="mx-auto border border-danger" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR11lMafo-ZYohC2qYI1BJN80gzcC-7IpohIeUQT1RT0WgBttaZX7J1yEea92wMCcTXa9A&usqp=CAU" alt="">
                        <p>{{ feedback.message }}</p>
                        <v-rating :length="5" :size="32" :model-value="feedback.star" readonly
                            active-color="primary" />
                        <h3>{{ feedback.user.name }}</h3>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!-- Image Section -->
        <section class="img-photo-section my-4">
            <div class="img-container1">
                <a href="shop.php">
                    <img src="../../images/deli.jpg" alt="">
                </a>
            </div>
        </section>

        <Footer />
    </div>
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import { onMounted } from 'vue';
import Swiper from 'swiper';
import { Pagination } from 'swiper/modules'; // Import from the modules
import 'swiper/css';


const props = defineProps({
   feedbacks: Array,
   categories : Array
});

// Initialize Swiper
onMounted(() => {
   const swiper = new Swiper('.reviews-slider', {
      modules: [Pagination],
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
      },
      breakpoints: {
         0: {
            slidesPerView: 1,
         },
         768: {
            slidesPerView: 2,
         },
         991: {
            slidesPerView: 3,
         },
      },
   });
});
</script>

<style scoped>
body {
    font-family: "Arial", sans-serif;
    background-color: #f8e5f3;
    color: #333;
    line-height: 1.6;
}

.about {
    padding: 50px 0;
    text-align: center;
}

.about h3 {
    font-size: 36px;
    color: #e91e63;
    margin-bottom: 30px;
}

.about p {
    font-size: 20px;
    margin: 20px 0;
}

.about .btn {
    padding: 12px 25px;
    background-color: #e91e63;
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-size: 20px;
    transition: background-color 0.3s ease;
}

.about .btn:hover {
    background-color: #c2185b;
}

.reviews h1 {
    text-align: center;
    font-size: 36px;
    color: #e91e63;
    margin-bottom: 50px;
}

.swiper-slide.slide {
    padding: 20px;
    text-align: center;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    transition: all 0.3s ease;
}

.swiper-slide.slide img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 20px;
}

.swiper-slide.slide p {
    font-size: 18px;
    margin-bottom: 15px;
}

.swiper-slide.slide .stars {
    color: #ff9800;
    font-size: 24px;
    margin-bottom: 10px;
}

.swiper-slide.slide h3 {
    font-size: 24px;
    color: #e91e63;
    margin-bottom: 5px;
}

.swiper-slide.slide:hover {
    transform: translateY(-5px);
}

.swiper-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background-color: #ccc;
    opacity: 0.7;
    border-radius: 50%;
    margin: 5px;
    transition: background-color 0.3s ease;
}

.swiper-pagination .swiper-pagination-bullet-active {
    background-color: #e91e63;
    opacity: 1;
}

.swiper-pagination .swiper-pagination-bullet:hover {
    background-color: #e91e63;
    opacity: 1;
    cursor: pointer;
}

/* Girly and Elegant Styling */
.about {
    background-color: #fff1f8;
}

.about .content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.about h3 {
    font-size: 32px;
    color: #e91e63;
    margin-bottom: 30px;
}

.about p {
    font-size: 14px !important;
    margin: 14px 0;
    color: #555;
}

.about .btn {
    padding: 12px 30px;
    background-color: #e91e63;
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-size: 20px;
    transition: background-color 0.3s ease;
}

.about .btn:hover {
    background-color: #c2185b;
}

.reviews .heading {
    color: #e91e63;
    font-size: 32px;
    margin-bottom: 50px;
}

.reviews-slider {
    padding: 20px;
}

.swiper-slide.slide {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    background-color: #fff;
    border: 1px solid #f1d2e1;
}

.swiper-slide.slide p {
    font-size: 18px;
    margin-bottom: 15px;
    color: #555;
}

.swiper-slide.slide .stars {
    color: #ff9800;
    font-size: 24px;
    margin-bottom: 10px;
}

.swiper-slide.slide h3 {
    font-size: 24px;
    color: #e91e63;
    margin-bottom: 5px;
}

.swiper-slide.slide:hover {
    transform: translateY(-5px);
}

.swiper-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background-color: #ccc;
    opacity: 0.7;
    border-radius: 50%;
    margin: 5px;
    transition: background-color 0.3s ease;
}

.swiper-pagination .swiper-pagination-bullet-active {
    background-color: #e91e63;
    opacity: 1;
}

.swiper-pagination .swiper-pagination-bullet:hover {
    background-color: #e91e63;
    opacity: 1;
    cursor: pointer;
}



.empty {
    font-size: 24px;
    color: #e91e63;
    margin-top: 20px;
}

/* Dropdown Styling */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    /* Increase border radius for a softer look */
    padding: 15px;
    /* Increase padding for a more spacious feel */
    z-index: 1;
    display: none;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-item {
    display: block;
    padding: 8px 15px;
    /* Adjust padding for better spacing */
    font-size: 18px;
    /* Increase font size for a more elegant look */
    color: #e91e63;
    /* Use a girly color for the text */
    transition: background-color 0.3s ease;
    text-decoration: none;
    /* Remove underline from the links */
}

.dropdown-item:hover {
    background-color: #fce4ec;
    /* Add a subtle hover background color */
    border-radius: 10px;
    /* Adjust border radius for a softer hover effect */
}

/* Additional Decorative Elements */
.dropdown-menu::before {
    content: "";
    position: absolute;
    top: -10px;
    left: 20px;
    border: 10px solid transparent;
}

.dropdown-menu::after {
    content: "";
    position: absolute;
    top: -8px;
    left: 20px;
    border: 9px solid transparent;
}

/* Apply the dropdown styles to the "Shop" dropdown */
.dropdown-menu {
    width: 250px;
    /* Adjust the width of the dropdown */
}

.dropdown-item {
    color: #e91e63;
    /* Girly color for dropdown items */
}

.dropdown-item:hover {
    background-color: #fce4ec;
    /* Add a subtle hover background color */
}
/* Style for the Image Section */
#image {
    background-color: rgba(255, 255, 255, 0.726); /* Light gray background */
    padding: 40px 0;
    text-align: center;
}

#image h2 {
    font-size: 39px;
    color: #e91e63; /* Dark gray color */
    margin-bottom: 20px;
}

.image-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 0 auto 10px; /* Center the container and add bottom margin */
}

.image-type {
    background-color: #e91e63;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.341); /* Lighter shadow */
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    position: relative; /* Added position */
}

.image-type:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
}

.img-container {
    position: relative;
}

.img-container img {
    max-width: 100%; /* Ensure the image fits the container */
    height: auto;
    display: block;
}

.img-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    padding: 10px;
    text-align: center;
    opacity: 0; /* Initially hidden */
    transition: opacity 0.3s ease-in-out; /* Smooth fade-in effect */
}

.image-type:hover .img-content {
    opacity: 1; /* Show content on hover */
}

.img-content h3 {
    font-size: 18px;
    color: #333; /* Dark gray color */
    margin: 0;
    text-transform: capitalize;
}



/* Style for the section */
.img-photo-section {
    background-color: white; /* Optional background color for the section */
    text-align: center; /* Center the image horizontally */
    width: 100%; /* Make the section full width */
    padding: 20px 0; /* Add some vertical padding for aesthetics */
    border-radius: 8px; /* Add rounded corners */
  }
  
  /* Container for the image */
  .img-container1 {
    max-width: 100%; /* Ensure the container spans the full viewport width */
    overflow: hidden; /* Hide any overflow content */
    border: 4px solid white; /* Add a white border around the image */
    border-radius: 8px; /* Add rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
  }
  
  /* Image inside the container */
  .img-container1 img {
    width: 100%; /* Make the image fill its container */
    height: 300px; /* Automatically adjust the height to maintain aspect ratio */
    display: block; /* Remove any extra spacing */
  }
</style>