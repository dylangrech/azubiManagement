<?php
/** @var AzubiForm $controller */
$azubi = $controller->getAzubi();  ?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
            <div class="card card-registration my-4">
                <div class="row g-0">
                    <div class="col-xl-6">
                        <div class="card-body p-md-5 text-black">
                            <form class="formInput" action="<?php echo $controller->getUrl('index.php'); ?>" method="post">
                                <input type="hidden" name="controller" value="AzubiForm">
                                <input type="hidden" name="action" value="submit">
                                <h3 id="formPersonalTitle" class="mb-5">Input Personal Data</h3>
                                <input type="hidden" name="azubi_id" value="<?= $azubi->getId(); ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Full Name" name="name" value="<?= $azubi->getName();?>" type="text" id="form3Example1m" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Birth Date (YY-MM-DD)" name="birthday" value="<?= $azubi->getBirthday();?>" type="text" id="form3Example1n" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="E-Mail" name="email" value="<?= $azubi->getEmail();?>" type="text" id="form3Example1m1" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Github Username" name="githubuser" value="<?= $azubi->getGithubuser();?>" type="text" id="form3Example1n1" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Employment Date (YY-MM-DD)" name="employmentstart" value="<?= $azubi->getEmploymentstart();?>" type="text" id="form3Example1m1" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Picture URL" name="pictureurl" value="<?= $azubi->getPictureurl();?>" type="text" id="form3Example1n1" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Password" name="password" value="<?= $azubi->getPassword();?>" type="text" id="form3Example1m1" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input placeholder="Confirm Password" name="password-confirm" type="text" id="form3Example1n1" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <h3 id="preSkillTitle">Pre-Skills</h3>
                                    <?php
                                    if (!empty($azubi->getSkillPre())){
                                        for ($i = 0; $i <= count($azubi->getSkillPre())-1; $i++){
                                            $skillPre = $azubi->getSkillPre(); ?>
                                            <input type="text" class="form-control" name="preSkill<?= $i+1; ?>" id="preSkill<?= $i+1; ?>" placeholder="Skill <?= $i+1;?>" value="<?php echo $skillPre[$i]; ?>"> <br>
                                       <?php } } ?>
                                    <!-- Old PreSkill Code Goes Under Here (Just in case) -->
                                    <div id="addMoreInputFields">
                                        <input type="text" class="form-control" name ="preSkill0" id="preSkill0" placeholder="Input Skill" value=""><br>
                                    </div>
                                    <button id="addInputFieldsPre" class="btn btn-outline-primary" type="button">Add Skill</button>
                                </div>

                                <div class="form-outline mb-4">
                                    <h3 id="newSkillTitle">New Skills</h3>
                                    <?php
                                    if (!empty($azubi->getSkillNew())){
                                        for ($i = 0; $i <= count($azubi->getSkillNew())-1; $i++){
                                            $skillNew = $azubi->getSkillNew(); ?>
                                            <input type="text" class="form-control" name="newSkill<?= $i+1; ?>" id="preSkill<?= $i+1; ?>" placeholder="Skill <?= $i+1;?>" value="<?php echo $skillNew[$i]; ?>"> <br>
                                        <?php } } ?>
                                    <div id="addMoreInputFieldsNew">
                                        <input type="text" class="form-control" name ="newSkill0" id="newSkill0" placeholder="Input Skill" value=""><br>
                                    </div>
                                    <button id="addInputFieldsNew" class="btn btn-outline-primary" type="button">Add Skill</button>
                                </div>
                                <div id="submit" class="">
                                    <input type="submit" class="btn btn-primary btn-lg " value="Submit" name="Authenticate-Submit">
                                </div>
                            </form>
                            <br>
                            <div class="row">
                                <?php if ($azubi->getId() !== false){ ?>
                                    <div class="col-sm">
                                        <div class="form-outline">
                                            <form class="deleteID" action="<?php echo $controller->getUrl('index.php'); ?>" method="GET" >
                                                <input type="hidden" name="controller" value="AzubiForm">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="delete-azubi-id" value="<?= $azubi->getId(); ?>">
                                                <button type="submit" class="btn btn-light btn-lg" name="delete-azubi-button">Delete Azubi</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm d-flex flex-row-reverse">
                                        <div class="form-outline">
                                            <form class="searchID" action="<?php echo $controller->getUrl('index.php'); ?>" method="GET">
                                                <div class="input-group mb-3">
                                                    <input type="hidden" name="controller" value="AzubiForm">
                                                    <input value="<?php if(isset($_GET['azubi_id'])){echo $_GET['azubi_id'];}?>" name="azubi_id" type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2"> <!-- Style move -->
                                                    <div class="input-group-append">
                                                        <button class="btn btn-light btn-lg" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
