<?php
// Connect to body database
$database = new mysqli("localhost", "root", "", "orbital_bodies");
if ($database->connect_error) die("Connection Error");
