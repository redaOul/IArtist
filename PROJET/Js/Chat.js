
$(document).ready(function(){
  setInterval(function updateDiv(){
    $("#chats").load(window.location.href + " #chats");
    $("#list").load(window.location.href + " #list");
    var element = document.getElementById('loadddd');
    element.scrollTop = element.scrollHeight;
  }, 200);
})
