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

-- ----------------------------
-- Records of inventory_quantity
-- ----------------------------
INSERT INTO `inventory_quantity` VALUES ('1', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('1', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('2', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('3', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('4', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('5', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('6', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('7', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('8', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('9', '15', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '1', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '2', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '3', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '4', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '5', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '6', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '7', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '8', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '9', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '10', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '11', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '12', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '13', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '14', '100');
INSERT INTO `inventory_quantity` VALUES ('10', '15', '100');

SET FOREIGN_KEY_CHECKS=1;