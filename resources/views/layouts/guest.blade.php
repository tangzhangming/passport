<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

    <script src="https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/1.12.4/jquery.min.js" ></script>
    <script type="text/javascript">
function loginExc(event){
    console.log(event)
    event.preventDefault();
    $.ajax({
        url: '/login',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
    })
    .done(function(res) {
        console.log(res.data.endpoint);
        request_crossdomain(res.data.endpoint);

        setTimeout(function(){
            // window.location.href = res.data.redirect + '?v=' + (new Date().getTime())
            window.location.href = '/to?redirect_url=' + res.data.redirect
        },100)
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
}

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



$(document).ready(function() { 
    // $('#login-form').submit(loginExc);

    // console.log(window.parent)
});
    </script>
</html>
