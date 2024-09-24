<template>

    <div :class="['sidebar', { 'collapsed': isCollapsed }]">
      <ul class="nav flex-column">
        <li class="nav-item">
          <Link :class="isActive('/admin/dashboard')" :href="$route('dashboard')">
            <i class="fas fa-home"></i> Dashboard
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/categories')" :href="$route('categories.index')">
            <i class="fas fa-users"></i> Categories
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/products')" :href="$route('products.index')">
            <i class="fas fa-users"></i> Products
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/orders')" :href="$route('orders.index')">
            <i class="fas fa-users"></i> Orders
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/feedbacks')" :href="$route('feedback')">
            <i class="fas fa-users"></i> FeedBacks
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/payments')" :href="$route('payments.index')">
            <i class="fas fa-users"></i> Payments
          </Link>
        </li>

        <li class="nav-item">
          <Link :class="isActive('/admin/carousel-images')" :href="$route('carousel-images.index')">
            <i class="fas fa-users"></i> Carousel Images
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
