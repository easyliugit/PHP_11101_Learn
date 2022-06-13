# 泰山PHP網頁設計職訓課程
* [指導老師GitHub:https://github.com/mackliu](https://github.com/mackliu)
* [BSG:https://github.com/wdaweb/be-start-github-easyliugit](https://github.com/wdaweb/be-start-github-easyliugit)
* [BSC:https://github.com/wdaweb/be-start-classroom-easyliugit](https://github.com/wdaweb/be-start-classroom-easyliugit)

# PHP基礎課程Basic

### 課程單元

* [變數](index.php)
* [運算子](operator.php)
* [判斷式](flow.php)
* [迴圈](loop.php)
* [陣列](array.php)

### 作業練習

1. [迴圈練習](pra01.php)
2. [九九乘法表](pra02.php)
3. [迴圈畫星星](pra03.php)
4. [陣列練習](pra04.php)

# PHP中等課程Intermediate

### 課程單元

* [網頁傳值](GET、POST)
* [網頁狀態管理](COOKIE、SESSION)
* [MySQL/MariaDB 語法操作](INSERT、UPDATE、DELETE、SELECT)
* [SQL 條件句操作](WHERE、IN、BETWEEN、ORDER BY、GROUP BY、LIMIT)
* [SQL 聚合函式](AVG、COUNT、MAX、MIN、SUM)
* [SQL 字串函式](SUBSTRING、LENGTH、CONCAT、GROUP_CONCAT)
* [SQL 日期/時間函式](NOW、DATEDIFF、CURRENT_DATE)
* [正規化](第一正規化、第二正規化、第三正規化)
* [關聯式資料表](一對一、一對多、多對多)
* [結合查詢 JOIN](INNER JOIN、FROM WHERE、Left Join、Right Join)
* [SQL 語句順序](GROUP BY 遇到Null、LEFT JOIN 多張表)
* [子查詢](在Select區段、在from區段、在where(join) 區段)
* [SQL 語句順序](書寫SQL、執行SQL)
* [PHP連線資料庫的方式](mysql、mysqli、PDO)
* [自訂函式](function)
### 作業練習

1. [BMI 計算](from/bmi.php、bmi_post.html、bmi_single-bmi.php)
2. [登入檢查](login/login.php)
3. [萬年曆](calendar/index.php)
4. [登入後導向(首頁或後台或使用者資料)](cookie\index.php、session\index.php)
5. [只要瀏灠器不關閉，不會再次要求登入)](cookie\index.php、session\index.php)
6. [模擬購物車效果)](cookie_session\cart.php)
7. [每日記帳表拆成關聯式資料表](db\index.php)
8. [簡易註冊登入系統](db\login\index.php)
9. [簡易投票系統]()

# PHP進階課程Advanced
### 課程單元

*
### 作業練習

1.
# PHP學員學習成果
[[01]](http://220.128.133.15/s1110201) [[02]](http://220.128.133.15/s1110202) [[03]](http://220.128.133.15/s1110203) [[04]](http://220.128.133.15/s1110204) [[05]](http://220.128.133.15/s1110205) [[06]](http://220.128.133.15/s1110206) [[07]](http://220.128.133.15/s1110207) [[08]](http://220.128.133.15/s1110208) [[09]](http://220.128.133.15/s1110209) [[10]](http://220.128.133.15/s1110210)
[[11]](http://220.128.133.15/s1110211) [[12]](http://220.128.133.15/s1110212) [[13]](http://220.128.133.15/s1110213) [[14]](http://220.128.133.15/s1110214) [[15]](http://220.128.133.15/s1110215) [[16]](http://220.128.133.15/s1110216) [[17]](http://220.128.133.15/s1110217) [[18]](http://220.128.133.15/s1110218) [[19]](http://220.128.133.15/s1110219) [[20]](http://220.128.133.15/s1110220)
[[21]](http://220.128.133.15/s1110221) [[22]](http://220.128.133.15/s1110222) [[23]](http://220.128.133.15/s1110223) [[24]](http://220.128.133.15/s1110224)
[萬年曆作業111年](http://220.128.133.15/mackliu/calendar/11101/index.html)

# [投票系統作業]()

## 使用者故事(user story)

### 共用
* 主畫面切割為上中下三塊
    * 上方為標題輪播或選單列
    * 中間為主要內容區
    * 下方為公司名稱及頁尾版權宣告或聯絡方式
* 選單列有以下列內容
    * 首頁按鈕
    * 登入按鈕
    * 投票列表按鈕
* 會員註冊時需提供以下資料，以供投票分析之用
    * 生日
    * 性別
    * 學歷
    * 住址

### 使用者端
* 進入首頁時，可以看到投票項目列表
* 可以選擇想要了解的項目進行點選
* 未登入的使用者只可以看到投票的結果
* 已登入的使用者可以看到投票結果及"我要投票"按鈕
* 按下我要投票時會顯示投票項目
* 選擇項目後，按送出，完成投票
* 完成投票後，跳至投票結果頁
* 投票結果有一顆按鈕可以返回首頁
* 可以選擇投票分類
* 可以排序投票
* 投票列表可以分頁
* 會員中心可以查看參與過的投票

### 管理者端
* 要透過登入才能進入管理者端
* 登入後可以看到所有的投票列表
* 有"新增投票"按鈕
* 點選新增投票後進入新增投票表單頁面
* 在新增頁面可以設定投票主題
* 選項可以動態增加
    * 在主題旁有一個"增加選項"的按鈕
    * 每按一次"增加選項"就會在下方增加一個項目
    * 可以刪除選項
* 完成設定後按下"完成新增"，即增加一個投票主題
* 可查看投票結果(含統計分析)
* 可以修改投票主題或選項
* 可以刪除投票

## 功能需求
* 註冊/登入系統
* 前/後台頁面切版
* 前端讀出功能(列表/註冊表單/會員中心)
* 新增投票
* 修改投票
* 刪除投票
* 投票結果的統計分析
* 投票的參與者資料分析

## 資料表設計
### 資料庫名稱:vote
* users
    |名稱|型態|預設值|A_I|備註|
    |--|--|--|--|--|
    |id|int(11)|--|true|序號|
    |acc|varchar(12)|--|--|帳號|
    |pw|varchar(16)|--|--|--|
    |name|date|--|--|--|
    |birthday|date|--|--|--|
    |gender|tinyint(1)|--|--|--|
    |addr|varchar(64)|--|--|--|
    |education|varchar(32)|--|--|--|
    |reg_date|date|--|--|--|
* admins
* subjects
* options
* log
* type