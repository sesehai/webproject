#!/bin/bash

########################
# 接口响应时间统计
########################

# 例如: /usr/local/nginx/logs/api.yonggongbao.cn.log
LOG_FILE=$1

# line: 100.97.169.170 - - [02/Jul/2015:14:25:02 +0800] "GET /zeus/security/labor/frontpage?os=android&appid=0101&mac=0c%3A1d%3Aaf%3Ac5%3Ad7%3A0a&version=9 HTTP/1.0" 200 739 "-" "okhttp/2.3.0" 223.104.5.194 "127.0.0.1:8080" "200" "0.044" "0.045"

cat /usr/local/nginx/logs/api.yonggongbao.cn.log | awk '
	{if($7 != "/"){print $7, $(NF-1), $NF}}
' | awk '
	gsub(/"/,"",$0) {print $0}
' | awk -F"?" '
	{print $1, $2}
' | awk '
	{print $1,$3,$4}
' | awk '
	BEGIN {
		uamount[$1]=0;
		u_rows[$1]=0;
		print "接口,总耗时(毫秒),总行数,平均耗时(毫秒)"
	} 
	{
		uamount[$1]=uamount[$1]+$(NF-1)*1000;
		u_rows[$1]=u_rows[$1]+1;
	} 
	END{
		for(i in uamount){
			average=uamount[i]/u_rows[i];
			print i,",",uamount[i],",",u_rows[i],",",average;
		}
	}
'

# cat api.yonggongbao.cn.log | grep "/zeus/security/labor/frontpage" | awk 'gsub(/"/,"",$0){print $(NF-1)}' | awk '{count=count+$0;row_num++;print $0} END{print count, row_num, count/row_num}'
