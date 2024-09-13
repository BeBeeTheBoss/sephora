<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button @click="$emit('toggleSidebar')" class="btn btn-outline-secondary me-3">
          <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">Admin Panel</a>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </template>

  <script>
  </script>

  <style scoped>
  .navbar {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  </style>
