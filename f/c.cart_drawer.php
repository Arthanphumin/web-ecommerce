<!-- พื้นหลังสีดำโปร่งแสง (Overlay) -->
<div id="cartOverlay" class="fixed inset-0 bg-black/50 z-[60] hidden opacity-0 transition-opacity duration-300" onclick="toggleCart()"></div>

<!-- ตัวตะกร้าสไลด์ (Drawer) -->
<div id="cartDrawer" class="fixed top-0 right-0 h-full w-full sm:w-[550px] bg-sand z-[70] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
    
    <!-- Header ตะกร้า -->
    <div class="bg-pine text-white p-5 flex justify-between items-center shadow-md">
        <h2 class="text-xl font-bold flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-terra" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 2.293M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747"/></svg>
            ตะกร้าสินค้า
        </h2>
        <button onclick="toggleCart()" class="text-gray-300 hover:text-terra transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    
    <!-- พื้นที่แสดงรายการสินค้า -->
    <div id="cartItemsContainer" class="flex-1 overflow-y-auto p-6 flex flex-col gap-4 bg-sand/30">
        <!-- JS จะแทรกสินค้าตรงนี้ -->
    </div>

    <!-- ส่วนสรุปยอดและปุ่มชำระเงิน -->
    <div class="p-6 border-t border-gray-200 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="flex justify-between mb-4 font-bold text-lg text-charcoal">
            <span>ยอดรวมทั้งหมด:</span>
            <span id="cartTotal" class="text-terra">฿0.00</span>
        </div>
        <button class="w-full bg-terra hover:bg-[#c25a1e] text-white font-bold py-3.5 rounded-xl transition-colors shadow-md flex justify-center items-center gap-2">
            ดำเนินการสั่งซื้อ
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /></svg>
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 🔥 NEW: Sticky Bottom Cart Bar (Floating) -->
<!-- ========================================== -->
<div id="floating-cart-bar" onclick="toggleCart()" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 w-[calc(100%-2rem)] max-w-3xl bg-pine text-white rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] z-40 transition-all duration-500 translate-y-32 opacity-0 flex items-center justify-between px-4 sm:px-6 py-3 cursor-pointer hover:scale-[1.02] border border-gray-700/50">
    <div class="flex items-center gap-4">
        <!-- Icon & Small Badge -->
        <div class="relative hidden sm:block">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-terra" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 2.293M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747"/></svg>
            <span id="floating-cart-badge" class="absolute -top-1 -right-2 bg-terra text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
        </div>
        <!-- Summary Text -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3">
            <span id="floating-cart-items" class="text-sm font-medium text-gray-300">0 items</span>
            <span class="hidden sm:block text-gray-500 text-sm">|</span>
            <span id="floating-cart-total" class="font-bold text-lg text-terra">฿0.00</span>
        </div>
    </div>
    <!-- Action Button -->
    <button class="bg-terra hover:bg-[#c25a1e] text-white px-5 py-2 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 shadow-sm">
        ดูตะกร้า <span class="hidden sm:inline">/ ชำระเงิน</span> &rarr;
    </button>
</div>

<script>
    let cart = JSON.parse(localStorage.getItem('campgear_cart')) || [];

    document.addEventListener('DOMContentLoaded', () => {
        updateCartUI();
    });

    function saveCart() {
        localStorage.setItem('campgear_cart', JSON.stringify(cart));
    }

    function toggleCart(event) {
        if(event) event.preventDefault();
        const drawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('cartOverlay');
        
        if (drawer.classList.contains('translate-x-full')) {
            drawer.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        } else {
            drawer.classList.add('translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }
    }

    // 🔥 UPDATED: Frictionless Add to Cart
    function addToCart(id, name, price, image) {
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            cart.push({ id, name, price, image, qty: 1 });
        }
        
        saveCart();
        updateCartUI();
        
        // --- 1. Animation ให้ไอคอนตะกร้าข้างบนกระเด้ง (Bounce/Scale Feedback) ---
        const badgeEl = document.getElementById('cart-badge');
        if (badgeEl && badgeEl.parentElement) {
            const cartIconBtn = badgeEl.parentElement;
            // ใส่ class ขยายขนาดและเปลี่ยนสีชั่วคราว
            cartIconBtn.classList.add('scale-125', '-translate-y-1', 'text-terra');
            setTimeout(() => {
                // เอาออกเมื่อผ่านไป 300ms เพื่อให้มันเด้งกลับ
                cartIconBtn.classList.remove('scale-125', '-translate-y-1', 'text-terra');
            }, 300);
        }
        
        // --- 2. ลบคำสั่ง toggleCart() ออก เพื่อไม่ให้ลิ้นชักเด้งกวนใจลูกค้า ---
    }

    function updateCartUI() {
        const container = document.getElementById('cartItemsContainer');
        const badge = document.getElementById('cart-badge'); 
        const totalEl = document.getElementById('cartTotal');
        
        // Elements สำหรับ Floating Bar
        const floatingBar = document.getElementById('floating-cart-bar');
        const floatingItems = document.getElementById('floating-cart-items');
        const floatingTotal = document.getElementById('floating-cart-total');
        const floatingBadge = document.getElementById('floating-cart-badge');
        
        container.innerHTML = '';
        let total = 0;
        let totalQty = 0;

        if (cart.length === 0) {
            container.innerHTML = '<div class="text-center text-gray-400 mt-10">ยังไม่มีสินค้าในตะกร้า</div>';
            if(badge) badge.classList.add('hidden');
            
            // ซ่อน Floating Bar เมื่อตะกร้าว่างเปล่า
            if(floatingBar) {
                floatingBar.classList.add('translate-y-32', 'opacity-0');
                floatingBar.classList.remove('translate-y-0', 'opacity-100');
            }
        } else {
            if(badge) badge.classList.remove('hidden');
            cart.forEach((item, index) => {
                total += item.price * item.qty;
                totalQty += item.qty;
                
                container.innerHTML += `
                    <div class="flex gap-4 border-b border-gray-100 pb-4 bg-white p-3 rounded-xl shadow-sm">
                        <img src="${item.image}" class="w-16 h-16 object-contain rounded-md bg-gray-50 border border-gray-100">
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-charcoal line-clamp-1">${item.name}</h4>
                            <div class="text-terra text-sm font-bold mt-1">฿${item.price.toLocaleString(undefined, {minimumFractionDigits: 2})}</div>
                            <div class="flex items-center gap-3 mt-2">
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                    <button onclick="changeQty(${index}, -1)" class="w-7 h-7 flex items-center justify-center text-gray-500 bg-gray-50 hover:bg-gray-200 transition-colors">-</button>
                                    <span class="text-sm w-8 text-center font-medium bg-white">${item.qty}</span>
                                    <button onclick="changeQty(${index}, 1)" class="w-7 h-7 flex items-center justify-center text-gray-500 bg-gray-50 hover:bg-gray-200 transition-colors">+</button>
                                </div>
                            </div>
                        </div>
                        <button onclick="removeItem(${index})" class="text-gray-300 hover:text-red-500 self-start transition-colors p-1" title="ลบสินค้า">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                `;
            });
            
            // โชว์ Floating Bar และอัปเดตข้อมูล
            if(floatingBar) {
                floatingBar.classList.remove('translate-y-32', 'opacity-0');
                floatingBar.classList.add('translate-y-0', 'opacity-100');
                
                if(floatingItems) floatingItems.innerText = totalQty + (totalQty > 1 ? ' items' : ' item');
                if(floatingTotal) floatingTotal.innerText = '฿' + total.toLocaleString(undefined, {minimumFractionDigits: 2});
                if(floatingBadge) floatingBadge.innerText = totalQty;
            }
        }
        
        if(badge) badge.innerText = totalQty;
        if(totalEl) totalEl.innerText = '฿' + total.toLocaleString(undefined, {minimumFractionDigits: 2});
    }

    function changeQty(index, delta) {
        cart[index].qty += delta;
        if (cart[index].qty <= 0) cart.splice(index, 1);
        saveCart();
        updateCartUI();
    }

    function removeItem(index) {
        cart.splice(index, 1);
        saveCart();
        updateCartUI();
    }
</script>