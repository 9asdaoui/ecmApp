<?php 
require_once __DIR__ . '/../../controllers/ClientsController.php';
include"nav.php";
if(isset($_GET["changestatu"])){
  $id=$_GET["changestatu"];
  $class = ClientManager::changestat($id);
}
?>
<div class="main-content">
<div id="customers" class="card p-3">
      <h5>Recent customers</h5>
      <input type="text" id="customersSearch" class="form-control mb-3" placeholder="Search Orders...">
      <table class="table table-hover">
        <thead>
          <tr style="font-size: larger;">
            <th style="width: 100px;">customers ID</th>
            <th>profile</th>
            <th>Customer name</th>
            <th>email</th>
            <th>Status</th>
            <th>change Status</th>
          </tr>
        </thead>
        <tbody id="customersTable">
          <?php
            $costumer = new ClientsController;
            echo $costumer->displayAll();
          ?>        
        </tbody>
      </table>
    </div>
</div>

<?php include"footer.php"?>
