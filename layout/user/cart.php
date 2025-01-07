<?php require_once"navbar.php"; ?>
<style>
      .content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }
</style>
<div class="content" id="container_cart">
    
 <div class="cart-items" id="cart-items">

            <div class="cart-item" id="cart-item">
               
            </div>

</div>

<div class="cart-summary" id="cart-summary">
        
</div>
<?php require_once"foter.php"; ?>
<script>
  fetch_items();
</script>