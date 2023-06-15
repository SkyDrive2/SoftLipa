FROM dachxy/apache2-php-mssql

EXPOSE 80

# 刪除容器中的所有 php session 暫存資料
RUN rm -rf /var/lib/php/sessions/*

# 設定不互動的 Debian 介面
ENV DEBIAN_FRONTEND=noninteractive

# 安裝 python
RUN apt install python3 python3-pip -y

# 安裝 python 套件 pyodbc
RUN pip install pyodbc

WORKDIR /var/www/html

COPY . /var/www/html