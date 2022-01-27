CREATE TABLE contactsss
(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  phone varchar(20) NOT NULL,
  role varchar(30)
);

INSERT INTO contactsss SET name='Артем', phone='+79122081147', role='Разработчик справочника';