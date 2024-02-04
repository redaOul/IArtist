
function editmodal(){
    document.querySelector('.model-layerB').classList.add('active');
}
function closeeditmodal(){
    document.querySelector('.model-layerB').classList.remove('active');
}

function imagemodal(_id){
    document.querySelector('.model-layerA').classList.add('active');
  
  
    var myRequest = new XMLHttpRequest();
    myRequest.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        response = JSON.parse(this.responseText);
        // console.log(this.responseText);
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
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

var loadFile1 = function(event) {
    var output1 = document.getElementById('output1');
    output1.src = URL.createObjectURL(event.target.files[0]);
    output1.onload = function() {
        URL.revokeObjectURL(output1.src) // free memory
    }
};

var loadFile2 = function(event) {
    var output2 = document.getElementById('output2');
    output2.src = URL.createObjectURL(event.target.files[0]);
    output2.onload = function() {
        URL.revokeObjectURL(output2.src) // free memory
    }
};

// refresh after closing