<?php
  require_once 'Database.php';

  class User extends Database{

    public function store($request)
    {
      $first_name = $request['first_name'];
      $last_name = $request['last_name'];
      $username = $request['username'];
      $password = $request['password'];

      $password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO assets (first_name, last_name, username, password) VALUES ('$first_name', '$last_name', '$username', '$password')";

      if($this->conn->query($sql)){
        header('location: ../views');
        exit;
      } else {
        die('Error creating the user: ' . $this->conn->error);
      }
    }

    public function login($request)
    {
      $username = $request['username'];
      $password = $request['password'];

      $sql = "SELECT * FROM assets WHERE username = '$username'";

      if($result = $this->conn->query($sql)){
        # check the username
        if($result->num_rows === 1){
          $user = $result->fetch_assoc();

          # check the password
          if(password_verify($password, $user['password'])){
            # create session
            session_start();

            $_SESSION['id']        = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

            header('location: ../views/dashboard.php');
            exit;
          } else {
            die('Password is incorrect');
          }
        } else {
          die ('Username not found.');
        }
      } else{
        die('Error retrieving the user: ' . $this->conn->error);
      }
    }

    public function logout()
    {
      session_start();
      session_unset();
      session_destroy();

      header('location: ../views');
      exit;
    }

    public function getAllUsers(){
      $sql = "SELECT * FROM assets";

      if($result = $this->conn->query($sql)){
        return $result;
      } else {
        die('Error retrieving all users: ' . $this->conn->error);
      }
    }

    public function getUser(){
      $id = $_SESSION['id'];

      $sql = "SELECT * FROM assets WHERE id = $id";

      if($result = $this->conn->query($sql)){
        return $result->fetch_assoc();
      } else {
        die('Error retrieving the user: ' . $this->conn->error);
      }
    }

    public function update($request, $file){
      session_start();
      $id = $_SESSION['id'];

      $first_name = $request['first_name'];
      $last_name  = $request['last_name'];
      $username   = $request['username'];
      $photo      = $file['photo']['name'];
      $tmp_photo  = $file['photo']['tmp_name'];

      $sql = "UPDATE assets SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $id";

      if($this->conn->query($sql)){
        $_SESSION['username'] = $username;
        $_SESSION['full_name'] = "$first_name $last_name";

        # Check if the user uploaded a new photo, save it to the db and save the file to the images folder

        if($photo){
          $sql = "UPDATE assets SET photo = '$photo' WHERE id = $id";
          $destination = "../assets/images/$photo";
          
          # Save the image name to the db
          if($this->conn->query($sql)){
            #Save the file to the images folder
            if(move_uploaded_file($tmp_photo, $destination)){
              header('location: ../views/dashboard.php');
              exit;
            } else {
              die('Error moving the photo.');
            }
          } else {
            die('Error uploading the photo: ' . $this->conn->eerror);
          }
        }
        header('location: ../views/dashboard.php');
        exit;
      } else {
        die('Error updating the user: ' . $this->conn->error);
      }
    }

    public function delete(){
      session_start();
      $id = $_SESSION['id'];

      $sql = "DELETE FROM assets WHERE id = $id";

      if($this->conn->query($sql)){
        $this->logout();
      } else {
        die("Error deleting your account: " . $this->conn->error);
      }
    }

  }
?>