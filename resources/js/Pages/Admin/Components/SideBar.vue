<template>
    <div :class="['sidebar', { 'collapsed': isCollapsed }]">
      <ul class="nav flex-column">
        <li class="nav-item">
          <Link class="nav-link active" href="/admin/dashboard">
            <i class="fas fa-home"></i> Dashboard
          </Link>
        </li>

        <li class="nav-item">
          <Link class="nav-link" href="/admin/categories">
            <i class="fas fa-users"></i> Categories
          </Link>
        </li>

        <li class="nav-item">
          <Link class="nav-link" href="/admin/orders">
            <i class="fas fa-users"></i> Orders
          </Link>
        </li>
        
        <li class="nav-item">
          <Link class="nav-link" href="/admin/products">
            <i class="fas fa-users"></i> Products
          </Link>
        </li>

        <li class="nav-item">
          <Link class="nav-link" href="/admin/products">
            <i class="fas fa-users"></i> FeedBacks
          </Link>
        </li>

        <li class="nav-item">
          <Link class="nav-link" href="/admin/payments">
            <i class="fas fa-users"></i> Payments
          </Link>
        </li>
      </ul>
    </div>
  </template>

  <script>
  import { Link } from '@inertiajs/vue3'

  export default {
    name: "Sidebar",
    props: ['isCollapsed']
  };
  </script>

  <style scoped>
  .sidebar {
    background-color: #343a40;
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
    background-color: #495057;
  }
  </style>
