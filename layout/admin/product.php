<?php include"nav.php"?>

<div class="main-content">

<div class="form-container">
        <h2>Add New Product</h2>
        <form id="addProductForm" action="../../core/Router.php" method="POST">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="name" placeholder="Enter product name" required>
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Enter price" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" placeholder="Enter quantity" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Home">Home</option>
                    <option value="Beauty">Beauty</option>
                    <option value="Sports">Sports</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image URL</label>
                <input type="text" id="image" name="image" placeholder="Enter image URL">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Write a short description"></textarea>
            </div>
            <input type="hidden" name="url" value="addproduct">
            <button type="submit" class="btnsub" name="adp">Add Product</button>
        </form>
    </div>
  </div>
  </div>

<?php include"footer.php"?>
