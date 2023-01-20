<?php
/** @var SearchSuggest $controller */
$data = $controller->getSearchData();
?>
<ul style="position: absolute; z-index: 5;" class="list-group list-group-flush">
<?php if (empty($data)) { ?>
<a class="list-group-item list-group-item-action p-3">No result found!</a>
<?php } ?>
<?php foreach ($data as $row) { ?>
    <button id="<?= $row ?>" type="button" class="list-group-item list-group-item-action" onclick="outputResult('<?= $row ?>'); outputPaginationResult('<?= $row ?>')"><?php $controller->boldText($row) ?></button>
    <!-- Make search box better(make the inputted user text bold in all search fields), and finally when clicking on the suggestion, user is immediately shown result -->
<?php } ?>
</ul>

