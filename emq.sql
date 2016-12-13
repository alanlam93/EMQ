SET FOREIGN_KEY_CHECKS=0;

--
-- Database: `emq`
--
CREATE DATABASE IF NOT EXISTS `emq` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `emq`;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `default_addr_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `acc_idx` (`id`) USING BTREE,
  UNIQUE KEY `email_idx` (`email`) USING BTREE,
  KEY `addr_fk` (`default_addr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account
-- ----------------------------

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `accountId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address_id` (`id`) USING BTREE,
  KEY `acc_index` (`accountId`) USING BTREE,
  CONSTRAINT `address_fk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `accountId` int(11) NOT NULL,
  `itemId` int(11) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(3) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountId`,`itemId`),
  UNIQUE KEY `acc_idx` (`accountId`,`itemId`) USING BTREE,
  KEY `cart_fk_2` (`itemId`),
  CONSTRAINT `cart_fk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_fk_2` FOREIGN KEY (`itemId`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Apple');
INSERT INTO `category` VALUES ('2', 'Laptop');
INSERT INTO `category` VALUES ('3', 'VR');
INSERT INTO `category` VALUES ('4', 'TV');
INSERT INTO `category` VALUES ('5', 'Headphones');
INSERT INTO `category` VALUES ('6', 'Monitor');
INSERT INTO `category` VALUES ('7', 'GPU');
INSERT INTO `category` VALUES ('8', 'CPU');
INSERT INTO `category` VALUES ('9', 'Mouse');
INSERT INTO `category` VALUES ('10', 'Camera');
INSERT INTO `category` VALUES ('11', 'Soundbar');
INSERT INTO `category` VALUES ('12', 'Fitness Tracker');
INSERT INTO `category` VALUES ('13', 'Printer');
INSERT INTO `category` VALUES ('14', 'Drones');

-- ----------------------------
-- Table structure for inventory
-- ----------------------------
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(10000) NOT NULL DEFAULT '',
  `product_features` varchar(10000) NOT NULL DEFAULT '',
  `specifications` varchar(10000) NOT NULL DEFAULT '',
  `img_src` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL,
  `is_best_seller` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `brand` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `itemId_idx` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inventory
-- ----------------------------
INSERT INTO `inventory` VALUES ('1', '1', 'Apple - 9.7-Inch iPad Pro with WiFi - 128GB - Space Gray', 'MLMV2LL/A', '\"The 9.7-inch iPad Pro delivers an unprecedented combination \nof portability and performance. At just 6.1mm thin and weighing \nless than a pound, iPad Pro features the brightest, most \nadvanced Retina display ever with True Tone, advanced sensors \nthat adjust the display to your environment for even more \ncomfortable viewing. It has a powerful A9X chip with 64-bit\ndesktop-class architecture, four speaker audio, advanced iSight \nand FaceTime HD cameras, Touch ID fingerprint sensor, ultrafast \nWi-Fi connectivity, and up to 10 hours of battery life. When you \nadd Apple Pencil with its pixel-perfect precision, and the \nincredibly thin Smart Keyboard, iPad Pro becomes even more versatile.\"', '\"9.7-inch Retina display with anti-reflective coating (diagonal)\nA9X third-generation chip with 64-bit desktopclass architecture\nTouch ID fingerprint sensor\n12MP iSight camera with 4K video\n5MP FaceTime HD camera\n802.11ac Wi-Fi with MIMO\nUp to 10 hours of battery life¹\nFour speaker audio\n* Apple Pencil and Smart Keyboard sold separately.\n¹ Battery life varies by use and configuration.\"', '\"Key Specs\nDisplay TypeOther\nScreen Size9.7 inches\nTouch Screen  Yes\nOperating System  Apple iOS 9\nInternet ConnectivityWi-Fi\nProcessor BrandApple\nProcessor Model  A9X chip with 64?bit architecture, M9 coprocessor\nScreen Resolution  2048 x 1536\nStorage Capacity  128 gigabytes\"', 'img/products/ipad.jpg', '599.99', '1', 'Apple');
INSERT INTO `inventory` VALUES ('2', '2', 'HP - Spectre x360 2-in-1 13.3\" Touch-Screen Laptop - Intel \nCore i7 - 8GB Memory - 256GB Solid State Drive - Silver', '13-W013DX', '\"Choose this HP Spectre notebook for a versatile and \nproductive computing experience. It offers 8GB of DDR3 \nSDRAM for fast response times while you\'re multitasking, \nand its convertible touch screen monitor doubles as a \ntablet. This HP Spectre notebook manages the most \ndemanding applications with the power of its 2.7GHz Intel \ni7 processor.\"', '\"Product Features\n\nWindows 10 operating system\nWindows 10 brings back the Start Menu from Windows 7 and introduces new features, like the Edge Web browser that lets you markup Web pages on your screen. Learn more ›\n13.3\"\" multitouch screen\nBrightView glossy screen maintains the vivid colors in your photos and videos. 1920 x 1080 FHD resolution. LED backlight.\n7th generation Intel® Core™ i7-7500U mobile processor\nUltra-low-voltage platform. Dual-core processing performance. Intel Turbo Boost Technology delivers dynamic extra power when you need it.\n8GB system memory for intense multitasking\nReams of high-bandwidth LPDDR3 RAM to smoothly run your graphics-heavy PC games and video-editing applications, as well as numerous programs and browser tabs all at once.\n256GB solid state drive (SSD)\nWhile offering less storage space than a hard drive, a flash-based SSD has no moving parts, resulting in faster start-up times and data access, no noise, and reduced heat production and power draw on the battery.\n360° flip-and-fold design\nOffers versatile functionality with laptop, audience, tabletop, presentation and tablet modes.\nIntel® HD Graphics 620\nOn-processor graphics with shared video memory provide everyday image quality for Internet use, basic photo editing and casual gaming.\nBang & Olufsen sound with quad speakers\nCreate a virtual surround sound experience for your music, movies, streaming Web content and games.\nWeighs 2.85 lbs. and is 0.54\"\" thin\nUltraportable design, featuring a smaller screen size to achieve the compact form factor.\nUp to 14 hours and 45 minutes of batterry life\nLong operation time with the built-in battery.\nBluetooth 4.2 interface synchronizes with compatible devices\nWirelessly transfer photos, music and other media between the laptop and your Bluetooth-enabled cell phone or MP3 player, or connect Bluetooth wireless accessories.\nThunderbolt port for connecting advanced monitors and external drives\nThis single interface supports both high-speed data and high-def video - plus power over cable for bus-powered devices - ideal for digital content creators.\n2 USB Type-C ports and 1 USB 3.1 port maximize the latest high-speed devices\nOne of the ports is equipped with Power-off Charging to power USB devices, even if the laptop is off.\nUSB 3.1 port is backward-compatible with USB 2.0 devices (at 2.0 speeds).\nWireless-AC connectivity (2x2)\nBuilt-in high-speed wireless LAN, so it connects to your network or hotspots using all current Wi-Fi standards in both laptop and tablet modes.\nBuilt-in HP TrueVision FHD IR webcam with two microphones\nMakes it easy to video chat with family and friends or teleconference with colleagues over Skype or other popular applications.\nBacklit keyboard for easy typing in dim or dark locations\nTouchpad with scroll and multitouch capability.\nSoftware package\nIncludes HP ePrint; HP Support Assistant; Netflix; HP Recovery Manager; McAfee® LiveSafe™ with a free 30-day trial.\nNote: This laptop does not include a built-in DVD/CD drive.\nIntel, Pentium, Celeron, Core, Atom, Ultrabook, Intel Inside and the Intel Inside logo are trademarks or registered trademarks of Intel Corporation or its subsidiaries in the United States and other countries\"', '\"Key Specs\nHard Drive Capacity256 gigabytes\nHard Drive Type  Solid State Drive\nIncluded SoftwareHP ePrint; HP Support Assistant; \nNetflix; HP Recovery Manager; McAfee® LiveSafe™ with a \nfree 30-day trial.\nOperating System  Windows 10\nProcessor BrandIntel\nProcessor Speed  2.7 gigahertz\nProcessor Model  Intel 7th Generation Core i7\nSystem Memory (RAM)  8 gigabytes\nWireless Networking  Wireless-B, Wireless-A, Wireless-G, \nWireless-N, Wireless-AC\nBattery Life  14 hours\nScreen Size13.3 inches\nEmbedded Mobile BroadbandNone\"', 'img/products/hp-spectre.jpg', '1159.99', '1', 'HP');
INSERT INTO `inventory` VALUES ('3', '3', 'Samsung - Gear VR for Select Samsung Cell Phones - Blue Black', 'SM-R323NBKAXAR', 'Immerse yourself in virtual reality fun with your Galaxy device and these Samsung Gear VR goggles. Whether you want to experience movies on the big screen or enter your favorite gaming world, simply snap in a smartphone to make it possible. These Samsung Gear VR goggles are also lightweight and padded for comfort.', '\"Product Features\n\nCompatible with select Samsung phones\nIncluding Galaxy Note7, Galaxy S7, Galaxy S7 edge, Galaxy Note5, Galaxy S6 edge+, Galaxy S6 and Galaxy S6 edge cell phones require a software update from your carrier.\nTake your adventures with you.\nThe Gear VR turns your Samsung Galaxy smartphone into a completely portable and wireless virtual reality machine as soon by snapping your phone into the headset.\nPowered by Oculus\nWith technology from Oculus, the leader in virtual reality, exploring your environment feels completely natural. The Gear VR provides the smoothest virtual reality experience of any mobile device.\nGet in, game on\nGaming on the Gear VR is like nothing else you’ve ever done. You’ll feel like you’ve stepped right into the action of your favorite games, including Minecraft and EVE: Gunjack.\nEndless entertainment\nHours of 360° adventures await. Tour the world, go to the hottest concerts and hang with celebrities. There’s something new to discover every day.\n© 2015 Samsung Electronics America, Inc. Samsung, Galaxy, Note, Gear, Samsung Milk VR, and Super AMOLED are all trademarks owned or registered by Samsung Electronics Co., Ltd.\"', '\"Key Specs\nSensorsGyro Sensor, Proximity Sensor\nControl TypeTouch pad\"', 'img/products/gear.jpg', '99.99', '1', 'Samsung');
INSERT INTO `inventory` VALUES ('4', '4', 'Samsung - 55\" Class (54.6\" Diag.) - LED - 2160p - Smart - 4K Ultra HD TV - Black', 'UN55KU6300FXZA', 'Samsung UN55KU6300FXZA LED Smart 4K Ultra HD TV: Enjoy taking in the beautiful colors and imagery on your Samsung UHD TV. It has an expansive 55-inch screen, 2160p resolution and a 120Hz refresh rate so you can enjoy smooth images without stuttering. Add a laptop, gaming console or Blu-ray player by connecting it to one of the different ports on the Samsung UHD TV.', '\"Product Features\n\n54.6\"\" screen (measured diagonally from corner to corner)\nA great size for a living room or mid-sized home theater space.\nLED TVs perform well in all lighting conditions\nThey also deliver plasma-like deep blacks and rich colors.\n2160p resolution for breathtaking HD images\nWatch 4K movies and TV shows at 4x the resolution of Full HD, and upscale your current HD content to gorgeous, Ultra HD-level picture quality.\nMotion Rate 120\nEnjoy high-speed action with good motion clarity.\nBuilt-in Wi-Fi Smart TV means a huge world of entertainment\nStream movies, music and more using Smart Hub, and surf your favorite websites with the included Web browser. All apps in one place – and you only need one remote control for it all.\nPurColor technology\nBrings you closer to what nature intended with accurate expression of color in life-like detail.\nConnectShare Movie\nPlug your favorite entertainment and media into your TV – watch videos, play music, or view photos through a USB connection.\nSmart View 2.0\nWatch your TV entertainment on your mobile device – or your mobile media on your TV.\nAdvanced TV sound\nTwo 10W front speakers. Dolby Digital Plus and DTS Premium Sound 5.1 decoding.\n3 HDMI inputs for the best home theater connection\nHigh-speed HDMI delivers a full 1080p picture and digital surround sound in one convenient cable. HDMI cable not included.\n2 USB inputs\nEasily connect your digital camera, camcorder or other USB device.\nWeb-based services and content require high-speed Internet service. Some services may require a subscription.\"', '\"Key Specs\nTV Tuner  Digital\nSmart Capable  Yes\nDisplay TypeLED\nNumber Of USB Port(s)2\nResolution (Native)  3840 x 2160 (4K)\nScreen Size54.6 inches\"', 'img/products/uhd-tv.jpg', '749.99', '1', 'Samsung');
INSERT INTO `inventory` VALUES ('5', '5', 'Sennheiser - HD 800 S Over-the-Ear Headphones - Black', 'HD 800 S', 'Experience high-quality sound with these Sennheiser high resolution headphones, featuring handmade fiber earpads for comfortable listening. Two connection leads offer balanced sound, letting you connect to dual outputs for true stereo sound. These Sennheiser high resolution headphones feature absorber technology that filters sound and eliminates unwanted peaks which may inhibit pure sound enjoyment.\r\nExperience high-quality sound with these Sennheiser high resolution headphones, featuring handmade fiber earpads for comfortable listening. Two connection leads offer balanced sound, letting you connect to dual outputs for true stereo sound. These Sennheiser high resolution headphones feature absorber technology that filters sound and eliminates unwanted peaks which may inhibit pure sound enjoyment.', '\"Product Features\n\nOver-the-ear design\nFor a secure fit.\n4Hz - 51kHz frequency response\nFor faithful sound reproduction.\n300 ohms impedance\nTo efficiently conduct power.\nDynamic transducer design\nFor reference-grade audio.\"', '\"Key Specs\nHeadphone FitOver-the-Ear\nWirelessNo\nBuilt-In BluetoothNo\"', 'img/products/hd-800-s.jpg', '1699.98', '1', 'Sennheiser');
INSERT INTO `inventory` VALUES ('6', '6', 'Asus - ROG SWIFT PG248Q 24\" 3D LED HD GSync Monitor - Black', 'PG248Q', 'Dive into your games on this ASUS full HD monitor, and experience the lag-free fun offered by a blazing fast 180Hz refresh rate. LED backlighting offers clear views from any angle, and full HD delivers on crisp, true-to-life imaging. This ASUS full HD monitor is made for gaming with a slim bezel that easily incorporates with your multi-monitor setup.', '\"Product Features\n\n1920 x 1080 resolution at 180Hz\nDelivers crystal-clear picture quality with stunning detail.\nUltrafast 1 ms response time\nAllows pixels to change colors quickly to avoid streaking, blurring and ghosting in fast-moving scenes and video games.\n24\"\" antiglare widescreen flat-panel LED monitor\nProvides a large viewing area and clear images.\nG-SYNC technology for smooth gameplay\nNVIDIA G-SYNC synchronizes the refresh rates between the GPU and display, eliminating screen tearing and minimizing display stutter and input lag.\nHDMI and DisplayPort inputs\nAllow you to set up DVD players and other AV sources for a clear, high quality audio and video signal.\n2 USB 3.0 ports\nLet you access data stored on a compatible flash drive or connect a mouse, keyboard or other peripheral.\n170° horizontal and 160° vertical viewing angles\nEnsure a clear view of the monitor from multiple vantage points.\n1000:1 contrast ratio\nProvides a high number of shades between black and white. This range enables accurate color reproduction when displaying images with extreme differences between light and dark for excellent picture quality.\n350 cd/m² brightness\nOffers an enhanced view, even in low lighting.\"', '\"Key Specs\nInput(s)DisplayPort, USB 3.0, HDMI\nRefresh Rate  180Hz\nMaximum Resolution1920 x 1080\nResolution (Native)  1920 x 1080\nResponse Time  1 milliseconds\nScreen Size24 inches\"', 'img/products/asus-rog-monitor.jpg', '449.99', '1', 'ASUS');
INSERT INTO `inventory` VALUES ('7', '7', 'NVIDIA - Founders Edition GeForce GTX 1080 8GB GDDR5X PCI Express 3.0 Graphics Card', '9001G4132500001', 'Play the world and incredible definition with the GeForce GTX 1080 graphics card. Designed to cope with 4K gaming, high frame rates and exquisite detail, the Pascal GPU architecture takes the GDDR5 memory inside this card to a whole new level. Get every last drop of performance from your machine with this GeForce GTX 1080 graphics card.', '\"Powered by the NVIDIA GeForce GTX 1080 graphics processing unit (GPU)\nWith a 1607MHz clock speed and 1733MHz boost clock speed to help meet the needs of demanding games.\n8GB GDDR5X (256-bit) on-board memory\nPlus 2560 CUDA processing cores and up to 320GB/sec. of memory bandwidth provide the memory needed to create striking visual realism.\nPCI Express 3.0 interface\nOffers compatibility with a range of systems. Also includes DVI-D, HDMI and 3 x DisplayPort outputs for expanded connectivity.\nNVIDIA Ansel\nRevolutionary new 360-degree image capture.\nNVIDIA SLI-ready\nTransmits synchronization, display and pixel data for reliable connection between GPUs (additional graphics cards not included).\nNVIDIA G-SYNC technology\nScenes appear instantly, objects look sharper, and gameplay is super smooth, giving you a stunning visual experience and a serious competitive edge\nMicrosoft DirectX 12\nSupport for the latest Microsoft DirectX API to enable next-generation gaming.\nOpenGL 4.5 Support\nSupporting the latest standards in the OpenGL API.\nVulkan API\nA next generation graphics and compute API from Khronos Group that provides high-efficiency, cross-platform access to modern GPUs.\"', '\"Key Specs\nInterface(s)  PCI Express 3.0\n4K Ultra HD Resolution SupportYes\nCooling SystemAir\nFeatured TechnologyDirectX 12, NVIDIA CUDA, NVIDIA G-SYNC, NVIDIA GameStream, NVIDIA PhysX, NVIDIA SLI\nGPU Clock Speed1607 megahertz\nGraphics Processing Unit (GPU)  NVIDIA GeForce GTX 1080\nVideo Memory Capacity8 gigabytes\nVideo Memory TypeGDDR5X\nGPU Boost Clock Speed1733 megahertz\"', 'img/products/gtx-1080.jpg', '699.99', '1', 'Nvidia');
INSERT INTO `inventory` VALUES ('8', '8', 'Intel® - Core™ i7-6700K 4.0GHz Processor - Silver', 'BX80662I76700K', 'Enhance your gaming setup with this Intel® Core™ i7-6700K BX80662I76700K processor, which offers Intel® Turbo Boost and a 6MB L3 cache for efficiency. Enjoy your favorite videos in 4K Ultra HD resolution when paired with a compatible monitor.', '\"Intel® Core™ i7-6700K processor\nWith 4.0GHz processor speed for smooth quad-core performance. Intel® Turbo Boost offers a boost of power when you need it and energy efficiency when you don\'t.\n6MB Level 3 cache\nSpeeds up access to frequently used data.\nSupports 4096 x 2304 4K Ultra HD resolution\nFor crisp, life-like images.\nIntel® HD Graphics 530\nProvides smooth videos and graphics.\nSupports DDR4 and DDR3L memory\nFor flexibility to suit your computing needs.\nIntel, Pentium, Celeron, Centrino, Intel Inside and the Intel Inside logo are trademarks or registered trademarks of Intel Corporation or its subsidiaries in the United States and other countries.\"', '\"Processor Speed  4.0 gigahertz\nENERGY STAR Certified  No\nBrand CompatibilityIntel\nModel CompatibilityIntel 100-series chipset motherboards\nProcessor SocketSocket LGA 1151\nCache LevelL3\nCache Memory  6 megabytes\nGraphics  Intel HD Graphics 530\nIntegrated GraphicsYes\nCompatible Platform(s)Windows\nProcessor CoresQuad-core\nTurbo Boost Processor Speed4.2 gigahertz\nKey Specs\nProcessor Speed  4.0 gigahertz\nENERGY STAR Certified  No\nBrand CompatibilityIntel\nModel CompatibilityIntel 100-series chipset motherboards\nProcessor SocketSocket LGA 1151\nCache LevelL3\nCache Memory  6 megabytes\nGraphics  Intel HD Graphics 530\nIntegrated GraphicsYes\nCompatible Platform(s)Windows\nProcessor CoresQuad-core\nTurbo Boost Processor Speed4.2 gigahertz\"', 'img/products/i7.jpg', '365.99', '1', 'Intel');
INSERT INTO `inventory` VALUES ('9', '9', 'Logitech - G700s Rechargeable Laser Gaming Mouse - Black', '910-003584', 'Enjoy precision control during gameplay with this Logitech G700s 910-003584 rechargeable gaming mouse that features 13 programmable buttons for quick access to commands and a dual-mode scrolling wheel for easy operation.', '\"Product Features\n\nLaser technology\nEnsures precise operation.\nDual-mode scrolling wheel\nEnables smooth transitions between click-to-click mode and hyper-fast scrolling.\n13-button design\nOffers programmability for frequently used commands.\nOn-board memory\nLets you store up to 5 ready-to-play profiles.\nWireless USB connectivity\nPermits a flexible range of motion while gaming.\n5.9\' USB recharging/data cable\nSwitches to data-over-cable mode when you connect the mouse to allow for continuous gameplay.\"', '\"Key Specs\nCompatible Platform(s)Windows\nWirelessYes\"', 'img/products/g700s.jpg', '99.99', '1', 'Logitech');
INSERT INTO `inventory` VALUES ('10', '5', 'Bose® - QuietComfort® 35 wireless headphones - Black', 'QC35 WIRELESS HDPH BLACK', 'QuietComfort® 35 wireless headphones are engineered with world-class noise cancellation that makes quiet sound quieter and music sound better. Free yourself from wires and connect easily to your devices with Bluetooth® and NFC pairing. And enjoy up to 20 hours of wireless listening per battery charge.', '\"Product Features\n\nWorld-class noise cancellation makes quiet sound quieter and music sound better.\nBluetooth® and NFC pairing so you can connect to your devices wirelessly.\nVolume-optimized EQ gives you balanced audio performance at any volume.\nLithium-ion battery lets you enjoy up to 20 hours of wireless listening per charge.\nNoise-rejecting dual-microphone system provides clear calls, even in windy or noisy environments.\nPremium materials make them lightweight and comfortable for all-day listening.\nThe Bose® Connect app helps you manage your paired devices and gives you a personalized experience.\"', '\"Key Specs\nHeadphone FitOver-the-Ear\nWirelessYes\nBuilt-In BluetoothYes\nBuilt-In MicrophoneYes\nNoise Canceling  Yes\"', 'img/products/qc35.jpg', '349.99', '1', 'Bose');
INSERT INTO `inventory` VALUES ('11', '10', 'Canon - EOS Rebel T5 DSLR Camera with 18-55mm and 75-300mm Lenses - Black', '9126B069', '\"Capture vivid photos and videos with this Canon EOS Rebel T5 DSLR camera that features 18.0-megapixel CMOS sensor that captures up to 5184 x 3456 resolution for high-quality images. The wide array of shooting modes let you optimize your shots to suit your needs.\n\nMemory card sold separately. \"', '\"Product Features\n\n18.0-megapixel APS-C CMOS sensor\nCaptures high-resolution images up to 5184 x 3456 pixels.\nEF-S 18-55mm f/3.5-5.6 IS and EF 75-300mm f/4-5.6 III lenses included\nTo enable shooting in a wide variety of situations.\n3\"\" TFT-LCD monitor\nProvides a clear view of your shots.\nEOS full high-definition movie mode\nHelps you capture quality videos.\n3 fps (frames per second)\nFor continuous shooting.\nISO 100-6400 (expandable to 12,800)\nFor shooting in most lighting conditions.\n9-point AF system\nIncluding 1 center cross-type AF point and AI Servo AF, helps ensure fast autofocus performance and accuracy.\nViewfinder\nLets you quickly and easily frame your shots.\nBuilt-in flash\nEnables you to take pictures in a variety of conditions.\nCanon DIGIC 4 imaging processor\nProvides fast, high-quality processing.\nWide selection of shooting modes\nIncludes program AE, shutter-priority AE, aperture-priority AE, manual exposure, Scene Intelligent Auto, flash off, creative auto, portrait, landscape, close-up, sports and more.\nScene Intelligent Auto mode\nOptimizes settings and improves results when shooting at night.\nMedia slot\nSupports SD, SDHC and SDXC cards.\"', '\"Key Specs\nTotal Megapixels  18.7 megapixels\nEffective Megapixels  18.0 megapixels\nFrame Rate3 frames per second\nImage Sensor Type  CMOS\nISO Settings  100-6400\nWi-Fi Built-inNo\"', 'img/products/dslr.jpg', '449.99', '1', 'Canon');
INSERT INTO `inventory` VALUES ('12', '11', 'VIZIO - 2.0-Channel Soundbar with Bluetooth - Black', 'SB2920-D6', 'Enjoy crisp, clear sound at every turn with the help of this Vizio 29-inch sound bar. It boasts a sophisticated design that will accentuate your high-definition television, and it\'s built to work with televisions of all sizes. Experience true Dolby Digital and DTS surround sound with this Vizio 29-inch sound bar.', '\"Product Features\n\n91 dB sound output\nWith <1% total harmonic distortion for crystal-clear, room-filling audio.\nBuilt-in Bluetooth\nMakes it easy to enjoy tracks stored on a compatible Bluetooth-enabled device.\nSound Bar features DTS TruVolume™ and DTS TruSurround™\nThe Sound Bar features DTS TruVolume™, which minimizes the distractions of fluctuating volume and DTS TruSurround™ for an immersive surround sound experience.\nRemote\nAllows you to adjust the volume and audio and switch inputs from across the room.\"', '\"Key Specs\nInput(s)USB\nBluetooth Enabled  Yes\nNumber Of HDMI Inputs0\nNumber Of HDMI Outputs0\"', 'img/products/soundbar.jpg', '89.99', '1', 'Vizio');
INSERT INTO `inventory` VALUES ('13', '12', 'Fitbit - Alta Activity Tracker (Small) - Black', 'FB406BKS', 'Fitbit Alta Activity Tracker: Maintain a healthy, active lifestyle with help from this wireless activity tracker, which tracks your steps, distance, calories burned, active minutes and sleep patterns for 24/7 monitoring. A wireless sync dongle is included for easy connectivity to your Windows, Apple or Android device.', '\"Product Features\n\nKeep track of daily activity levels\nMeasures steps taken, distance traveled and calories burned.\nEasy viewing in low-light conditions\nBacklit OLED display.\nAdjustable strap\nFits comfortably on most wrists from 5.5\"\" to 6.7\"\" in circumference.\nSyncs to select Apple, Android and Windows devices\nSuch as iPhone, iPad, iPod touch and cell phones and tablets with Android or Windows for simple wireless communication.\nWater-resistant design\nSo you don\'t have to worry if you wear it in the shower or get caught in the rain.\nApple, the Apple logo and iTunes are trademarks of Apple Computer, Inc., registered in the U.S. and other countries. iPod is a trademark of Apple Computer, Inc.\niPad is a trademark of Apple Inc., registered in the U.S. and other countries\"', '\"Key Specs\nColorBlack\nBody Metrics MeasuredCalories burned, Distance traveled, Other, Steps taken\nGPS EnabledNo\nMobile Operating System CompatibilityAndroid, Apple iOS, Windows\nWater ResistantYes\nDisplay TypeOther\"', 'img/products/fitbit.jpg', '129.95', '1', 'Fitbit');
INSERT INTO `inventory` VALUES ('14', '13', 'Epson - WorkForce WF-3640 Wireless All-In-One Printer - Black', 'C11CD16201', 'Epson WorkForce WF-3640 All-In-One Printer: Complete a variety of projects using this all-in-one printer, which enables you to create 1- and 2-sided documents and photos, plus copy, scan and fax. Simply connect your computer or mobile device via built-in Wi-Fi to get started, or enjoy a wired connection with the built-in Ethernet LAN.', '\"Product Features\n\nInkjet printers are best for home or small business use\nThey offer excellent print quality for photos and documents and accept a variety of paper types and sizes.\nWireless and mobile printing capability\nConnect this printer to your home or office network with built-in Ethernet or wireless LAN with Wi-Fi Direct. Plus, print from your mobile device with Epson Connect or Apple® AirPrint.\nUp to 4800 x 1200 optimized dpi (dots per inch) resolution\nHigh resolution for producing incredible quality and detail in documents and photos.\n4 individual print cartridges are economical\nOnly replace ink cartridges (black, cyan, magenta and yellow) when a color runs out. DURABrite Ultra pigment ink resists smudging, fading and moisture damage, so you can create long-lasting prints.\nLarge paper trays for your high-volume printing\nReload less often with the two 250-sheet input trays and 1-sheet rear specialty tray. Print, copy, scan and fax 1- or 2-sided documents with the 35-sheet automatic document feeder.\n3.5\"\" color touch screen\nLets you easily navigate features and choose settings.\nMore connectivity options\nBuilt-in memory card slots and 1 USB port let you simply plug in your SD, SDHC, SDXC, microSDXC, miniSD, miniSDHC, microSD, microSDHC, MS Duo, MS Duo MagicGate, MS PRO Duo or other compatible memory card or computer.\nApple, the Apple logo, iPod, iPad and Apple AirPrint are trademarks of Apple Computer, Inc., registered in the U.S. and other countries.\"', '\"Key Specs\nMobile Device PrintingYes\nNetworkingWireless\nPrinter ConnectivityApple AirPrint\nPrinter TypeAll In One\nMinimum System RequirementsWindows 8 (32-bit, 64-bit), Windows 7 (32-bit, 64-bit), Windows Vista (32-bit, 64-bit), Windows XP SP3 (32-bit), Windows XP Professional x64 Edition, Mac OS X 10.5.8 - 10.9.x7\"', 'img/products/printer.jpg', '119.99', '1', 'Epson');
INSERT INTO `inventory` VALUES ('15', '14', 'DJI - Phantom 4 Quadcopter - White', 'CP.PT.000312', '\"Get a bird\'s-eye view of the world with this DJI Phantom 4 camera drone. Offering unrivaled image quality and maneuverability, this camera drone includes smart object avoidance and easy control using your iPhone or iPad. You can also select a target with this DJI Phantom 4 camera drone and track it automatically. Fly Responsibly:\nThe FAA requires operators of unmanned aircraft weighing more than 0.55 pounds (250 grams) on takeoff (including everything on board or attached), and operating outdoors, be registered at www.faa.gov/uas/registration. If you are under age 13, you must have a parent or someone age 13 or older register for you. \nAdditional state or local requirements may apply. Check your local jurisdiction. The following websites may help you make informed decisions about how regulations impact you: www.knowbeforeyoufly.org and www.modelaircraft.org. \n\nSome manufacturers recommend minimum age requirements for operating certain models of unmanned aircrafts. See the Specifications tab on this page for the Recommended Minimum Age for this product.\nAdd to Cart\n$1,199.99\nON SALE\nSAVE $200 (Reg. $1,399.99)\nFREE 2-DAY SHIPPING\non orders $35 and up\nBuild A Bundle\nAdd to List\nAdd to Registry\nShipping: FREE Two Day\nGet it by 10/29/2016 for 95101  Edit\nOrder by 3:00 p.m. CT on 10/27/2016\nStore Pickup:\nOrder today, pick up at:\nMILPITAS CA - Pick up 10/27/2016\nCheck More Stores\nLearn more about store pickup\nQUESTIONS?\nBlue Assist Help center\nGet Answers Online\nDJI Phantom 4 Quadcopter with Lowepro DroneGuard CS 400 Quadcopter Case - largeImageSee (3) Package Deals That Include This Item\nSpecial Offers\n$64.99 Select Media Software with Device\nCardholder Offers\n18-Month Financing\n6-Month Financing\nGet 5% Back in Rewards\nCustomers Who Viewed This Item Also Viewed\"', '\"Product Features\n\nFlying camera\nUse the included controller and propellers to take aerial photos and videos. Includes a 16GB microSD card for easy file storage.\nAuto takeoff and auto return home\nWith GPS technology make controlling the unit simple. Download the monitoring/camera operation app for additional control.\nCapture 4K ultra HD video at 30 fps\nFor breathtaking footage. Shoot 12.0MP (4000 x 3000) photos. The f/2.8 lens with a 94° field of view delivers crisp, clear images.\nGimbal stabilization technology\nAlong with a hover function allows you to capture smooth, clean footage while the camera is in the air.\nCreate and share videos\nDownload DJI director software with a built-in video editor to add music, text, and more to your videos.\"', '\"Key Specs\nApp-ControlledYes\nWireless Range16368 feet\nMaximum Flight Time (no payload)28 minutes\nIntegrated GPSYes\nIntegrated CameraYes\nProduct Weight3.04 pounds\nVideo Resolution  4096 x 2160\nTotal Megapixels  12 megapixels\"', 'img/products/drone.jpg', '1199.99', '1', 'DJI');

-- ----------------------------
-- Table structure for inventory_quantity
-- ----------------------------
DROP TABLE IF EXISTS `inventory_quantity`;
CREATE TABLE `inventory_quantity` (
  `warehouse_id` int(11) unsigned NOT NULL,
  `item_id` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`,`item_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `inventory_quantity_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse_address` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inventory_quantity_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `accountId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address_pt1` varchar(255) NOT NULL,
  `address_pt2` varchar(255) NOT NULL,
  `warehouseId` int(11) unsigned NOT NULL DEFAULT '0',
  `total` decimal(10,2) unsigned NOT NULL,
  `last4` int(4) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Processing','Shipping','Shipped','Delivered') NOT NULL,
  `est_speed` double(13,10) unsigned NOT NULL DEFAULT '20.0000000000',
  PRIMARY KEY (`id`),
  KEY `order_idx_1` (`accountId`) USING BTREE,
  KEY `order_idx_2` (`warehouseId`) USING BTREE,
  CONSTRAINT `order_fk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`),
  CONSTRAINT `order_fk_2` FOREIGN KEY (`warehouseId`) REFERENCES `warehouse_address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `accountId` int(11) NOT NULL,
  `orderId` int(11) unsigned NOT NULL,
  `itemId` int(11) unsigned NOT NULL,
  `quantity` int(3) unsigned NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`accountId`,`orderId`,`itemId`),
  KEY `order_items_fk_2` (`itemId`),
  KEY `order_items_fk_3` (`orderId`),
  CONSTRAINT `order_items_fk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_fk_2` FOREIGN KEY (`itemId`) REFERENCES `inventory` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_fk_3` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_items
-- ----------------------------

-- ----------------------------
-- Table structure for warehouse_address
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_address`;
CREATE TABLE `warehouse_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` mediumint(5) unsigned NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `long` float(10,6) DEFAULT NULL,
  `phone` char(14) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `warehouse_idx` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of warehouse_address
-- ----------------------------
INSERT INTO `warehouse_address` VALUES ('1', '', '5604 Bay St', 'Emeryville', 'CA', '94608', '37.833500', '-122.292839', '(510) 428-0129');
INSERT INTO `warehouse_address` VALUES ('2', 'Union Landing Shopping Center', '31350 Courthouse Dr', 'Union City', 'CA', '94587', '37.601173', '-122.064224', '(510) 687-4103');
INSERT INTO `warehouse_address` VALUES ('3', '', '1333 N California Blvd', 'Walnut Creek', 'CA', '94596', '37.898266', '-122.063782', '(925) 555-6684');
INSERT INTO `warehouse_address` VALUES ('4', '', '1817 Somersville Rd', 'Antioch', 'CA', '94509', '38.003323', '-121.837791', '(925) 321-4788');
INSERT INTO `warehouse_address` VALUES ('5', '', '250 W Maude Ave', 'Sunnyvale', 'CA', '94085', '37.388546', '-122.028366', '(866) 754-9660');
INSERT INTO `warehouse_address` VALUES ('6', 'The Plant', '2179 Monterey Highway', 'San Jose', 'CA', '95125', '37.303547', '-121.866898', '(408) 988-4862');
INSERT INTO `warehouse_address` VALUES ('7', '', '2309 Noriega St', 'San Francisco', 'CA', '94122', '37.753513', '-122.488441', '(415) 531-4995');
INSERT INTO `warehouse_address` VALUES ('8', '', '896 Valencia St', 'San Francisco', 'CA', '94110', '37.758629', '-122.421593', '(415) 679-0510');
INSERT INTO `warehouse_address` VALUES ('9', '', '1901 Junipero Serra Blvd', 'Daly City', 'CA', '94014', '37.702538', '-122.470375', '(650) 439-8882');
INSERT INTO `warehouse_address` VALUES ('10', '', '3520 S El Camino Real', 'San Mateo', 'CA', '94403', '37.535412', '-122.296776', '(650) 284-7965');

-- ----------------------------
-- Update Product Information
-- ---------------------------- 
UPDATE `emq`.`inventory` SET `description`='The 9.7-inch iPad Pro delivers an unprecedented combination \nof portability and performance. At just 6.1mm thin and weighing \nless than a pound, iPad Pro features the brightest, most \nadvanced Retina display ever with True Tone, advanced sensors \nthat adjust the display to your environment for even more \ncomfortable viewing. It has a powerful A9X chip with 64-bit\ndesktop-class architecture, four speaker audio, advanced iSight \nand FaceTime HD cameras, Touch ID fingerprint sensor, ultrafast \nWi-Fi connectivity, and up to 10 hours of battery life. When you \nadd Apple Pencil with its pixel-perfect precision, and the \nincredibly thin Smart Keyboard, iPad Pro becomes even more versatile.', `product_features`='9.7-inch Retina display with anti-reflective coating (diagonal)\nA9X third-generation chip with 64-bit desktopclass architecture\nTouch ID fingerprint sensor\n12MP iSight camera with 4K video\n5MP FaceTime HD camera\n802.11ac Wi-Fi with MIMO\nUp to 10 hours of battery life¹\nFour speaker audio\n* Apple Pencil and Smart Keyboard sold separately.\n¹ Battery life varies by use and configuration.', `specifications`='Key Specs\nDisplay Type Other\nScreen Size 9.7 inches\nTouch Screen  Yes\nOperating System  Apple iOS 9\nInternet Connectivity Wi-Fi\nProcessor Brand Apple\nProcessor Model  A9X chip with 64-bit architecture, M9 coprocessor\nScreen Resolution  2048 x 1536\nStorage Capacity  128 gigabytes' WHERE `id`='1';
UPDATE `emq`.`inventory` SET `description`='Choose this HP Spectre notebook for a versatile and \nproductive computing experience. It offers 8GB of DDR3 \nSDRAM for fast response times while you\'re multitasking, \nand its convertible touch screen monitor doubles as a \ntablet. This HP Spectre notebook manages the most \ndemanding applications with the power of its 2.7GHz Intel \ni7 processor.', `product_features`='Product Features\n\nWindows 10 operating system\nWindows 10 brings back the Start Menu from Windows 7 and introduces new features, like the Edge Web browser that lets you markup Web pages on your screen. Learn more ›\n13.3\"\" multitouch screen\nBrightView glossy screen maintains the vivid colors in your photos and videos. 1920 x 1080 FHD resolution. LED backlight.\n7th generation Intel® Core™ i7-7500U mobile processor\nUltra-low-voltage platform. Dual-core processing performance. Intel Turbo Boost Technology delivers dynamic extra power when you need it.\n8GB system memory for intense multitasking\nReams of high-bandwidth LPDDR3 RAM to smoothly run your graphics-heavy PC games and video-editing applications, as well as numerous programs and browser tabs all at once.\n256GB solid state drive (SSD)\nWhile offering less storage space than a hard drive, a flash-based SSD has no moving parts, resulting in faster start-up times and data access, no noise, and reduced heat production and power draw on the battery.\n360° flip-and-fold design\nOffers versatile functionality with laptop, audience, tabletop, presentation and tablet modes.\nIntel® HD Graphics 620\nOn-processor graphics with shared video memory provide everyday image quality for Internet use, basic photo editing and casual gaming.\nBang & Olufsen sound with quad speakers\nCreate a virtual surround sound experience for your music, movies, streaming Web content and games.\nWeighs 2.85 lbs. and is 0.54\"\" thin\nUltraportable design, featuring a smaller screen size to achieve the compact form factor.\nUp to 14 hours and 45 minutes of batterry life\nLong operation time with the built-in battery.\nBluetooth 4.2 interface synchronizes with compatible devices\nWirelessly transfer photos, music and other media between the laptop and your Bluetooth-enabled cell phone or MP3 player, or connect Bluetooth wireless accessories.\nThunderbolt port for connecting advanced monitors and external drives\nThis single interface supports both high-speed data and high-def video - plus power over cable for bus-powered devices - ideal for digital content creators.\n2 USB Type-C ports and 1 USB 3.1 port maximize the latest high-speed devices\nOne of the ports is equipped with Power-off Charging to power USB devices, even if the laptop is off.\nUSB 3.1 port is backward-compatible with USB 2.0 devices (at 2.0 speeds).\nWireless-AC connectivity (2x2)\nBuilt-in high-speed wireless LAN, so it connects to your network or hotspots using all current Wi-Fi standards in both laptop and tablet modes.\nBuilt-in HP TrueVision FHD IR webcam with two microphones\nMakes it easy to video chat with family and friends or teleconference with colleagues over Skype or other popular applications.\nBacklit keyboard for easy typing in dim or dark locations\nTouchpad with scroll and multitouch capability.\nSoftware package\nIncludes HP ePrint; HP Support Assistant; Netflix; HP Recovery Manager; McAfee® LiveSafe™ with a free 30-day trial.\nNote: This laptop does not include a built-in DVD/CD drive.\nIntel, Pentium, Celeron, Core, Atom, Ultrabook, Intel Inside and the Intel Inside logo are trademarks or registered trademarks of Intel Corporation or its subsidiaries in the United States and other countries', `specifications`='Key Specs\nHard Drive Capacity 256 gigabytes\nHard Drive Type  Solid State Drive\nIncluded Software HP ePrint; HP Support Assistant; \nNetflix; HP Recovery Manager; McAfee® LiveSafe™ with a \nfree 30-day trial.\nOperating System  Windows 10\nProcessor Brand Intel\nProcessor Speed  2.7 gigahertz\nProcessor Model  Intel 7th Generation Core i7\nSystem Memory (RAM)  8 gigabytes\nWireless Networking  Wireless-B, Wireless-A, Wireless-G, \nWireless-N, Wireless-AC\nBattery Life  14 hours\nScreen Size 13.3 inches\nEmbedded Mobile Broadband None' WHERE `id`='2';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nCompatible with select Samsung phones\nIncluding Galaxy Note7, Galaxy S7, Galaxy S7 edge, Galaxy Note5, Galaxy S6 edge+, Galaxy S6 and Galaxy S6 edge cell phones require a software update from your carrier.\nTake your adventures with you.\nThe Gear VR turns your Samsung Galaxy smartphone into a completely portable and wireless virtual reality machine as soon by snapping your phone into the headset.\nPowered by Oculus\nWith technology from Oculus, the leader in virtual reality, exploring your environment feels completely natural. The Gear VR provides the smoothest virtual reality experience of any mobile device.\nGet in, game on\nGaming on the Gear VR is like nothing else you’ve ever done. You’ll feel like you’ve stepped right into the action of your favorite games, including Minecraft and EVE: Gunjack.\nEndless entertainment\nHours of 360° adventures await. Tour the world, go to the hottest concerts and hang with celebrities. There’s something new to discover every day.\n© 2015 Samsung Electronics America, Inc. Samsung, Galaxy, Note, Gear, Samsung Milk VR, and Super AMOLED are all trademarks owned or registered by Samsung Electronics Co., Ltd.', `specifications`='Key Specs\nSensors Gyro Sensor, Proximity Sensor\nControl Type Touch pad' WHERE `id`='3';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\n54.6\"\" screen (measured diagonally from corner to corner)\nA great size for a living room or mid-sized home theater space.\nLED TVs perform well in all lighting conditions\nThey also deliver plasma-like deep blacks and rich colors.\n2160p resolution for breathtaking HD images\nWatch 4K movies and TV shows at 4x the resolution of Full HD, and upscale your current HD content to gorgeous, Ultra HD-level picture quality.\nMotion Rate 120\nEnjoy high-speed action with good motion clarity.\nBuilt-in Wi-Fi Smart TV means a huge world of entertainment\nStream movies, music and more using Smart Hub, and surf your favorite websites with the included Web browser. All apps in one place – and you only need one remote control for it all.\nPurColor technology\nBrings you closer to what nature intended with accurate expression of color in life-like detail.\nConnectShare Movie\nPlug your favorite entertainment and media into your TV – watch videos, play music, or view photos through a USB connection.\nSmart View 2.0\nWatch your TV entertainment on your mobile device – or your mobile media on your TV.\nAdvanced TV sound\nTwo 10W front speakers. Dolby Digital Plus and DTS Premium Sound 5.1 decoding.\n3 HDMI inputs for the best home theater connection\nHigh-speed HDMI delivers a full 1080p picture and digital surround sound in one convenient cable. HDMI cable not included.\n2 USB inputs\nEasily connect your digital camera, camcorder or other USB device.\nWeb-based services and content require high-speed Internet service. Some services may require a subscription.', `specifications`='Key Specs\nTV Tuner  Digital\nSmart Capable  Yes\nDisplay Type LED\nNumber Of USB Port(s) 2\nResolution (Native)  3840 x 2160 (4K)\nScreen Size 54.6 inches' WHERE `id`='4';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nOver-the-ear design\nFor a secure fit.\n4Hz - 51kHz frequency response\nFor faithful sound reproduction.\n300 ohms impedance\nTo efficiently conduct power.\nDynamic transducer design\nFor reference-grade audio.', `specifications`='Key Specs\nHeadphone Fit Over-the-Ear\nWireless No\nBuilt-In Bluetooth No' WHERE `id`='5';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\n1920 x 1080 resolution at 180Hz\nDelivers crystal-clear picture quality with stunning detail.\nUltrafast 1 ms response time\nAllows pixels to change colors quickly to avoid streaking, blurring and ghosting in fast-moving scenes and video games.\n24\"\" antiglare widescreen flat-panel LED monitor\nProvides a large viewing area and clear images.\nG-SYNC technology for smooth gameplay\nNVIDIA G-SYNC synchronizes the refresh rates between the GPU and display, eliminating screen tearing and minimizing display stutter and input lag.\nHDMI and DisplayPort inputs\nAllow you to set up DVD players and other AV sources for a clear, high quality audio and video signal.\n2 USB 3.0 ports\nLet you access data stored on a compatible flash drive or connect a mouse, keyboard or other peripheral.\n170° horizontal and 160° vertical viewing angles\nEnsure a clear view of the monitor from multiple vantage points.\n1000:1 contrast ratio\nProvides a high number of shades between black and white. This range enables accurate color reproduction when displaying images with extreme differences between light and dark for excellent picture quality.\n350 cd/m² brightness\nOffers an enhanced view, even in low lighting.', `specifications`='Key Specs\nInput(s) Display Port, USB 3.0, HDMI\nRefresh Rate  180Hz\nMaximum Resolution 1920 x 1080\nResolution (Native)  1920 x 1080\nResponse Time  1 milliseconds\nScreen Size 24 inches' WHERE `id`='6';
UPDATE `emq`.`inventory` SET `product_features`='Powered by the NVIDIA GeForce GTX 1080 graphics processing unit (GPU)\nWith a 1607MHz clock speed and 1733MHz boost clock speed to help meet the needs of demanding games.\n8GB GDDR5X (256-bit) on-board memory\nPlus 2560 CUDA processing cores and up to 320GB/sec. of memory bandwidth provide the memory needed to create striking visual realism.\nPCI Express 3.0 interface\nOffers compatibility with a range of systems. Also includes DVI-D, HDMI and 3 x DisplayPort outputs for expanded connectivity.\nNVIDIA Ansel\nRevolutionary new 360-degree image capture.\nNVIDIA SLI-ready\nTransmits synchronization, display and pixel data for reliable connection between GPUs (additional graphics cards not included).\nNVIDIA G-SYNC technology\nScenes appear instantly, objects look sharper, and gameplay is super smooth, giving you a stunning visual experience and a serious competitive edge\nMicrosoft DirectX 12\nSupport for the latest Microsoft DirectX API to enable next-generation gaming.\nOpenGL 4.5 Support\nSupporting the latest standards in the OpenGL API.\nVulkan API\nA next generation graphics and compute API from Khronos Group that provides high-efficiency, cross-platform access to modern GPUs.', `specifications`='Key Specs\nInterface(s)  PCI Express 3.0\n4K Ultra HD Resolution Support Yes\nCooling System Air\nFeatured Technology DirectX 12, NVIDIA CUDA, NVIDIA G-SYNC, NVIDIA GameStream, NVIDIA PhysX, NVIDIA SLI\nGPU Clock Speed 1607 megahertz\nGraphics Processing Unit (GPU)  NVIDIA GeForce GTX 1080\nVideo Memory Capacity 8 gigabytes\nVideo Memory Type GDDR5X\nGPU Boost Clock Speed 1733 megahertz' WHERE `id`='7';
UPDATE `emq`.`inventory` SET `product_features`='Intel® Core™ i7-6700K processor\nWith 4.0GHz processor speed for smooth quad-core performance. Intel® Turbo Boost offers a boost of power when you need it and energy efficiency when you don\'t.\n6MB Level 3 cache\nSpeeds up access to frequently used data.\nSupports 4096 x 2304 4K Ultra HD resolution\nFor crisp, life-like images.\nIntel® HD Graphics 530\nProvides smooth videos and graphics.\nSupports DDR4 and DDR3L memory\nFor flexibility to suit your computing needs.\nIntel, Pentium, Celeron, Centrino, Intel Inside and the Intel Inside logo are trademarks or registered trademarks of Intel Corporation or its subsidiaries in the United States and other countries.', `specifications`='Key Specs\n\nProcessor Speed  4.0 gigahertz\nENERGY STAR Certified  No\nBrand Compatibility Intel\nModel Compatibility Intel 100-series chipset motherboards\nProcessor Socket Socket LGA 1151\nCache Level L3\nCache Memory  6 megabytes\nGraphics  Intel HD Graphics 530\nIntegrated Graphics Yes\nCompatible Platform(s) Windows\nProcessor Cores Quad-core\nTurbo Boost Processor Speed 4.2 gigahertz' WHERE `id`='8';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nLaser technology\nEnsures precise operation.\nDual-mode scrolling wheel\nEnables smooth transitions between click-to-click mode and hyper-fast scrolling.\n13-button design\nOffers programmability for frequently used commands.\nOn-board memory\nLets you store up to 5 ready-to-play profiles.\nWireless USB connectivity\nPermits a flexible range of motion while gaming.\n5.9\' USB recharging/data cable\nSwitches to data-over-cable mode when you connect the mouse to allow for continuous gameplay.', `specifications`='Key Specs\nCompatible Platform(s) Windows\nWireless Yes' WHERE `id`='9';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nWorld-class noise cancellation makes quiet sound quieter and music sound better.\nBluetooth® and NFC pairing so you can connect to your devices wirelessly.\nVolume-optimized EQ gives you balanced audio performance at any volume.\nLithium-ion battery lets you enjoy up to 20 hours of wireless listening per charge.\nNoise-rejecting dual-microphone system provides clear calls, even in windy or noisy environments.\nPremium materials make them lightweight and comfortable for all-day listening.\nThe Bose® Connect app helps you manage your paired devices and gives you a personalized experience.', `specifications`='Key Specs\nHeadphone Fit Over-the-Ear\nWireless Yes\nBuilt-In Bluetooth Yes\nBuilt-In Microphone Yes\nNoise Canceling  Yes' WHERE `id`='10';
UPDATE `emq`.`inventory` SET `description`='Capture vivid photos and videos with this Canon EOS Rebel T5 DSLR camera that features 18.0-megapixel CMOS sensor that captures up to 5184 x 3456 resolution for high-quality images. The wide array of shooting modes let you optimize your shots to suit your needs.\n\nMemory card sold separately. ', `product_features`='Product Features\n\n18.0-megapixel APS-C CMOS sensor\nCaptures high-resolution images up to 5184 x 3456 pixels.\nEF-S 18-55mm f/3.5-5.6 IS and EF 75-300mm f/4-5.6 III lenses included\nTo enable shooting in a wide variety of situations.\n3\"\" TFT-LCD monitor\nProvides a clear view of your shots.\nEOS full high-definition movie mode\nHelps you capture quality videos.\n3 fps (frames per second)\nFor continuous shooting.\nISO 100-6400 (expandable to 12,800)\nFor shooting in most lighting conditions.\n9-point AF system\nIncluding 1 center cross-type AF point and AI Servo AF, helps ensure fast autofocus performance and accuracy.\nViewfinder\nLets you quickly and easily frame your shots.\nBuilt-in flash\nEnables you to take pictures in a variety of conditions.\nCanon DIGIC 4 imaging processor\nProvides fast, high-quality processing.\nWide selection of shooting modes\nIncludes program AE, shutter-priority AE, aperture-priority AE, manual exposure, Scene Intelligent Auto, flash off, creative auto, portrait, landscape, close-up, sports and more.\nScene Intelligent Auto mode\nOptimizes settings and improves results when shooting at night.\nMedia slot\nSupports SD, SDHC and SDXC cards.', `specifications`='Key Specs\nTotal Megapixels  18.7 megapixels\nEffective Megapixels  18.0 megapixels\nFrame Rate 3 frames per second\nImage Sensor Type  CMOS\nISO Settings  100-6400\nWi-Fi Built-in No' WHERE `id`='11';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\n91 dB sound output\nWith <1% total harmonic distortion for crystal-clear, room-filling audio.\nBuilt-in Bluetooth\nMakes it easy to enjoy tracks stored on a compatible Bluetooth-enabled device.\nSound Bar features DTS TruVolume™ and DTS TruSurround™\nThe Sound Bar features DTS TruVolume™, which minimizes the distractions of fluctuating volume and DTS TruSurround™ for an immersive surround sound experience.\nRemote\nAllows you to adjust the volume and audio and switch inputs from across the room.', `specifications`='Key Specs\nInput(s) USB\nBluetooth Enabled  Yes\nNumber Of HDMI Inputs 0\nNumber Of HDMI Outputs 0' WHERE `id`='12';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nKeep track of daily activity levels\nMeasures steps taken, distance traveled and calories burned.\nEasy viewing in low-light conditions\nBacklit OLED display.\nAdjustable strap\nFits comfortably on most wrists from 5.5\"\" to 6.7\"\" in circumference.\nSyncs to select Apple, Android and Windows devices\nSuch as iPhone, iPad, iPod touch and cell phones and tablets with Android or Windows for simple wireless communication.\nWater-resistant design\nSo you don\'t have to worry if you wear it in the shower or get caught in the rain.\nApple, the Apple logo and iTunes are trademarks of Apple Computer, Inc., registered in the U.S. and other countries. iPod is a trademark of Apple Computer, Inc.\niPad is a trademark of Apple Inc., registered in the U.S. and other countries', `specifications`='Key Specs\nColor Black\nBody Metrics Measured Calories burned, Distance traveled, Other, Steps taken\nGPS Enabled No\nMobile Operating System Compatibility Android, Apple iOS, Windows\nWater Resistant Yes\nDisplay Type Other' WHERE `id`='13';
UPDATE `emq`.`inventory` SET `product_features`='Product Features\n\nInkjet printers are best for home or small business use\nThey offer excellent print quality for photos and documents and accept a variety of paper types and sizes.\nWireless and mobile printing capability\nConnect this printer to your home or office network with built-in Ethernet or wireless LAN with Wi-Fi Direct. Plus, print from your mobile device with Epson Connect or Apple® AirPrint.\nUp to 4800 x 1200 optimized dpi (dots per inch) resolution\nHigh resolution for producing incredible quality and detail in documents and photos.\n4 individual print cartridges are economical\nOnly replace ink cartridges (black, cyan, magenta and yellow) when a color runs out. DURABrite Ultra pigment ink resists smudging, fading and moisture damage, so you can create long-lasting prints.\nLarge paper trays for your high-volume printing\nReload less often with the two 250-sheet input trays and 1-sheet rear specialty tray. Print, copy, scan and fax 1- or 2-sided documents with the 35-sheet automatic document feeder.\n3.5\"\" color touch screen\nLets you easily navigate features and choose settings.\nMore connectivity options\nBuilt-in memory card slots and 1 USB port let you simply plug in your SD, SDHC, SDXC, microSDXC, miniSD, miniSDHC, microSD, microSDHC, MS Duo, MS Duo MagicGate, MS PRO Duo or other compatible memory card or computer.\nApple, the Apple logo, iPod, iPad and Apple AirPrint are trademarks of Apple Computer, Inc., registered in the U.S. and other countries.', `specifications`='Key Specs\nMobile Device Printing Yes\nNetworking Wireless\nPrinter Connectivity Apple AirPrint\nPrinter Type All In One\nMinimum System Requirements Windows 8 (32-bit, 64-bit), Windows 7 (32-bit, 64-bit), Windows Vista (32-bit, 64-bit), Windows XP SP3 (32-bit), Windows XP Professional x64 Edition, Mac OS X 10.5.8 - 10.9.x7' WHERE `id`='14';
UPDATE `emq`.`inventory` SET `description`='Get a bird\'s-eye view of the world with this DJI Phantom 4 camera drone. Offering unrivaled image quality and maneuverability, this camera drone includes smart object avoidance and easy control using your iPhone or iPad. You can also select a target with this DJI Phantom 4 camera drone and track it automatically. Fly Responsibly:\nThe FAA requires operators of unmanned aircraft weighing more than 0.55 pounds (250 grams) on takeoff (including everything on board or attached), and operating outdoors, be registered at www.faa.gov/uas/registration. If you are under age 13, you must have a parent or someone age 13 or older register for you. \nAdditional state or local requirements may apply. Check your local jurisdiction. The following websites may help you make informed decisions about how regulations impact you: www.knowbeforeyoufly.org and www.modelaircraft.org. \n', `product_features`='Product Features\n\nFlying camera\nUse the included controller and propellers to take aerial photos and videos. Includes a 16GB microSD card for easy file storage.\nAuto takeoff and auto return home\nWith GPS technology make controlling the unit simple. Download the monitoring/camera operation app for additional control.\nCapture 4K ultra HD video at 30 fps\nFor breathtaking footage. Shoot 12.0MP (4000 x 3000) photos. The f/2.8 lens with a 94° field of view delivers crisp, clear images.\nGimbal stabilization technology\nAlong with a hover function allows you to capture smooth, clean footage while the camera is in the air.\nCreate and share videos\nDownload DJI director software with a built-in video editor to add music, text, and more to your videos.', `specifications`='Key Specs\nApp-Controlled Yes\nWireless Range 16368 feet\nMaximum Flight Time (no payload) 28 minutes\nIntegrated GPS Yes\nIntegrated Camera Yes\nProduct Weight 3.04 pounds\nVideo Resolution  4096 x 2160\nTotal Megapixels  12 megapixels' WHERE `id`='15';