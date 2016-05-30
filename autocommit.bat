cd D:\www\yii2_composer\uzexpress
set _date=%DATE:/=-%
set _time=%TIME:/=-%
set /p dbpassword=<"C:\Program Files (x86)\Ampps\ampps\data\my.conf"
"C:\Program Files (x86)\Ampps\mysql\bin\mysqldump.exe" -e -uroot -p%dbpassword% aliadvanced > db_dump\%_date%-%_time%.sql
git add .
git commit -m "autocommit %_date%-%_time%"
git push origin master 
