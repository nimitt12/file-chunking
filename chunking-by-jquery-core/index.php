<?php ?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <title>File Chunking Process</title>
</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <input type="file" id="f" />

  <script>
    (function () {

      var f = document.getElementById('f');
      if (f.files.length)
        processFile();

      f.addEventListener('change', processFile, false);


      function processFile(e) {
        var file = f.files[0];
        var size = file.size;
        var sliceSize = 1111256;
        var start = 0;

        setTimeout(loop, 1);

        function loop() {
          var end = start + sliceSize;
          if (size - end < 0) {
            end = size;
          }

          var s = slice(file, start, end);



          send(s, start, end);

          if (end < size) {
            start += sliceSize;
            setTimeout(loop, 1);
          }
        }
      }


      function send(piece, start, end) {
        //   var formdata = new FormData();
        //   var xhr = new XMLHttpRequest();

        //   xhr.open('POST', '/chunk/upload.php', true);

        //   formdata.append('start', start);
        //   formdata.append('end', end);
        //   formdata.append('file', piece);

        //   xhr.send(formdata);
        var formData = new FormData();

        formData.append('start', start);
        formData.append('end', end);
        formData.append('file', piece);

        $.ajax('upload.php', {
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (data) {
            console.log(data)
          },
          error: function (data) {
            console.log(data)
          }
        });
      }

      /**
       * Formalize file.slice
       */

      function slice(file, start, end) {
        var slice = file.mozSlice ? file.mozSlice :
          file.webkitSlice ? file.webkitSlice :
          file.slice ? file.slice : noop;

        return slice.bind(file)(start, end);
      }

      function noop() {

      }

    })();
  </script>

</body>

</html>
