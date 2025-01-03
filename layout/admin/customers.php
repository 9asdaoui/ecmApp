<?php include"nav.php"?>

<div class="main-content">
<div id="customers" class="card p-3">
      <h5>Recent customers</h5>
      <input type="text" id="customersSearch" class="form-control mb-3" placeholder="Search Orders...">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>customers ID</th>
            <th>Customer name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody id="customersTable">
          <!-- Dynamic Content -->
        </tbody>
      </table>
    </div>
</div>

<?php include"footer.php"?>
