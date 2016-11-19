SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `inventory` DROP COLUMN `rem_quantity`;
CREATE TABLE `inventory_quantity` (
`warehouse_id`  int(11) UNSIGNED NOT NULL ,
`item_id`  int(11) UNSIGNED NOT NULL ,
`quantity`  int(11) NOT NULL DEFAULT 0 ,
PRIMARY KEY (`warehouse_id`, `item_id`),
CONSTRAINT `inventory_quantity_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse_address` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT `inventory_quantity_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
INDEX `item_id` (`item_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
ROW_FORMAT=Compact
;
SET FOREIGN_KEY_CHECKS=1;