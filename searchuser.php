<?php
    /* In this PHP I use the Torre.co API to search all info about an user.  */

    // Get the user name
    $searchuser=$_GET['searchuser'];

    // Download the JSON using the API
    $json = file_get_contents("https://bio.torre.co/api/bios/$searchuser");


    // If the API returns an empty string I assume the user does not exist. (It could be something else...)
    if (strlen($json)==0) {
        header('Location: notfound.php');
    }

    // Convert JSON to PHP Object
    $obj = json_decode($json);
  

?><!DOCTYPE html>
<html lang="en">
<head>
   <?php require 'htmlhead.php'; ?>
</head>
<body>
    
    <?php require 'header.php'; ?>
   
    <main>
        <div class="container">

            <div class="row py-3">
                <div class="col-xl-3 col-md-4 col-lg-6 col-md-12 col-sm-12 text-center">
                    <?php /* A Card with the user data */ ?>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $obj->person->picture; ?>" alt="UserPic">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $obj->person->name; ?></h4>
                            <p class="card-text"><?php echo $obj->person->professionalHeadline; ?></p>
                        </div>
                    </div>

        
                </div>

                <div class="col-xl-3 col-md-4 col-lg-6 col-md-12 col-sm-12 text-center">

                    <div class="card">
                        <div class="card-header">
                            Skills and Interests
                        </div>
                        <div class="card-body">
                        <?php

                            // I create an array to store the different skills proficiencies 

                            $t=array(
                                'master'=>'Master/Influencer',
                                'expert'=>'Expert',
                                'proficient'=>'Proficient',
                                'no-experience-interested'=>'No Experience but Interested'
                            );


                            // And then I iterate thru that array to sepparate the different skill levels 
                            foreach($t as $pr=>$ti) {
                                $shown=false;
                        ?>
                                <?php foreach($obj->strengths as $skill) { 
                                    if($skill->proficiency==$pr) { 
                                        if (!$shown) {
                                        ?>
                                        <span class="md-icon"><?php require $pr.".svg"; ?></span><?php echo $ti; ?><br>
                                        <?php 
                                            $shown=true;
                                        } ?>
                                    <span class="badge rounded-pill bg-secondary oneskill mypointer" to-level="<?php echo $pr; ?>"><?php echo $skill->name; ?></span>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($shown) { ?><br><br><?php } ?>
                        <?php } ?>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3 col-md-4 col-lg-6 col-md-12 col-sm-12 text-center" id="otherusers">
                </div>
            </div>
        </div>
                
    </main>


    <script>

    $(function() {

        $('.oneskill').click(function() {

            var skill=$(this).html();
            var level=$(this).attr('to-level');

            $('#otherusers').html('Searching for Users that are '+level+' in '+skill);

            $.ajax({
                url:'otherusers.php',
                method:'get',
                data: { skill: skill, level: level },
                success: function(data) {
                    $('#otherusers').html(data);
                }
            });
        });

    });


    </script>
</body>
</html>