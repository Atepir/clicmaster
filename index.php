<!-- Clic Master -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clic Master</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- Creating the banner -->

<p class="home">
    <img src="" alt="icone et nom">
    <p><label id="dedicace">Dedicated to my sweetheart Flore Kabré</label></p>
    <p><label id="consignes">Cliquez autant de fois que possible, vous aurez 10 secondes.</label></p>
    <p>
    <form action="highscores.php" method="post">
        <input type="submit" class="leaderboard-btn" name="scores-table" value="Meilleurs Scores">
        <input type="submit" class="leaderboard-btn" name="scores-table" value="Meilleurs Scores">
    </form>
    </p>
    <input type="button" class="share" value="Partager">
    <button class="begin" onclick="start()">Commencer</button>
</div>

<!-- Creating the game -->

<div class="game">

    <!-- Timeout -->

    <label id="timeout"></label>

    <!-- Score display -->

    <label id="score">0</label>

    <!-- User registering -->

    <div class="registering" id="registering" hidden>
        <form action="index.php" method="post">
            <input type="number" readonly id="score_number" name="score" value="0">
            <input type="text" name="pseudo" minlength="3" maxlength="10">
            <input type="submit" value="OK">
        </form>
    </div>

    <!-- Click-area -->

    <div onclick="increaseScore()" id="click-area" class="click-area"><br><br><br></div>

    <script type="text/javascript">

        var nb = 10;

        setInterval(function () {
            document.getElementById('timeout').innerHTML = nb.toFixed(2);
            if (nb > 0.001){
                nb -= 0.001;
            }else{
                // Then it's the end
                document.getElementById('timeout').innerHTML = "Temps écoulé !";

                document.getElementById('click-area').hidden = true;

                saving(score);

                document.getElementById('registering').hidden = false;

                return 0;
            }
        }, 1);

        var score = 1;

        function increaseScore() {
            document.getElementById('click-area').classList.toggle('clicked-area');
            document.getElementById('score').innerHTML = score;
            score++;
        }

        function savingScore(score, name) {
            registerUser();

        }

        function saving(score) {
            if (document.getElementById('click-area').hidden === true){
                console.log("Score =", score-1);
            }
            return 0;
        }

    </script>

    <?php

    $bdd = new PDO('mysql:host=sql306.byetcluster.com;dbname=b22_25607929_score;charset=utf8', 'b22_25607929', 'drareg1,');

    if (isset($_POST['score']) and isset($_POST['pseudo'])){
        $score = $_POST['score'];
        $pseudo = $_POST['pseudo'];
        $req = "INSERT INTO score(pseudo, score) VALUES (:pseudo, :score)";
        $req_set = $bdd->prepare($req);
        $req_set->execute(array(
            pseudo=>$pseudo,
            score=>$score,
    ));
        $req_set.closeCursor();
    }

    ?>

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

</body>
</html>