geckodriver &
scripts/run.sh &

vendor/bin/phpunit tests
EXIT=$?

killall geckodriver
killall php

exit $EXIT
