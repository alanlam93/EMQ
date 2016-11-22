ALTER TABLE `order`
MODIFY COLUMN `status`  enum('Processing','Shipping','Shipped','Delivered') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `date`,
ADD COLUMN `est_speed`  double(13,10) UNSIGNED NOT NULL DEFAULT 20.0 AFTER `status`;