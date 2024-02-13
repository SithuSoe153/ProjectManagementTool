<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>

<body>
    <h1>Hello</h1>
    {{-- socket cdn --}}
    <script src="https://cdn.socket.io/4.7.4/socket.io.min.js"
        integrity="sha384-Gr6Lu2Ajx28mzwyVR8CFkULdCU7kMlZ9UthllibdOSo6qAiN+yXNHqtgdTvFXMT4" crossorigin="anonymous">
    </script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>


    <button id="button">Press</button>
    <script>
        $(function() {
            let ip_address = 'http://127.0.0.1:3000';
            let socket = io(ip_address);
            socket.on('connection');

            let button = $('#button');

            button.click(function(e) {
                socket.emit('sendChatToServer');
            })

            socket.on('sendChatToServer', () => {
                console.log("okay okay okay");
            })

        })
    </script>
</body>

</html>
