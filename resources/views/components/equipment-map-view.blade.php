<div id="map" style="height: 700px;"></div>

<script>
    function onEachFeature(feature, layer) {
        if (feature.properties) {                                
            var popupContent = `<h5>${feature.properties.title}</h5><p>${feature.properties.msl_organization_name}</p><a href="/lab/${feature.properties.msl_lab_ckan_name}">view lab information</a>`;

            layer.bindPopup(popupContent);
        }
    }

    var features = <?php echo json_encode($locations); ?>;        				

    var map = L.map('map').setView([51.505, -0.09], 4);
    
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    for (feature of features) {
        L.geoJSON(feature, {
            onEachFeature: onEachFeature
        }).addTo(map);        					
    }
    
</script>