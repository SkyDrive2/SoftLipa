# SoftLipa 資料庫專案

### 410530003簡更新專案

---
## 如何開啟專案
1. 啟動容器，詳細設定可以在 ```docker-compose.yml``` 中找到
   
    ```bash
    cd 當前專案路徑
    docker-compose up
    ```
2. 連資料庫時如果找不到 sofitlipa 會自動建立 softlipa 與 Insert 資料  
創建資料庫的 ```script.sql``` 與 ```insert.sql``` 位於 ```SQL_File\``` 路徑中

3. 開啟專案頁面

   <http://localhost:8081/>


### DB設定 

   ### DB 的連接字串設定於位於 ```db_connect.php``` 中
---

## 說明

因為我也是使用linux來撰寫 所以有向張辰瑋同學求救 所以在docker的部份會有雷同
