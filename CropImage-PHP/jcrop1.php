<?php include("header1.php"); ?>
<script src="js/jcrop_main.js"></script>
<style type="text/css">
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}
  #cropbox1{
    background-color: #ccc;
    width: 600px;
    height: 400px;
    font-size: 24px;
    display: block;
  }
  #preview-pane .preview-container {
  width: 200px;
  height: 200px;
  overflow: hidden;
}
</style>
<?php
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    include_once("config/db.php");  
    $fetch= "SELECT * from image where id='$id'";
    $result = mysqli_query($conn,$fetch);
    $row=mysqli_fetch_assoc($result);
 ?>

<section id="main">
      <div class="container">
        <article id="main-col">
          <h1 class="page-title">Crop Image :</h1>
          <img src="image/<?php echo $row['image']; ?>" id="cropbox1" alt="[Jcrop Example]">    
        </article>

        <aside id="sidebar">
        <h1 class="page-title">Preview Image :</h1>
            <div id="preview-pane">
                <div class="preview-container">
                            <div style="overflow: hidden; width: 200px; height: 200px;">
                                <img src="image/<?php echo $row['image']?>" id="preview" alt="Preview" />
                        </div>
                </div>
              </div><br>
              <form action="jcrop1.php?image=<?php echo $row['image'];?>" method="post" onsubmit="return checkCoords();" style="float: left;">
                  <div class="inline-labels">
                      <label>X1 <input type="text" size="4" id="x" name="x" /></label>
                      <label>Y1 <input type="text" size="4" id="y" name="y" /></label><br>
                      <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
                      <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label><br>
                      <label>W: <input type="text" size="4" id="w" name="w" /></label>
                      <label>H : <input type="text" size="4" id="h" name="h" /></label>
                      </div>
                      <div style="margin:5px;">
                        <input type="submit" name="submit" value="Crop Image" class="button_1" />
                      </div>
                  </form>
                  
        </aside>
      </div>
    </section>

<?php } ?>
<?php
if (isset($_POST['submit']))
{
    $image=$_GET['image']; 

	$targ_w = $targ_h = 500;
	$jpeg_quality = 100;
    $src="image/".$image;
    $finalname = md5(time());
	$img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);
    $filename=$finalname.".jpeg";
    //header('Content-type: image/jpeg');
    imagejpeg($dst_r,"cropimg/".$filename,$jpeg_quality);
    include_once("config/db.php");
    $insert="INSERT into cropped(image)values('$filename')";
    $query=mysqli_query($conn,$insert);
    if(!$query){
        echo"Data not inserted";
    }
    else{
        header("location: index.php");
    }
    //imagedestroy($img_r);
	//imagedestroy($dst_r);
	exit;
}
?>