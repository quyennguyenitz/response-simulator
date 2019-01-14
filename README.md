API Response Simulator
=========================
Response Simulator for Lumen 5
This package is created by [Quyen Nguyen](mailto:quyennguyenitz@gmail.com). This package adapted to work with Lumen 5.7.

Installation
============
```composer require quyennguyenitz/response-simulator```

Configuration
-------------


Usage
=====

Integer
-------
 Option      |Description
:-----------|:----------
value:val|Specific response value
in:val_1,val_2,...|Random a  value in collection
range:min,max|Range of response value

**Example:** ```"id"=>"integer|value:10|in:0,1|range:1,100"```

String
------
 Option      |Description
:-----------|:----------
length:val|String length
in:val_1,val_2,...|Random a  value in collection

**Example:** ```"name"=>"string|length:20|in:New,Approved,Rejected"```

Code
----
 Option      |Description
:-----------|:----------
prefix:val|Code prefix
content:datatype,length|Code content, datatype is string or integer
suffix:val|Code suffix

**Example:** ```"code"=>"code|prefix:PRE-|content:string,10|suffix:-SUF"```

Date
-----
 Option      |Description
:-----------|:----------
value|Specific response value, ```value=current``` going to return current time follow bellow format
format:val|Data format, default ```"Y-m-d"```
min:val|Min date
max:val|Max date

**Example** ```"birthday"=>"date|value:2019-01-01|format:m-d-Y|min:01-01-2019|max:12-31-2019"```


