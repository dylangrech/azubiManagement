<?php
/** @var AzubiList $controller */
$data = $controller->getAzubiData();
$search = $this->getRequestParameter('search');
$this->deleteSelected();
$selectedOption = $this->getRequestParameter('amountPerPage');
?>
<div id="list-table" class="mainContent container-fluid bg-light p-2">
    <form class="list_form" action="<?php echo $controller->getUrl('index.php'); ?>" method="post">
        <div class="mt-4 sticky-top input-group ">
            <input value="" id="searchInput" onkeyup="showResult(this.value)" name="search" type="text" class="form-control" placeholder="Search by Name.."  aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <input class="btn btn-primary" value="Search"  type="submit" name="submit-search">
            </div>
        </div>
        <div  class="list-group" id="livesearch"></div>
        <br>
        <div class="table-responsive" id="table-break">
            <table id="listTable" class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Select</th>
                    <th scope="col">Name</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="listDisplay">
                <?php
                foreach ($data as $azubi){  ?>
                    <tr id="<?= $azubi->getId(); ?>">
                        <td data-title="Select"><input type="checkbox" class="selectButtonList" name="checkedId[]" value="<?= $azubi->getId(); ?>"></td>
                        <td id="name" data-title="Name"><?= $azubi->getName(); ?></td>
                        <td data-title="Birthday"><?= $azubi->getBirthday(); ?></td>
                        <td data-title="Email"><?= $azubi->getEmail(); ?></td>
                        <td data-title="Edit"><button type="button" class="btn"><a href="<?php echo $controller->getUrl('index.php?controller=AzubiForm&'); ?> azubi_id=<?= $azubi->getId(); ?>"><img width="25px" src="Views/images/1200px-Simpleicons_Business_crayon-pen-variant-in-diagonal-position.svg.png"></a></button>
                        </td>
                        <td data-title="Delete"><button id="deleteAzubiButton" type="button" onclick="deleteData(<?= $azubi->getId(); ?>)" class="btn""><img width="25px" src="Views/images/garbage-bin-10419.svg"></button></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div id="paginationDisplay" class="pagination justify-content-center">
            <?php
            $totalPages = $controller->getNumberOfPages();
            for ($i=1; $i <= $totalPages; $i++){ ?>
                <a class='page-link' href='<?= $controller->getPaginationLinks($selectedOption, $search, $i); ?>'><?= $i ?></a>
            <?php } ?>
            <?php if (!empty($search)){ ?>
                <a class='position-absolute bottom-0 end-0 btn btn-secondary' href='index.php'>Refresh Page</a>
            <?php } ?>
        </div>
        <br>
        <div class=" container-fluid row">
            <div class="col-lg-2">
                <div class="buttonLinkForm">
                    <a class="btn btn-success" role="button" href="<?php echo $controller->getUrl('index.php?controller=AzubiForm'); ?>">Neue Azubi anlegen</a>
                </div>
            </div>
            <div class="col-lg-1">
                <div>
                    <input class="btn btn-danger" type="submit" name ="delete_all_button" value="Ausgewählte Azubis löschen">
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="container-fluid col-sm-3">
        <form action="<?php echo $controller->getUrl('index.php'); ?>" id="amountToDisplay" method="post">
                <div>
                    <select onchange="submitForm()" class="form-select" name="amountPerPage">
                        <?php foreach ($controller->getOptions() as $oneOption){?>
                            <option value="<?= $oneOption?>" <?= $controller->injectSelectAttribute($selectedOption, $oneOption)?>><?= $oneOption ?></option>
                        <?php } ?>
                    </select>
                </div>
        </form>
    </div>
</div>