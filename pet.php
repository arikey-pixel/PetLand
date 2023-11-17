<?php
session_start();
include 'leaderboard.php';

// Initialize all variables
$petCaredFor = false;
$walkingClass = '';
$showTreat = false;
$showDryFood = false;
$showWetFood = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'walk' exercise is selected for the animation
    if (isset($_POST['exercise']) && $_POST['exercise'] === 'walk') {
        $_SESSION['animateDog'] = true;
        $walkingClass = 'walking';
    } elseif (isset($_POST['exercise']) && $_POST['exercise'] === 'run') {
        $_SESSION['animateDog'] = true;
        $walkingClass = 'running';
    }

    // Check food options
    if (isset($_POST['food'])) {
        if ($_POST['food'] === 'treat') {
            $showTreat = true;
        } elseif ($_POST['food'] === 'dryfood') {
            $showDryFood = true;
        } elseif ($_POST['food'] === 'wetfood') {
            $showWetFood = true;
        }
    }
}

// Reset the animation flag at the end of the page rendering
if (isset($_SESSION['animateDog']) && $_SESSION['animateDog']) {
    $_SESSION['animateDog'] = false;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Welcome to PetLand</title>
        <link href="./petgame.css" type="text/css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="proj2-img/dog-icon.png">        
    </head>
    
    <body>
        <div class="game" style="background-image: url(proj2-img/grass.jpeg);">
            <img src="proj2-img/cloud.png" width="100" height="50" alt="cloud" class="cloudOne">
            <img src="proj2-img/cloud.png" width="100" height="50" alt="cloud" class="cloudTwo">
            <div class="statusBar" style="background: rgb(237, 45, 45);">
                Your pet needs care!
            </div>
            <div class="leaderboard">
                <h3>LEADER BOARD:</h3>
                <p>Care for your pet daily for more points!</p>
                <?php displayLeaderboard(); ?>
            </div>
			<div class="pet">
                <img src="proj2-img/dog.png" width="100" height="200" alt="doggy" class="<?php echo $walkingClass; ?>">
                <?php if ($showTreat): ?>
                    <img src="proj2-img/treat.png" alt="Treat" class="food-image">
                <?php elseif ($showDryFood): ?>
                    <img src="proj2-img/dryfood.png" alt="Dry Food" class="food-image">
                <?php elseif ($showWetFood): ?>
                    <img src="proj2-img/wetfood.png" alt="Wet Food" class="food-image">
                <?php endif; ?>
            </div>
            <div class="careBar">
                <img src="proj2-img/bone.png" width="100" height="100">
                <h2>Care for your pet here!</h2><br>
                <form action="pet.php" method="POST">
                    <dl>
                        <dt>
                            <strong> Choose food: </strong>
                            <input type="radio" id="treat" name="food" value="treat"> <img src="proj2-img/treat.png"> Treat
                            <input type="radio" id="dryfood" name="food" value="dryfood"> <img src="proj2-img/dryfood.png"> Dry Food
                            <input type="radio" id="wetfood" name="food" value="wetfood"> <img src="proj2-img/wetfood.png"> Wet Food
                        </dt>
                        <dt>
                            <strong> Choose exercise: </strong>
                            <select name="cars" id="cars">
                                <option value="10mins">10 mins</option>
                                <option value="20mins">20 mins</option>
                                <option value="30mins">30 mins</option>
                            </select>
                            <input type="radio" id="walk" name="exercise" value="walk"> <img src="proj2-img/walk.png">Walk
                            <input type="radio" id="run" name="exercise" value="run"> <img src="proj2-img/run.png">Run
                            <input type="radio" id="play" name="exercise" value="play"> <img src="proj2-img/play.png">Play
                        </dt>
                        <dt>
                            <strong> Choose care: </strong>
                            <input type="checkbox" id="brush" name="care" value="brush"> <img src="proj2-img/brush.png">Brush
                            <input type="checkbox" id="bathe" name="care" value="bathe"> <img src="proj2-img/bathe.png">Bathe
                        </dt>
                    </dl>
                    <input type="submit" name="Submit" value="Care for pet" />
                </form>
            </div>
        </div>

         <?php
        // Reset the animation flag at the end of the page
        if (isset($_SESSION['animateDog']) && $_SESSION['animateDog']) {
            $_SESSION['animateDog'] = false;
        }
        ?> 
    </body>
</html>
