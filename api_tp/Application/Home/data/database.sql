##购物车表
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custId` int(11) NOT NULL,
  `goodId` varchar(50) NOT NULL,
  `colorId` int(11) NOT NULL,
  `styleId` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0：正常；1：已结算；2：已删除',
  `price` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

##订单
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `orderid` bigint(20) NOT NULL,
  `orderid_oms` bigint(20) DEFAULT NULL,
  `custid` int(10) NOT NULL,
  `ordertime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` bigint(20) NOT NULL,
  `goodid` int(10) NOT NULL,
  `colorid` int(11) NOT NULL,
  `styleid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

##短信验证码信息
DROP TABLE IF EXISTS `smscode`;
CREATE TABLE `smscode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `createdt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '0:待验证；1已使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

##商品信息
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goodId` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
