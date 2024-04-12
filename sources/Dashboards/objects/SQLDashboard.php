<?php
Class SQLDashboard {
   protected function dataDashboard () {
    $select = "SELECT 
    DATE(dateReserve) AS DDay,
    consommations.name AS name_Consommation,
    SUM(numberPeople) AS number_Personnes_Consommation,
    COUNT(idConsommation) AS number_Consommation
        FROM 
            reserveTables
        INNER JOIN consommations ON consommations.id = idConsommation
        WHERE 
            dateReserve BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) AND reserveTables.valid = 1
        GROUP BY 
            DATE(dateReserve), idConsommation
        ORDER BY 
            DATE(dateReserve), idConsommation;";
    return ActionDB::select($select, [], 1);
   }
   protected function numberOfchairReserved () {
    $select = "SELECT
    DATE(dateReserve) AS DDay,
    SUM(CASE WHEN TIME(dateReserve) BETWEEN '09:00:00' AND '12:00:00' THEN numberPeople ELSE 0 END) AS Morning,
    SUM(CASE WHEN TIME(dateReserve) BETWEEN '14:00:00' AND '19:00:00' THEN numberPeople ELSE 0 END) AS Afternoon,
    SUM(CASE WHEN TIME(dateReserve) > '19:00:00' THEN numberPeople ELSE 0 END) AS Nigth
    FROM
        reserveTables
    WHERE
        dateReserve BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
    GROUP BY
        DATE(dateReserve)
    ORDER BY
        DATE(dateReserve);";
    return ActionDB::select($select, [], 1); 
   }
   protected function forecastInventoryManement () {
    $select = "SELECT 
    consommations.name AS name_Consommation,
    SUM(numberPeople) AS total_Personnes_Consommation,
    COUNT(idConsommation) AS number_Consommation
    FROM 
        reserveTables
    INNER JOIN consommations ON consommations.id = idConsommation
    WHERE 
        dateReserve BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) AND reserveTables.valid = 1
    GROUP BY 
        idConsommation
    ORDER BY 
        idConsommation;";
    return ActionDB::select($select, [], 1); 
   }
}