# 前言
* 我將5/27~5/30 期間老師上課存取資料庫的範本，
* 調整成PDO 預備語法prepare() 的寫法分享大家參考，
* 主要是看到PHP 官方文件常用預備語法寫範例，
* 希望對大家有幫助。
* `註：conndb.php 是連線資料庫的設定檔，記得要修改。`

# 為什麼使用預備語法?
* 使用預備語法的優點是先告訴PHP 在SQL 語法中，
* 我們要解析的SQL 語意有哪些，
* 最後才將變數值帶入SQL 語法中執行，
* 防止變數值有SQL 語意而被解析。

# 預備語法使用流程
1. 將SQL 語法帶入預備語法prepare() 方法中，
2. SQL 語法中的問號(?) 是標記接下來帶入變數值的位置，
3. 變數值以陣列的形式array() 帶入execute() 方法中，
4. 依序填入對應的問號(?) 位置執行預備語法，
5. 透過execute(array()) 帶入的變數只會被當作數值使用，
6. 不會因為帶入的變數值有SQL 語意而追加解析，
7. 拆成**SQL 語意**與**變數值**兩個階段是增加存取資料庫安全性的寫法。