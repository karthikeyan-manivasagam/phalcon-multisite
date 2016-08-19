#Multisite 

This is the multi site Skeleton  built in phalcon

With shared common views ,models and controllers among multiple websites 

	multisite/shared 
	├── apps
	│   ├── common
	│   │   ├── controllers        (Register namespace Common/Controller)
	│   │   │   ├── IndexController.php   
	│   │   │   ├── ArticleController.php
	│   │   ├── models             (Register namespace Common/Model)
	│   │   │   └── Article.php  
	│   │   └── views
	│   │       ├── index
	│   │       │   └── index.volt
	│   │       └── article
	│   │       |    └── index.volt
	|   |       └──index.volt   
	│   ├── example.com
	│   │   ├── controllers
	│   │   │   ├── IndexController.php (extend Common/Controller)
	│   │   │   ├── ArticleController.php  (extend Common/Controller)
	│   │   ├── models
	│   │   │   └── Article.php (extend Common/Model)
	|   |   |   └── Users.php (Site Specific Model)
	│   │   └── views
	│   │       └── article   (Other view templates will refer to Common view folder)
	│   │           └── index.volt
	│   ├── example2.com
	│   │   ├── controllers
	│   │   │   ├── IndexController.php (extend Common/Controller)
	│   │   │   ├── ArticleController.php (extend Common/Controller)
	│   │   │   └── SitespecificController.php   Site Specific Controller
	│   │   ├── models
	│   │   │   └── Article.php (extend Common/Model)
	|   |   |   └── SiteSpecific.php (Site Specific Model)
	│   │   └── views
	│   │       └── sitespecific        (Other view templates will refer to Common view folder)
	│   │           └── index.volt
	└── public
	    └── example.com   (Will contain Js CS Images to support site specific theme)
	    └── example2.com  (Will contain Js CS Images to support site specific theme)
	    └── index.php




# Phalcon Multi site skeleton  

This is the multi site Skeleton  built in phalcon

1. Shared / site specific common views, models and controllers among multiple websites 

2. Advantage here is without duplicating the whole views folder in all websites

3. Also can create the different module.php for each websites, Can have different database or same database for websites. 

4. Each websites in this multisite setup can have phalcon multi module setup separately.  

5. Views folder will have n number of volt templates, one specific volt template can be overridden for site specfic changes with out creating whole views folder in all sites rather just by creating single volt template file.


# **Steps to achieve it**

* Step 1 : Register the namespaces of common controllers and models
* Step 2 : Extend the phalcon view engine to cascading the view (say for example View engine will look for specific template file in site specific view folder if its not exist it will look in common views folder, there is no need to replicate all the template files in all sites views directories, you can overwrite single template file alone).
* Step 3 : Extend Phalcon volt to provide Skin path for tempaltes
* Step 4: Create site specfic Volt cache folder
* Step 5 : Create seperate folders with sitenames in public folder for js/css/images
* Step 6: Create common contollers, views, modals
* Step 7: Extend common controllers , modals in site specific folderss , Views wil be taken from common folder. if you want to overwrite any template you can overwiite that alone no need all view folder.
* Step 8 : Set sitename by current domain name. this sitename will be used to register contollers models directries
* Step 9: Set two views directory one is common and another is sitename (thi can be done only if you have extened the phalcon view to add two directories refer step 2)

