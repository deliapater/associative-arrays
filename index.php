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
//Step 1: Define the User interface (Blueprint for user types)
interface User {
    public function getRole();
}

//Step 2: Create Concrete Classes (Admin and Guest)
class Admin implements User {
    public function getRole() {
        return "Admin";
    }
}

class Guest implements User {
    public function getRole() {
        return "Guest";
    }
}

//Step 3: Factory Class to Create Users
class UserFactory {
public static function createUser($type) {
    switch ($type) {
        case "admin":
            return new Admin();
        case "guest":
            return new Guest();
        default:
        throw new Expection("Invalid user type");
        }
    }
}
//Step 4: Create Users using the Factory
$users = [
    ["name" => "Alice", "age" => 25, "country" => "UK", "role" => UserFactory::createUser("admin")->getRole()],
    ["name" => "Bob", "age" => 25, "country" => "Venezuela", "role" => UserFactory::createUser("guest")->getRole()]
];

//Step 5: Convert to Json for Javascript
echo "<script>let users = " . json_encode($users) . ";</script>";
//Step 6: Use built-in functions to modify data
$users =  array_map(function($user) {
    return [
        "name" => strtoupper($user["name"]), // Convert name to uppercaase
        "age" => $user["age"],
        "country" => ucfirst($user["country"]) // Capitalize first letter
    ];
}, $users);
?>

<script>
//Step 7: Use JavaScript to manipulate and display the data
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