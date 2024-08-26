CREATE 
    
VIEW `proyectosusuario` AS
    SELECT 
        `levels`.`id` AS `level_id`,
        `levels`.`namenivel` AS `nivel`,
        `levels`.`deleted_at` AS `deleted_at`,/*,
        DATE_FORMAT(`activitys`.`fecha`, '%Y') AS `anio`,
        DATE_FORMAT(`activitys`.`fecha`, '%W') AS `dia_sem`,
        DATE_FORMAT(`activitys`.`fecha`, '%d') AS `dia_mes`,
        DATE_FORMAT(`activitys`.`fecha`, '%b') AS `mes`,*/
        `projects`.`id` AS `project_id`,
        `projects`.`name` AS `proyecto`,
        /*`places`.`latitud` AS `latitud`,
        `places`.`longitud` AS `longitud`,
        `activitys`.`descripcion` AS `descripcion`,
        DATE_FORMAT(`activitys`.`fecha`, '%r') AS `hora`,*/
        `users`.`name` AS `usuario`,
        `users`.`id` AS `user_id`
        /*`events`.`evento` AS `evento`,
        `events`.`estado_id` AS `estado_id`,
        `events`.`deleted_at` AS `deleted_at`,
        `events`.`updated_at` AS `updated_at`,
        `events`.`created_at` AS `created_at`*/
    FROM
        ((`project_user`
        JOIN `projects` ON (`project_user`.`project_id` = `projects`.`id`))
        JOIN `users` ON (`project_user`.`user_id` = `users`.`id`)
        JOIN `levels` ON (`project_user`.`level_id` = `levels`.`id`))
    /*WHERE
        `activitys`.`fecha` >= CURDATE()
    ORDER BY `activitys`.`id`*/