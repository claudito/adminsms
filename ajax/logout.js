var ruta    = "https://marketing.perutec.com.pe/";

function logout(){

$.ajax({
url:ruta+'controlador/logout.php',
type:'POST',
async:true,
data:{accion:'logout'},
success:function()
{  
localStorage.url = "";

self.location=ruta;
},
error:function(xhr,status,error)
{
	alert('ERROR: '+error);
}


});
}
