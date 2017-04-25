<?php


//http://myunitel.uniteltmais.cv/MyUnitel/api/IOSupload/couverIOS/102"
	
   
?>

<!--?php
$image = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
$exif = exif_read_data($_FILES['image']['tmp_name']);
if(!empty($exif['Orientation'])) {
    switch($exif['Orientation']) {
        case 8:
            $image = imagerotate($image,90,0);
            break;
        case 3:
            $image = imagerotate($image,180,0);
            break;
        case 6:
            $image = imagerotate($image,-90,0);
            break;
    }
}

echo "Junk"
// $image now contains a resource with the image oriented correctly
?-->
<html>
   <body>
      
      <form action="http://myunitel.uniteltmais.cv/MyUnitel/api/IOSupload/couverIOS/48" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>
      
   </body>
</html>