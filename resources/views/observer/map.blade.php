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

    <script>
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
    var triangleCoords = [
        { lat: 41.745577, lng: 44.792170 },
        { lat: 41.737956, lng: 44.816203 },
        { lat: 41.727900, lng: 44.800410 },
        { lat: 41.732640, lng: 44.785647 },
    ];
    // Construct the polygon.
    var bermudaTriangle = new google.maps.Polygon({
        paths: triangleCoords,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    bermudaTriangle.setMap(map);
    // Add a listener for the click event.
    bermudaTriangle.addListener("click", showArrays);
    infoWindow = new google.maps.InfoWindow();
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
