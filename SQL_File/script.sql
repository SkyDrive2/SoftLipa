-- 商品資料表 (Products)
  CREATE TABLE Products (
    ProductID INT IDENTITY(1,1) PRIMARY KEY,
    ProductName NVARCHAR(255),
    ProductDescription NVARCHAR(255),
    Price DECIMAL(10, 2),
    StockQuantity INT,
    ProductPhoto NVARCHAR(255)
  );

-- 使用者資料表 (Users)
CREATE TABLE Users (
  UserID INT IDENTITY(1,1) PRIMARY KEY,
  UserName NVARCHAR(255),
  Address NVARCHAR(255),
  ContactInfo NVARCHAR(255),
  Email NVARCHAR(255),
  Password NVARCHAR(255)
);

CREATE TABLE ShoppingCart (  CartID INT PRIMARY KEY,  UserID INT,  FOREIGN KEY (UserID) REFERENCES Users(UserID),);

CREATE TABLE Cart_Product (  ProductID INT,  CartID INT ,  Quantity INT,  PRIMARY KEY (ProductID, CartID),  FOREIGN KEY (CartID) REFERENCES ShoppingCart(CartID),  FOREIGN KEY (ProductID) REFERENCES Products(ProductID),);

-- 訂單資料表 (Orders)
CREATE TABLE Orders (
  OrderID INT IDENTITY(1,1) PRIMARY KEY,
  UserID INT,
  OrderDate DATE,
  TotalAmount DECIMAL(10, 2),
  FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- 訂單明細資料表 (OrderDetails)
CREATE TABLE OrderDetails (
  DetailID INT IDENTITY(1,1) PRIMARY KEY,
  OrderID INT ,
  ProductID INT,
  Price DECIMAL(10, 2),
  Quantity INT,
  FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
  FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);
