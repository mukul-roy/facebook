<?php

if (file_exists(__DIR__ . "/../autoload.php")) {
   require_once __DIR__ . "/../autoload.php";
}



?>


<?php

if (isset($_GET['action'])) {
   $action = $_GET['action'];
}


switch ($action) {

      //facebook ajex get form data

   case "users_create";
      //get form data
      echo $name = $_POST['posta_user_name'];
      echo $post_content = $_POST['post_content'];


      //upload user photo
      $fileName = fileupload([
         "name"    => $_FILES['post_user_photo']['name'],
         "tmp_name"    => $_FILES['post_user_photo']['tmp_name'],
      ], "../media/post/");
      echo $fileName;

      //post photos upload
      $post_photo = [];
      if (!empty($_FILES['post_photos']['name'][0])) {
         for ($i = 0; $i < count($_FILES['post_photos']['name']); $i++) {

            $post_photo_item = fileupload([
               "tmp_name"   => $_FILES['post_photos']['tmp_name'][$i],
               "name"   => $_FILES['post_photos']['name'][$i],
            ], "../media/post/user_photo/");

            array_push($post_photo, $post_photo_item);
         }
      }

      $post_photo_json = json_encode($post_photo);

      //sent data to db
      $sql = "INSERT INTO users (name, content, photo, postphotos) VALUES (?, ?, ?, ?)";
      $statement = connect()->prepare($sql);
      $statement->execute([$name, $post_content, $fileName,  $post_photo_json]); // Corrected


      break;



      //comment ajex get form data

   case "comment_create";
      //get form data
      echo $name = $_POST['comment_user_name'];
      echo $post_content = $_POST['comment_content'];
      $id = $_POST['commentId'];


      //upload user photo
      $fileName = fileupload([
         "name"    => $_FILES['comment_user_photo']['name'],
         "tmp_name"    => $_FILES['comment_user_photo']['tmp_name'],
      ], "../media/post/");
      echo $fileName;

      //sent data to db
      $sql = "UPDATE users SET commentname='$name',comment='$post_content',commenrphoto='$fileName'  WHERE id='$id' ";
      // $sql = "INSERT INTO users (commentname, comment, commenrphoto) VALUES (?, ?, ?)";
      $statement = connect()->prepare($sql);
      $statement->execute(); // Corrected


      break;

      //get all facebook user 

   case "devs_all";
      //new create sql
      $sql = "SELECT * FROM users";
      $statement = connect()->prepare($sql);
      $statement->execute();
      $data = $statement->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($data);

      break;




      //status_update
   case "devs_status_update";
      $id = $_POST['statusId'];

      $sql = "UPDATE users SET likes = likes + 1 WHERE id = $id";
      $statement = connect()->prepare($sql);
      $statement->execute();
      // echo json_encode($data);

      $sql = "SELECT * FROM users WHERE likes>0 AND id = $id";
      $statement = connect()->prepare($sql);
      $statement->execute();
      $data = $statement->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($data);

      break;
}


?>