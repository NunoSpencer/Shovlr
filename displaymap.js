<<<<<<< HEAD
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
=======
function loadMap() 
{
  var centerMapRI = {lat:  41.5801, lng: -71.4774};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: centerMapRI
  });

  var marker = new google.maps.Marker({
      position: centerMapRI,
      map: map
    });


  // var cdata = JSON.parse(document.getElementById('data').innerHTML);

  // Array.prototype.forEach.call(cdata, function (data){
  //   console.log(data);
  // });
  
}
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
