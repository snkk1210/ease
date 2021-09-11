# EASE Ansible MG

## これは何？

Ansible の playbook を WEB上で管理/実行するツールです。  
※詳細は下記参照  
https://ease-wiki.fingerease.work

## できること

- ユーザ認証
- playbook 作成/管理
- Ansible 実行

## 動作環境

PHP:  7系

```
PHP 7.3.15 (cli) (built: Feb 18 2020 09:25:23) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.3.15, Copyright (c) 1998-2018 Zend Technologies
```

Laravel:  8系

```
[root@develop-server ease]# php artisan -V
Laravel Framework 8.19.0
```



## 導入方法

### 1.ソースのダウンロード

```
cd [ドキュメントルート]
git clone https://github.com/keisukesanuki/ease.git
```

### 2.依存パッケージのダウンロード

```
cd ease
composer install
```

### 3.環境変数の調整

```
cp -p .env.example .env
vi .env
=====================
DB_DATABASE=xxxx
DB_USERNAME=xxxx
DB_PASSWORD=xxxx
CW_TOKEN=""
CW_ENDPOINT=""
=====================
```

※ Ansible 実行時に ChatWork への通知が必要であれば、下記2つを定義して下さい。

CW_TOKEN → ChatWork トークン  
CW_ENDPOINT → 通知先エンドポイント 

### 4.マイグレーション

```
php artisan migrate
```

### 5.APP_KEY の生成

```
php artisan key:generate
```

### 6.権限変更

```
chmod -R 777 storage
```

### 7.デフォルト playbook 取得

```
cd storage/app
git clone https://github.com/keisukesanuki/default-CentOS7.git
chown [webユーザ]:[webグループ] default-CentOS7
chown [webユーザ]:[webグループ] default-CentOS7/group_vars
```

### 8.初期ユーザ作成

```
php artisan db:seed
```

### 9.初期ユーザでログイン
- 管理者ユーザ
```
ID: admin@localhost
PASSWORD: easeease 
```
- read-onlyユーザ
```
ID: read@localhost
PASSWORD: easeease 
```

## 補足

Ansible 実行時に WEB サーバがタイムアウトしないよう 適宜 WEBサーバの設定を調整して下さい。  
※ Nginx であれば、下記のファイルを参考下さい。

```
docker/nginx/ease.conf
```