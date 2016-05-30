:<<"::CMDLITERAL"
@ECHO OFF
GOTO :CMDSCRIPT
::CMDLITERAL
echo "Linux shell git autocommit"
datetime=`date +%m.%d.%Y-%H-%M-%S`
dbname=`php getitem.php dbname`
dbusername=`php getitem.php username`
dbpassword=`php getitem.php password`
mysqldump -u$dbusername -p$dbpassword $dbname > db_dump/$datetime.sql
git pull origin master
git add .
git commit -m "autocommit $datetime"
git push origin master 
exit 0



:CMDSCRIPT
echo "windows git autocommit"
rem set workdir="D:\www\yii2_composer\uzexpress\automation"
rem cd %workdir%
set _date=%DATE:/=-%
set _time=%TIME::=-%
set _time=%_time:~0,8%
for /f %%i in ('php getitem.php dbname') do set dbname=%%i
for /f %%i in ('php getitem.php username') do set dbusername=%%i
for /f %%i in ('php getitem.php password') do set dbpassword=%%i
"C:\Program Files (x86)\Ampps\mysql\bin\mysqldump.exe" -u%dbusername% -p%dbpassword% %dbname% > db_dump\%_date%-%_time%.sql
git pull origin master
git add .
git commit -m "autocommit %_date%-%_time%"
git push origin master
exit
