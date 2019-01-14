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
 Option      |Description| Example
:-----------|:----------|:---------------------------
value:val|Specific response value|```id=>"integer|value:10"```
in:val_1,val_2,...|Random a  value in collection|```id=>"integer|in:0,1"```
range:min,max|Range of response value|```id=>"integer|range:1,100"```

String
------
 Option      |Description| Example
:-----------|:----------|:---------------------------
length:val|String length|```name=>"string|length:20"```
in:val_1,val_2,...|Random a  value in collection|```status=>"string|in:New,Approved,Rejected```

Code
----
 Option      |Description| Example
:-----------|:----------|:---------------------------
prefix:val|Code prefix|```code=>"code|prefix:PRE-"```
content:datatype,length|Code content, datatype is string or integer|```code=>"code|content:string,10"```
suffix|Code suffix|```code=>"code|suffix:-SUF"```


Date
-----
 Option      |Description| Example
:-----------|:----------|:---------------------------
value|Specific response value, ```value=current``` going to return current time follow bellow format|```birthday=>"date|value:2019-01-01"```
format:val|Data format, default ```"Y-m-d"```|```birthday=>"date|format:m-d-Y"```
min:val|Min date|```birthday=>"date|min:01-01-2019"```
max:val|Max date|```birthday=>"date|max:12-31-2019"```





