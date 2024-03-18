const sideMenu = document.querySelector("aside");
const themeToggler = document.querySelector(".theme-toggler");

const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const sidebar = document.querySelector('aside');

// Function to show the sidebar
function showSidebar() {
    sidebar.style.display = 'block';
}

// Function to hide the sidebar
function hideSidebar() {
    sidebar.style.display = 'none';
}

// Function to toggle sidebar visibility based on screen size
function toggleSidebar() {
    // Check screen size
    if (window.innerWidth >= 768) {
        // Always show sidebar when screen is above 786
        showSidebar();
    } else {
        // Toggle sidebar visibility using menuBtn and closeBtn
        sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    }
}

// Initial toggle based on screen size

// Toggle sidebar when menu button is clicked
menuBtn.addEventListener('click', () => {
    toggleSidebar();
});

// Close sidebar when close button is clicked
closeBtn.addEventListener('click', () => {
    hideSidebar();
});

// Update sidebar visibility on window resize
window.addEventListener('resize', () => {
  if (window.innerWidth >= 768) {
    // Always show sidebar when screen is above 786
    showSidebar();
} ;
});



// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})






























// ******************************************************************************************************************fill orders in table
// Orders.forEach(order => {
//     const tr = document.createElement('tr');
//     const trContent = `
//                         <td>${order.productName}</td>
//                         <td>${order.productNumber}</td>
//                         <td>${order.paymentStatus}</td>
//                         <td class="${order.shipping === 'Declined' ? 'danger' : order.shipping === 'pending' ? 'warning' : 'primary'}">${order.shipping}</td>
//                         <td class="primary">Details</td>
//                         `;
//     tr.innerHTML = trContent;
//     document.querySelector('table tbody').appendChild(tr);

// })