<div class="h-menu-l"><span class="glyphicon glyphicon-link"></span> หน่วยงานที่เกี่ยวข้อง</div>
<div class="boxlink">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "patong_2019";

        // Create connection
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM tb_page WHERE page_id='4'";
        $result = mysqli_query($connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $page_id = $row['page_id'];
            $page_name = $row['page_name'];
            $page_detail = $row['page_detail'];

            $word_cut = array("<p>", "</p>");
            $replace = " ";
            
            for ($i = 0; $i < sizeof($word_cut); $i++) {
                $page_detail = str_ireplace($word_cut[$i], $replace, $page_detail);
            }
            
            echo str_replace("../upload/files", "upload/files", $page_detail);
        } else {
            echo "0 results";
        }

        // Close connection
        mysqli_close($connection);
    ?>
</div>
