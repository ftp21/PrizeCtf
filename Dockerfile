FROM php:8.0-apache
WORKDIR /

COPY root/ /

RUN gcc -o /bin/setuid /opt/setuid.c && chmod 4755 /bin/setuid /opt/backup.sh && chmod 700 /root/flag.txt

EXPOSE 80
