# Rdms2nosql


Rdms2nosql is a simple project with one dependency (mongodbclient). Rdms2nosql is create to for exportation of data from MySQL into MongoDB.

# Features!

  - It is a two page web page which does the export directly into NoSQL collection automatically
  - The page is designed to work both on mobile an desktop
  - Auto Retry

# Instalation

Clone the repository by clicking on "clone or download" button from the top right corner of the page 
**or**
Using composer
`````
composer create-project --prefer-dist horlarme/rdms2nosql
`````
Make sure to download create project into the directory that suite your environment.

# Usage

Open the homepage by loading 
```
localhost/rdms2nosql
```
Fill in the forms as explained;
- hkhkf
- SQL Connection - Information related to mysql database which data will be fetched from
- NoSQL Connection - The NoSQL connection information, the database to receive the data
- Item Counter - This field takes a sql query statement that fetches the data to be exported without limititng it. Example 
````
SELECT * FROM users
````
- SQL Data Fetch Query - This fields takes the query that fetches the data to be exported into NoSQL. Please note that the data will import everything that is provided as the result of the query. Example
```
SELECT * FROM users
```
If the result is like:
| name | password | email |
|------|----------|-------|
|Lawal Oladipupo | ihee93e238232e2e | lawaloladipupo@outlook.com|
The the fields in NoSQL will be exactly the same with the above.
- NoSQL (Collection) - The collection name to export data into.

# Bug
- The current known bus is that processes each row one by one to monitor failures and retry them.


License
----
Apache2.0

**Free Software, Hell Yeah!**
