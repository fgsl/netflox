<html>
  <head>
    <style>
      .column {
        float: left;
        width: 33.33%;
      }
      .row:after {
        content: "";
        display: table;
        clear: both;
      }
    </style>
  </head>
  <body>
    <h1>Netflox</h1>
    <div class="column">
      <h2>Catálogo de Filmes</h2>
      <?=file_get_contents('http://localhost:8009/filmes.txt',false);?>
    </div>
    <div class="column">
      <h2>Player de Vídeo</h2>
      <?=file_get_contents('http://localhost:8008/video.txt',false);?>
    </div>
    <div class="column">
      <h2>Conta</h2>
      <?=file_get_contents('http://localhost:8010/usuario.txt',false);?>
    </div>
  </body>
</html>