#!/bin/bash
FILE=$1
KEY_WORD=$2
NUM=$3
NUM_5=$4
ARGNUM=$#
if [ $ARGNUM -ne 4 ]
then
    echo "Usage:  $0  FILE KEY_WORD NUM400 NUM500"
    exit 0
fi

Uname=`uname`
if [ "$Uname" = "linux" ] || [ "$Uname" = "Linux" ]
then
    cat /dev/null > /tmp/nginxlogcheck_${FILE}
    if [ -r /usr/local/nginx/logs/${FILE} ]
    then
        #i=0
        #while [ $i -le 6 ];do
        #    echo "while $i";
        #    tail -20000 /usr/local/nginx/logs/${FILE} | grep "`date --date="$i minutes ago" +%d/%b/%Y:%R`" | grep -Ei "${KEY_WORD}"  >> /tmp/nginxlogcheck_${FILE}
        #    i=$((i+1))
        #done
        tail -20000 /usr/local/nginx/logs/${FILE} | grep "`date --date="1 minutes ago"  +%d/%b/%Y:%R`" | grep -Ei "${KEY_WORD}" | grep -ic "HTTP/1....4"  > /tmp/nginxlogcheck_4_${FILE}
        tail -20000 /usr/local/nginx/logs/${FILE} | grep "`date --date="1 minutes ago"  +%d/%b/%Y:%R`" | grep -Ei "${KEY_WORD}" | grep -ic "HTTP/1....5"  > /tmp/nginxlogcheck_5_${FILE}
        #cat /usr/local/nginx/logs/${FILE} | grep "`date  +%d/%b/%Y`" | grep -Ei "${KEY_WORD}"  >> /tmp/nginxlogcheck_${FILE}
        if [ -s /tmp/nginxlogcheck_4_${FILE} ]&&[ `cat /tmp/nginxlogcheck_4_${FILE}` -ge $NUM ]
        then
            cat /tmp/nginxlogcheck_4_${FILE}
        elif [ -s /tmp/nginxlogcheck_5_${FILE} ]&&[ `cat /tmp/nginxlogcheck_5_${FILE}` -ge $NUM_5 ]
        then
            cat /tmp/nginxlogcheck_5_${FILE} 
        else
            #echo "check_error"
            echo 0
        fi
    else
        #echo "check_error, log file can not read: /usr/local/nginx/logs/${FILE}"
        echo 0
    fi
else
    #echo "check_error, not linux system"
    echo 0
fi