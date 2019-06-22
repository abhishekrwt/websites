<!DOCTYPE html>
<html lang="en">
<?php include_once("header1.php");?> 
<link rel="stylesheet" href="css/mycss.css">
<body>
  <div id="reg">
<form action="update.php" method="post" enctype="multipart/form-data">
    <h1>Upload Image : </h1>
    <fieldset>
      <legend>Select Images:</legend>
      <label for="text">Upload File:</label>
      <input type="file" id="img" name="image[]" multiple="multiple" required>
    </fieldset><br>
    <button type="submit" name="submit" id="add">Add</button>
  </form>
  <br>
  <a class="links" href="delete.php">delete images?</a>
  <a class="links" href="index.php">Index Page</a>
</div>
</body>
</html>
