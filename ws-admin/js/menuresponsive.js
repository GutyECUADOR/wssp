$(document).ready(main);
 
var contador = 1;
 
function main(){
	$('.btn_menu').click(function(){
		 //$('.sidebar-left').toggle(); 
 
		if(contador == 1){
			$('.sidebar-left').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('.sidebar-left').animate({
				left: '-100%'
			});
		}
 
	});
 
};

function showHide(){ 

var oImageDiv=document.getElementById('myimageDiv') 
var otextDiv=document.getElementById('mytext') 


otextDiv.style.display='inline'
} 