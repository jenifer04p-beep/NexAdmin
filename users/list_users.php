<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

require "../config/database.php";

$search = $_GET['search'] ?? "";
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$limit = 5;
$skip = ($page - 1) * $limit;

if (!empty($search)) {

    $filter = [
        '$or' => [
            ['name' => ['$regex' => $search, '$options' => 'i']],
            ['email' => ['$regex' => $search, '$options' => 'i']],
            ['phone' => ['$regex' => $search, '$options' => 'i']]
        ]
    ];

} else {

    $filter = [];

}

$totalUsers = $usersCollection->countDocuments($filter);

$totalPages = ceil($totalUsers / $limit);

$users = $usersCollection->find(
    $filter,
    [
        'limit' => $limit,
        'skip' => $skip,
        'sort' => [
            'created_at' => -1
        ]
    ]
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>User Management</title>
<link rel="stylesheet" href="css/style.css">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>User Management</h3>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-6">

<a href="add_user.php"
class="btn btn-success">

Add User

</a>

<a href="../dashboard.php"
class="btn btn-secondary">

Dashboard

</a>

</div>

<div class="col-md-6">

<form method="GET" class="d-flex">

<input
type="text"
name="search"
class="form-control me-2"
placeholder="Search Name / Email / Phone"
value="<?= htmlspecialchars($search) ?>">

<button class="btn btn-primary">

Search

</button>

</form>

</div>

</div>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Role</th>
<th width="180">Action</th>

</tr>

</thead>

<tbody>

<?php foreach($users as $user): ?>

<tr>

<td><?= htmlspecialchars($user['name'] ?? '-') ?></td>

<td><?= htmlspecialchars($user['email'] ?? '-') ?></td>

<td><?= htmlspecialchars($user['phone'] ?? '-') ?></td>

<td><?= htmlspecialchars($user['role'] ?? '-') ?></td>

<td>

<?php if(isset($user['_id'])): ?>

<a
href="edit_user.php?id=<?= $user['_id'] ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_user.php?id=<?= $user['_id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this user?')">

Delete

</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

<?php if($totalUsers==0): ?>

<tr>

<td colspan="5" class="text-center">

No Users Found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

<nav>

<ul class="pagination justify-content-center">

<?php if($page>1): ?>

<li class="page-item">

<a
class="page-link"
href="?search=<?= urlencode($search) ?>&page=<?= $page-1 ?>">

Previous

</a>

</li>

<?php endif; ?>

<?php for($i=1;$i<=$totalPages;$i++): ?>

<li class="page-item <?= ($page==$i)?'active':'' ?>">

<a
class="page-link"
href="?search=<?= urlencode($search) ?>&page=<?= $i ?>">

<?= $i ?>

</a>

</li>

<?php endfor; ?>

<?php if($page<$totalPages): ?>

<li class="page-item">

<a
class="page-link"
href="?search=<?= urlencode($search) ?>&page=<?= $page+1 ?>">

Next

</a>

</li>

<?php endif; ?>

</ul>

</nav>

</div>

</div>

</div>

</body>

</html>