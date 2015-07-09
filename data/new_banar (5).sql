-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 26 日 04:09
-- 服务器版本: 5.6.22
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `new_banar`
--
CREATE DATABASE IF NOT EXISTS `new_banar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `new_banar`;

-- --------------------------------------------------------

--
-- 表的结构 `lb_admin`
--

CREATE TABLE IF NOT EXISTS `lb_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(20) NOT NULL DEFAULT '' COMMENT '密码',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1代表最高用户',
  `name` varchar(20) NOT NULL DEFAULT 'admin',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lb_admin`
--

INSERT INTO `lb_admin` (`id`, `user_name`, `password`, `level`, `name`, `date`, `state`) VALUES
(1, 'lai', '1111111', 1, 'laii', '2015-05-25 13:01:20', 2);

-- --------------------------------------------------------

--
-- 表的结构 `lb_admin_action`
--

CREATE TABLE IF NOT EXISTS `lb_admin_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1代表绑定订单，2代表完成订单，4代表强制完成，3代表取消订单',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `lb_admin_action`
--

INSERT INTO `lb_admin_action` (`id`, `order_id`, `admin_id`, `type`, `time`) VALUES
(3, 7, 1, 1, '2015-05-25 05:10:23'),
(4, 7, 1, 4, '2015-05-25 05:12:35'),
(5, 7, 1, 2, '2015-05-25 05:13:09');

-- --------------------------------------------------------

--
-- 表的结构 `lb_admin_action_driver`
--

CREATE TABLE IF NOT EXISTS `lb_admin_action_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `driver_name` varchar(20) NOT NULL,
  `driver_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `lb_admin_action_driver`
--

INSERT INTO `lb_admin_action_driver` (`id`, `admin_name`, `time`, `type`, `driver_name`, `driver_id`) VALUES
(15, 'laii', '2015-05-25 01:54:09', 1, '黄星', 18),
(16, 'laii', '2015-05-25 02:01:03', 2, '黄星_改', 18);

-- --------------------------------------------------------

--
-- 表的结构 `lb_area`
--

CREATE TABLE IF NOT EXISTS `lb_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lb_car`
--

CREATE TABLE IF NOT EXISTS `lb_car` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '货车的类型',
  `dimension` varchar(60) NOT NULL DEFAULT '0立方米' COMMENT '货车能载体积',
  `carrying` varchar(60) NOT NULL DEFAULT '0吨' COMMENT '货车能载重量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lb_car`
--

INSERT INTO `lb_car` (`id`, `name`, `dimension`, `carrying`) VALUES
(1, '小面包车', '0立方米', '0吨'),
(2, '金杯车', '0立方米', '0吨');

-- --------------------------------------------------------

--
-- 表的结构 `lb_comment`
--

CREATE TABLE IF NOT EXISTS `lb_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单的id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `driver_id` int(11) NOT NULL COMMENT '司机的id',
  `comment` text COMMENT '评论的内容',
  `star` int(4) NOT NULL COMMENT '星星的个数',
  `label` varchar(20) DEFAULT NULL COMMENT '标签',
  `commentTime` date NOT NULL COMMENT '评论的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lb_comment`
--

INSERT INTO `lb_comment` (`id`, `order_id`, `user_id`, `driver_id`, `comment`, `star`, `label`, `commentTime`) VALUES
(3, 7, 1, 18, 'niu bi', 3, '0102', '2015-05-17');

-- --------------------------------------------------------

--
-- 表的结构 `lb_comment_lab`
--

CREATE TABLE IF NOT EXISTS `lb_comment_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `lab1` int(11) NOT NULL DEFAULT '0',
  `lab2` int(11) NOT NULL DEFAULT '0',
  `lab3` int(11) NOT NULL DEFAULT '0',
  `lab4` int(11) NOT NULL DEFAULT '0',
  `lab5` int(11) NOT NULL DEFAULT '0',
  `lab6` int(11) NOT NULL DEFAULT '0',
  `lab7` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lb_comment_lab`
--

INSERT INTO `lb_comment_lab` (`id`, `driver_id`, `lab1`, `lab2`, `lab3`, `lab4`, `lab5`, `lab6`, `lab7`) VALUES
(1, 18, 8, 10, 22, 2, 7, 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lb_comment_lab_2`
--

CREATE TABLE IF NOT EXISTS `lb_comment_lab_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `lab1` int(11) NOT NULL DEFAULT '0',
  `lab2` int(11) NOT NULL DEFAULT '0',
  `lab3` int(11) NOT NULL DEFAULT '0',
  `lab4` int(11) NOT NULL DEFAULT '0',
  `lab5` int(11) NOT NULL DEFAULT '0',
  `lab6` int(11) NOT NULL DEFAULT '0',
  `lab7` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lb_comment_lab_2`
--

INSERT INTO `lb_comment_lab_2` (`id`, `order_id`, `lab1`, `lab2`, `lab3`, `lab4`, `lab5`, `lab6`, `lab7`) VALUES
(1, 7, 0, 1, 1, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lb_coupons`
--

CREATE TABLE IF NOT EXISTS `lb_coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `worth` int(11) unsigned NOT NULL COMMENT '优惠劵价值',
  `startTime` date NOT NULL COMMENT '优惠劵开始时间',
  `endTime` date NOT NULL COMMENT '优惠劵截止时间',
  `isUsed` int(1) NOT NULL DEFAULT '0' COMMENT '是否被使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `lb_coupons`
--

INSERT INTO `lb_coupons` (`id`, `user_id`, `worth`, `startTime`, `endTime`, `isUsed`) VALUES
(1, 1, 100, '2015-04-30', '2015-08-31', 0),
(2, 2, 20, '2015-05-11', '2015-08-11', 0),
(3, 3, 100, '2015-05-11', '2015-08-11', 1),
(4, 1, 20, '2015-01-09', '2015-12-12', 1),
(5, 14, 10, '2015-05-30', '2015-06-30', 0),
(6, 15, 10, '2015-05-17', '2015-06-30', 0),
(7, 16, 10, '2015-05-17', '2015-06-30', 0),
(8, 17, 10, '2015-05-17', '2015-06-30', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lb_coupons_admin`
--

CREATE TABLE IF NOT EXISTS `lb_coupons_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `worth` int(11) NOT NULL COMMENT '面值',
  `total_count` int(11) NOT NULL COMMENT '总共数量',
  `used_count` int(11) NOT NULL DEFAULT '0' COMMENT '被使用的数量',
  `endTime` date DEFAULT NULL COMMENT '结束日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lb_coupons_admin`
--

INSERT INTO `lb_coupons_admin` (`id`, `worth`, `total_count`, `used_count`, `endTime`) VALUES
(1, 100, 105, 0, '2015-08-31'),
(2, 20, 100, 0, '2015-08-31');

-- --------------------------------------------------------

--
-- 表的结构 `lb_driver`
--

CREATE TABLE IF NOT EXISTS `lb_driver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '司机姓名',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '司机电话',
  `car_cate` tinyint(4) NOT NULL COMMENT '车的类型',
  `city` int(11) NOT NULL DEFAULT '1',
  `area` int(11) NOT NULL DEFAULT '1' COMMENT '地区',
  `little_area` int(11) NOT NULL DEFAULT '1',
  `license` varchar(20) NOT NULL DEFAULT '' COMMENT '车牌号码',
  `bank_number` varchar(30) DEFAULT NULL COMMENT '银行卡账号',
  `bank_name` varchar(30) DEFAULT NULL COMMENT '开户人姓名',
  `bank_type` varchar(60) DEFAULT NULL COMMENT '开户行',
  `wechat_id` varchar(31) DEFAULT NULL COMMENT '微信id',
  `zhifubao_id` varchar(20) DEFAULT NULL COMMENT '支付宝id',
  `zhifubao_name` varchar(30) DEFAULT NULL COMMENT '支付宝人名',
  `level` int(1) NOT NULL DEFAULT '0' COMMENT '司机的等级',
  `lab` varchar(15) NOT NULL DEFAULT '000000000000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `lb_driver`
--

INSERT INTO `lb_driver` (`id`, `name`, `phone`, `car_cate`, `city`, `area`, `little_area`, `license`, `bank_number`, `bank_name`, `bank_type`, `wechat_id`, `zhifubao_id`, `zhifubao_name`, `level`, `lab`) VALUES
(18, '黄星_改', '18811399342', 1, 1, 1, 18, 'pe_1234', '220192918291892', '黄星', '中国工商银行', 'weixin_12', '18811399231', '大帅', 2, '000000000000000');

-- --------------------------------------------------------

--
-- 表的结构 `lb_order`
--

CREATE TABLE IF NOT EXISTS `lb_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(30) NOT NULL COMMENT '用户姓名',
  `phone` varchar(12) NOT NULL COMMENT '用户的联系方式',
  `car_id` int(11) NOT NULL COMMENT '车的类型',
  `price` int(11) NOT NULL COMMENT '价格',
  `pre_price` int(11) NOT NULL DEFAULT '0',
  `startLocation` text NOT NULL COMMENT '开始地',
  `endLocation` text NOT NULL COMMENT '结束地点',
  `state` tinyint(1) NOT NULL COMMENT '0代表新的订单,1代表已经绑定司机的订单,2用户已经确认没有给司机付款的订单,3是用户确认并且已经给司机付款的订单',
  `createTime` datetime NOT NULL COMMENT '下单时间',
  `startTime` datetime NOT NULL COMMENT '订单执行的时间',
  `completeTime` timestamp NOT NULL DEFAULT '2014-12-31 16:00:00',
  `message` text COMMENT '客户捎句话',
  `floorCount` int(11) DEFAULT '0' COMMENT 'A需要司机帮运的楼层',
  `toFloorCount` int(11) DEFAULT NULL COMMENT 'B需要司机帮运的楼层',
  `isCancel` int(11) NOT NULL DEFAULT '0',
  `real_price` int(11) NOT NULL DEFAULT '0' COMMENT '支付给司机的钱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `lb_order`
--

INSERT INTO `lb_order` (`id`, `user_id`, `name`, `phone`, `car_id`, `price`, `pre_price`, `startLocation`, `endLocation`, `state`, `createTime`, `startTime`, `completeTime`, `message`, `floorCount`, `toFloorCount`, `isCancel`, `real_price`) VALUES
(7, 1, '刘佳', '19823456789', 1, 120, 10, '北京航空航天大学', '清华大学', 0, '2015-05-25 10:09:00', '2015-05-27 08:30:00', '2014-12-31 16:00:00', '请准时到达谢谢', 2, 4, 0, 115);

-- --------------------------------------------------------

--
-- 表的结构 `lb_order_relation`
--

CREATE TABLE IF NOT EXISTS `lb_order_relation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单的id',
  `driver_id` int(11) NOT NULL COMMENT '司机的id',
  `admin_id` int(11) NOT NULL COMMENT '管理员的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `lb_order_relation`
--

INSERT INTO `lb_order_relation` (`id`, `order_id`, `driver_id`, `admin_id`) VALUES
(29, 7, 18, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lb_price`
--

CREATE TABLE IF NOT EXISTS `lb_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL COMMENT '汽车id',
  `startPrice` int(11) NOT NULL COMMENT '开始计费的价格',
  `startLength` int(11) NOT NULL COMMENT '开始计费的路程',
  `perPrice` int(11) NOT NULL COMMENT '每单位公里的价格',
  `perLength` int(11) NOT NULL COMMENT '每单位公里',
  `elevatorPrice` int(11) NOT NULL COMMENT '每层楼的价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lb_price_standed`
--

CREATE TABLE IF NOT EXISTS `lb_price_standed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '代表选择什么标准1：定价2：百分比3：标杆',
  `s_price` int(11) NOT NULL,
  `s_per` int(11) NOT NULL,
  `r_sta` int(11) NOT NULL,
  `r_price` int(11) NOT NULL,
  `r_per` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lb_price_standed`
--

INSERT INTO `lb_price_standed` (`id`, `state`, `s_price`, `s_per`, `r_sta`, `r_price`, `r_per`) VALUES
(1, 1, 10, 20, 100, 12, 20);

-- --------------------------------------------------------

--
-- 表的结构 `lb_question`
--

CREATE TABLE IF NOT EXISTS `lb_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(20) NOT NULL COMMENT '名字',
  `email` varchar(60) NOT NULL COMMENT '邮箱',
  `message` text NOT NULL COMMENT '问题详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `lb_question`
--

INSERT INTO `lb_question` (`id`, `user_id`, `name`, `email`, `message`) VALUES
(1, 1, '牛威', 'nniuwei@163.com', '接口使用规则：所有的无标记的值都是Post提交，所有发送和接受数据均为Application/json类型'),
(2, 1, '牛威', 'nniuwei@163.com', 'jhdsakhdask'),
(3, 1, '牛威', 'nniuwei@163.com', '牛威长得真刷哦'),
(4, 1, '牛威', 'nniuwei@163.com', '牛威长得真帅哦'),
(5, 1, '"牛威"', 'nniuwei@163.com', '今天天气真的好'),
(6, 1, '牛威', 'nniuwei@163.com', '今天天气真的好'),
(7, 1, '牛威', 'nniuwei@163.com', '今天天气真的好ya'),
(8, 1, 'niuwei', 'nniuwei@163.com', 'askdhsahdkjhaskj'),
(9, 1, 'ewq@163.com', 'ewq@163.com', 'ewq@163.com'),
(10, 1, 'nniuwei@163.com', 'nniuwei@163.com', 'nniuwei@163.com'),
(11, 1, 'nniuwei@163.com', 'nniuwei@163.com', 'nniuwei@163.com'),
(12, 1, 'nniuwei@163.com', 'nniuwei@163.com', 'I am Handsome'),
(13, 1, 'niuwei@163.com', 'niuwei@163.com', 'niuwei@163.com'),
(14, 1, 'niuwei@163.com', 'niuwei@163.com', 'niuwei@163.com');

-- --------------------------------------------------------

--
-- 表的结构 `lb_user`
--

CREATE TABLE IF NOT EXISTS `lb_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weichat_id` varchar(21) NOT NULL DEFAULT '' COMMENT '微信号的唯一凭证',
  `phone` varchar(11) DEFAULT '' COMMENT '电话',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='CREATE TABLE `lb_user` (\n  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,\n  `weichat_id` varchar(21) NOT NULL DEFAULT '''' COMMENT ''微信号的唯一凭证'',\n  `phone` varchar(11) NOT NULL DEFAULT '''' COMMENT ''电话'',\n  PRIMARY KEY (`id`),\n unique key (`weichat_id`)\n) ENGINE=InnoDB DEFAULT CHARSET=utf8;' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lb_user`
--

INSERT INTO `lb_user` (`id`, `weichat_id`, `phone`) VALUES
(1, 'weserds', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
