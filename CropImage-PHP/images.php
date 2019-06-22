<?php include_once("header1.php"); ?>
<style>
    img{
        height: 200px;
        width: 330px;
        margin : 10px;
    }
</style>
<?php
    include_once("config/db.php");
    $fetch= 'SELECT * from image';
    $result = mysqli_query($conn, $fetch);
?>
        <?php while($row=mysqli_fetch_assoc($result)){ ?>
        <div class="row" style="float: left; margin-top: 50px; padding: 20px;">
        <a href="jcrop1.php?id=<?php echo $row['id'];?>" ><img src="image/<?php echo $row['image']?>"></a><br>
        </div>
        <?php } ?>