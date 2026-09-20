<?php
require_once 'connectdb.php';

$sql = "SELECT * FROM products";
$rs = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>21Missionboss - ท่องเที่ยวขุนเขา</title>
    
    <!-- ดึง Bootstrap มาใช้ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <!-- ดึงไฟล์ CSS ของเรามาใช้ (บรรทัดนี้คือตัวดึงไฟล์) -->
    <link rel="stylesheet" href="a.css">
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>
      </div>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">ขุนเขา</a></li>
        <li><a href="#" class="nav-link px-2">ฟีเจอร์</a></li>
        <li><a href="#" class="nav-link px-2">ราคา</a></li>
        <li><a href="#" class="nav-link px-2">คำถาม</a></li>
        <li><a href="#" class="nav-link px-2">เกี่ยวกับ</a></li>
      </ul>
      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-2">เข้าสู่ระบบ</button>
        <button type="button" class="btn btn-primary">สมัครสมาชิก</button>
      </div>
    </header>
</div>

<!-- Header ชื่อของคุณ -->
<div class="container text-center mb-4">
    <h1>21Missionboss</h1>
</div>

<!-- สไลด์ภาพ -->
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="mountain1.jpg" class="d-block w-100" alt="แสงแรกแห่งขุนเขา">
        <div class="carousel-caption d-none d-md-block">
          <h5>แสงแรกแห่งขุนเขา</h5>
          <p>สัมผัสความงามของพระอาทิตย์ขึ้นเหนือยอดเขาที่สูงที่สุด</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="peak2.jpg" class="d-block w-100" alt="เส้นทางสู่ธรรมชาติ">
        <div class="carousel-caption d-none d-md-block">
          <h5>เส้นทางสู่ธรรมชาติ</h5>
          <p>เดินป่าตามเส้นทางที่เขียวขจีและเงียบสงบ</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="trail3.jpg" class="d-block w-100" alt="ทิวทัศน์ตระการตา">
        <div class="carousel-caption d-none d-md-block">
          <h5>ทิวทัศน์ตระการตา</h5>
          <p>ชมทิวทัศน์แบบพาโนรามาของเทือกเขาที่ทอดยาวสุดลูกหูลูกตา</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- ส่วนแสดงการ์ดข้อมูล (วนลูป 12 ครั้งตรงนี้) -->
<!-- ส่วนแสดงการ์ดข้อมูล (วนลูป 12 ครั้งตรงนี้) -->
<div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        <?php while ($data = mysqli_fetch_array($rs)) { ?>
        <div class="col">
          <div class="card shadow-sm">
            <!-- ดึงรูปภาพจากคอลัมน์ image_url -->
            <img src="<?php echo $data['image_url']; ?>" aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top" height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%">
            <div class="card-body">
              <!-- ดึงชื่อจากฐานข้อมูลมาแสดงเป็นหัวข้อการ์ด -->
              <h5 class="card-title text-success"><?php echo $data['name']; ?></h5>
              <!-- ดึงรายละเอียดจากฐานข้อมูลมาแสดง (จากเดิมที่ฟิกซ์ข้อความไว้) -->
              <p class="card-text">
                <?php echo $data['description']; ?>
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">ดูเพิ่มเติม</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">แก้ไข</button>
                </div>
                <small class="text-body-secondary">9 นาที</small>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <!-- สิ้นสุดการวนลูป -->

      </div>
    </div>
</div>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">ผจญภัยในขุนเขา</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em" aria-hidden="true"><use xlink:href="#collection"></use></svg>
        </div>
        <h3 class="fs-2 text-body-emphasis">ไกด์ท้องถิ่นผู้เชี่ยวชาญ</h3>
        <p>เรามีบริการไกด์พาเดินป่าที่มีความรู้เรื่องเส้นทาง ประวัติศาสตร์ และความปลอดภัย พร้อมดูแลท่านอย่างดีตลอดการเดินทาง</p>
        <a href="#" class="icon-link">ดูรายละเอียดไกด์</a>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em" aria-hidden="true"><use xlink:href="#people-circle"></use></svg>
        </div>
        <h3 class="fs-2 text-body-emphasis">เป้าหมายการปีนเขา</h3>
        <p>เรามีเส้นทางเดินป่าและปีนเขาที่หลากหลาย ตอบโจทย์ทุกความท้าทาย ตั้งแต่ระดับเริ่มต้นไปจนถึงระดับมืออาชีพ</p>
        <a href="#" class="icon-link">เลือกเส้นทาง</a>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em" aria-hidden="true"><use xlink:href="#toggles2"></use></svg>
        </div>
        <h3 class="fs-2 text-body-emphasis">อุปกรณ์เดินป่า</h3>
        <p>เรามีอุปกรณ์เดินป่าคุณภาพสูงให้เช่าหรือซื้อครบครัน เช่น รองเท้า, เป้, เต้นท์, ถุงนอน เพื่อให้การผจญภัยของท่านสะดวกสบายและปลอดภัยที่สุด</p>
        <a href="#" class="icon-link">ดูอุปกรณ์ที่มี</a>
      </div>
    </div>
</div>

<div class="card mb-3">
    <img src="1.jpg" class="card-img-top" alt="สถานที่แนะนำสัปดาห์นี้">
    <div class="card-body">
      <h5 class="card-title">สถานที่แนะนำสัปดาห์นี้</h5>
      <p class="card-text">เส้นทางเดินป่า "ดอยผ้าห่มปก" และ "ยอดเขาโมโกจู" กำลังเป็นที่นิยมมากที่สุด เหมาะสำหรับผู้ที่ต้องการความท้าทายและทิวทัศน์ที่สวยงาม</p>
      <p class="card-text"><small class="text-body-secondary">อัพเดทล่าสุด 3 นาทีที่แล้ว</small></p>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
      <h5 class="card-title">ข้อมูลสำคัญสำหรับนักเดินป่า</h5>
      <p class="card-text">การตรวจสอบสภาพอากาศ, การจัดเตรียมน้ำดื่มและอาหาร, และการแจ้งเจ้าหน้าที่ป่าไม้ เป็นสิ่งที่จำเป็นก่อนการเดินทางทุกครั้ง</p>
      <p class="card-text"><small class="text-body-secondary">อัพเดทล่าสุด 3 นาทีที่แล้ว</small></p>
    </div>
    <img src="bottom_card2.jpg" class="card-img-bottom" alt="ข้อมูลสำคัญ">
</div>

</body>
</html>