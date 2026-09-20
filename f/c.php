<?php
// ไฟล์เชื่อมต่อฐานข้อมูลของคุณ
require_once 'connectdb.php';

// รับค่าหมวดหมู่ที่ถูกเลือก (ถ้ามี)
$category_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;

// 1. ดึงข้อมูลหมวดหมู่ทั้งหมดสำหรับทำปุ่มตัวกรอง
$sql_categories = "SELECT * FROM categories";
$rs_categories = mysqli_query($conn, $sql_categories);

// 2. ดึงข้อมูลสินค้า (พร้อมชื่อหมวดหมู่) และกรองตามหมวดหมู่ถ้ามีการเลือก
if ($category_id > 0) {
    $sql_products = "SELECT p.*, c.name as category_name 
                     FROM products p 
                     LEFT JOIN categories c ON p.category_id = c.id 
                     WHERE p.category_id = $category_id 
                     ORDER BY p.id DESC";
} else {
    $sql_products = "SELECT p.*, c.name as category_name 
                     FROM products p 
                     LEFT JOIN categories c ON p.category_id = c.id 
                     ORDER BY p.id DESC";
}
$rs_products = mysqli_query($conn, $sql_products);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMPGEAR | Premium Outdoor Gear</title>
    <!-- Google Fonts: Noto Sans Thai -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pine: '#1B3B2B',       /* Deep Pine/Forest Green */
                        terra: '#D96B27',      /* Warm Terracotta/Amber */
                        sand: '#F4F3EF',       /* Warm Off-White/Light Sand */
                        charcoal: '#1A1A1A',   /* Charcoal Text */
                    },
                    fontFamily: {
                        sans: ['Noto Sans Thai', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sand text-charcoal antialiased flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    <header class="bg-pine text-white sticky top-0 z-50 shadow-md">
        <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo (แก้ไข href เป็น ? เพื่อให้อยู่หน้าเดิม) -->
            <a href="?" class="text-2xl font-bold tracking-wider flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-terra">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>
                CAMP<span class="text-terra">GEAR</span>
            </a>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-md mx-8 relative">
                <input type="text" placeholder="ค้นหาอุปกรณ์เดินป่า..." class="w-full bg-[#2a4d3a] text-white placeholder-gray-300 rounded-full py-2.5 pl-5 pr-12 focus:outline-none focus:ring-2 focus:ring-terra text-sm transition-shadow">
                <button class="absolute right-3 top-2.5 text-gray-300 hover:text-terra">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                </button>
            </div>

            <!-- User & Cart Icons -->
            <div class="flex items-center gap-5">
                <a href="#" class="hover:text-terra transition-colors hidden sm:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                </a>
                <a href="#" onclick="toggleCart(event)" class="relative hover:text-terra transition-all duration-300 ease-out inline-block cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    <!-- Cart Badge -->
                    <span id="cart-badge" class="absolute -top-2 -right-2 bg-terra text-white text-[10px] font-bold h-5 w-5 rounded-full flex items-center justify-center border-2 border-pine hidden">0</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 lg:px-8 py-10 flex-grow">
        
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-pine mb-3">21Missionboss</h1>
            <p class="text-gray-500 font-medium">Premium Outdoor & Camping Gear</p>
        </div>

        <!-- Filter Categories (Pill-shaped) -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <!-- (แก้ไข href เป็น ? เพื่อให้อยู่หน้าเดิม) -->
            <a href="?" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 <?php echo ($category_id == 0) ? 'bg-pine text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-pine hover:text-pine'; ?>">
                All Gear
            </a>
            
            <?php while ($cat = mysqli_fetch_array($rs_categories)) { ?>
                <!-- (แก้ไข href เป็น ?cat_id=... เพื่อให้อยู่หน้าเดิม) -->
                <a href="?cat_id=<?php echo $cat['id']; ?>" 
                   class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 <?php echo ($category_id == $cat['id']) ? 'bg-pine text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-pine hover:text-pine'; ?>">
                    <?php echo $cat['name']; ?>
                </a>
            <?php } ?>
        </div>

        <!-- Responsive 4-Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            
            <?php 
            if (mysqli_num_rows($rs_products) > 0) {
                while ($data = mysqli_fetch_array($rs_products)) { 
                    $image_path = "image/" . $data['image_url'];
                    if(!file_exists($image_path) || empty($data['image_url'])) {
                        $image_path = "image/no-image.jpg"; 
                    }
                    
                    // คำนวณเปอร์เซ็นต์สต็อก (สมมติเต็มที่ 50 ชิ้น)
                    $stock_percent = min(($data['stock_quantity'] / 50) * 100, 100);
            ?>
                <!-- Product Card -->
                <div class="group bg-white rounded-2xl flex flex-col overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    
                    <!-- Image Wrapper -->
                    <div class="relative bg-gray-50 p-6 flex justify-center items-center h-56 overflow-hidden">
                        <!-- In Stock Badge (Absolute) -->
                        <?php if($data['stock_quantity'] > 0) { ?>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-pine text-xs font-bold px-3 py-1.5 rounded-md shadow-sm border border-gray-100 flex items-center gap-1 z-10">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> พร้อมส่ง
                            </span>
                        <?php } ?>
                        
                        <img src="<?php echo $image_path; ?>" alt="<?php echo $data['name']; ?>" class="object-contain w-full h-full mix-blend-multiply group-hover:scale-110 transition-transform duration-500 ease-out">
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5 flex flex-col flex-grow">
                        <!-- Category Line -->
                        <div class="text-xs text-gray-400 font-medium tracking-wide uppercase mb-1 flex justify-between">
                            <span><?php echo $data['category_name'] ?? 'General'; ?></span>
                            <span class="text-gray-300">SKU: <?php echo $data['sku']; ?></span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-charcoal font-bold text-base leading-tight mb-4 line-clamp-2"><?php echo $data['name']; ?></h3>
                        
                        <!-- Price & Stock (Push to bottom) -->
                        <div class="mt-auto">
                            <div class="text-2xl font-bold text-terra mb-3">
                                ฿<?php echo number_format($data['price'], 2); ?>
                            </div>
                            
                            <!-- Stock Level Bar -->
                            <div class="mb-5">
                                <div class="flex justify-between text-[11px] mb-1.5 text-gray-500 font-medium">
                                    <span>สต็อกคงเหลือ</span>
                                    <span><?php echo $data['stock_quantity']; ?> ชิ้น</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-pine h-1.5 rounded-full transition-all duration-1000" style="width: <?php echo $stock_percent; ?>%"></div>
                                </div>
                            </div>
                            
                            <!-- 2 Distinct Buttons -->
                            <div class="flex gap-2">
                                <!-- Quick View (Icon Button) -->
                                <a href="product_detail.php?id=<?php echo $data['id']; ?>" class="flex items-center justify-center bg-gray-50 hover:bg-pine text-gray-500 hover:text-white border border-gray-200 hover:border-pine w-11 rounded-xl transition-colors tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                </a>

                                <!-- Add to Cart CTA -->
                                <button type="button" onclick="addToCart('<?php echo $data['id']; ?>', '<?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?>', <?php echo $data['price']; ?>, '<?php echo $image_path; ?>')" class="flex-1 bg-terra hover:bg-[#c25a1e] text-white font-semibold py-2.5 rounded-xl transition-colors shadow-sm shadow-terra/30 active:scale-95 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    หยิบใส่ตะกร้า
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php 
                } 
            } else { 
            ?>
                <!-- Empty State -->
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    <h3 class="text-xl font-bold text-charcoal mb-2">ไม่พบสินค้า</h3>
                    <p class="text-gray-500">ไม่มีอุปกรณ์ในหมวดหมู่ที่คุณเลือก โปรดลองเลือกหมวดหมู่อื่น</p>
                </div>
            <?php } ?>

        </div>
    </main>

    <?php include 'c.cart_drawer.php'; ?>

    <!-- Footer -->
    <footer class="bg-charcoal text-gray-300 py-8 border-t-4 border-terra">
        <div class="container mx-auto px-4 lg:px-8 text-center text-sm">
            <p>&copy; <?php echo date('Y'); ?> <span class="text-white font-bold tracking-wide">CAMPGEAR by 21Missionboss</span>. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>