# 此文档为该项目的项目的数据库表情况


## 概述
现在共有14张数据表

表名|简要描述|所受外键约束（表）|
-|-|-|
[users](#users)        |用户表              |
[problems](#problems)              |问题表              |
[statuses](#statuses)              |提交表              |users
[topics](#topics)                |讨论表              |users
[replies](#replies)               |回复表              |users
[teams](#teams)                 |队伍表              |contest
[announcements](#announcements)         |公告表              |
[contests](#contests)              |比赛表              |
[notifications](#notifications)         |消息通知表          |users
[contest_problem](#contest_problem)       |比赛问题表          |contest，problem
[contest_user](#contest_user)          |比赛用户表          |contest,user
[team_apply](#team_apply)            |队伍申请表          |users，teams
[team_user](#team_user)             |队伍用户表          |users，teams
[contest_reject_user](#contest_reject_user)   |比赛黑名单用户表     |contest，users

## 数据库约定

1. 数据库表名与数据库字段使用下划线法
开发约定中的别名同样生效

2. 除特殊表外，所有表均需要id字段，类型为`int(10) unsigned`
特殊表：notifications


## 详细说明

### users

### problems

### statuses

### topics

### replies

### teams

### announcements

### contests

### notifications

### contest_problem

### contest_user

### team_apply

### team_user

### contest_reject_user