-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-06-07 13:25:11
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `starsnacks`
--

-- --------------------------------------------------------

--
-- 表的结构 `sunmoonanalysis`
--

CREATE TABLE IF NOT EXISTS `sunmoonanalysis` (
  `sun` varchar(2) NOT NULL,
  `moon` varchar(2) NOT NULL,
  `explanation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sunmoonanalysis`
--

INSERT INTO `sunmoonanalysis` (`sun`, `moon`, `explanation`) VALUES
('ar', 'ge', '太阳白羊+月亮双子=最聪明的羊 <br><br>\n\n优点：思维敏捷<br><br>\n\n缺点：思想肤浅<br><br>\n\n性格解析：<br><br>\n\n在黄道带上，这种太阳星座和月亮星座的组合使你成为最善言谈的人。<br><br>\n\n你极可能主导任何谈话，因为你思维敏捷，消息灵通。你必须学会至少在决定说出去之前能够守口如瓶，这对你来说很难做到。相比闭门独思，你更欢通过座谈的方式作决定。不假思索的讲话和仓促的下结论会给你带来很大的麻烦。如果你能学会保密的艺术以及凡事三思而后行的习惯，成功会来得更容易些。尽管你有这种缺点，但是由于你机智过人动机淳朴，你仍可取得较大成就。你的辩论技能会使你轻松击退对手。令人惊讶的是，正如你行动之快，你对掌握细节有自己独特的技巧。生意场上，你对细节和数据的精通让你看上去像一位出色的经理。然而，因为你掌握的细节太过肤浅，学习深度不够，你经常为自己的犹豫不决而内疚。总之，思维敏捷是你最显著的特点。整合零碎信息的风格以及流畅有效的表达能力会让你有不错的前景。你可能期望成为一位经理级人物。然而，当经理必须要作各种重要的决策，你不如在广告领域、文学界或者任何能利用你的能言善道或表达能力的行业谋个职位。遇到智力问题和情感问题时，你应该努力多动脑筋，克服肤浅的想法。<br><br>\n\n白羊座的火相和双子座的风相结合，助长了白羊座的不耐烦、不安定、遇事反应飞快，会寻求高明的点子，立即采取****。<br><br>\n\n你的生活若是没有成就感，将会比其他白羊座的人痛苦。请避免错误的第一步和虎头蛇尾。如果克服得了这些缺点，你将会超越最严重的障碍：完全无法忍受无聊。<br><br>\n\n白羊座的你生性直率，同时受到月亮的影响而喜欢变化。让后者在你的事业上为你拓展广阔的空间。请不要压抑你的感受，或是干脆找个理由把直觉压制掉。<br><br>\n\n你具备白羊座的热情，善于沟通，对伴侣的欲望和建议，你的反应会很好。最幸运的是白羊座的自私习性在你身上比较缓和。<br><br>\n\n你在人生中的某些阶段，可能会暴露狡猾及白羊座的自私、惟我独尊的毛病。你会事事精打细算，以便战胜对手。你更善于表达自我，以****性的活力高明地领导他人。<br><br>\n\n月亮在变动的风象星座，给白羊太阳的活力注入双子的多变和伶牙俐齿。60度；他们流畅地表达着白羊的活力，能够轻松地推销自己。他们的沟通流畅而又过量。这个配置需要通过强硬的刑冲相位来找到根基，（否则）热络的言谈会流动得太过轻松（给人以夸夸其谈的浮夸感）。<br><br>\n\n建议：必须学会守口如瓶<br><br>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sunmoonanalysis`
--
ALTER TABLE `sunmoonanalysis`
  ADD UNIQUE KEY `sun` (`sun`,`moon`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
