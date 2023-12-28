document.addEventListener('DOMContentLoaded',()=>{
    const wishlist=document.getElementById('wishlist');
    wishlist.addEventListener('mouseover',()=>{
        const message= document.createElement('span');
        message.textContent="You have no items in your wish list.";
        document.body.appendChild(message);
        wishlist.addEventListener('mouseout',()=>{
            document.body.removeChild(message);
        });
    });
});

