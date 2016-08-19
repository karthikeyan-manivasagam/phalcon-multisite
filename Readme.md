#Multisite 

This is the multi site Skeleton built in phalcon

With shared common views , models and controllers among multiple websites 

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
