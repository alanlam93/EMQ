ALTER TABLE `order_items` DROP PRIMARY KEY, ADD PRIMARY KEY (`accountId`, `orderId`, `itemId`);
