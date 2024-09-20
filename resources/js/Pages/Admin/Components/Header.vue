<template>
    <div style="position:sticky;z-index:10;top:0;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container-fluid z-10">
        <img src="https://iconape.com/wp-content/png_logo_vector/shopping-and-ecommerce-28.png"
        style="width: 40px" />
        <a class="navbar-brand" href="#" >
            <div class="logo col-2 flex align-items-center"
                style="font-size:25px">
                <div class="font-bold" style="color: #ff006e">Sep</div>
                <span class="text-white font-bold">hora</span>
            </div>
        </a>

        <ul class="navbar-nav ms-auto" >
          <li class="nav-item">
            <Link class="nav-link text-white" :href="$route('profile')" ><i class="fas fa-user-circle"></i> Profile</Link>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    </div>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>

  <style scoped>
  .navbar {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  </style>
