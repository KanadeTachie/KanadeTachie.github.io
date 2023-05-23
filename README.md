# mediaserver
Basic local-network based media server created from PHP.

May be updated in the future

## INTRODUCTION TO MySQL DATABASES
The program I used is XAMPP, an all in one program for home server solutions. To turn activate your server using XAMPP, simply turn on Apache and MySQL.
Inside the xampp folder, there is an 'htdocs' folder. Open it and create a new folder and name it whatever you want, in this case, I named the folder 'mediaserver'
Inside this folder is where you will be putting all of your scripts and subdirectories that will be accessed by your server. </br>

In order to access your PHP files through the browser, simply put in 'localhost/foldername/script.php'. In this case, use 'localhost/mediaserver/main.php'. </br>

## CREATING A DATABASE
In order to create your database, head into 'localhost/phpmyadmin' and this is where you will see all your databases. Create a new one and name it 'mediaserver' for the
sake of simplicity. Inside your database, you could manually create a database table or use a query that will do it for you. To create a 'files' table for your database,
use the following query. </br>

**CREATE TABLE files(</br>
fileno INT(11) UNSIGNED AUTO-INCREMENT PRIMARY KEY,</br>
filename VARCHAR(255),</br>
extension VARCHAR(5))**</br>

All tables must have one value that has the 'PRIMARY KEY' attribute.</br>
Click your database, and at the top, there should be a 'SQL' link. Press it and execute the query there.

## BASICS OF QUERY
Above, we could see an example of query, but what about others?</br>
1. If you want to add data into a table, use</br></br>
**INSERT INTO tableName(column1, column2, etc)
VALUES(value1, value2, etc)**

2. If you want to get data from a database, use</br></br>
**SELECT * FROM tableName** This returns all values</br>
**SELECT column1 FROM tableName** This returns values from 'column1'</br>
**SELECT * FROM tableName WHERE column1='$value1'** This returns all values from a specific row</br>
**SELECT * FROM tableName WHERE column1='$value1' LIMIT 1** Limits the returned values to return only 1 dataset</br>
**SELECT * FROM tableName WHERE column1 LIKE '$value1'** Returns all values that are similar to the passed variable</br>

3. If you want to update data in a database, use</br></br>
**UPDATE tableName</br>
SET column1 = '$someOtherData'</br>
WHERE column2 = '$value2'**</br>

For more information, read into documentations or other sources.
