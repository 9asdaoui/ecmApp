<?php 
require_once __DIR__ . '/../../controllers/OrderController.php';
include"nav.php"?>

<!-- Orders Table -->
<div class="main-content">

<div id="orders" class="card p-3">
      <h5>Recent Orders</h5>
      <input type="text" id="orderSearch" class="form-control mb-3" placeholder="Search Orders...">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Order detiles</th>
          </tr>
        </thead>
        <tbody id="orderTable">
        <?php
        $class = new OrderController;
        echo $class->displayAll(); 
         ?> 
       </tbody>
      </table>
    </div>
    </div>
  </div>

<?php include"footer.php"?>
