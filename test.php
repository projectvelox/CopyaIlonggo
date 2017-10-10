<?php
$user = 'Dude';

$db=new mysqli('localhost','root',"",'ci');
if($db->connect_errno){
echo $db->connect_error;}
$pull="select * from userimage where user='$user'"; $allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
$extension = @end(explode(".", $_FILES["file"]["name"]));
if(isset($_POST['pupload'])){
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/JPG")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts))
{
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
echo '<div class="plus">';
echo "Uploaded Successully";
echo '</div>';
echo"<br/><b><u>Image Details</u></b><br/>";

echo "Name: " . $_FILES["file"]["name"] . "<br/>";
echo "Type: " . $_FILES["file"]["type"] . "<br/>";
echo "Size: " . ceil(($_FILES["file"]["size"] / 1024)) . " KB";

if (file_exists("upload/" . $_FILES["file"]["name"]))
{
unlink("upload/" . $_FILES["file"]["name"]);
}
else
{
$pic=$_FILES["file"]["name"];
$conv=explode(".",$pic);
$ext=$conv['1'];

move_uploaded_file($_FILES["file"]["tmp_name"],
"img/uploads/". $user.".".$ext);
echo "Stored in as: " . "img/uploads/" . $user.".".$ext;
$url=$user.".".$ext;

$query="update userimage set url='$url' where user='$user'";
if($upl=$db->query($query)){
echo "<br/>Saved to Database successfully";
}
}
}
}
else {
echo "File Size Limit Crossed 200 KB Use Picture Size less than 200 KB";

}
}
?>

<form action="" method="post" enctype="multipart/form-data">
<?php
$res=$db->query($pull);
$pics=$res->fetch_assoc();
echo '<div class="imgLow">';
echo "<img src='img/uploads/$pics[url]' alt='Profile Picture' width='80' height='64' class='doubleborder'/></div>";
?>

<input type="file" name="file" />
<input type="submit" name="pupload" class="button" value="Upload"/>

</form>

