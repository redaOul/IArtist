function imagemodal(_id){
  document.querySelector('.model-layerA').classList.add('active');


  var myRequest = new XMLHttpRequest();
  myRequest.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      response = JSON.parse(this.responseText);
      document.getElementById('image-src').setAttribute("src", response.DESTINATION);
      document.getElementById('DName').innerHTML = response.DNOM;
      document.getElementById('UName').setAttribute("href", "Gallery.php?user-id=" + response.UTILISATEURID);
      document.getElementById('UName').innerHTML = response.UNOM;
      document.getElementById('DType').innerHTML = response.GENRE;
      document.getElementById('DDescription').innerHTML = response.TABDESCRIPTION;
    }
  };
  myRequest.open("GET", "./GetDataToModal.php?img-id=" + _id, true);
  myRequest.send();

}

function closepreviewmodal(){
  document.querySelector('.model-layerA').classList.remove('active');
}