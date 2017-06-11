ALTER TABLE `#__ncompcustomcode` 
CHANGE COLUMN `mainhtmldata` `mainhtmldata` TEXT NULL ,
ADD COLUMN `description` VARCHAR(45) NULL AFTER `id`,
ADD COLUMN `cssdata` TEXT NULL AFTER `mainhtmldata`,
ADD COLUMN `jsdata` TEXT NULL AFTER `cssdata`;

update `#__ncompcustomcode` set description = mainhtmldata;

ALTER TABLE `#__ncompcustomcode` 
CHANGE COLUMN `description` `description` VARCHAR(45) NOT NULL ;