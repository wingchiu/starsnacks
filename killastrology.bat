echo off
:start
ping 192.0.2.2 -n 1 -w 1000 > nul
taskkill /im astrolog.exe
goto start
