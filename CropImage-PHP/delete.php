<?php include_once("header1.php");
error_reporting(0); ?>
<style>
    img{
        height: 200px;
        width: 330px;
        margin : 10px;
    }
    #orig ,crop{
        display: inline-block;
    }
</style>

<?php
    if($_GET['cat']==1 && isset($_GET['cat'])){
    include_once("config/db.php");
    $id=$_GET['id'];
    $fetch= 'SELECT * from images where id='.$id;
    $result = mysqli_query($conn, $fetch);
    while($row=mysqli_fetch_assoc($result)){
        unlink("image/".$row['image']);
    }
    $del="DELETE from image where id=$id";
    $query=mysqli_query($conn,$del);
    if(!$query){
        echo "not deleted";
    }
}

    if($_GET['cat'] == 0 && isset($_GET['cat'])){
    include_once("config/db.php");
    $id=$_GET['id'];
    $fetch= 'SELECT * from cropped where id='.$id;
    $result = mysqli_query($conn, $fetch);
    while($row=mysqli_fetch_assoc($result)){
        unlink("cropimg/".$row['image']);
    }
    $del="DELETE from cropped where id=".$id;
    $query=mysqli_query($conn,$del);
    if(!$query){
        echo "not deleted";
    }
    }
?>


<div id="orig">
<h1>ORIGINAL PHOTOS</h1>
<?php
    $cat="";
    include_once("config/db.php");
    $fetch= 'SELECT * from image';
    $result = mysqli_query($conn, $fetch);
     while($row=mysqli_fetch_assoc($result)){ ?>
        <div class="row" style="float: left; margin-top: 50px; padding: 20px;">
        <img src="image/<?php echo $row['image']?>"><br>
        <a href="delete.php?id=<?php echo $row['id'];?>&cat=1"><button type="button" name="original">Delete Image</button></a>
        </div>
        <?php } ?>

</div>
<div id="crop">
<h1>CROPPED PHOTOS</h1>
<?php
    $cat="";
    include_once("config/db.php");
    $fetch= 'SELECT * from cropped';
    $result = mysqli_query($conn, $fetch);
?>
        <?php while($post=mysqli_fetch_assoc($result)){ ?>
        <div class="row" style="float: left; margin-top: 50px; padding: 20px;">
        <img src="cropimg/<?php echo $post['image']?>"><br>
        <a href="delete.php?id=<?php echo $post['id'];?>&cat=0"><button type="button" name="crop">Delete Image</button></a>
        </div>
        <?php } ?>
    </div>