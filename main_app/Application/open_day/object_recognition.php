<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web AR Scan Prototype</title>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.0/dist/mindar-face.min.js"></script>
    <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.0/dist/mindar-aframe.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        body { margin: 0; overflow: hidden; }
        #info-box {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <?php
        include("navbar.html");
    ?>
    <div id="info-box">Object detected: Pen</div>
    <a-scene mindar-image embedded>
        <a-assets>
            <a-asset-item id="pen-marker" src="/targets.mind"></a-asset-item>
        </a-assets>
        <a-camera position="0 0 0" look-controls></a-camera>
        <a-entity mindar-image-target="targetIndex: 0">
            <a-plane position="0 0 0" width="1" height="1" color="blue"></a-plane>
        </a-entity>
    </a-scene>
    
    <script>
        document.querySelector('a-scene').addEventListener('targetFound', function() {
            document.getElementById('info-box').style.display = 'block';
        });
        document.querySelector('a-scene').addEventListener('targetLost', function() {
            document.getElementById('info-box').style.display = 'none';
        });
    </script>
</body>
</html>
