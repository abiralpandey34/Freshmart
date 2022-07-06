

<style>


body{
}

.container{
    font-family: 'Lato', sans-serif;
    display:flex;
    flex-direction:column;

    margin: auto auto;
    margin-top:8%;
    height:400px;
    width:700px;
    text-align:center;
    align-items: center;
    justify-content: center;
}



.top-container{
    
    display:flex;
    flex-direction:row;
    flex-wrap:wrap;
    align-items: center;
    justify-content: center;
}

.top-container .img{flex:2;}
.top-container .text{flex:3;}

.top-container img{
    width:90%;
    height:auto;
}

.top-container .text{
    text-align:left;
    color:gray;
    font-weight:600;
    font-size:2em;
}

.top-container p{
    display:inline-block;
    margin-top:110px;

}

.bottom-container{
    padding-top:10px;
    text-align:center;
    font-size:17px;
}

.bottom-container a{
    text-decoration:none;
    font-weight:600;
    color:rgb(129, 192, 34);
}

@media only screen and (max-width: 700px) {
    .container{
        width:80%;
    }

    .top-container{
        text-align:center;
        width:80%;
        flex-direction:column;
    }

    .top-container .img{ flex:2 }
    .top-container .text{ flex:5 }

    .top-container img{
    width:80%;
    height:auto;
    }

    .top-container p{
    position: relative;
    margin-top:10px;
    }

}

</style>



<body>
    <div class='container'>
        <div class='top-container'>
            <div class='img'>
                <img src='../images/errorPages/lock.png'>
            </div>

            <div class='text'>
                <p>Collection slot for your chosen day is filled up. Please choose any other day. </p>
            </div>
        </div>

        <div class='bottom-container'>
            You'll be automatically redirected to Home Page in <span id='countdowntimer'>5</span> seconds.
            <?php header('Refresh: 5; URL=../customer/index.php');?>
        </div>
    </div>
</body>














<script type="text/javascript">
    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>