-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 12:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `albumtable`
--

CREATE TABLE `albumtable` (
  `albumID` int(11) NOT NULL,
  `albumName` varchar(45) NOT NULL,
  `albumCreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albumtable`
--

INSERT INTO `albumtable` (`albumID`, `albumName`, `albumCreationDate`, `userID`) VALUES
(2, 'Timeline', '2017-10-31 20:26:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commentstable`
--

CREATE TABLE `commentstable` (
  `commentID` int(11) NOT NULL,
  `commentText` varchar(500) NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `isHidden` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friendstable`
--

CREATE TABLE `friendstable` (
  `friendID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `isHidden` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `imageDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `imageName`, `userid`, `albumid`, `postid`, `imageDate`) VALUES
(1, '', 1, 2, 1, '2017-10-31 11:54:34'),
(2, '', 1, 2, 2, '2017-10-31 12:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `liketable`
--

CREATE TABLE `liketable` (
  `likeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liketable`
--

INSERT INTO `liketable` (`likeID`, `userID`, `postID`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendingfriendstable`
--

CREATE TABLE `pendingfriendstable` (
  `pendingFriendID` int(11) NOT NULL,
  `userOne` int(11) NOT NULL,
  `userTwo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poststable`
--

CREATE TABLE `poststable` (
  `postID` int(11) NOT NULL,
  `postText` varchar(500) NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `isHidden` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poststable`
--

INSERT INTO `poststable` (`postID`, `postText`, `postDate`, `userID`, `isHidden`) VALUES
(1, 'This is my first post.', '2017-10-31 11:54:34', 1, 1),
(2, 'Hello. My name is Aaron.', '2017-10-31 12:31:23', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usercredentialstable`
--

CREATE TABLE `usercredentialstable` (
  `userCredID` int(11) NOT NULL,
  `userPassword` varchar(45) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usercredentialstable`
--

INSERT INTO `usercredentialstable` (`userCredID`, `userPassword`, `userID`) VALUES
(1, '3fc0a7acf087f549ac2b266baf94b8b1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userprivacytable`
--

CREATE TABLE `userprivacytable` (
  `privacyID` int(11) NOT NULL,
  `privacyLevel` int(11) NOT NULL,
  `privacyType` varchar(45) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `userEmail` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `userPhoto` varchar(128) DEFAULT 'default.jpg',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`userID`, `firstName`, `lastName`, `userEmail`, `dob`, `userPhoto`, `creationDate`) VALUES
(1, 'Aaron', 'Ward', 'u3174571@uni.canberra.edu.au', '1996-10-19', '1_6698_tto.jpg', '2017-10-31 20:26:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albumtable`
--
ALTER TABLE `albumtable`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `fk_albumTable_userTable1_idx` (`userID`);

--
-- Indexes for table `commentstable`
--
ALTER TABLE `commentstable`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `fk_commentsTable_postsTable1_idx` (`postID`),
  ADD KEY `fk_commentsTable_userTable1_idx` (`userID`);

--
-- Indexes for table `friendstable`
--
ALTER TABLE `friendstable`
  ADD PRIMARY KEY (`friendID`),
  ADD KEY `fk_friendsTable_userTable1_idx` (`userid`),
  ADD KEY `fk_friendsTable_userTable2_idx` (`friend`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `images_ibfk_1` (`albumid`),
  ADD KEY `images_ibfk_2` (`postid`),
  ADD KEY `images_ibfk_3` (`userid`);

--
-- Indexes for table `liketable`
--
ALTER TABLE `liketable`
  ADD PRIMARY KEY (`likeID`),
  ADD KEY `PostID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `pendingfriendstable`
--
ALTER TABLE `pendingfriendstable`
  ADD PRIMARY KEY (`pendingFriendID`),
  ADD KEY `fk_pendingFriendsTable_userTable1_idx` (`userOne`),
  ADD KEY `fk_pendingFriendsTable_userTable2_idx` (`userTwo`);

--
-- Indexes for table `poststable`
--
ALTER TABLE `poststable`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `fk_postsTable_userTable1_idx` (`userID`);

--
-- Indexes for table `usercredentialstable`
--
ALTER TABLE `usercredentialstable`
  ADD PRIMARY KEY (`userCredID`),
  ADD KEY `fk_userCredentialsTable_userTable1_idx` (`userID`);

--
-- Indexes for table `userprivacytable`
--
ALTER TABLE `userprivacytable`
  ADD PRIMARY KEY (`privacyID`),
  ADD UNIQUE KEY `privacyID_UNIQUE` (`privacyID`),
  ADD KEY `fk_userPrivacyTable_userTable_idx` (`userID`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID_UNIQUE` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albumtable`
--
ALTER TABLE `albumtable`
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commentstable`
--
ALTER TABLE `commentstable`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friendstable`
--
ALTER TABLE `friendstable`
  MODIFY `friendID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `liketable`
--
ALTER TABLE `liketable`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pendingfriendstable`
--
ALTER TABLE `pendingfriendstable`
  MODIFY `pendingFriendID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poststable`
--
ALTER TABLE `poststable`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usercredentialstable`
--
ALTER TABLE `usercredentialstable`
  MODIFY `userCredID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userprivacytable`
--
ALTER TABLE `userprivacytable`
  MODIFY `privacyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `albumtable`
--
ALTER TABLE `albumtable`
  ADD CONSTRAINT `fk_albumTable_userTable1` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commentstable`
--
ALTER TABLE `commentstable`
  ADD CONSTRAINT `fk_commentsTable_postsTable1` FOREIGN KEY (`postID`) REFERENCES `poststable` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commentsTable_userTable1` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friendstable`
--
ALTER TABLE `friendstable`
  ADD CONSTRAINT `fk_friendsTable_userTable1` FOREIGN KEY (`userid`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friendsTable_userTable2` FOREIGN KEY (`friend`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `albumtable` (`albumID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `poststable` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `images_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `liketable`
--
ALTER TABLE `liketable`
  ADD CONSTRAINT `liketable_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `poststable` (`postID`),
  ADD CONSTRAINT `liketable_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`);

--
-- Constraints for table `pendingfriendstable`
--
ALTER TABLE `pendingfriendstable`
  ADD CONSTRAINT `fk_pendingFriendsTable_userTable1` FOREIGN KEY (`userOne`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pendingFriendsTable_userTable2` FOREIGN KEY (`userTwo`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `poststable`
--
ALTER TABLE `poststable`
  ADD CONSTRAINT `fk_postsTable_userTable1` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usercredentialstable`
--
ALTER TABLE `usercredentialstable`
  ADD CONSTRAINT `fk_userCredentialsTable_userTable1` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userprivacytable`
--
ALTER TABLE `userprivacytable`
  ADD CONSTRAINT `fk_userPrivacyTable_userTable` FOREIGN KEY (`userID`) REFERENCES `usertable` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
