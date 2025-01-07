fetch_Data();
const cart = JSON.parse(localStorage.getItem('cart')) || []; 
//=====================================================================================================
function toggleSidebar() {
  const sidebar = document.getElementById("mySidebar");
  if (sidebar.style.width === "250px") {
    closeSidebar();
  } else {
    sidebar.style.width = "250px";
  }
}

function closeSidebar() {
  document.getElementById("mySidebar").style.width = "0";
}
//=====================================================================================================
function increment(id) {
  var input = document.getElementById(id);
  var currentValue = parseInt(input.value);
  input.value = currentValue + 1;
}

function decrement(id) {
  var input = document.getElementById(id);
  var currentValue = parseInt(input.value);
  if (currentValue > 1) {
    input.value = currentValue - 1;
  }
}
//=====================================================================================================
async function fetch_Data(){
  const url = "http://ecmapp.test/controllers/api.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const json = await response.json();
    renderRow(json);
  } catch (error) {
    console.error(error.message);
    }
}

async function fetch_items(){
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  if (cart.length === 0) {
    empty_cart();
    return;
  }
  let path =  cart.map((item) => {
      return `${item.id}`;
    }); 
    
    const url = `http://ecmapp.test/controllers/api.php/?itemsIds=${path}`;
    console.log(url);
    console.log(path);

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const json = await response.json();
    renderItems(json);
  } catch (error) {
    console.error(error.message);
    }
}

//=====================================================================================================

function renderRow(json) {
  const container = document.getElementById('cardes_content');

  json.forEach((item) => {
    const card = document.createElement('div');
    card.classList.add('card');

    const img = document.createElement('img');
    img.src = item[6];
    card.appendChild(img);

    const cardContent = document.createElement('div');
    cardContent.classList.add('card-content');

    const title = document.createElement('h3');
    title.textContent = item[2];
    cardContent.appendChild(title);

    const description = document.createElement('p');
    description.textContent = `Brief description for ${item[1]}.`;
    cardContent.appendChild(description);

    
    const category = document.createElement('div');
    category.classList.add('category');
    category.textContent = item[5];
    cardContent.appendChild(category);

    const price = document.createElement('div');
    price.classList.add('price');
    price.textContent = `$${item[3]}`;
    cardContent.appendChild(price);

    const quantityContainer = document.createElement('div');
    quantityContainer.classList.add('quantity-container');

    const decrementBtn = document.createElement('button');
    decrementBtn.textContent = '-';
    decrementBtn.onclick = () => decrement(`quantity-${item[0]}`);

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.id = `quantity-${item[0]}`;
    quantityInput.value = 1;
    quantityInput.readOnly = true;

    const incrementBtn = document.createElement('button');
    incrementBtn.textContent = '+';
    incrementBtn.onclick = () => increment(`quantity-${item[0]}`);

    quantityContainer.appendChild(decrementBtn);
    quantityContainer.appendChild(quantityInput);
    quantityContainer.appendChild(incrementBtn);
    cardContent.appendChild(quantityContainer);

    const addToCartBtn = document.createElement('button');
    addToCartBtn.classList.add('add-to-cart-btn');
    addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';

    const productInCart = cart.find((product) => product.id === item[0]);
    if (productInCart) {
      addToCartBtn.innerHTML = '<i class="fas fa-trash-alt"></i> Remove from Cart';
    }

    addToCartBtn.onclick = () => toggleCartItem(item[0], quantityInput.value, addToCartBtn);
    cardContent.appendChild(addToCartBtn);

    card.appendChild(cardContent);
    container.appendChild(card);
  });

  document.body.appendChild(container);
}
//=====================================================================================================

function toggleCartItem(id, quantity, button) {
  const index = cart.findIndex((product) => product.id === id);
  if (index === -1) {
    cart.push({ id, quantity: parseInt(quantity) });
    button.innerHTML = '<i class="fas fa-trash-alt"></i> Remove from Cart';
  } else {
    cart.splice(index, 1);
    button.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
  }
  localStorage.setItem('cart', JSON.stringify(cart));

  const storedCart = JSON.parse(localStorage.getItem('cart'));
  console.log(storedCart);
}

function increm(ide,id) {
  var input = document.getElementById(ide);
  var currentValue = parseInt(input.value);
  input.value = currentValue + 1;
  const index = cart.findIndex((product) => product.id === id);
    
  cart.splice(index, 1);
  cart.push({ id, quantity: input.value });
  localStorage.setItem('cart', JSON.stringify(cart));
  fetch_items();
}


function decrem(ide,id) {
  var input = document.getElementById(ide);
  var currentValue = parseInt(input.value);
  if (currentValue > 1) {
    input.value = currentValue - 1;
  }
  const index = cart.findIndex((product) => product.id === id);
    
  cart.splice(index, 1);
  cart.push({ id, quantity: input.value });
  localStorage.setItem('cart', JSON.stringify(cart));
  fetch_items();
}
//=====================================================================================================
function empty_cart(){
  const container = document.getElementById('cart-items');
  const summaryContainer = document.getElementById('cart-summary');

  container.innerHTML = '';
  summaryContainer.innerHTML = '';

  const emptyCartMessage = document.createElement('div');
  emptyCartMessage.classList.add('empty-cart-message');

  const heading = document.createElement('h2');
  heading.textContent = 'Your Cart is Empty';

  const paragraph = document.createElement('p');
  paragraph.textContent = 'Looks like you haven’t added anything to your cart yet.';

  const shopNowLink = document.createElement('a');
  shopNowLink.href = 'index.php';
  shopNowLink.classList.add('shop-now-btn');
  shopNowLink.textContent = 'Shop Now';

  const emptyCart = document.createElement('div');
  emptyCart.classList.add('empty-cart-message');

  const head = document.createElement('h2');
  head.textContent = 'Your Cart is Empty';

  const paragr = document.createElement('p');
  paragr.textContent = 'Looks like you haven’t added anything to your cart yet.';

  emptyCart.appendChild(head);
  emptyCart.appendChild(paragr);

  emptyCartMessage.appendChild(heading);
  emptyCartMessage.appendChild(paragraph);
  emptyCartMessage.appendChild(shopNowLink);

  container.appendChild(emptyCart);
  summaryContainer.appendChild(emptyCartMessage);
}

function renderItems(json) {
  const container = document.getElementById('cart-items');
  const summaryContainer = document.getElementById('cart-summary');

  container.innerHTML = '';
  summaryContainer.innerHTML = '';

  const heading = document.createElement('h2');
  heading.textContent = 'Your Cart';
  container.appendChild(heading);


  let subtotal = 0;

  json.forEach((item) => {
    const cartItem = document.createElement('div');
    cartItem.classList.add('cart-item');

    const img = document.createElement('img');
    img.src = item[6];
    cartItem.appendChild(img);

    const itemDetails = document.createElement('div');
    itemDetails.classList.add('item-details');

    const name = document.createElement('h3');
    name.textContent = item[2];
    itemDetails.appendChild(name);

    const description = document.createElement('p');
    description.textContent = item[1];
    itemDetails.appendChild(description);

    const category = document.createElement('p');
    category.innerHTML = `Category: <strong>${item[5]}</strong>`;
    itemDetails.appendChild(category);

    cartItem.appendChild(itemDetails);

    const quantityContainer = document.createElement('div');
    quantityContainer.classList.add('quantity-container');

    const foundItem = cart.find((i) => i.id === item[0]); 

    const decrementBtn = document.createElement('button');
    decrementBtn.textContent = '-';
    decrementBtn.onclick = () => decrem(`quantity-${item[0]}`,item[0]);

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.id = `quantity-${item[0]}`;
    quantityInput.value = foundItem.quantity;
    quantityInput.readOnly = true;

    const incrementBtn = document.createElement('button');
    incrementBtn.textContent = '+';
    incrementBtn.onclick = () => increm(`quantity-${item[0]}`,item[0]);

    quantityContainer.appendChild(decrementBtn);
    quantityContainer.appendChild(quantityInput);
    quantityContainer.appendChild(incrementBtn);
    cartItem.appendChild(quantityContainer);

    const price = document.createElement('div');
    price.classList.add('item-price');
    const totayp = item[3] * foundItem.quantity;
    price.textContent = `$`+totayp;
    cartItem.appendChild(price);

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('remove-btn');
    removeBtn.textContent = 'Remove';
    removeBtn.onclick = () => {
      const index = cart.findIndex((i) => i.id === item[0]);
      if (index > -1) cart.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(cart));
      fetch_items(); 
    };

    cartItem.appendChild(removeBtn);

    container.appendChild(cartItem);

    subtotal += totayp;
  });

  const summaryHeading = document.createElement('h3');
  summaryHeading.textContent = 'Order Summary';
  summaryContainer.appendChild(summaryHeading);

  const subtotalItem = document.createElement('div');
  subtotalItem.classList.add('summary-item');
  subtotalItem.innerHTML = `<span>Subtotal:</span><span>$${subtotal}</span>`;
  summaryContainer.appendChild(subtotalItem);

  const shippingItem = document.createElement('div');
  shippingItem.classList.add('summary-item');
  shippingItem.innerHTML = `<span>Shipping:</span><span>Free</span>`;
  summaryContainer.appendChild(shippingItem);

  const taxItem = document.createElement('div');
  taxItem.classList.add('summary-item');
  taxItem.innerHTML = `<span>Tax:</span><span>0$</span>`;
  summaryContainer.appendChild(taxItem);

  const total = subtotal;
  const totalPrice = document.createElement('div');
  totalPrice.classList.add('total-price');
  totalPrice.innerHTML = `<span>Total:</span><span>$${total}</span>`;
  summaryContainer.appendChild(totalPrice);

  const checkoutBtn = document.createElement('button');
  checkoutBtn.classList.add('checkout-btn');
  checkoutBtn.textContent = 'Proceed to Checkout';
  // checkoutBtn.onclick = () => {
  //   alert('Order confirmed!');
  //   json.length = 0;
  //   renderItems(json);
  // };
  summaryContainer.appendChild(checkoutBtn);
}


