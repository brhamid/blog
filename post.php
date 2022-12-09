<?php
include "./config/db.php";
include "./config/config.php";


if(isset($_POST['delete'])){

    $delete_id = mysqli_real_escape_string($connection,$_POST['delete_id']);
    


    $query = "DELETE FROM posts where id = {$delete_id};
    
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
    <div class="container">
        <a href="<?php echo ROOT_URL;?>" class="btn btn-primary">Back</a>
        <h1><?php echo $post['title'];?></h1>
            <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
            <p> <?php echo $post['body'];?> </p>
            <hr>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

            <input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        
        
            </form>

            <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">EDIT</a>

            
           
    </div>
</body>
</html>