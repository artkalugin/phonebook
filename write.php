<?php
require_once('Contact.php');
ini_set('display_errors', '1');

if (!empty($_POST)) {
    extract($_POST);
    if (isset($id)) {
        Contact::edit($id, $name, $phone, $role);
    } else {
        Contact::write($name, $phone, $role);
        $id = $db->insertId();
    }
    $row = Contact::get_one($id);
    Contact::print_one($row);
}
