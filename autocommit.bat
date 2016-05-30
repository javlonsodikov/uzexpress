cd D:\www\yii2_composer\uzexpress
set _date=%DATE:/=-%
set /p dbpassword=<"C:\Program Files (x86)\Ampps\ampps\data\my.conf"
"C:\Program Files (x86)\Ampps\mysql\bin\mysqldump.exe" -e -uroot -p%dbpassword% aliadvanced > db_dump\%_date%.sql
pause
git add .
git commit -m "autocommit %_date%"
git push origin master 
pause 