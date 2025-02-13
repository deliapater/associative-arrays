<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & JavaScript Associative Arrays</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: white;
            text-align: center;
            margin-top: 50px;
        }
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
            background`: #333;
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
        }
        th {
            background: #444;
        }
    </style>
</head>
<body>
<h2>User List (PHP → JavaScript)</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody id="userTable"></tbody>
</table>

<?php
// Step 1: Create an associative array in PHP
$users = array(
    array("name" => "Alice", "age" => 25, "country" => "USA"),
    array("name" => "Bob", "age" => 30, "country" => "UK"),
    array("name" => "Charlie", "age" => 28, "country" => "Canada"),
);

// Step 2: Use built-in functions to modify data
$users =  array_map(function($user) {
    return [
        "name" => strtoupper($user["name"]), // Convert name to uppercaase
        "age" => $user["age"],
        "country" => ucfirst($user["country"]) // Capitalize first letter
    ];
}, $users);
// Step 3: Convert PHP array to JSON and pass it to Javascript
$jsonData = json_encode($users);

echo "<script>let users = $jsonData;</script>";
?>

<script>
// Step 4: Use JavaScript to manipulate and display the data
document.addEventListener("DOMContentLoaded", function () {
    let tableBody = document.getElementById("userTable");

    users.forEach(user => {
        let row = `<tr>
        <td>${user.name}</td>
        <td>${user.age}</td>
        <td>${user.country}</td>
        </tr>`;
        tableBody.innerHTML += row;
    });
});
</script>

</body>
</html>