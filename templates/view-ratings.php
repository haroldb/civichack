<?php require 'includes/header.php'; ?>

<input type="hidden" id="gMapApiKey" name="gMapApiKey" value="AIzaSyA7Tq9Y5gDSBuFMBjdt3fhjozyLjdHb3v0">
<div id="postcode-entry" style="padding-bottom:40px;">
    <form id="validatePostCodeSubmit" action="javascript:void(0);">
        Search via postcode: <input type="validatePostCode" name="validatePostCode" id="validatePostCodeCode">
        <input type="submit" value="Search" class="validatePostCodeSubmit">
        <div class="postcode-entry-error" style="color:red;"></div>
    </form>
</div>

<?php
foreach ($this->data['ratings'] as $rating):
    $totalScore = 0;
?>
<div class="rating">
    <address>
        <a href="/rating/<?= $rating->entryId; ?>"><?= $rating->streetAddress; ?></a><br />
        <?= $rating->postcode; ?><br>
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
