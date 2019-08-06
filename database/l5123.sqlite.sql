BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS `users` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	varchar NOT NULL,
	`email`	varchar NOT NULL,
	`password`	varchar NOT NULL,
	`remember_token`	varchar,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `subjects` (
	`id`	INTEGER NOT NULL,
	`subj`	VARCHAR ( 255 ) NOT NULL COLLATE BINARY,
	`shsubj`	TEXT,
	`forclass`	VARCHAR ( 255 ) NOT NULL COLLATE BINARY,
	`fmTh`	INTEGER NOT NULL,
	`fmPr`	INTEGER NOT NULL,
	`pmTh`	INTEGER NOT NULL,
	`pmPr`	INTEGER NOT NULL,
	`created_at`	DATETIME DEFAULT NULL,
	`updated_at`	DATETIME DEFAULT NULL,
	`shreny_id`	integer,
	PRIMARY KEY(`id`)
);
CREATE TABLE IF NOT EXISTS `studies` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`student_id`	integer NOT NULL,
	`subject_id`	integer NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `students` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	varchar NOT NULL,
	`shreny_id`	integer NOT NULL,
	`roll`	integer NOT NULL,
	`reg`	varchar,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `shrenies` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`cls`	integer NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `password_resets` (
	`email`	varchar NOT NULL,
	`token`	varchar NOT NULL,
	`created_at`	datetime
);
CREATE TABLE IF NOT EXISTS `migrations` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`migration`	varchar NOT NULL,
	`batch`	integer NOT NULL
);
CREATE TABLE IF NOT EXISTS `marks` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`thmark`	float NOT NULL,
	`prmark`	float NOT NULL,
	`study_id`	integer NOT NULL,
	`exam_id`	integer NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `exams` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`exname`	varchar NOT NULL,
	`forclass`	varchar NOT NULL,
	`stdate`	date NOT NULL,
	`endate`	date NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `clsses` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`cls`	integer NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `classes` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`cls`	integer NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE UNIQUE INDEX IF NOT EXISTS `users_email_unique` ON `users` (
	`email`
);
CREATE INDEX IF NOT EXISTS `password_resets_token_index` ON `password_resets` (
	`token`
);
CREATE INDEX IF NOT EXISTS `password_resets_email_index` ON `password_resets` (
	`email`
);
CREATE VIEW studentminopmarksdetails as 

select id, reg, name, roll, subject_id, min(thmark+prmark) as minOpmark from studentmarksdetails 

where subject_id != 1 and subject_id != 2 

group by reg 
order by minOpmark desc;
CREATE VIEW studentmarksdetails as

Select students.id, students.name, roll, reg, studies.subject_id as subject_id, (select subj from subjects where subjects.id=subject_id)subject_name, 
(select shsubj from subjects where subjects.id=subject_id) as subject_shname,
(select thmark from marks mr where mr.id = marks.id) as thmark, 
(select prmark from marks mr where mr.id = marks.id) as prmark, (thmark+prmark) as totalsubj 


from students, studies, marks where studies.student_id = students.id and studies.id = marks.study_id order by reg;
CREATE VIEW studentbest5subjectmarksdetails as 
select smrk.id, smrk.name, smrk.roll, smrk.reg, sum(totalsubj) as total6subject, sminmrk.subject_id,

(select subj from subjects where subjects.id = sminmrk.subject_id ) as subject_name,
(select shsubj from subjects where subjects.id = sminmrk.subject_id ) as subject_shname,
sminmrk.minOpmark, 



(sum(totalsubj) - sminmrk.minOpmark) as total5subject

from studentmarksdetails smrk, studentminopmarksdetails sminmrk 

where smrk.reg = sminmrk.reg 
group by smrk.reg;
CREATE VIEW minelecmarks as select students.reg, min(thmark+prmark) as minElecMark,study_id, subject_id, student_id, marks.id as mark_id 

from marks,studies,students 
where students.id = studies.student_id and marks.study_id = studies.id and (studies.subject_id != 1 AND studies.subject_id != 2) 
group by student_id;
CREATE VIEW MeritLists as Select  students.name, (select cls from shrenies where shrenies.id = students.shreny_id) as  class, roll, reg, 
		(sum(marks.thmark + marks.prmark)) as tot6subj, min(marks.thmark + marks.prmark) as totminsubj, (sum(marks.thmark + marks.prmark)- min(marks.thmark + marks.prmark)) as tot5subj
from students, studies, subjects, marks
where studies.student_id = students.id and 
      studies.subject_id = subjects.id and 
	  marks.study_id = studies.id
	  
group by students.reg
order by tot5subj desc;
COMMIT;
