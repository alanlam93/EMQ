ALTER TABLE `emq`.`inventory` 
ADD COLUMN `brand` VARCHAR(45) NOT NULL AFTER `is_best_seller`;

UPDATE `emq`.`inventory` SET `brand`='Apple' WHERE `id`='1';
UPDATE `emq`.`inventory` SET `brand`='HP' WHERE `id`='2';
UPDATE `emq`.`inventory` SET `brand`='Samsung' WHERE `id`='3';
UPDATE `emq`.`inventory` SET `brand`='Samsung' WHERE `id`='4';
UPDATE `emq`.`inventory` SET `brand`='Sennheiser' WHERE `id`='5';
UPDATE `emq`.`inventory` SET `brand`='ASUS' WHERE `id`='6';
UPDATE `emq`.`inventory` SET `brand`='Nvidia' WHERE `id`='7';
UPDATE `emq`.`inventory` SET `brand`='Intel' WHERE `id`='8';
UPDATE `emq`.`inventory` SET `brand`='Logitech' WHERE `id`='9';
UPDATE `emq`.`inventory` SET `brand`='Bose' WHERE `id`='10';
UPDATE `emq`.`inventory` SET `brand`='Canon' WHERE `id`='11';
UPDATE `emq`.`inventory` SET `brand`='Vizio' WHERE `id`='12';
UPDATE `emq`.`inventory` SET `brand`='Fitbit' WHERE `id`='13';
UPDATE `emq`.`inventory` SET `brand`='Epson' WHERE `id`='14';
UPDATE `emq`.`inventory` SET `brand`='DJI' WHERE `id`='15';
