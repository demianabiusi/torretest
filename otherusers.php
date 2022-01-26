<?php

/* Get a list of people with the specified skill and generate the HTML code to fit in div#otherusers from searchuser.php */


$skill=$_GET['skill'];
$level=$_GET['level'];

$t=array(
    'master'=>'Master/Influencer',
    'expert'=>'Expert',
    'proficient'=>'Proficient',
    'no-experience-interested'=>'No Experience but Interested'
);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://search.torre.co/people/_search?size=10&aggregate=true");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,'{"skill/role":{"text":"'.$skill.'","proficiency":"'.$level.'"}}');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($ch);

curl_close ($ch);

$obj = json_decode($json);

?>
<div class="card">
    <div class="card-header">
        Other Users that are <?php echo  $t[$level];  ?> in <?php echo $skill; ?>
    </div>
    <div class="list-group">
    <?php
    foreach($obj->results as $result) {
    ?>
        <a href="searchuser.php?searchuser=<?php echo $result->username; ?>" class="list-group-item d-flex align-items-start">
            <div class="image-parent">
            <img src="<?php echo $result->picture; ?>" class="img-fluid" alt=".">
            </div>
            &nbsp;
            <div>
            <?php echo $result->name." (".$result->username.") ";  ?>
            </div>
        </a>
    <?php } ?>
    </div>
</div>