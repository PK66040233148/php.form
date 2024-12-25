<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <h2>ฟอร์มบันทึกข้อมูล</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">ชื่อ (Required):</label>
        <input type="text" name="name" id="name" required>
        <br><br>

        <label for="nickname">ชื่อเล่น (Required):</label>
        <input type="text" name="nickname" id="nickname" required>
        <br><br>

        <input type="submit" value="บันทึกข้อมูล">
    </form>

    <?php
    function test_input($data) {
        $data = trim($data);          // ลบช่องว่างที่ไม่จำเป็น
        $data = stripslashes($data);  // ลบเครื่องหมาย backslashes
        $data = htmlspecialchars($data); // แปลงอักขระพิเศษให้เป็น HTML entities
        return $data;
    }

    $nameErr = $nicknameErr = "";
    $name = $nickname = "";

    // ตรวจสอบว่าเป็นการส่งฟอร์มด้วยวิธี POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ตรวจสอบการกรอกข้อมูลในฟิลด์ชื่อ
        if (empty($_POST["name"])) {
            $nameErr = "กรุณากรอกชื่อ";
        } else {
            $name = test_input($_POST["name"]);
            // ตรวจสอบว่าชื่อประกอบด้วยตัวอักษรและช่องว่าง
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "ต้องกรอกตัวอักษรและเว้นวรรคเท่านั้น";
            }
        }

        // ตรวจสอบการกรอกข้อมูลในฟิลด์ชื่อเล่น
        if (empty($_POST["nickname"])) {
            $nicknameErr = "กรุณากรอกชื่อเล่น";
        } else {
            $nickname = test_input($_POST["nickname"]);
            // ตรวจสอบว่าชื่อเล่นประกอบด้วยตัวอักษรและช่องว่าง
            if (!preg_match("/^[a-zA-Z-' ]*$/", $nickname)) {
                $nicknameErr = "ต้องกรอกตัวอักษรและเว้นวรรคเท่านั้น";
            }
        }

        // ถ้าไม่มีข้อผิดพลาด ก็ทำการบันทึกข้อมูลลงในไฟล์
        if (empty($nameErr) && empty($nicknameErr)) {
            $content = "ชื่อ: $name, ชื่อเล่น: $nickname\n";

            // กำหนดชื่อไฟล์
            $file = "student.txt";

            // เปิดไฟล์ในโหมด append เพื่อเพิ่มข้อมูล
            $file_handle = fopen($file, "a"); // ใช้ "a" เพื่อเพิ่มข้อมูลลงไฟล์
            if ($file_handle) {
                // เขียนข้อมูลลงในไฟล์
                fwrite($file_handle, $content); 
                fclose($file_handle); // ปิดไฟล์
                echo "<h3>บันทึกข้อมูลสำเร็จ!</h3>";
                echo "ชื่อ: $name<br>";
                echo "ชื่อเล่น: $nickname<br>";
            } else {
                echo "<h3>ไม่สามารถเปิดไฟล์เพื่อบันทึกข้อมูลได้</h3>";
            }
        } else {
            // ถ้ามีข้อผิดพลาดในการกรอกข้อมูล จะแสดงข้อผิดพลาด
            echo "<span class='error'>$nameErr</span><br>";
            echo "<span class='error'>$nicknameErr</span><br>";
        }
    }
    ?>
</body>
</html>
