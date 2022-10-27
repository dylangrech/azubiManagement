<?php
/** @var AzubiForm $controller */
$azubi = $controller->getAzubi();  ?>
<div id="wrapper-content">
    <form class="formInput" action="<?php echo $controller->getUrl('index.php'); ?>" method="post">
        <input type="hidden" name="controller" value="AzubiForm">
        <input type="hidden" name="action" value="submit">
        <div id="personal-info-wrapper">
            <h1 style="color: darkorange">Input Personal Data</h1>
            <p>
                <input type="hidden" name="azubi_id" value="<?= $azubi->getId(); ?>">
                <input type="text" name="name" id="fullName" placeholder="Full Name" value="<?= $azubi->getName();?>">
            </p>
            <br>
            <p>
                <input type="text" name="birthday" id="birthDate" placeholder="Birth Date (YY-MM-DD)" value="<?= $azubi->getBirthday();?>"> <br>
            </p>
            <br>
            <p>
                <input type="text" name="email" id="emailAddress" placeholder="E-Mail" value="<?= $azubi->getEmail();?>"> <br>
            </p>
            <br>
            <p>
                <input type="text" name="githubuser" id="gitUser" placeholder="Github Username" value="<?= $azubi->getGithubuser();?>"> <br>
            </p>
            <br>
            <p>
                <input style="width: 12%" type="text" name="employmentstart" id="employeeStart" placeholder="Start of Employment(YY-MM-DD)" value="<?= $azubi->getEmploymentstart();?>"> <br>
            </p>
            <br>
            <p>
                <input type="text" name="pictureurl" id="pictureURL" placeholder="PictureURL" value="<?= $azubi->getPictureurl();?>"> <br>
            </p>
            <br>
            <p>
                <input type="password" name="password" id="password" placeholder="Password" value="<?= $azubi->getPassword();?>" > <br>
            </p>
            <br>
            <p>
                <input type="password" name="password-confirm" placeholder="Confirm Password">
            </p>
        </div>
        <br>
        <div id="wrapper-skills">
            <div id="input1">
                <h1 style="color: darkorange">Pre-Skills</h1>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <p>
                        <?php
                        $value = "";
                        $skillDataPre = $azubi->getSkillPre();
                        if (isset($skillDataPre[$i])) {
                            $value = $skillDataPre[$i];
                        }
                        ?>
                        <input type="text" name="preSkill<?= $i; ?>" id="preSkill<?= $i; ?>" placeholder="Skill" value="<?php echo $value; ?>"> <br>
                    </p>
                <?php } ?>

            </div>
            <br>
                    <div id="input2">
                        <h1 style="color: darkorange">New Skills</h1>
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <p>
                                    <?php
                                    $value = "";
                                    $skillDataNew = $azubi->getSkillNew();
                                    if (isset($skillDataNew[$i])) {
                                        $value = $skillDataNew[$i];
                                    }
                                    ?>
                                    <input type="text" name="newSkill<?= $i; ?>" id="newSkill<?= $i; ?>" placeholder="Skill" value="<?php echo $value; ?>"> <br>
                                </p>
                            <?php } ?>

                    </div>
        </div>
        <div id="submit">
        <input type="submit" value="Submit" name="Authenticate-Submit">
        </div>
    </form>
    <form class="searchID" action="<?php echo $controller->getUrl('index.php'); ?>" method="GET">
        <input type="hidden" name="controller" value="AzubiForm">
        <input type="text" name="azubi_id" value="<?php if(isset($_GET['azubi_id'])){echo $_GET['azubi_id'];}?>">
        <button type="submit">Search</button>
    </form>
    <?php if ($azubi->getId() !== false){ ?>
    <form class="deleteID" action="<?php echo $controller->getUrl('index.php'); ?>" method="GET">
        <input type="hidden" name="controller" value="AzubiForm">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="delete-azubi-id" value="<?= $azubi->getId(); ?>">
        <button type="submit" name="delete-azubi-button">Delete Azubi</button>
    </form>
    <?php } ?>
</div>