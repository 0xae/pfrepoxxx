SELECT 
	country_id,
	convert(DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d'), date) AS `date`, 
    count(1) AS `total_registrations` 
FROM `user` 
GROUP BY DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d'), country_id
