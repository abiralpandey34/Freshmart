<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">

</head>
<style>
    .container{
        width:700px;
        height:500px;
        /* background-color:silver; */
        margin:auto auto;
        margin-top:15%;
        border-radius:20px;
        font-family: 'Lato', sans-serif;


        display:flex;
        flex-direction:column;
        text-align:center;
    }

    .img-container img{
        width:40%;
        height:auto;
    }

    .text-container button{
        background-color:rgb(129, 192, 34);
        color:white;
        font-weight:600;
        padding:8px 40px;
        border:none;
        font-size:1.2em;
        cursor:pointer;
    }

    @media only screen and (max-width: 700px) {
        .container{
            width:80%;
        }

        .img-container img{
        width:50%;
        height:auto;
    }
    }


</style>
<body>
    <div class="container">
        <div class="img-container">
            <img src="../images/errorPages/mail4.png" alt="">
        </div>
        <div class="text-container">
            <h1>Email Confirmation</h1>
            <p>We have sent you an email at email you provided. Please verify by clicking on link. You can leave this page if you want. </p>
    </div>
</body>
</html>