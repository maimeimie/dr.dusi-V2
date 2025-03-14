<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dusi_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$insert = false;
$update = false;
$empty = false;
$delete = false;
$already_card = false;

if (isset($_GET['delete'])) {
  $user_id = intval($_GET['delete']);

  if ($user_id > 0) {
      $sql = "DELETE FROM `users_dusi` WHERE `user_id` = $user_id";
      $result = mysqli_query($conn, $sql);
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['user_idEdit'])) {
      $user_id = mysqli_real_escape_string($conn, $_POST['user_idEdit']);
      $name_title = mysqli_real_escape_string($conn, $_POST["name_titleEdit"]);
      $name = mysqli_real_escape_string($conn, $_POST["nameEdit"]);
      $surname = mysqli_real_escape_string($conn, $_POST["surnameEdit"]);
      $identification = mysqli_real_escape_string($conn, $_POST["identificationEdit"]);
      
      $sql = "UPDATE `users_dusi` SET 
              `name_title` = '$name_title',
              `name` = '$name',
              `surname` = '$surname',
              `identification` = '$identification' 
              WHERE `users_dusi`.`user_id` = $user_id"; 
      $result = mysqli_query($conn, $sql);
      if ($result) {
          $update = true;
      } else {
          echo "ไม่สามารถอัพเดทได้: " . mysqli_error($conn);
      }
  } else {
      $name_title = isset($_POST['name_title']) ? $_POST['name_title'] : '';
      $name = isset($_POST['name']) ? $_POST['name'] : '';
      $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
      $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
      $identification = isset($_POST['identification']) ? $_POST['identification'] : '';
      $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
      $registration_date = isset($_POST['registration_date']) ? $_POST['registration_date'] : date('Y-m-d');
      $id_card_base = rand(100000, 999999); 
      $id_card = generateCode128($registration_date, $id_card_base); 

      if (empty($name_title) || empty($surname) || empty($name) || empty($sex) || empty($birthday) || empty($identification)) {
        $empty = true;
      } else {
          $query = mysqli_query($conn, "SELECT * FROM users_dusi WHERE identification = '$identification'");
          if (mysqli_num_rows($query) > 0) {
              $already_card = true;
          } else {
              $sql = "INSERT INTO `users_dusi` 
              (`name_title`, `name`, `surname`, `birthday`, `registration_date`, `identification`, `sex`, `id_card`) 
              VALUES ('$name_title', '$name', '$surname', '$birthday', '$registration_date', '$identification', '$sex', '$id_card')";
              $result = mysqli_query($conn, $sql);
              
              if ($result) { 
                  $insert = true;
              } else {
                  echo "Insert error: " . mysqli_error($conn);
              }
          }
      }
  }
}

function generateCode128($registration_date, $id_card_base) {
    $day = date('d', strtotime($registration_date));
    return $day . $id_card_base;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <title>เพิ่มผู้ใช้</title>
</head>

<body>
  <div class="container my-4">
    <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your Card has been inserted successfully
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
              </button>
            </div>";
    }
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your Card has been deleted successfully
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
              </button>
            </div>";
    }
    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your Card has been updated successfully
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
              </button>
            </div>";
    }
    if($empty){
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>Error!</strong> The Fields Cannot Be Empty! Please Give Some Values.
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
              </button>
            </div>";
    }
    if($already_card){
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>Error!</strong> This Card is Already Added.
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
              </button>
            </div>";
    }
    ?>
    
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      <i class="fa fa-plus"></i>เพิ่มผู้ใช้
    </button>
    <a href="id-card.php" class="btn btn-primary">
      <i class="fa fa-address-card"></i>สร้างการ์ด
    </a>
    
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <form method="POST" >
          <div class="form-row">

            <div class="form-group col-md-2.5">
              <label for="name_title">คำนำหน้า</label>
              <select name="name_title" class="form-control" id="name_title">
                <option selected>เลือก...</option>
                <option>นาย</option>
                <option>นาง</option>
                <option>นางสาว</option>
                <option>เด็กหญิง</option>
                <option>เด็กชาย</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="name">ชื่อ</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group col-md-4">
              <label for="surname">นามสกุล</label>
              <input type="text" name="surname" class="form-control" id="surname">
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">
              <label for="sex">เพศ</label>
              <select name="sex" class="form-control" id="sex">
                <option selected>เลือก...</option>
                <option>ชาย</option>
                <option>หญิง</option>
              </select>
            </div>

            <div class="form-group col-md-6.5">
              <label for="birthday">วันเกิด</label>
              <input type="date" name="birthday" class="form-control" id="birthday">
            </div>

            <div class="form-group col-md-5">
              <label for="identification">หมายเลขบัตรประจำตัวประชาชน</label>
              <input type="identification" name="identification" class="form-control" id="identification">
            </div>
            
          </div>

          <button type="submit" class="btn btn-primary">ยืนยัน</button>
        </form>
      </div>
    </div>
  </div>

        <div class="container my-4">

        <table class="table" id="myTable">
          <thead>
            <tr>
            <th scope="col">ลำดับที่</th>
            <th scope="col">ชื่อ-นามสกุล</th>
            <th scope="col">หมายเลขบัตรประจำตัวประชาชน</th>
            <th scope="col">แก้ไข</th>
            </tr>
        </thead>
        <tbody>
  <?php 
        $sql = "SELECT user_id, CONCAT(name_title, ' ', name, ' ', surname) AS full_name, identification FROM `users_dusi` ORDER BY user_id DESC";
        $result = mysqli_query($conn, $sql);
        $user_id = 0;
        while($row = mysqli_fetch_assoc($result)){
            $user_id++;
            echo "<tr>
                <th scope='row'>". $user_id . "</th>
                <td>". $row['full_name'] . "</td>
                <td>". $row['identification'] . "</td>
                <td>
                    <button class='delete btn btn-sm btn-primary' id=d".$row['user_id'].">Delete</button>
                </td>
              </tr>";
        }
  ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("delete ");
            user_id = e.target.id.substr(1); // ดึง user_id จาก id ปุ่ม

            if (confirm("Are you sure you want to delete this note!")) {
                console.log("yes");
                window.location = `card-user.php?delete=${user_id}`; // ส่งค่าผ่าน URL
            } else {
                console.log("no");
            }
        });
    });
  </script>
</body>

</html>