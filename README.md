# Lumen RESTful API Micro Service

> * [Lumen 官网](https://lumen.laravel.com/)
> * [GitHub](https://github.com/laravel/lumen)
> * [Lumen 文档](http://lumen.laravel.com/docs)

***

[![Build Status](https://travis-ci.org/imajinyun/lumen-api.svg?branch=master)](https://travis-ci.org/imajinyun/lumen-api)
[![codecov](https://codecov.io/gh/imajinyun/lumen-api/branch/master/graph/badge.svg)](https://codecov.io/gh/imajinyun/lumen-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/imajinyun/lumen-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/imajinyun/lumen-api/?branch=master)

🔥 This is a RESTful API micro service based on Lumen framework.

## 简介

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## 安装

### 开发环境

> * [英文官网](https://laravel.com/docs/master/homestead)
> * [中文网站](https://docs.golaravel.com/docs/5.0/homestead/)
> * [GitHub](https://github.com/laravel/homestead)
> * [如何搞定 Homestead](https://github.com/imajinyun/notes/blob/master/01-mac/1.2-开发工具/1.2.13-homestead.md)

一般情况下, 请使用 `Laravel` 官方提供的 `Homestead` 集成开发环境

### 项目安装

```bash
$ git clone https://github.com/imajinyun/lumen-api.git
$ cd ./lumen-api
$ composer install
```

### 工具助手

> [GitHub](https://github.com/barryvdh/laravel-ide-helper)

```bash
$ php artisan ide-helper:generate
$ php artisan ide-helper:meta
```

### 项目配置


- 重命名 `.evn.example`

```bash
$ cp .env.example .env

// 这是我的配置, 请根据自己需要去配置
$ cat .env
APP_ENV=local
APP_DEBUG=true
APP_KEY=
APP_TIMEZONE=PRC
APP_MAX_LOG_FILE=7

HOMESTEAD_CONNECTION=mysql
HOMESTEAD_HOST=192.168.10.10
HOMESTEAD_PORT=3306
HOMESTEAD_DATABASE=homestead
HOMESTEAD_USERNAME=homestead
HOMESTEAD_PASSWORD=secret
HOMESTEAD_CHARSET=utf8mb4
HOMESTEAD_COLLATION=utf8mb4_general_ci

FRAMEWORK_CONNECTION=mysql
FRAMEWORK_HOST=192.168.10.10
FRAMEWORK_PORT=3306
FRAMEWORK_DATABASE=homestead
FRAMEWORK_USERNAME=homestead
FRAMEWORK_PASSWORD=secret
FRAMEWORK_CHARSET=utf8mb4
FRAMEWORK_COLLATION=utf8mb4_general_ci

CACHE_DRIVER=file
QUEUE_DRIVER=sync

JWT_SECRET=...
```

- 生成 `JWT_SECRET`

```bash
$ php artisan jwt:generate
```

- 创建数据库

```bash
$ touch database/database.sqlite 
$ php artisan migrate
$ php artisan db:seed
```