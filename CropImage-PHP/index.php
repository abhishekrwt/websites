<?php include("header1.php"); ?>

<section id="showcase">
      <div class="container">
        <h1>Cropped Image Gallery</h1>
        <p>All the images after cropping them</p>
      </div>
</section>
<section id="newsletter">
    </section>
     


	<section>
    <div class="container">
        <div class="heading">
            <h2 style="text-align: center;">|    Galary    |</h2>           
        </div>
      <?php
          require('config/db.php'); 
          $query = 'SELECT * FROM cropped';
          $result = mysqli_query($conn, $query);
          while($post=mysqli_fetch_array($result))
          {
        ?>
      <div style="float: left; padding: 10px;">
      <a class="example-image-link" href="cropimg/<?php echo $post['image']?>" data-lightbox="example-1">
      <img class="example-image" src="cropimg/<?php echo $post['image']?>" alt="image-1" style="height: 300px; width: 300px;" /></a>
    </div>
      <?php } ?>
    </div>
    </section>



  <footer>
      <p>Image Crop Tool, Copyright &copy; 2018</p>
</footer>

