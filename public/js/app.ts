let burger = document.getElementById("burger");
var click = false;
burger.addEventListener('click', function(){
    console.log(click);
    let header = document.getElementById("header");
    let headerBalise = document.getElementById("header2");
    if(click === true){
        console.log("enfait ca marche");
        header.style.height = "8vh";
        headerBalise.style.display = "none";
        header.style.transition = "200ms";
        click = false;
    }
    else{
        header.style.height = "100vh";
        headerBalise.style.display = "block";
        header.style.transition = "300ms";
        click = true;
    }
   
})