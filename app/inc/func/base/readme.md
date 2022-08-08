# Работа с базой данных

### Подключение

```php
require 'mainDB.php';
$db = new mainDB(dbhost, dbuser, dbpass, dbname);
```

### Запрос в таблицу
#### select()
```php
//Синтаксис
select('название таблицы', 'массив значений')
```
```php
//Пример
$params = array(
    'login' => 'diller',
    'id'    => 1
);
$ank = $db->select('users', $params);
echo $ank->login;
```
### Одиночный запрос в таблицу
#### selectOne()
```php
//Синтаксис
selectOne('название таблицы', 'поле', 'значение')
```
```php
//Пример
$query = $db->selectOne('users', 'login', 'diller');
echo $query->id;
```
### Запрос while
#### selectRow()
```php
//Синтаксис
selectRow('название таблицы', 'массив значений', 'лимит', 'ORDER BY', 'значение ORDER BY')
```
```php
//Пример простого запроса
$params = array(
    'login' => 'diller',
    'id'    => 1
);
$q = $db->selectRow('users', $params);
while ($post = $q){
    echo $post->id;
}
```
```php
//Пример полного запроса
$params = array(
    'login' => 'diller',
    'id'    => 1
);
$q = $db->selectRow('users', $params, 25, 'DESC', 'id');
while ($post = $q){
    echo $post->id;
}
```
### Запись в базу данных
#### insert() - вернет id записи
```php
//Синтаксис
insert('название таблицы', 'массив значений')
```
```php
//Пример
$params = array(
    'login' => 'diller',
    'phone'    => '79000000000'
);
$query = $db->insert('users', $params);
```
### Обновить записи
#### update()
```php
//Синтаксис
update('название таблицы', 'массив значений', 'id')
```
```php
//Пример
$params = array(
    'login' => 'diller',
    'phone'    => '79000000000'
);
$query = $db->update('users', $params, 1);
```
### Кастомный запрос к БД
#### dbquery()
```php
//Синтаксис
dbquery('название таблицы', 'значения', 'лимит')
```
```php
//Пример
$params = "`date_last` < " . (time() - 86400) . " AND `id_user` = '0'";
$guestQuery = $db->dbquery('guest', $params, 100);
if ($guestQuery) {
    while ($guestRow = mysqli_fetch_array($guestQuery)){
        $db->delete('guest', $guestRow['id']);
    }
}
```
```php
//Пример количество
$params = "`date_last` < " . (time() - 86400) . " AND `id_user` = '0'";
$guestQuery = $db->dbquery('guest', $params, 100);
if ($guestQuery) {
    $guestCount = mysqli_num_rows($guestQuery);
    if ($guestCount > 0)echo $guestCount;
}
```

