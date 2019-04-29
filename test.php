<body><div id='body'></div>
  <script>
  var ws = new WebSocket('ws://192.168.1.31:8081');

  ws.onmessage = function (event) {
    console.log(event)
    document.getElementById('body').innerHTML = event.data;
};
</script> 
</body>
