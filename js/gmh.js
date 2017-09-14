


//This is my arowoyin slideshow
var myIndex=0;
var i;
carousel();
weekSong();
	function carousel(){
		var x=document.getElementsByClassName("arowoyin");
		for (i=0;i<x.length;i++){
		x[i].style.display="none";
		}
		myIndex++;
		if (myIndex>x.length){myIndex=1}
		x[myIndex-1].style.display="block";
		setTimeout(carousel, 3000);
	}
	
	function mOver(obj){
		var x=document.getElementById("menu_new_nav");
		var y=document.getElementById("ipolowo");
		x.style.display="block";
		y.style.width="75%";
	}
	function mOut(obj){
		var x=document.getElementById("menu_new_nav");
		var y=document.getElementById("ipolowo");
		x.style.display="none";
		y.style.width="95%";
	}
    function weekSong(){
    var x=document.getElementsByClassName("song_week");
    for (i=0;i<x.length;i++){
        x[i].style.display="none";
    }
    myIndex++;
    if (myIndex>x.length){myIndex=1}
    x[myIndex-1].style.display="block";
    setTimeout(weekSong, 86400000);
	}

