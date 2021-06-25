<?php 
        include 'reuseable/connection.php';

                    if(isset($_POST['save'])){

                      $fullname = filter_var($_POST['fullname'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $contact = filter_var($_POST['contact'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $address = filter_var($_POST['address'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $allergy = filter_var($_POST['allergy'],FILTER_SANITIZE_SPECIAL_CHARS);

                      $updateProfileQuery = "UPDATE user SET user_fullname='$fullname', user_phone_number='$contact', user_address='$address', user_allergy='$allergy' WHERE user_id=1;";


                      if(!empty($_POST['new-pass']) && !empty($_POST['re-pass']) && !empty($_POST['old-pass'])){
                        $oldPass = $_POST['old-pass'];
                        $newPass = $_POST['new-pass'];
                        $rePass = $_POST['re-pass'];

                        if($newPass != $rePass){
                          echo "New Password and Re-entered Passwords didn't match.";
                        }
                        else{
                          $passwordQuery = "SELECT user_password from user where user_id=1;";

                          $passwordQueryResult = mysqli_query($connection, $passwordQuery);
                          while($passwordQueryRow = mysqli_fetch_assoc($passwordQueryResult)){  
                            $currentPassword = $passwordQueryRow['user_password'];
                          }

                          if($oldPass != $currentPassword){
                            echo "Old Password you entered is wrong. ";
                          }
                          else{
                            $updateProfileQuery = "UPDATE user SET user_fullname='$fullname', user_phone_number='$contact', user_address='$address', user_allergy='$allergy', user_password='$newPass' WHERE user_id=1;";
                            $updateProfileResult = mysqli_query($connection, $updateProfileQuery);
                          }
                        }
                      }

                      elseif(!empty($_POST['new-pass']) && !empty($_POST['re-pass']) && empty($_POST['old-pass'])){
                        echo "Old password missing. Make sure you entered your old password.";
                      }

                      elseif(!empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass'])){
                        echo "Please fill Old password and re-new password";
                      }

                      elseif(!empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass'])){
                        echo "Please fill Old password and re-new password";
                      }

                      elseif(empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass'])){
                        $updateProfileQuery = "UPDATE user SET user_fullname='$fullname', user_phone_number=$contact, user_address='$address', user_allergy_information='$allergy' WHERE user_id=1;";
                        $updateProfileResult = mysqli_query($connection, $updateProfileQuery);

                        if($updateProfileResult){
                          echo "Update Successful";
                          header("Location:updateProfile.php");

                          }

                        else{
                          echo "Update wasn't Successful";

                        }
                      }

                      else{echo 'Please fill up all forms.';}



                    }
                ?>
