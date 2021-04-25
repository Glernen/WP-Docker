#!/bin/bash
set -e

function download_yml() {
	cd /opt/wordpress/zjzx
	#github文件通过加速https://www.jsdelivr.com/进行cdn加速：
	wget https://cdn.jsdelivr.net/gh/h455257166/WP-Docker@main/docker/wp-compose.yml
	# git clone -b main https://github.com/h455257166/WP-Docker.git /opt/wordpress/zjzx
}

echo -e "\n========================1. 创建目录========================\n"
#判断liunx系统下/opt/wordpress/zjzx是否存在，如果不存在，则创建该目录层级
[ ! -d /opt/wordpress/zjzx ] && mkdir -p /opt/wordpress/zjzx
echo -e "\n创建完成\n"

echo -e "\n========================2. 下载文件========================\n"
download_yml
echo -e "\n创建完成\n"

echo -e "\n========================3. 创建镜像========================\n"
#不使用-f参数指定文件，docker-compose会默认寻找名为docker-compose.yml 、docker-compose.yaml的配置文件
docker-compose -f wp-compose.yml up -d