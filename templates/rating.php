<?php require 'includes/header.php'; ?>

<?php
foreach ($this->data['ratings'] as $rating):

?>
<div class="rating">
    <address>
        <a href="/rating/<?= $rating->entryId; ?>"><?= $rating->streetAddress; ?></a><br />
        <?= $rating->postcode; ?><br>
    </address>
    <ul class="list-unstyled">
        <li>Occupants: <?= $rating->occupants; ?></li>
    </ul>
    <ul class="list-inline">
        <li>Time to respond: <?= $rating->timeToRespond; ?></li><br />
        <li>Quality of solution: <?= $rating->qualityOfSolution; ?></li><br />
        <li>Location: <?= $rating->location; ?></li><br />
        <li>Property condition: <?= $rating->propertyCondition; ?></li><br />
        <li>Communication: <?= $rating->communication; ?></li><br /><br />
        <li>Submission Date: <?= $rating->dateCreated; ?></li><br />
    </ul>
    <h2>Overall rating:</h2>
</div>
<hr>
<?php
endforeach;

$totalScore += calc_rating($rating->timeToRespond + $rating->qualityOfSolution + $rating->location + $rating->propertyCondition + $rating->communication);

for ($i = 0; $i < $totalScore; $i++) {
?>
    <img src="https://cdn1.iconfinder.com/data/icons/simple2/Favorites.png" alt="star">
<?php
}
require 'includes/footer.php'; ?>
