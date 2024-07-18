<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>账号中心 - 操作结果</title>
<style>
@media (prefers-color-scheme:dark) {
  html {
    background-color:#000;
  }
}
</style>

<!--[if (gt IE 8)|(!IE)]><!-->
<script>
window.onetrack=window.onetrack||function(){(onetrack.q=onetrack.q||[]).push(arguments)}
onetrack('init', '30000000031')
</script>
<!--<![endif]-->

</head>
<body>
<input type="hidden" id="callback" value="{{ $redirect_url }}">
<script>
var logoutList=[];

@foreach ($endpoints as $endpoint)
logoutList.push("{{ $endpoint }}");

@endforeach

var protocol="https" || "https";
var down = 0;
var target = 0;
var time=(new Date()).getTime();
var callback=document.getElementById("callback").value;
function onload(){
  down++;
}
for(var i = 0,img; i < logoutList.length ; i++){ 
  img = new Image();
  img.onload = img.onerror = img.oncomplete = onload
  try{
    // img.src = protocol+"://"+logoutList[i] ;
    img.src = logoutList[i] ;
    target++;
  }catch(e){
  }
}
function check(){
  if(down>=target){
    location.href=callback;
  }else{
    if((new Date()).getTime()-time > 5000){
      location.href=callback;
    }else{
      setTimeout(check,200);
    }
  }
}
check();
function inArray(arr,item){
  for(var i=0,len=arr.length;i<len;i++){
    if(arr[i]===item){
      return true;
    }
  }
  return false;
}
</script>
</body>
</html>