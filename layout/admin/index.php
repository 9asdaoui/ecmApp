<?php include"nav.php"?>

  <div class="main-content">
    <!-- Dashboard Cards -->
    <div id="dashboard" class="row mb-4">
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Total Sales</h6>
          <h3>$12,345</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Orders</h6>
          <h3>1,234</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Customers</h6>
          <h3>567</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Revenue</h6>
          <h3>$8,910</h3>
        </div>
      </div>
    </div>

    <!-- Sales Chart -->
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="card p-3">
          <h5>Sales Overview</h5>
          <canvas id="salesChart"></canvas>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h5>Top Products</h5>
          <ul id="topProducts" class="list-group list-group-flush"></ul>
        </div>
      </div>
    </div>
    </div>

 
    <?php include"footer.php"?>
