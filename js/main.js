// DOM Elements
const customerName = document.getElementById("customerName");
const carPrice = document.getElementById("carPrice");
const rentalDays = document.getElementById("rentalDays");
const carCategory = document.getElementById("carCategory");
const updateBtn = document.getElementById("updateBtn");
const saveBtn = document.getElementById("saveBtn");
const itemsTable = document.getElementById("items");

// Car prices mapping
const carPrices = {
    "Ferrari 488 GTB": 150,
    "Ferrari Portofino": 178,
    "Ferrari F8 Tributo": 243,
    "Mercedes S-Class": 120,
    "Ferrari Roma": 195,
    "Ferrari 812 Superfast": 280
};

// Initialize array from localStorage or empty array
let rentals = localStorage.getItem('allRentals') ? JSON.parse(localStorage.getItem('allRentals')) : [];
let updateIndex = null;

// Initialize the display
displayRentals();

// Update price based on car selection
function updatePrice() {
    const selectedCar = carCategory.value;
    carPrice.value = selectedCar && carPrices[selectedCar] ? carPrices[selectedCar] : "";
}

// Add new rental
function addRental() {
    if (!validateForm()) return;
    
    const newRental = {
        customer: customerName.value,
        car: carCategory.value,
        price: parseFloat(carPrice.value),
        days: parseInt(rentalDays.value)
    };
    
    rentals.push(newRental);
    saveToLocalStorage();
    displayRentals();
    clearForm();
}

// Display all rentals
function displayRentals() {
    let html = '';
    
    rentals.forEach((rental, index) => {
        const totalPrice = rental.price * rental.days;
        html += `
            <tr>
                <td>${rental.customer}</td>
                <td>${rental.car}</td>
                <td>$${rental.price}</td>
                <td>${rental.days}</td>
                <td>$${totalPrice}</td>
                <td>
                    <button onclick="deleteRental(${index})" class="btn btn-sm btn-danger">Delete</button>
                    <button onclick="prepareUpdate(${index})" class="btn btn-sm btn-warning">Update</button>
                </td>
            </tr>
        `;
    });
    
    itemsTable.innerHTML = html || '<tr><td colspan="6" class="text-center">No rentals found</td></tr>';
}

// Delete a rental
function deleteRental(index) {
    if (confirm("Are you sure you want to delete this rental?")) {
        rentals.splice(index, 1);
        saveToLocalStorage();
        displayRentals();
    }
}

// Prepare form for update
function prepareUpdate(index) {
    updateIndex = index;
    const rental = rentals[index];
    
    customerName.value = rental.customer;
    carCategory.value = rental.car;
    carPrice.value = rental.price;
    rentalDays.value = rental.days;
    
    saveBtn.classList.add("d-none");
    updateBtn.classList.remove("d-none");
}

// Finish update
function finishUpdate() {
    if (!validateForm()) return;
    
    rentals[updateIndex] = {
        customer: customerName.value,
        car: carCategory.value,
        price: parseFloat(carPrice.value),
        days: parseInt(rentalDays.value)
    };
    
    saveToLocalStorage();
    displayRentals();
    clearForm();
    cancelUpdate();
}

// Cancel update mode
function cancelUpdate() {
    updateIndex = null;
    saveBtn.classList.remove("d-none");
    updateBtn.classList.add("d-none");
}

// Clear all data
function clearAllData() {
    if (confirm("Are you sure you want to delete ALL rental records?")) {
        rentals = [];
        localStorage.removeItem('allRentals');
        displayRentals();
    }
}

// Search rentals
function searchRental(term) {
    const filtered = rentals.filter(rental => 
        rental.customer.toLowerCase().includes(term.toLowerCase())
    );
    
    let html = '';
    filtered.forEach((rental, index) => {
        const totalPrice = rental.price * rental.days;
        html += `
            <tr>
                <td>${rental.customer}</td>
                <td>${rental.car}</td>
                <td>$${rental.price}</td>
                <td>${rental.days}</td>
                <td>$${totalPrice}</td>
                <td>
                    <button onclick="deleteRental(${index})" class="btn btn-sm btn-danger">Delete</button>
                    <button onclick="prepareUpdate(${index})" class="btn btn-sm btn-warning">Update</button>
                </td>
            </tr>
        `;
    });
    
    itemsTable.innerHTML = html || '<tr><td colspan="6" class="text-center">No matching rentals found</td></tr>';
}

// Clear form
function clearForm() {
    customerName.value = '';
    carCategory.value = '';
    carPrice.value = '';
    rentalDays.value = '';
}

// Save to localStorage
function saveToLocalStorage() {
    localStorage.setItem('allRentals', JSON.stringify(rentals));
}

// Form validation
function validateForm() {
    if (!customerName.value) {
        alert("Please enter customer name");
        return false;
    }
    if (!carCategory.value) {
        alert("Please select a car model");
        return false;
    }
    if (!rentalDays.value || rentalDays.value < 1) {
        alert("Please enter a valid number of rental days");
        return false;
    }
    return true;
}