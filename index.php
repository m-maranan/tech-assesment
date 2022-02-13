<?php
    session_start();

    include('Classes/User.php');
    //$_SESSION['user'] = null;
    
    $user = new User();
    $all_users = $user->all();

    // Saving user
    if(isset($_POST['name'])) {
        $user->set($_POST['name']);
    
        $new_user = $user->save();
    
        $_SESSION['user'] = $new_user;
    }

    // Get Current user
    if(isset($_SESSION['user'])) {
        $current_user = $user->getById($_SESSION['user']['id']);
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Unit Calculator</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Unit Calculator</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?php if(!isset($_SESSION['user'])) : ?>
                    <form action="/" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
                            <div id="nameHelp" class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                <?php else: ?>
                    <form action="convert.php" method="POST" class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Select Unit Conversion</label>
                            <select class="form-select" name="unit" id="unit" aria-label="Default select example">
                                <option value="">Conversions</option>
                                <option value="litter_barrel" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'litter_barrel' ? 'selected' : ''); ?>>Litters to Barrels</option>
                                <option value="barel_litter" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'barel_litter' ? 'selected' : ''); ?>>Barrels to Litters</option>
                                <option value="litter_hogshead" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'litter_hogshead' ? 'selected' : ''); ?>>Litters to Hogsheads</option>
                                <option value="hogshead_litter" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'hogshead_litter' ? 'selected' : ''); ?>>Hogsheads to Litters</option>
                                <option value="hour_shake" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'hour_shake' ? 'selected' : ''); ?>>Hours to Shakes</option>
                                <option value="shake_hour" <?php echo (isset($_GET['unit']) && $_GET['unit'] == 'shake_hour' ? 'selected' : ''); ?>>Shakes to Hours</option>
                            </select>
                            <div id="nameHelp" class="form-text"></div>
                        </div>
                        <div class="col-md-6 units">
                            <label for="unit_from" class="form-label text-capitalize" id="unit_from_label">Unit From</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo (isset($_GET['unit']) ? $_GET['quantity'] : '') ?>" id="unit_from">
                        </div>
                        <div class="col-md-6 units">
                            <label for="unit_to" class="form-label text-capitalize" id="unit_to_label">Unit To</label>
                            <input type="text" name="converted" class="form-control" readonly value="<?php echo (isset($_GET['unit']) ? $_GET['value'] : '') ?>" id="unit_to">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Calculate</button>
                            <button type="submit" name="change_user" value="true" class="btn btn-warning">Change User</button>
                        </div>
                    </form>
                <?php endif; ?>
                <?php 

                ?>
            </div>
            <?php if(isset($current_user)) : ?>
            <div class="col-4">
                <h4>Conversion History</h4>
                <?php if(count($current_user['history']) != 0):?>
                    <?php foreach($current_user['history'] as $history): ?>
                        <p>Converted <?= $history['quantity'] ?> <?= $history['unit_from'] ?> to  <?= $history['converted'] ?> <?= $history['unit_to'] ?></p>
                    <?php endforeach;?>
                <?php else: ?>
                    You dont have any conversion history
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if(isset($all_users)) : ?>
            <div class="col-4">
                <h4>Users</h4>
                <?php if(count($all_users)):?>
                    <?php foreach($all_users as $user): ?>
                        <p><?= ucfirst($user['name']) ?> has <?= count($user['history']) ?> conversion<?= (count($user['history']) > 1 ? 's' : '') ?></p>
                    <?php endforeach;?>
                <?php else: ?>
                    No Users has converted anything
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
  <script type="text/javascript">
    if($("#unit").val() == "") {
        $(".units").hide();
    }else{
        showUnitNames();
    }

    $("#unit").change(function() {
        if($("#unit").val() != "") {
            $(".units").show()
            showUnitNames();
        }else{
            $(".units").hide();
        }   
    });

    function showUnitNames() {   
        if($("#unit").length > 0) {
            units = $("#unit").val().split("_");
            
            $("#unit_from_label").text(units[0]);
            $("#unit_to_label").text(units[1]);    
        }
    }
  </script>
</html>

