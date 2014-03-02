<?php require 'includes/header.php'; ?>

<div id="postcode-entry" style="padding-bottom:40px;">
    <form id="validatePostCodeSubmit" action="javascript:void(0);">
        Search via postcode: <input type="validatePostCode" name="validatePostCode" id="validatePostCodeCode">
        <input type="submit" value="Search" class="validatePostCodeSubmit">
        <div class="postcode-entry-error" style="color:red;"></div>
    </form>
</div>
<div id="map-canvas" style="width:100%;height:400px;text-align:center;border:1px solid black; margin-top:30px; margin-bottom:30px;"></div>

<?php
foreach ($this->data['ratings'] as $index => $rating):
    $totalScore = 0;
?>
<div class="rating">
    <address>
        <a href="/rating/<?= $rating->entryId; ?>"><?= $rating->streetAddress; ?></a><br />
        <div class="postcodeval postcode<?= $index; ?>"><?= $rating->postcode; ?><br>
    </address>
</div>

<?php
$totalScore += calc_rating($rating->timeToRespond + $rating->qualityOfSolution + $rating->location + $rating->propertyCondition + $rating->communication);

for ($i = 0; $i < $totalScore; $i++) {
?>
    <img src="https://cdn1.iconfinder.com/data/icons/simple2/Favorites.png" alt="star">
<?php
}
?>

<hr>
<?php

endforeach;

require 'includes/footer.php'; ?>
