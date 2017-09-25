### Summary
This application will fetch, store and return a data set from a website. 

It will also expose a user interface for static queries on the data. 
 

### Usage
- Run `git clone https://github.com/roycocup/SK.git`
- Run `composer install`
- Create a mysql database named `samknows`
- Alter the credentials for db in the configs.yaml file 
- Run `vendor/bin/doctrine orm:schema-tool:update --force` to install the 
- Run `./setup.php run` 
- Setup a server and open the browser at the homepage and you should see a dropdown list with
a load button. 
- Select the desired date and time and push load to get the calculated values. 
