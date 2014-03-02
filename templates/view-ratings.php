<?php require 'includes/header.php'; ?>

<div id="postcode-entry" style="padding-bottom:40px;">
    <form id="validatePostCodeSubmit" action="javascript:void(0);">
        Search via postcode: <input type="validatePostCode" name="validatePostCode" id="validatePostCodeCode">
        <input type="submit" value="Search" class="validatePostCodeSubmit">
        <div class="postcode-entry-error" style="color:red;"></div>
    </form>
</div>

<?php
foreach ($this->data['ratings'] as $rating):
?>
<div class="rating">
    <address>
        <?= $rating->streetAddress; ?><br>
        <?= $rating->postcode; ?><br>
    </address>
    <ul class="list-unstyled">
        <li>Email: <?= $rating->email; ?></li>
        <li>Occupants: <?= $rating->occupants; ?></li>
    </ul>
    <ul class="list-inline">
        <li>Time to respond: <?= $rating->timeToRespond; ?></li>
        <li>Quality of solution: <?= $rating->qualityOfSolution; ?></li>
        <li>Location: <?= $rating->location; ?></li>
        <li>Property condition: <?= $rating->propertyCondition; ?></li>
        <li>Communication: <?= $rating->communication; ?></li>
    </ul>
</div>
<hr>
<?php
endforeach;
?>

<?php require 'includes/footer.php'; ?>
