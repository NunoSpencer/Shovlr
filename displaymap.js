function loadMap() {
    var centerMapRI = {lat:  41.5801, lng: -71.4774};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: centerMapRI
    });

    var marker = new google.maps.Marker({
        position: centerMapRI,
        map: map
      });
  }