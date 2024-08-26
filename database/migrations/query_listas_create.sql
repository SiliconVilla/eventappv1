create view listas as 
SELECT 
        `activitys`.`id` AS `activity_id`,
        `activitys`.`event_id` AS `event_id`,
        DATE_FORMAT(`activitys`.`fecha`, '%Y') AS `anio`,
        DATE_FORMAT(`activitys`.`fecha`, '%W') AS `dia_sem`,
        DATE_FORMAT(`activitys`.`fecha`, '%d') AS `dia_mes`,
        DATE_FORMAT(`activitys`.`fecha`, '%b') AS `mes`,
        `activitys`.`actividad` AS `actividad`,
        `places`.`place` AS `lugar`,
        `places`.`latitud` AS `latitud`,
        `places`.`longitud` AS `longitud`,
        `activitys`.`descripcion` AS `descripcion`,
        DATE_FORMAT(`activitys`.`fecha`, '%r') AS `hora`,
        `activitys`.`fecha` AS `fechafull`,
        `events`.`imagen` AS `imagen`,
        `events`.`evento` AS `evento`,
        `events`.`estado_id` AS `estado_id`,
        `events`.`deleted_at` AS `deleted_at`,
        `events`.`updated_at` AS `updated_at`,
        `events`.`created_at` AS `created_at`
    FROM
        ((`activitys`
        JOIN `places` ON (`activitys`.`place_id` = `places`.`id`))
        JOIN `events` ON (`activitys`.`event_id` = `events`.`id`))
    WHERE
        `activitys`.`fecha` >= CURDATE()
    ORDER BY `activitys`.`id`