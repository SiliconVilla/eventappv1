CREATE 
VIEW `registroasistencias` AS
    SELECT 
        `users`.`email` AS `email`,
        `users`.`name` AS `name`,
        `users`.`qrcode` AS `qrcode`,
        `activitys`.`actividad` AS `actividad`,
        `events`.`evento` AS `evento`,
        `activitys`.`id` AS `activity_id`,
        `activitys`.`event_id` AS `event_id`,
        
        `activitys`.`fecha` AS `fecha_actividad`,
        
        `asistencias`.`fecha` AS `fecha_registro`
    FROM
        (((`asistencias`
        JOIN `activitys` ON (`asistencias`.`activity_id` = `activitys`.`id`))
        JOIN `events` ON (`activitys`.`event_id` = `events`.`id`))
        JOIN `users` ON (`asistencias`.`user_id` = `users`.`id`))
    WHERE
        `activitys`.`fecha` >= CURDATE()
    ORDER BY `asistencias`.`id`