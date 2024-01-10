
function showMessage() {
    if (this.ItemsCount === 0) {
        const message = document.createElement('span');
        message.textContent = "You have no items in your wishlist.";
        message.style.position = "absolute";
        message.classList.add('wishlist');
        document.body.appendChild(message);

        this.$el.addEventListener('mouseout', () => {
            document.body.removeChild(message);
        });
    }
}

function redirectToWishlist() {
    if (this.wishlistItemsCount > 0) {
        window.location.href = "{{ route('wishlistIndex') }}";
    }
}


const menuBar=document.getElementById('menu');
const close=document.getElementById('close');
const category=document.getElementById('categories');
const nav=document.querySelector('.section2');

menuBar.addEventListener('click',(e)=>{
   e.preventDefault()
    nav.style.display="flex";
    category.style.display="flex";
    menuBar.style.display="none";
    close.style.display="flex";


});
close.addEventListener('click',(e)=>{
        e.preventDefault();
    nav.style.display="none";
    category.style.display="none";
    menuBar.style.display="flex";
    close.style.display="none";
});




function showCart(productCard) {
    const cart = productCard.querySelector('.cart');
    cart.style.display = "flex";
}

function hideCart(productCard) {
    const cart = productCard.querySelector('.cart');
    cart.style.display = "none";

}

//Pop up window

const popupLink=document.getElementById('popup');
const popupContainer=document.getElementById('popup-window');
const closeBtn=document.getElementById('cancel');

const form=document.getElementById('checkoutForm');
popupLink.addEventListener('click',(e)=>{
    e.preventDefault();
    popupContainer.style.display="block";
});
//Hiding the popup window
closeBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    popupContainer.style.display="none";
});




// const span=document.getElementById('span');
// const list=document.getElementById('block');

// span.addEventListener('mouseover',()=>{
//     list.style.display="flex";
// });


document.addEventListener('DOMContentLoaded', function () {
    // Get all radio buttons
    const radioButtons = document.querySelectorAll('input[name="address"]');
    
    // Add event listeners for mouseover and mouseout events
    radioButtons.forEach(function (radioButton) {
        radioButton.addEventListener('mouseover', function () {
            const addressId = this.value;
            showAddressDetails(addressId);
        });

        radioButton.addEventListener('mouseout', function () {
            const addressId = this.value;
            hideAddressDetails(addressId);
        });
    });

    // Function to show address details
    function showAddressDetails(addressId) {
        const addressDetails = document.getElementById('address_' + addressId);
        if (addressDetails) {
            addressDetails.style.display = 'block';
        }
    }

    // Function to hide address details
    function hideAddressDetails(addressId) {
        const addressDetails = document.getElementById('address_' + addressId);
        if (addressDetails) {
            addressDetails.style.display = 'none';
        }
    }
});
function setSelectedAddressId(radioButton) {
    const selectedAddressId = radioButton.value;
    document.getElementById('selectedAddressId').value = selectedAddressId;
}