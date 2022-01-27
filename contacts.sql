CREATE TABLE contacts
(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  phone varchar(12) NOT NULL,
  role varchar(30)
);

INSERT INTO contacts SET name='Артем', phone='+79122081147', role='Разработчик справочника';
