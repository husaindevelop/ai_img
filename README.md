## Prerequisites
Before running the project, please create ai_images database and images table by running the following sql queries in your database client for proper functioning of the application:


    CREATE DATABASE IF NOT EXISTS ai_images;  
    CREATE TABLE IF NOT EXISTS ai_images.`images` (
      `img_id` int(11) NOT NULL DEFAULT '0',
      `input` longtext,
      `created_at` datetime DEFAULT NULL,
      `updated_at` datetime DEFAULT NULL,
      PRIMARY KEY (`img_id`) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



