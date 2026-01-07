<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // ถ้าไม่ได้ Login ห้ามเข้าหน้านี้
    exit();
}
include 'db.php';
$uid = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id=$uid")->fetch_assoc();
?>
<!---***********************************************--->
<!---***********************************************--->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบโพสต์</title>
    <link rel="stylesheet" href="system.css">
</head>
<body>
<!-- TOP BAR -->
<div class="header" style="z-index: 1;">
  <div class="header-left">
    <div class="circle"><img src="icon2.jpeg" alt=""></div>
    <h2>ระบบ ททท</h2>
  </div>


  <!-- ไอคอน 3 ขีด -->
  <div class="box_header" style="display:flex; align-items:center;">
    <div class="box_namebar" style="margin-right:20px; font-size:24px;">
      <?php echo $user['name']; ?>
    </div>
    <div class="menu-icon" id="boxchan" onclick="alnalogbox()">☰</div>
    <!-- เมนูเปิดปิด -->
    <div id="dropdownMenu" class="dropdown-menu">
      <div><a href="profile.php" onclick="showPage('profile')"> Profile</a></div>
      <div><a href="history.html" onclick="showPage('history')"> History</a></div>
      <div> <a href="logout.php">ออกจากระบบ</a> </div>
    </div>
  </div>
</div>
<script>
function alnalogbox(){
  const cat_boxes = document.getElementsByClassName("cat-box");
  const menu = document.getElementById("dropdownMenu");
  menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>

<!---***********************************************--->
<!---***********************************************--->
<!---***********************************************--->

            <!---     สวนของ header    --->

<!---***********************************************--->
<!---***********************************************--->
<!---***********************************************--->
<!---***********************************************--->

<!-- NEWS SECTION -->
<div class="section-title">
  <h3>ข่าวสาร</h3>
  <div class="add-btn" onclick="location.href='form_news/from1.html'">+</div>
</div>

<div id="feed" style="display:flex;flex-wrap:wrap;gap:15px;justify-content:center;"></div>

<style>
.menu3{
  position:absolute;
  top:8px;
  right:8px;
  width:26px;
  height:26px;
  border-radius:50%;
  background:rgba(0,0,0,0.6);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  font-size:18px;
}

.menu-box{
  position:absolute;
  top:35px;
  right:8px;
  background:white;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,.3);
  overflow:hidden;
  display:none;
}

.menu-box div{
  padding:10px 15px;
  cursor:pointer;
}

.menu-box div:hover{
  background:#f1f1f1;
}
</style>

<script>
let posts = JSON.parse(localStorage.getItem("posts")) || [];

function renderFeed(){
  let html = "";

  posts.forEach((p,i)=>{
    html += `
      <div style="
        width:250px;height:350px;border-radius:18px;
        background:url('${p.image}');
        background-size:cover;background-position:center;
        position:relative;overflow:hidden;">

        <!-- 3 จุด -->
        <div class="menu3" onclick="toggleMenu(${i})">⋮</div>

        <!-- เมนู -->
        <div id="menu-${i}" class="menu-box">
          <div onclick="editPost(${i})">แก้ไข</div>
          <div onclick="deletePost(${i})">ลบ</div>
        </div>

        <!-- เนื้อหา -->
        <div onclick="openPost(${i})" style="
          position:absolute;bottom:0;width:100%;color:white;
          padding:10px;
          background:linear-gradient(to top,rgba(0,0,0,1),transparent)">
          
          <h3>${p.title}</h3>
          <p>${p.summary}</p>
          <small>${p.date}</small>
        </div>

      </div>
    `;
  });

  document.getElementById("feed").innerHTML = html;
}

function toggleMenu(i){
  document.querySelectorAll(".menu-box").forEach(m=>m.style.display="none");
  let box = document.getElementById("menu-"+i);
  box.style.display = box.style.display === "block" ? "none" : "block";
}

// ลบโพสต์
function deletePost(index){
  if(confirm("ต้องการลบโพสต์นี้ไหม?")){
    posts.splice(index,1);
    localStorage.setItem("posts", JSON.stringify(posts));
    renderFeed();
  }
}

// แก้ไขโพสต์ --> ไปหน้า edit_news.html
function editPost(index){
  location.href = "form_news/edit_news.html?id=" + index;
}

// เปิดโพสต์
function openPost(i){
  location.href = "post_view.html?id=" + i;
}

renderFeed();
</script>

<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<div class="section-title">
  <h3>แนะนำ</h3>
  <div class="add-btn" onclick="location.href='recomend/from_p1.html'">+</div>
</div>

<div id="feedter" style="display:flex;flex-wrap:wrap;gap:15px;justify-content:center;"></div>

<style>
.menuR{
  position:absolute;
  top:8px;
  right:8px;
  width:26px;
  height:26px;
  border-radius:50%;
  background:rgba(0,0,0,0.6);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  font-size:18px;
}

.menu-box-r{
  position:absolute;
  top:35px;
  right:8px;
  background:white;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,.3);
  overflow:hidden;
  display:none;
}

.menu-box-r div{
  padding:10px 15px;
  cursor:pointer;
}

.menu-box-r div:hover{
  background:#f1f1f1;
}
</style>

<script>
// ดึงข้อมูล
let postser = JSON.parse(localStorage.getItem("postser")) || [];

// แสดงโพสต์
function renderFeedter(){
  const feed = document.getElementById("feedter");
  if(postser.length === 0){
    feed.innerHTML = "<p style='text-align:center;width:100%'>❌ ยังไม่มีโพสต์แนะนำ</p>";
    return;
  }

  let html = "";
  postser.forEach((p,i)=>{
    html += `
    <div style="
      width:250px;height:350px;margin:15px;border-radius:18px;
      background:url('${p.image || ""}');
      background-size:cover;background-position:center;
      position:relative;overflow:hidden;
    ">

      <!-- จุด 3 จุด -->
      <div class="menuR" onclick="toggleMenuR(event,${i})">⋮</div>

      <!-- กล่องเมนู -->
      <div id="menuR-${i}" class="menu-box-r">
        <div onclick="editPostR(${i})">แก้ไข</div>
        <div onclick="deletePostR(${i})">ลบ</div>
      </div>

      <!-- เนื้อหา -->
      <div onclick="openPostR(${i})"
        style="position:absolute;bottom:0;left:0;right:0;
        background:linear-gradient(to top,rgba(0,0,0,.8),transparent);
        color:white;padding:10px;cursor:pointer;">
        <h4>${p.title || ""}</h4>
        <small>${p.summary || ""}</small><br>
        <span>${p.date || ""}</span>
      </div>

    </div>
    `;
  });

  feed.innerHTML = html;
}

// เมนู
function toggleMenuR(e,i){
  e.stopPropagation();
  document.querySelectorAll(".menu-box-r").forEach(m=>m.style.display="none");
  const box = document.getElementById("menuR-"+i);
  box.style.display = box.style.display === "block" ? "none" : "block";
}

document.addEventListener("click",(e)=>{
  if(!e.target.closest(".menu-box-r") && !e.target.closest(".menuR")){
    document.querySelectorAll(".menu-box-r").forEach(m=>m.style.display="none");
  }
});

// ลบโพสต์
function deletePostR(index){
  if(confirm("ต้องการลบโพสต์นี้ไหม?")){
    postser.splice(index,1);
    localStorage.setItem("postser", JSON.stringify(postser));
    renderFeedter();
  }
}

// แก้ไขโพสต์ --> ไปหน้า edit
function editPostR(index){
  location.href = "recomend/edit_p1.html?id="+index;
}

// เปิดโพสต์ --> ไปหน้าอ่าน
function openPostR(i){
  location.href = "recomend/postser.html?id="+i;
}

renderFeedter();
</script>
<!--------------------------->
<!--------------------------->

<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
<!--------------------------->
</body>
</html>


<!--------------------------->
<!--------------------------->

<!--------------------------->
<!--------------------------->

<!--------------------------->
<!--------------------------->
