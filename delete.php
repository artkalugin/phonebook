<?php
require_once('Contact.php');

if (!empty($_POST)) {
    Contact::delete($_POST['id']);
}