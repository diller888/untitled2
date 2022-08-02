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
//Пример
$params = array(
    'login' => 'diller',
    'id'    => 1
);
$query = $db->select('product', $params);
echo $query->login;
```
### Одиночный запрос в таблицу
#### selectOne()
```php
//Синтаксис
selectOne('название таблицы', 'поле', 'значение')
//Пример
$query = $db->selectOne('users', 'login', 'diller');
echo $query->id;
```
### Запрос while
#### selectRow()
```php
//Синтаксис
selectRow('название таблицы', 'массив значений')
//Пример
$params = array(
    'login' => 'diller',
    'id'    => 1
);
$query = $db->selectRow('users', $params);
while ($post = mysqli_fetch_array($query)){
    echo $post->id;
}
```