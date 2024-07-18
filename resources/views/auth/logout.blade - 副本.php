<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>退出中</title>
</head>
<body>
<h1>退出中</h1>


<script type="text/javascript">
function request_crossdomain(imageUrls){
    var targetElement = document.body;

    // 循环创建并添加 image 标签
    for (var i = 0; i < imageUrls.length; i++) {
      // var image = document.createElement('img');
      // image.src = imageUrls[i];
      // targetElement.appendChild(image);

      var iframe = document.createElement('iframe');
            iframe.src = imageUrls[i]; 
            iframe.style.display = 'none';
        targetElement.appendChild(iframe);
    }
}

var endpoint = @json($endpoint)

request_crossdomain(endpoint)

setTimeout(function(){
    window.location.href = "/login";
}, 100)

</script>
</body>
</html>