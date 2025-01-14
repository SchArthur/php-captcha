<?php

$array = str_split(1063);

session_start();

if (isset($_POST['captcha'])) {
    if ($_POST['captcha'] == $_SESSION["captcha"]) {
        echo "Captcha valide !";
    } else {
        echo "Captcha invalide...";
    }
}

?>

<form method="POST">
    <img src="/captcha.php" alt="" id="captcha_image">
    <button type="button" id="reroll">re</button>
    <input type="text" name="captcha">
    <input type="submit">
</form>
<script>
    const rerollBtn = document.getElementById("reroll");
    const captchaImage = document.getElementById("captcha_image");

    rerollBtn.addEventListener("click", (e) => {
        const timestamp = new Date().getTime();
        captchaImage.src = `/captcha.php?rand=${timestamp}`;
    });

</script>