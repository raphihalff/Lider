#!/bin/bash
echo "importing new poems to database"
mysql -h "xn--7dbli0a4a.us.org" -u "xn7dbl5" "-pHraphi12%&96" "xn7dbl5_oytser" < mysql_script
echo "copying readings to Lider and public"
cp readings/* ~/public_html/readings/
cp readings/* ~/Lider/readings/
echo "copying images to Lider and public"
cp images/* ~/public_html/images/
cp images/* ~/Lider/images/
echo "DONE"
 
 
