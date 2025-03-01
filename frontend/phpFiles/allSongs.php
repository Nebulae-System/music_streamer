<?php 
    include('../../backend/query.php');
    $query = new dbQuery;
    $query->sessionCheck();
    $sql = "SELECT Songs.Song_ID,Songs.Title AS SongTitle, Artists.Artist_Name AS ArtistName, Albums.Title AS AlbumTitle, Genres.Genre_Name AS GenreName, Artists.Image AS ArtistImage
            FROM Songs JOIN Artists ON Songs.Artist_ID = Artists.Artist_ID 
            JOIN Albums ON Songs.Album_ID = Albums.Album_ID 
            JOIN Genres ON Songs.Genre_ID = Genres.Genre_ID";
    $songs = $query->displayJoin($sql);
    $i=0; 
    foreach($songs as $song) : 
    $likeDislikeStyle = $query->checkLikeDislike($song['Song_ID'], $_SESSION['id']) ? "color: #284edb;" : "color:white;";
?>
<tr onclick='songFunction(this)'>
    <td><?=++$i?></td>
    <td><?=$song['SongTitle']?></td>
    <td><?=$song['ArtistName']?></td>
    <td><?=$song['GenreName']?></td>
    <td><?=$song['AlbumTitle']?></td>
    <td><img src="assets/artists/<?=$song['ArtistImage']?>" alt="image" style="width:50px; height:50px;"></td>
    <td  onclick='likeDislikeFn(event);' class="likeDislike">
        <span style="display:none;"><?=$song['Song_ID']?></span>
        <i class="fa-solid fa-heart" style="<?=$likeDislikeStyle?>"></i>
    </td>
    <td onclick="togglePopup(event)">
        <span style="display:none;"><?=$song['Song_ID']?></span>
        <i class="fa-regular fa-square-plus"></i>
    </td>
</tr>
<?php endforeach; ?>
