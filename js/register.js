var x= document.getElementById("trader");
var y= document.getElementById("customer");
var z= document.getElementById("btn");
function customer(){
    x.style.left= "+1000px";
    z.style.left= "0px";
    y.style.left= "0px";
}
function trader(){
    y.style.left= "-1000px";
    z.style.left= "110px";
    x.style.left= "0px"; 

}


