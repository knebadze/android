<x-Observer-layout>

     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>MAP</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Map</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE MAP -->
                <div style="width: 100%; height:590px;" id="map"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBffrJkI4UIM_OjTA7WDE_gSGVFmq8sFm4&callback=initMap"></script>
    {{-- <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script> --}}

<script>
    var marker, i;
    var locations = [
        ['მეტრო ნაძალადევი', 41.732032, 44.797663],
        ['სკოლა', 41.737594, 44.795850],
        ['ლოტინის პარკი', 41.739132, 44.805432],
        ['ნიკორას სათაო ოფისი', 41.735139, 44.792606],
        ['სასტუმრო', 41.731561, 44.802580]
        ];
            // Initialize and add the map
    var map;
    var infoWindow;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: { lat: 41.7151, lng: 44.8271 },
            mapTypeId: "roadmap",
        });
        // Define the LatLng coordinates for the polygon.
        var bermudaTriangle = [];
        var polygons = [
            [
                { lat: 41.745577, lng: 44.792170 },
                { lat: 41.737956, lng: 44.816203 },
                { lat: 41.727900, lng: 44.800410 },
                { lat: 41.732640, lng: 44.785647 },
            ],
            [
                { lat: 41.727737, lng: 44.800644 },
                { lat: 41.729541, lng: 44.826078 },
                { lat: 41.729520, lng: 44.826920 },
                { lat: 41.722914, lng: 44.834284 },
                { lat: 41.717857, lng: 44.802868 },
                { lat: 41.719395, lng: 44.794200 },
                { lat: 41.726373, lng: 44.793747 },
            ],
        ];

        setTimeout(() => {
            map.setZoom(13);
            map.setCenter(bermudaTriangle.getPosition());
        }, 1000);
        // Construct the polygon.
        bermudaTriangle.push(new google.maps.Polygon({
            paths: polygons,
            strokeColor: "#810FCB",
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: "810FCB",
            fillOpacity: 0.35,
        }));
        bermudaTriangle[bermudaTriangle.length-1].setMap(map);
        // Add a listener for the click event.

        bermudaTriangle[bermudaTriangle.length-1].addListener("click", showArrays);
        infoWindow = new google.maps.InfoWindow();

        //MARKERS
        var markerInfowindow = new google.maps.InfoWindow();

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                markerInfowindow.setContent(locations[i][0]);
                markerInfowindow.open(map, marker);
            }
          })(marker, i));
        }
    }


    function showArrays(event) {
        // Since this polygon has only one path, we can call getPath() to return the
        // MVCArray of LatLngs.
        // @ts-ignore
        var polygon = this;
        var vertices = polygon.getPath();
        var contentString = "<b>ნაძალადევის მიმდებარე ტერიტორია</b><br>" +
            "Clicked location: <br>" +
            event.latLng.lat() +
            "," +
            event.latLng.lng() +
            "<br>";
        // map.setZoom(13);
        // map.setCenter(bermudaTriangle.getPosition());
        // Iterate over the vertices.
        for (var i = 0; i < vertices.getLength(); i++) {
            var xy = vertices.getAt(i);
            contentString +=
                "<br>" + "Coordinate " + i + ":<br>" + xy.lat() + "," + xy.lng();
        }
        // Replace the info window's content and position.
        infoWindow.setContent(contentString);
        infoWindow.setPosition(event.latLng);
        infoWindow.open(map);
    }
    window.initMap = initMap;
</script>

</x-Observer-layout>
