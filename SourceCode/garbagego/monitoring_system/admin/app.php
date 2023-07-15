<!DOCTYPE html>
<html class="use-all-space">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta charset="UTF-8">
    <title>Maps SDK for Web - Traffic Map</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps.css">
</head>
<body>
    <div id="map" class="map"></div>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps-web.min.js"></script>
    <script>
        var map = tt.map({
            key: "jZ5fpHYpVVyaVxslnAeBXwAoFnrgYCEH",
            container: "map",
            style: "tomtom://vector/1/basic-main",
            center: [13.9236, 120.6165],
            zoom: 13
        });
    </script>

</body>
</html>
