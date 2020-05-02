<!-- Clic Master -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clic Master</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="corps">

<!-- Creating the banner -->

<script src="https://kit.fontawesome.com/867e431317.js" crossorigin="anonymous"></script>

<!-- <p><label id="dedicace" class="white">Dedicated to my sweetheart Flore Kabré</label></p> -->
<p><label id="dedicace" class="white">Version première</label></p>

<div class="header">

    <h1 id="consignes" class="white indic">Bienvenue sur Clic Master !</h1>
    <h1 id="label" hidden class="white indic">Clic Master</h1>
    <h2 id="consignes1" class="white indic">Vous aurez 10 secondes ...</h2>
    <h2 id="consignes2" class="white indic">Pour prouver que vous êtes ...</h2>
    <h2 id="false-score" hidden class="white indic">0</h2>
    <h2 id="reb" hidden class="white indic">Temps restant ...</h2>
    <h2 id="consignes3" class="white indic">Le meilleur d'entre tous ...</h2>
    <h3 class="start-text indic" onclick="increaseScore()" id="start">Commencer</h3>

</div>

<div class="menu">
    <span id="best-scores">
        <i class="fas fa-chess-rook" onClick="parent.location='index.php?g=scores'"></i>
    </span>
    <span id="share">
        <i class="fab fa-facebook-square" onclick="parent.location='https://www.facebook.com/sharer/sharer.php?u=http://clicboom.000webhostapp.com'"></i>
    </span>
</div>

<!-- Creating the game -->

<div class="game">

    <!-- Timeout -->

    <!-- Place token by the reb id -->

    <!-- Score display -->

    <label id="score" hidden>0</label>

    <!-- User registering -->

    <div class="registering" id="registering" hidden>
        <center>
            <form action="index.php" method="post">
                <p><input style="border: 0; margin: 0; text-align: center; background: #5603a5; font-size: 200%; color: white" type="number" readonly id="score_number" name="score" value="0"></p>
                <p><input style="font-size: 200%; color: white; background: #2d0a4b; border-radius: 10px; width:200px; border-color: #6e08ad" type="text" name="pseudo" minlength="3" maxlength="15" value="pseudo">
                <p><input style="font-size: 200%; color: white; background: #510e87; border-radius: 4px; width:100px; border-color: #6e08ad" type="submit" value="OK"></p>
            </form>
        </center>
    </div>

    <!-- Click-area -->

    <div onclick="increaseScore()" id="click-area" class="click-area"><br><br><br></div>

    <?php

    $bdd = new PDO('mysql:host=localhost;dbname=id13407933_scores;charset=utf8', 'id13407933_lecodesource777', 'x#ESEcs=zgx^9qnu');

    if (isset($_POST['score']) and isset($_POST['pseudo'])){
        $score = $_POST['score'];
        $pseudo = $_POST['pseudo'];
        $req = "INSERT INTO score(pseudo, score) VALUES (:pseudo, :score)";
        $req_set = $bdd->prepare($req);
    $req_set->execute(array(
    'pseudo'=>$pseudo,
    'score'=>$score,
    ));
    }

    ?>

    <?php

        $bdd = new PDO('mysql:host=localhost;dbname=id13407933_scores;charset=utf8', 'id13407933_lecodesource777', 'x#ESEcs=zgx^9qnu');

        if (isset($_GET['g']) and $_GET['g'] == 'scores'){
            $req = "SELECT * FROM score ORDER BY score DESC LIMIT 5";
            $resp = $bdd->query($req);
    echo "<div id='body' style='width: 100%; height: 90%; top: 0; left: 0; background: rgba(69,20,175,0.2); z-index: 999;'>";
    echo "<center><table id='table'>";
        $i = 1;
        while ($ans = $resp->fetch()){
        if ($i == 1){
        echo '<center><tr style="border-radius: 5px; margin: 30px;"><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . '<div style="color: red;">' . $i . '</div>' . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['score'] . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['pseudo'] . '</td></tr></center>';
        }elseif ($i == 2){
        echo '<center><tr style="border-radius: 5px; margin: 30px;"><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . '<div style="color: blue;">' . $i . '</div>' . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['score'] . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['pseudo'] . '</td></tr></center>';
        }elseif ($i == 3){
        echo '<center><tr style="border-radius: 5px; margin: 30px;"><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . '<div style="color: green;">' . $i . '</div>' . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['score'] . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['pseudo'] . '</td></tr></center>';
        }else{
        echo '<center><tr style="border-radius: 5px; margin: 30px;"><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . '<div style="color: black;">' . $i . '</div>' . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['score'] . '</td><td style="border-radius: 5px; margin: 30px; background: #bb00ff; color: white; ">' . $ans['pseudo'] . '</td></tr></center>';
        }

        $i++;
        }
        echo "</table></center>";
    echo "</div>";
    }

    ?>

    <script type="text/javascript">

        var nb = 10;

        function begin(){
            var x = setInterval(function () {
                document.getElementById('reb').innerHTML = nb.toFixed(2);
                if (nb > 0.01){
                    nb -= 0.01;
                }else{
                    // Then it's the end

                    clearInterval(x);

                    document.getElementById('reb').innerHTML = "Temps écoulé !";

                    document.getElementById('click-area').hidden = true;

                    document.getElementById('false-score').hidden = true;

                    saving(score);

                    document.getElementById('registering').hidden = false;

                    return 0;
                }
            }, 10);
        }

        var score = 1;

        function increaseScore() {
            if (document.getElementById('start').hidden !== true) {
                document.getElementById('start').hidden = true;
                document.getElementById('consignes').hidden = true;
                document.getElementById('consignes1').hidden = true;
                document.getElementById('consignes2').hidden = true;
                document.getElementById('consignes3').hidden = true;
                document.getElementById('label').hidden = false;
                document.getElementById('reb').hidden = false;
                document.getElementById('false-score').hidden = false;
                begin();
            }
            if (document.getElementById('start').hidden === true){
                document.getElementById('click-area').classList.toggle('clicked-area');
                document.getElementById('score').innerHTML = score;
                document.getElementById('false-score').innerHTML = score;
                score++;
            }
            if (document.getElementById('body').hidden === false){
                document.getElementById('body').hidden = true;
                document.getElementById('table').hidden = true;
            }
        }

        function savingScore(score, name) {
            registerUser();

        }

        function saving(score) {
            if (document.getElementById('click-area').hidden === true){
                // console.log("Score =", score-1);
                document.getElementById('score_number').value = score;
            }
            return 0;
        }

    </script>

</div>

<!-- Creating High Score System -->

<div class="leaderboard">

    <!-- Registering the new High Score winner -->

    <input type="button" hidden onclick="savingScore(score, name)">

    <!-- Leaderboard will be saved to a database -->



</div>

<!-- Sharing the game via social networks -->

<div class="sharing">



</div>

<div id="delimiter"></div>
<div id="footer"></div>

</body>
</html>