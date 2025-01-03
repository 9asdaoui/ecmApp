 // Sales Chart
    const salesChart = new Chart(document.getElementById('salesChart'), {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Sales',
          data: [1200, 1900, 3000, 5000, 2300, 4500],
          borderColor: 'rgba(75, 192, 192, 1)',
          tension: 0.4
        }]
      }
    });

    // Top Products
    const topProducts = [
      { name: 'Product A', sales: 120 },
      { name: 'Product B', sales: 95 },
      { name: 'Product C', sales: 85 }
    ];
    const productList = document.getElementById('topProducts');
    topProducts.forEach(product => {
      const li = document.createElement('li');
      li.className = 'list-group-item';
      li.textContent = `${product.name} - ${product.sales} Sales`;
      productList.appendChild(li);
    });

    // Orders Table
    const orders = [
      { id: '#1234', customer: 'John Doe', date: '2024-12-30', status: 'Completed', amount: '$120.00' },
      { id: '#1235', customer: 'Jane Smith', date: '2024-12-29', status: 'Pending', amount: '$85.00' },
      { id: '#1236', customer: 'Alice Johnson', date: '2024-12-28', status: 'Cancelled', amount: '$60.00' }
    ];
    const orderTable = document.getElementById('orderTable');
    const orderSearch = document.getElementById('orderSearch');

    const renderOrders = (orders) => {
      orderTable.innerHTML = '';
      orders.forEach(order => {
        const row = `<tr>
          <td>${order.id}</td>
          <td>${order.customer}</td>
          <td>${order.date}</td>
          <td>${order.status}</td>
          <td>${order.amount}</td>
        </tr>`;
        orderTable.innerHTML += row;
      });
    };

    renderOrders(orders);

    // Filter Orders
    orderSearch.addEventListener('input', (e) => {
      const filteredOrders = orders.filter(order =>
        order.customer.toLowerCase().includes(e.target.value.toLowerCase()) ||
        order.id.toLowerCase().includes(e.target.value.toLowerCase())
      );
      renderOrders(filteredOrders);
    });