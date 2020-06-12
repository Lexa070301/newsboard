<?php
if (!empty($_POST["mail"])) {
    echo $_POST['email'];
} else {
    echo "No, mail is not set";
}
?>