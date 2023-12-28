
// document.addEventListener('DOMContentLoaded',()=>{
//     const wishlist=document.getElementById('wishlist');
//     console.log(wishlist);
//     wishlist.addEventListener('mouseover',()=>{
//         const message= document.createElement('span');
//         message.textContent="You have no items in your wish list.";
//         console.log(wishlist.offsetTop)
//         message.style.top = wishlist.offsetTop + wishlist.offsetHeight +20+ "px";
//         message.style.left = wishlist.offsetLeft - message.offsetWidth -250+ "px";
        
//         message.classList.add('wishlist');
//         document.body.appendChild(message);
//         wishlist.addEventListener('mouseout',()=>{
//             document.body.removeChild(message);
//         });
//     });
// });
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
console.log(nav);



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




const span=document.getElementById('span');
const list=document.getElementById('block');

span.addEventListener('mouseover',()=>{
    list.style.display="flex";
});


