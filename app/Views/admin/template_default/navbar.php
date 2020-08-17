<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">Rezeki Dua Saudara</a>
  </nav>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Rezeki Dua Saudara</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Links -->
      <ul class="navbar-nav">

        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="master" data-toggle="dropdown">
            Master
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url("admin/product"); ?>">Produk</a>
            <a class="dropdown-item" href="<?php echo base_url("admin/supplier"); ?>">Supplier</a>
            <a class="dropdown-item" href="<?php echo base_url("admin/customer"); ?>">Customer</a>
            <a class="dropdown-item" href="<?php echo base_url("admin/category"); ?>">Category</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="transaction" data-toggle="dropdown">
            Transaksi
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url("admin/purchase"); ?>">Pembelian</a>
            <a class="dropdown-item" href="<?php echo base_url("admin/sales"); ?>">Penjualan</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="report" data-toggle="dropdown">
            Laporan
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Link 1</a>
            <a class="dropdown-item" href="#">Link 2</a>
            <a class="dropdown-item" href="#">Link 3</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontak</a>
        </li>
      </ul>
    </div>
  </nav> 