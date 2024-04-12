<?php
require('sources/Dashboards/objects/TemplateDashboard.php');
$displayDashboard = new TemplateDashboard ();
$displayDashboard->dashboardChairDayByDay();
$displayDashboard->displayDashboardConsommations ();
$displayDashboard->mamagementPurchase ();