SELECT 
	country_id,
	DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d') AS `date`, 
    count(1) AS `total_registrations` 
FROM `user` 
GROUP BY DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d'), country_id