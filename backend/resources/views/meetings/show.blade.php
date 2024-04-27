<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ivy Streams</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body>


    <style>
        body {
            background: #6d7a80;
            background: -webkit-linear-gradient(to right, #b3bdc1, #55595a, #62686a);
            background: linear-gradient(to right, #6c7477, #606a6d, #323536);
        }

        #join-btn {
            position: fixed;
            top: 50%;
            left: 50%;
            margin-top: -50px;
            margin-left: -100px;
            font-size: 18px;
            padding: 20px 40px;
        }

        #video-streams {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            grid-gap: 20px;
            /* Added gap between video containers */
            height: 90vh;
            width: 1400px;
            margin: 0 auto;
        }

        .video-container {
            max-height: 100%;
            background-color: #203a49;
            border-radius: 30px;
            /* Added border-radius for rounded corners */
        }

        .video-player {
            height: 100%;
            width: 100%;
            border-radius: 30px;
            /* Added border-radius for rounded corners */
        }

        button {
            display: flex;
            /* Use flexbox */
            align-items: center;
            /* Center items vertically */

            border: none;
            background-color: cadetblue;
            color: #fff;
            padding: 15px 30px;
            /* Increased padding */
            font-size: 16px;
            margin: 5px;
            /* Increased margin */
            cursor: pointer;
            border-radius: 20px;
            /* Rounded corners */
        }

        button i {
            margin-right: 5px;
            /* Add some space between icon and text */
        }

        #stream-controls {
            display: none;
            justify-content: center;
            margin-top: 0.5em;
        }

        @media screen and (max-width: 1400px) {
            #video-streams {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                width: 95%;
            }
        }
    </style>

    {{-- <x-layout> --}}

    <button id="join-btn">
        <i class="material-icons">video_call</i> Join Meeting
    </button>

    <div id="stream-wrapper">
        <div id="video-streams"></div>

        <div id="stream-controls">
            <button id="leave-btn">
                <i class="material-icons">exit_to_app</i> Leave Stream
            </button>

            <button id="mic-btn"><i class="material-icons">mic</i> Mic On</button>
            <button id="camera-btn">
                <i class="material-icons">videocam</i> Camera on
            </button>
        </div>
    </div>

    <br>




    {{-- </x-layout> --}}

</body>
<!-- <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script> -->
<script src="{{ asset('js/agora/AgoraRTC_N-4.7.3.js') }}"></script>
<script src="{{ asset('js/agora/main.js') }}"></script>


<?php

// Check if the current URL is using HTTPS
$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

// Get the current URL
$currentUrl = url()->current();

// Check if the current URL is ngrok or localhost
if (strpos($currentUrl, 'ngrok-free.app') !== false) {
    // Use secure_asset for ngrok URLs

    echo "<script type=\"text/javascript\" src=\"" . secure_asset('js/agora/AgoraRTC_N-4.7.3.js') . "\"></script>";
    echo "<script type=\"text/javascript\" src=\"" . secure_asset('js/agora/main.js') . "\"></script>";
} elseif (strpos($currentUrl, 'localhost') !== false) {
    // Use asset for localhost URLs
    $assetUrl = asset('assets/css/theme.css');

    echo "<script type=\"text/javascript\" src=\"" . asset('js/agora/AgoraRTC_N-4.7.3.js') . "\"></script>";
    echo "<script type=\"text/javascript\" src=\"" . asset('js/agora/main.js') . "\"></script>";
} else {
    // Use a default asset URL if the current URL is neither ngrok nor localhost
    $assetUrl = asset('assets/css/theme.css');
}

// Output the asset URL in your HTML

?>


</html>
