#!/bin/bash
php -S 0.0.0.0:8000 -t src/ > /dev/null &
echo $! > pid.txt