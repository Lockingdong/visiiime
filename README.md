### 1. 到此專案根目錄開新分支
```
// 1. 切到 develop
git checkout develop

// 2. 開新分支
git checkout -B develop-暱稱
// ex. git checkout -B develop-dong

```

### 2. 到 design dashboard 目錄開發
```
// 1. 到 design dashboard 開發
cd resources/visiiime-design-dashboard

// 2. 建立環境變數檔
touch .env

```

### 3. 在剛剛建的.env 裡貼上以下內容
```
VUE_APP_URL=https://dev-web.visiiime.com

VUE_APP_API_TOKEN=XXX

VUE_APP_PAGE_ID=XXX

# 不要和專案根目錄的.env搞混
# XXX 會在以下步驟換掉
```

### 4. 更改.env 的 VUE_APP_API_TOKEN
```
在賴的記事本裡
ex:
VUE_APP_API_TOKEN=abcdefg12345678

```

### 5. 更改.env 的 VUE_APP_PAGE_ID
- 前往dev個人頁連結(可換成自己的) [https://dev-web.visiiime.com/d0ngy1n](https://dev-web.visiiime.com/d0ngy1n){:target="_blank"}
- 畫面右鍵 > 檢查
- 在 console 輸入 
```
window.vistorData.model_id

// 回傳 page_id
```
- 將 VUE_APP_PAGE_ID 的值換成 page_id

### 6. 開始開發
```
// 確認路徑是在 resources/visiiime-design-dashboard
// 1.
npm i

// 2.
npm run serve
```

### 7. 上傳
```
git add .

// ex. git commit -m "dong-update"
git commit -m "暱稱-開發內容(可英文)"

// 第一次 push會無法成功 把終端機回應的指令複製貼上後再push一次
git push

```

### 8. 備註
- 步驟 5 懶得用自己的可用我的 在賴裡
