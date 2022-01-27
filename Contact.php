<?php
    require_once('SafeMySQL.php');
    class Contact {
        private static $db;
        private static $tablename = 'contacts';

        public static function setDB($db) {
            self::$db = $db;
        }

        public static function get_one($id) {
            $query = "SELECT * FROM " . self::$tablename . " WHERE id=?i LIMIT 1";
            $result = self::$db->query($query, $id);
            return self::$db->fetch($result);
        }

        public function print_all() {
            $rows = self::$db->getAll("SELECT * FROM " . self::$tablename);
            foreach ($rows as $row) {
                self::print_one($row);
            }
        }

        public function print_one($row) {
            echo "<tr class='contact-list__row' data-id='{$row['id']}'>";
            echo "<td class='contact-list__name'>{$row['name']}</td>";
            echo "<td class='contact-list__phone'>{$row['phone']}</td>";
            echo "<td class='contact-list__role'>{$row['role']}</td>";
            echo "<td><button type='button' class='edit btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#editModal' onclick='fill_form({$row['id']})' value='Редактировать' title='Редактировать'><i class='fas fa-user-edit'></i></button> <button type='button' class='delete btn btn-sm btn-outline-danger' onclick='remove_row({$row['id']})' value='Удалить' title='Удалить'><i class='fas fa-user-times'></i></button></td>";
            echo '</tr>';
        }

        public function write($name, $phone, $role) {
            $query = "INSERT INTO contacts SET name=?s, phone=?s, role=?s";
            return self::$db->query($query, $name, $phone, $role);
        }

        public function edit($id, $name, $phone, $role) {
            $query = "UPDATE contacts SET name=?s, phone=?s, role=?s WHERE id=?i";
            return self::$db->query($query, $name, $phone, $role, $id);
        }

        public function delete($id) {
            $query = "DELETE FROM contacts WHERE id=?i";
            return self::$db->query($query, $id);
        }
    }

    Contact::setDB($db);