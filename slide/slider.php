<!-- your other HTML code -->

<?php
require('../cp/connect.php');

// Connect to MySQL using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM tb_news WHERE news_slide='1' ORDER BY news_id DESC";
$result = $conn->query($query);
$totalp = $result->num_rows;
$total = $result->num_rows;

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- your head section -->
</head>
<body>
    <!-- your body section -->
    <div id="amazingslider-wrapper-1">
        <div id="amazingslider-1">
            <ul class="amazingslider-slides">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $news_id = $row['news_id'];
                    $news_name = $row['news_name'];
                    $news_detail = $row['news_detail'];
                    $news_date = $row['news_date'];
                    $news_type = $row['news_type'];
                    $news_img = $row['news_img'];
                    $news_slide = $row['news_slide'];

                    echo "
                    <li><a href='../news.php?id=$news_id' target='_blank'><img src='../images/news/$news_img' alt='$news_name' data-description='";
                    echo mb_substr(strip_tags($news_detail), 0, 150, 'UTF-8') . ' ...';
                    echo "' /></a></li>";
                }
                ?>
            </ul>
            <ul class="amazingslider-thumbnails">
                <?php
                $result->data_seek(0); // รีเซ็ต pointer ของผลลัพธ์กลับไปที่ตำแหน่งแรก
                while ($row2 = $result->fetch_assoc()) {
                    $news_id = $row2['news_id'];
                    $news_name = $row2['news_name'];
                    $news_detail = $row2['news_detail'];
                    $news_date = $row2['news_date'];
                    $news_type = $row2['news_type'];
                    $news_img = $row2['news_img'];
                    $news_slide = $row2['news_slide'];

                    echo "
                    <li><img src='../images/news/$news_img' alt='$news_name' /></li>";
                }
                ?>
            </ul>
            <div class="amazingslider-engine"><a href="http://amazingslider.com" title="Responsive jQuery Slider">Responsive jQuery Slider</a></div>
        </div>
    </div>
</body>
</html>
