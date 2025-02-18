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
            background: #333;
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
            <th>Role</th>
        </tr>
    </thead>
    <tbody id="userTable"></tbody>
</table>

<?php
//Define the User interface (Blueprint for user types)
interface User {
    public function getRole();
}

//Create Concrete Classes (Admin and Guest)
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

//Factory Class to Create Users
class UserFactory {
public static function createUser($type, $name) {
    switch ($type) {
        case "admin":
            return ["name" => $name, "role" => (new Admin())->getRole()];
        case "guest":
            return ["name" => $name, "role" => (new Guest())->getRole()];
        default:
        throw new Exception("Invalid user type");
        }
    }
}
//Aggregate Pattern - Collection of Users
class UserCollection {
    private $users = [];

    public function addUser($user) {
        $this->users[] = $user;
    }

    public function removeUser($name) {
        $this->users = array_filter($this->users, function ($user) use ($name) {
            return $user["name"] !== $name;
        });
    }

    public function getUsers() {
        return $this->users;
    }
}
//Create UserCollection and Add Users
$userCollection = new UserCollection();
$userCollection->addUser(UserFactory::createUser("admin", "Alice"));
$userCollection->addUser(UserFactory::createUser("guest", "Bob"));
$userCollection->addUser(UserFactory::createUser("admin", "Charlie"));

//Use built-in functions to modify data
$users =  array_map(function($user) {
    return [
        "name" => strtoupper($user["name"]),
        "role" => $user["role"]
    ];
}, $userCollection->getUsers());
//Convert to Json for Javascript
echo "<script>let users = " . json_encode($users) . ";</script>";
?>

<script>
//Use JavaScript to manipulate and display the data
document.addEventListener("DOMContentLoaded", function () {
    let tableBody = document.getElementById("userTable");

    users.forEach(user => {
        let row = `<tr>
        <td>${user.name}</td>
        <td>${user.role}</td>
        </tr>`;
        tableBody.innerHTML += row;
    });
});
</script>

</body>
</html>