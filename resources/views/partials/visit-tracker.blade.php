<script>
(function(){
  var start = Date.now();
  var sent = false;
  function sendDuration(){
    if(sent) return;
    var d = Math.round((Date.now() - start) / 1000);
    if(d < 1) return;
    sent = true;
    var data = JSON.stringify({duration: d, _token: '{{ csrf_token() }}'});
    if(navigator.sendBeacon){
      navigator.sendBeacon('/api/visit-duration', new Blob([data], {type:'application/json'}));
    } else {
      var x = new XMLHttpRequest();
      x.open('POST','/api/visit-duration',false);
      x.setRequestHeader('Content-Type','application/json');
      x.send(data);
    }
  }
  document.addEventListener('visibilitychange', function(){if(document.visibilityState==='hidden') sendDuration();});
  window.addEventListener('beforeunload', sendDuration);
  window.addEventListener('pagehide', sendDuration);
})();
</script>
