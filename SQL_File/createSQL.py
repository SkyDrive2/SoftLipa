import pyodbc

SERVER = "skydrive-sql,1433"
DBNAME = "master"
USERNAME = "sa"
PASSWORD = "Test123456..."
DRIVER = "ODBC Driver 18 for SQL Server"

SCRIPT_PATH = "SQL_file/insert.sql"
CREATE_TABLE_PATH = "SQL_file/script.sql"

conn_str = (
    f"DRIVER={{{DRIVER}}};"
    f"SERVER={SERVER};"
    f"DATABASE={DBNAME};"
    f"UID={USERNAME};"
    f"PWD={PASSWORD};"
    f"TrustServerCertificate=yes;"
)

conn = pyodbc.connect(conn_str)

cursor = conn.cursor()
conn.autocommit = True

database_name = 'softlipa'
query = f"SELECT COUNT(*) FROM sys.databases WHERE name = '{database_name}'"
cursor.execute(query)
row = cursor.fetchone()

if row[0] > 0:
    print(f"The database '{database_name}' exists.")
else:
    CREATE_DATABASE_QUERY = "CREATE DATABASE softlipa"
    cursor.execute(CREATE_DATABASE_QUERY)

    with open(CREATE_TABLE_PATH, 'r') as file:
        content = file.read()
        cursor.execute(content)

    with open(SCRIPT_PATH, 'r') as file:
        insert = file.read()
        cursor.execute(content)

cursor.close()
conn.close()
