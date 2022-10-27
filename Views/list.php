<?php
/** @var AzubiList $controller */
$data = $controller->getAzubiData();
$search = $this->getRequestParameter('search');
$this->deleteSelected(); ?>
<div class="listContainer">
    <br><br><br>
    <form class="list_form" action="<?php echo $controller->getUrl('index.php'); ?>" method="post">
        <input class="search_input" type="text" name="search" placeholder="Search">
        <input class="search_button" value="Suchen"  type="submit" name="submit-search">
        <br>
        <table class="list-table">
            <thead>
                <tr>
                    <td>Select</td>
                    <td>Name</td>
                    <td>Birthday</td>
                    <td>Email</td>
                    <td colspan="2">Edit or Delete</td>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $azubi){  ?>
            <tr style="border:1px solid black;margin-left:auto;margin-right:auto;">
                <td><input type="checkbox" class="selectButtonList" name="checkedId[]" value="<?= $azubi->getId(); ?>"></td>
                <td><?= $azubi->getName(); ?></td>
                <td><?= $azubi->getBirthday(); ?></td>
                <td><?= $azubi->getEmail(); ?></td>
                <td><a href="<?php echo $controller->getUrl('index.php?controller=AzubiForm&'); ?> azubi_id=<?= $azubi->getId(); ?>"><img style="width: 25px" src="Views/images/69-697943_edit-data-icon-comments-transparent-pen-icon-png.png"></a>
                </td>
                <td><a href="<?php echo $controller->getUrl('index.php?controller=AzubiList&action=delete&'); ?>delete-azubi-id=<?= $azubi->getId(); ?>"><img style="width: 15px" src="Views/images/1000_F_272554194_9bJhYSJkUcLbTjXfDlDANV2RyQYGO06N.jpg"></a></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        <div class="paginationLink">
        <?php
            $totalPages = $controller->getNumberOfPages();
            for ($i=1; $i <= $totalPages; $i++){
                if (!empty($search)){
                    echo "<a class='paginationLinks' href='index.php?page=".$i."&search=".$search."'>".$i."</a>";
                    echo "<br>";
                    echo "<br>";
                    echo "<a class='refreshButton' href='index.php'>Refresh</a>";
                } else {
                    echo "<a class='paginationLinks' href='index.php?page=".$i."'>".$i."</a>";
                }
            }
        ?>
        </div>
        <div class="buttonLinkForm">
            <br>
            <a class="buttonLink" role="button" href="<?php echo $controller->getUrl('index.php?controller=AzubiForm'); ?>">Neue Azubi anlegen</a>
        </div>
        <div>
            <input class="deleteSelectedButton" type="submit" name ="delete_all_button" value="Ausgewählte Azubis löschen">
        </div>
    </form>
</div>

