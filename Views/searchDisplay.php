<?php
/** @var SearchDisplay $controller */
$data = $controller->getSearchedData();
$search = $this->getRequestParameter('search');

foreach ($data as $azubi){  ?>
    <tr id="<?= $azubi->getId(); ?>">
        <td data-title="Select"><input type="checkbox" class="selectButtonList" name="checkedId[]" value="<?= $azubi->getId(); ?>"></td>
        <td id="name" data-title="Name"><?= $azubi->getName(); ?></td>
        <td data-title="Birthday"><?= $azubi->getBirthday(); ?></td>
        <td data-title="Email"><?= $azubi->getEmail(); ?></td>
        <td data-title="Edit"><a href="<?php echo $controller->getUrl('index.php?controller=AzubiForm&'); ?> azubi_id=<?= $azubi->getId(); ?>"><img width="25px" src="Views/images/1200px-Simpleicons_Business_crayon-pen-variant-in-diagonal-position.svg.png"></a>
        </td>
        <td data-title="Delete"><button type="button" onclick="deleteData(<?= $azubi->getId(); ?>)" class="btn btn-outline-light""><img width="25px" src="Views/images/garbage-bin-10419.svg"></button></td>
    </tr>
<?php }?>
