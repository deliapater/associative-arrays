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

        th,
        td {
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
    interface UserRoleStrategy
    {
        public function getRole();
    }

    //Concrete Strategies for different Roles
    class AdminRole implements UserRoleStrategy
    {
        public function getRole()
        {
            return "Admin";
        }
    }

    class GuestRole implements UserRoleStrategy
    {
        public function getRole()
        {
            return "Guest";
        }
    }
    class ModeratorRole implements UserRoleStrategy
    {
        public function getRole()
        {
            return "Moderator";
        }
    }

    //Context Class (User) That uses a Strategy Pattern
    class User
    {
        private $name;
        private $roleStrategy;

        public function __construct($name, UserRoleStrategy $roleStrategy)
        {
            $this->name = $name;
            $this->roleStrategy = $roleStrategy;
        }

        public function getUserData()
        {
            return [
                "name" => $this->name,
                "role" => $this->roleStrategy->getRole()
            ];
        }
    }
    //Aggregate Pattern - Collection of Users
    class UserCollection
    {
        private $users = [];

        public function addUser(User $user)
        {
            $this->users[] = $user->getUserData();
        }

        public function getUsers()
        {
            return $this->users;
        }
    }

    //Create UserCollection and Add Users with different Strategies
    $userCollection = new UserCollection();
    $userCollection->addUser(new User("Alice", new AdminRole()));
    $userCollection->addUser(new User("Bob", new GuestRole()));
    $userCollection->addUser(new User("Charlie", new ModeratorRole()));

    //Convert to Json for Javascript
    echo "<script>let users = " . json_encode($userCollection->getUsers()) . ";</script>";
    ?>

    <script>
    //Use JavaScript to manipulate and display the data
        document.addEventListener("DOMContentLoaded", function() {
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