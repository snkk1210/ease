# EASE Ansible MG

## これは何？

AnsibleのplaybookをWEB上で管理/実行するツールです。

## できること

- ユーザ認証
- playbook作成/管理
- Ansible実行

## 動作環境

OS:  CentOS7  
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

### 3.DB環境の調整

```
cp -p .env.example .env
vi .env
=====================
DB_DATABASE=xxxx
DB_USERNAME=xxxx
DB_PASSWORD=xxxx
=====================
```

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

### 7.デフォルトplaybook取得

```
cd storage/app
git clone https://github.com/keisukesanuki/default-CentOS7.git
chown [webユーザ]:[webグループ] default-CentOS7
chown [webユーザ]:[webグループ] default-CentOS7/group_vars
```
