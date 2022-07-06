<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./verify.css">
    <title>Verified sucessfully</title>

    <style>

* {
  padding: 0;
  margin: 0;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

.main {
  width: 850px;
  height: auto;
  background-color: white;
  border-radius: 30px;
  -webkit-box-shadow: 0 0 20px 9px #96bf2e52;
          box-shadow: 0 0 20px 9px #96bf2e52;
  margin: 25vh auto;
}

img {
  width: 100%;
  border-top-right-radius: 30px;
  border-bottom-right-radius: 30px;
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}

.logoimage {
  margin: 20px auto;
  padding: 0;
  display: block;
  height: auto;
  width: 25%;
  border-radius: 0%;
}

input {
  width: 100%;
  padding: 10px 0;
  margin: 5px 0;
  border: none;
  border-bottom: 1px solid #999;
  background: transparent;
  -webkit-transition: 0.5s;
  transition: 0.5s;
}

.submit-btn {
  border: none;
  border-radius: 50px;
  outline: none;
  height: 50px;
  width: 100%;
  background-color: #96bf2e;
  color: white;
  font-weight: bold;
}

.submit-btn:hover {
  background: white;
  border: 2px solid #96bf2e;
  color: #96bf2e;
}

/*responsive*/
@media screen and (max-width: 769px) {
  .logoimage {
    width: 35%;
    margin: 20px auto;
    margin-bottom: 0;
  }
  .col-lg-5 {
    display: none;
  }
  .main {
    width: 90%;
  }
}

@media screen and (max-width: 426px) {
  .logoimage {
    width: 65%;
  }
  .main {
    width: 90%;
  }
}
/*# sourceMappingURL=verify.css.map */

    </style>
</head>
<body>
    <!-- main container -->
    <div class="main row justify-content-center align-items-center fade-in mx-auto g-0">
            <!-- column for the content -->
            <div class="col-lg-6 col-md-6 py-5">
                <div class="form-group row justify-content-center">
                    <!-- code for email -->
                    <div class="col-lg-8">
                        <h4>Congratulation! Your Verification has been successful.</h4>
                    </div>
                </div>
            </div> <!-- content ends-->
            <!-- column for the image -->
            <div class="col-lg-6 col-md-6">
                <img class="d-block w-100" src="./verified.png" alt="">    
            </div>
    </div> <!--main container ends-->



<!-- connecting to javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
</body>
</html>