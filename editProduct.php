<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    .edit-form-container{
        width: 50%;
        margin: auto;
        border: 2px solid #333;
        padding: 50px 20px;
        border-radius: 10px;
    }

    .main-text{
        border-left: #333 solid 3px;
        font-size: 20px;
        font-weight: 300;
        padding-left:10px;
    }

    /* .edit-form-container label{
        margin-top: 20px;
    } */

    .edit-form-container .name, .price, .imageName{
        border: 1px solid #ddd;
        width: 95%;
        padding:10px;
        margin-top:0px;
        border-radius:5px;
        margin-bottom: 15px;
    }

    .submit-btn{
        width: 49%;
        padding: 8px 15px;
        background-color: rgb(72, 178, 192);
        text-transform: uppercase;
        border:   rgb(72, 178, 192) 1px solid;
        color: white;
        font-weight: 600;
    }

    .delete-btn{
        width: 49%;
        padding: 8px 15px;
        background-color: rgb(245, 44, 84);
        text-transform: uppercase;
        border:  rgb(245, 44, 84) 1px solid;
        color: white;
        font-weight: 600;
    }

</style>

<body>

    <?php
    include 'connection.php';

    

    //Getting productId from trader interface
    $productID = $_GET['productID'];

    
    if(isset($_POST['update'])){
        $productName = $_POST['name'];
        $productPrice = $_POST['price'];
        $productDescription = $_POST['description'];
        $productImage = $_POST['image'];

        $updateQuery = "UPDATE product SET product_name='$productName', product_price = '$productPrice', product_description = '$productDescription',  product_image = '$productImage' WHERE product_id ='$productID'";
        
        $resultCheck = mysqli_query($connection, $updateQuery);

        if($resultCheck){
            echo "Update Successful";
            header('Location: dashboard.php');exit();
        }

        else{
            echo "Unsuccessful. Please Try Again";
        }

    }

    if(isset($_POST['delete'])){
        
        $deleteQuery = "DELETE from product WHERE product_id ='$productID'";
        
        $resultCheck = mysqli_query($connection, $deleteQuery);

        if($resultCheck){
            echo "Delete Successful";
            header('Location: dashboard.php');exit();
        }
        
        else{
            echo "Delete Unsuccessful. Please Try Again";
        }

    }


    $selectQuery = "SELECT * FROM product WHERE Product_id = '$productID'";

    $resultCheck = mysqli_query($connection, $selectQuery);

        while($row = mysqli_fetch_assoc($resultCheck)){
            echo 
            "<div class='container'>
                <div class='edit-form-container'>
                    <h2 class='main-text'>Update your product.</h2>
                    <form method='POST'>
                        <label for='Name:'>Name:</label>
                        <input type='text' name='name' class='name' placeholder='Product Name' value='$row[product_name]'> <br>
            
                        <label for='Name:'>Price:</label>
                        <input type='text' name='price' class='price' placeholder='Product Price' value='$row[product_price]'><br>
            
                        <label for='Name:'>Image Name:</label>
                        <input type='text' name='image' class='imageName' placeholder='Image Name' value='$row[product_image]'><br>

                        <label for='Name:'>Image Description</label>
                        <input type='text' name='description' class='imageName' placeholder='Image Name' value='$row[product_description]'><br>

                        <input type='submit' class='submit-btn' value='update' name='update'>
                        <input type='submit' class='delete-btn' value='delete' name='delete'>


                    </form>
                </div>
            </div>
            ";
        }


    ?>


</body>

</html>