<template>
    <div class="bg-white" :class="['sidebar', { 'collapsed': isCollapsed }]" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;padding:100px 0;">
      <ul class="nav flex-column mt-3">
        <li class="nav-item">
          <Link :class="isActive('/admin/dashboard')" :href="$route('dashboard')">
            <i class="fas fa-home"></i> <h6 class="text-black">Dashboard</h6>
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/categories')" :href="$route('categories.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Categories</h6>
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/products')" :href="$route('products.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Products</h6>
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/orders')" :href="$route('orders.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Orders</h6>
          </Link>
        </li>
<!-- 
        <li class="nav-item">
          <Link :class="isActive('/admin/feedbacks')" :href="$route('feedback')">
            <i class="fas fa-users"></i> <h6 class="text-black">FeedBacks</h6>
          </Link>
        </li> -->

        <li class="nav-item">
          <Link :class="isActive('/admin/payments')" :href="$route('payments.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Payments</h6>
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/carousel_images')" :href="$route('carousel_images.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Ads Images</h6>
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/users')" :href="$route('users.index')">
            <i class="fas fa-users"></i> <h6 class="text-black">Users</h6>
          </Link>
        </li>
      </ul>
    </div>
  </template>

  <script>
  import { Link } from '@inertiajs/vue3'

  export default {
    name: "Sidebar",
    props: ['isCollapsed'],

    methods: {
    isActive(path) {
      return window.location.pathname === path ? 'nav-link active' : 'nav-link';
    }
  }
  };
  </script>

  <style scoped>
  .sidebar {
    background-color: black;
    color: #fff;
    width: 250px;
    transition: all 0.3s;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    padding-top: 70px; /* Offset for header height */
  }
  .sidebar.collapsed {
    width: 80px;
  }
  .nav-link {
    color: #fff;
    padding: 10px 20px;
  }
  .nav-link.active {
    background-color: #06d6a0;
  }
  </style>
