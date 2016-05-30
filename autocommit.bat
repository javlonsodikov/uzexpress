:<<"::CMDLITERAL"
@ECHO OFF
GOTO :CMDSCRIPT
::CMDLITERAL
echo "Linux shell autocommit"
exit $?

:CMDSCRIPT

echo "windows autocommit"
cd D:\www\yii2_composer\uzexpress
set _date=%DATE:/=-%
set _time=%TIME::=-%
set _time=%_time:~0,8%
set /p dbpassword=<"C:\Program Files (x86)\Ampps\ampps\data\my.conf"
"C:\Program Files (x86)\Ampps\mysql\bin\mysqldump.exe"  --compact -e -uroot -p%dbpassword% aliadvanced > db_dump\%_date%-%_time%.sql
git pull origin master
git add .
git commit -m "autocommit %_date%-%_time%"
git push origin master 
pause
exit
