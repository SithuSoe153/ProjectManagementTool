<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".task-checkbox").click(function() {

                // $("p").text("Hello, jQuery!");
                console.log("Hello, jQuery!");
            });
        });
    </script>
</head>

<body>

    <form action="">

        <input class="form-check-input task-checkbox ms-0 me-2" value="" type="checkbox" id="">

    </form>

    {{-- <button>Click me</button> --}}
    <p></p>

</body>

</html>
