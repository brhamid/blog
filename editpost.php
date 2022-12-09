<?php
include "./config/db.php";
include "./config/config.php";


if(isset($_POST['submit'])){

    $update_id = mysqli_real_escape_string($connection,$_POST['update_id']);
    $title = mysqli_real_escape_string($connection,$_POST['title']);
    $author = mysqli_real_escape_string($connection,$_POST['author']);
    $body = mysqli_real_escape_string($connection,$_POST['body']);

    $query = "UPDATE posts SET
                title = '$title',
                author = '$author',
                body = '$body'

            WHERE id = {$update_id};
               
    
    ";

    if(mysqli_query($connection, $query)){
        header('Location: '. ROOT_URL.'');
    }else{
        echo 'Error'. mysqli_error($connection);
    }

}
$id = mysqli_real_escape_string($connection, $_GET['id']);
$query = 'SELECT * FROM posts WHERE id= '. $id;

$result = mysqli_query($connection,$query);
$post = mysqli_fetch_assoc($result);
echo "<pre>";

echo "</pre>";
mysqli_free_result($result);

mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://bootswatch.com/5/darkly/bootstrap.min.css">
</head>
<body>
<?php include('navbar.php');?>
    <div class="container">
        <h1>Edit Post</h1>

        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">



        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
        </div>

        <div class="form-group">
            <label for="">Author</label>
            <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
        </div>

        <div class="form-group">
            <label for="">Body</label>
            <textarea type="text" name="body" class="form-control"><?php echo $post['body']; ?></textarea>
        </div>
        <input type="hidden" name="update_id" value="<?php echo $post['id'];?>">
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">

    
    
    
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>