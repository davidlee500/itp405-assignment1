<?php
    $pdo = new PDO('sqlite:chinook.db');
    $sql = "
      SELECT tracks.Name as trackName, albums.Title, artists.Name, tracks.UnitPrice
      FROM tracks
      INNER JOIN albums
        ON tracks.AlbumId=albums.AlbumId
      INNER JOIN artists
        ON albums.ArtistId=artists.ArtistId
    ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $genres = $statement->fetchAll(PDO::FETCH_OBJ);
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Assignment 1: Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  </head>
  <body>
    <form action="index.php" method="get">
      <input type="text" name="search">
      <button type="submit">Search</button>
    </form>
    <table class="table">
      <tr>
        <th>Track</th>
        <th>Album</th>
        <th>Artist</th>
        <th>Price</th>
      </tr>
      <?php foreach($genres as $genre) : ?>
        <tr>
          <td>
           <?php echo $genre->trackName ?>
          </td>
          <td>
           <?php echo $genre->Title ?>
          </td>
          <td>
           <?php echo $genre->Name ?>
          </td>
          <td>
           $<?php echo $genre->UnitPrice ?>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
  </html>