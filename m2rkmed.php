<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">

    <title>Title</title>
    <style>

        header {
            background-image: url("header.jpg");
            background-size: contain;


            background-repeat: no-repeat;
            height: 150px;
            width: 1000px;
        }

    </style>
</head>
<body>

<header>
    <h1>Kuidas panna eksamit pudelisse?</h1>
</header>
<article>
    <p>Loo lihtne lehekülg märkmete tegemiseks. Kõik kasutajad näevad ja muudavad samu märkmeid.</p>
<h1>Harjutusi sabale</h1>
<form method="POST" action=''>
    <label for="nimi">Kasutaja</label>
    <input type="text" name="nimi" id="nimi"><br>
    <label for="textarea">Postitus</label>
    <textarea name="textarea" id="textarea"></textarea>
    <br/>
    <input type="submit" value="Lisa" name="lisa"/>
</form>


<?php
if ( isset( $_POST[ 'lisa' ] ) ) {
    onFunc();
}

function onFunc(){
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";
    $host = "localhost";
    $link = mysqli_connect ( $host, $user, $pass, $db );
    mysqli_query ( $link, "SET CHARACTER SET UTF8" );

    $text =  $_POST[ "textarea" ] ;
    $nimi = $_POST["nimi"];
    $sql = "INSERT INTO A4_eksam (tekst, kasutaja) VALUES ('$text','$nimi')";
    $result = mysqli_query ( $link, $sql );
    if ( $result ) {

        $kommentaar = array ();
        $sql = "SELECT * FROM A4_eksam WHERE id";
        $result = mysqli_query ( $link, $sql );
        while ( $rida = mysqli_fetch_assoc ( $result ) ) {
            $kommentaar[] = $rida;
        }

            foreach ( $kommentaar as $id => $rida ): ?>
<form method="POST" action=''>
<pre>Kasutaja:
    <?php echo $rida[ 'kasutaja' ]; ?> <br/>
    Postitus:
    <?php echo $rida[ 'tekst' ]; ?> <br/>
    <input type="submit" value="Kustuta" name="kustuta"/>


</pre>
</form>
<?php endforeach;
    }
}
?>

<?php
if ( isset( $_POST[ 'kustuta' ] ) ) {
    delete();
}

function delete(){
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";
    $host = "localhost";
    $link = mysqli_connect ( $host, $user, $pass, $db );
    mysqli_query ( $link, "SET CHARACTER SET UTF8" );


    $sql = "SELECT * FROM A4_eksam WHERE id = ''";
    $result = mysqli_query($link, $sql);
    $check = mysqli_fetch_assoc($result);
    $sql = "DELETE FROM A4_eksam WHERE id= ''";
    mysqli_query($link, $sql);

    echo "kas teeb ka midagi"
;

} ?>
</article>
<footer>
    <h4>Made by Annely</h4>
</footer>
</body>
</html>